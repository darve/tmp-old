<?php

	// Ajax Submit
	// header("Content-Type: application/soap+xml; charset=utf-8");
	header('Content-Type: application/json;charset=utf-8');

	require '../api/vendor/autoload.php';
  $client = new \BaseCRM\Client(['accessToken' => '07628ce2f159982af41e49eb66e01eb083a47ce8fd175c2bb919f3211a416175']);

	$BaseCRMid = $_GET['id'];
  require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php' );
  define('WP_USE_THEMES', false);

	$midasConfig = array(
		'url'				=> 'https://apis.mab.org.uk/Midas.WS.LeadImporter/ImportServiceRest.svc/',
		'username' 	=> 'themortgagepeople',
		'password' 	=> 'aZQ63BdwhUWSr6bQ',
		'secret' 		=> 'jg84wfafwahjhkfy54y54y54h4h3j8i23ktliliuk23mjn32nt32kmnwg289u27t',
	);


	class midas{
		protected $config;
		protected $case_id;
		protected $MidasProCaseId;
		protected $ExternalCaseRef;
		protected $MidasProClientId;
		protected $ExternalClientRef;
		protected $MidasProAddressId;
		protected $ExternalAddressRef;
		protected $posted;
		protected $info;
		protected $baseData = array();

		function __construct($c, $data){
			$this->config['username'] = $c['username'];
			$this->config['password'] = $c['password'];
			$this->config['secret'] 	= $c['secret'];
			$this->config['url']			= $c['url'];
			$this->info = array(
				'MidasProCaseId' 						=> 0,
				'ExternalCaseRef' 					=> 0,
				'MidasProClientId' 					=> 0,
				'ExternalClientRef' 				=> 0,
				'MidasProAddressId' 				=> 0,
				'ExternalAddressRef' 				=> 0,
				'MidasProFactFindId' 				=> 0,
				'MidasProFactFindClientId' 	=> 0,
			);
			$this->testMode = false;
			$this->timestamp = date('U');
			$this->baseData = array($data);
		}
		protected function make_base_auth($u, $p){
			return base64_encode($u . ':' . $p);
		}
		protected function encodeQueryParams($params){
			$encoded = [];
			foreach ($params as $key => $value){
				if (is_array($value)){
					$encoded[$key] = $this->encodeQueryParams($value);
				} else {
					$encoded[$key] = $value;
				}
			}
			return $encoded;
		}
		public function dateformat($date, $micro = false){
			$date = explode('/', $date);
			$date = "{$date[1]}/{$date[0]}/{$date[2]}";
			if($micro == true){
				$date = date('U', strtotime($date)) * 1000;
				$date = "/Date({$date})/";
			}
			return $date;
		}
		public function number_format($number){
			$replace = array(',','.','£');
			$with = array('','','');
			$number = str_replace($replace, $with, $number);
			$number = number_format($number, 2, '.', '');
			return $number;
		}
		public function request($method, $path, $params = null){
			$method = strtolower($method);
			$url = 	$this->config['url'] . $path;
			$params = $params;
			$params['testMode'] = $this->testMode;
			// $params['emailAdviser'] = false;
			$params['Timestamp'] = (int)$this->timestamp;
			$defaultHeaders['Authorization'] 	= "Basic {$this->make_base_auth($this->config['username'], $this->config['password'])}";
			$defaultHeaders['Accept'] 				= 'application/json';
			$defaultHeaders['Content-Type'] 	= 'application/json';
			$defaultHeaders['Stamp'] 					= $params['Timestamp'];
			$defaultHeaders['Params'] 				= preg_replace('/["\']([0-9][0-9]{0,9}|10000?)+(\.[0-9][0-9]?)["\']/', '$1$2', stripslashes(json_encode($params, JSON_UNESCAPED_SLASHES)));
			// $defaultHeaders['Params'] 				= stripslashes(json_encode($params, JSON_UNESCAPED_SLASHES));
			$defaultHeaders['Signature'] 			= hash_hmac('sha256', $defaultHeaders['Params'], $this->config['secret']);

			$rawHeaders = array();
			foreach ($defaultHeaders as $header => $value){
				$rawHeaders[] = $header . ': ' . $value;
			}

			$curl = curl_init();

			switch ($method){
				case "post":
					curl_setopt($curl, CURLOPT_POST, TRUE);
					if ($params){
						curl_setopt($curl, CURLOPT_POSTFIELDS, $defaultHeaders['Params']);
					}
				break;
				default:
					if($params){
						$query = http_build_query($this->encodeQueryParams($params));
						$url = "{$url}?{$query}";
					}
				break;
			}

			curl_setopt($curl, CURLOPT_VERBOSE, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_USERPWD, $this->config['username'] . ':' . $this->config['password']);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $rawHeaders);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLINFO_HEADER_OUT, false);

			$resp = curl_exec($curl);
			$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);

			$array = array(
				'url' 				=> $url,
				'headers'			=> $defaultHeaders,
				'POST'				=> $params,
				'code'				=> $code,
				'data'				=> $resp
			);


			if($code == 200){
				$dataReturn = json_decode($resp);
				foreach ($dataReturn as $item) {
					foreach ($item as $info) {
						$this->info[$info->key] = $info->value;
					}
				}
				$array['responce'] = 'Successfully added ' . $path;
			} else {
				$array['responce'] = 'There was an error performing ' . $path;
			}
			return $array;
		}
		public function time_elapsed_string($time, $full = false){
			 $now = new DateTime;
			 $ago = new DateTime($time);
			 $diff = $now->diff($ago);
			 $diff->w = floor($diff->d / 7);
			 $diff->d -= $diff->w * 7;
			 $string = array(
					 'y' => '',
					 'm' => '',
					 'w' => '',
					 'd' => '',
					 'h' => '',
					 'i' => '',
					 's' => '',
			 );
			 foreach ($string as $k => &$v) {
					 if ($diff->$k) {
							 $v = $diff->$k;
					 } else {
							 unset($string[$k]);
					 }
			 }
			 if (!$full) $string = array_slice($string, 0, 1);
			 return $string;
		}
		public function setInternal($info){
			$newInfo = json_decode($info);
			foreach ($newInfo as $item) {
				foreach ($item as $info) {
					$this->info[$info->key] = $info->value;
				}
			}
		}
		public function getInternal($item){
			return $this->info[$item];
		}
		public function getItem($method, $item){
			$params['Timestamp'] = date('U');
			$params['integrationId'] = 4;
			$url = $this->config['url'] . $method;

			$defaultHeaders = [
				'Authorization' => "Basic {$this->make_base_auth($this->config['username'], $this->config['password'])}",
				'Content-Type' => 'application/json',
				'Stamp' => date('U'),
				'Params' => json_encode($params),
				'Signature' => hash_hmac('sha256', json_encode($params), $this->config['secret']),
			];

			$rawHeaders = array();
			foreach ($defaultHeaders as $header => $value){
				$rawHeaders[] = $header . ': ' . $value;
			}
			if ($params) {
				$query = http_build_query($this->encodeQueryParams($params));
				$url = "{$url}?{$query}";
			}
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_VERBOSE, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_USERPWD, $this->config['username'] . ':' . $this->config['password']);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $rawHeaders);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLINFO_HEADER_OUT, false);

			$resp = curl_exec($curl);
			$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			$resp = json_decode($resp);

			if(!empty($item)){
				$item = explode(' ', $item);
				if(isset($item[0])){
					for ($i=0; $i < count($resp); $i++) {
						if(isset($resp[$i]->Value)){
							if (strpos($resp[$i]->Value, $item[0]) !== false) {
								$return = (int)$resp[$i]->Key;
							}
						}
						if(isset($resp[$i]->Description)){
							if (strpos($resp[$i]->Description, $item[0] . ' ' . $item[1]) !== false) {
								$return = (int)$resp[$i]->Id;
							}
						}
					}
				} else {
					$return = (int)(count($resp) - 1);
				}
			} else {
				$return = (int)(count($resp) - 1);
			}
			if(empty($return)){
				$return = (count($resp) - 1);
			}
			$array = array(
				'url' 				=> $url,
				'headers'			=> $defaultHeaders,
				'POST'				=> $params,
				'resp'				=> json_encode($resp),
				'item'				=> $item,
				'data'				=> $return,
			);
			return $array;
		}
	}

$postdata = array();
$postdata['Timestamp'] = date('U');

// for ($i=0; $i < ; $i++) {
// 	# code...
// }


if($BaseCRMid){
		$baseData = $client->leads->get($BaseCRMid);
		$midas = new midas($midasConfig, $baseData);
		$error = array();

		if(!isset($baseData['title'])){$error[] = 'Please provide the applicants title';}
		if(!isset($baseData['first_name'])){$error[] = 'Please provide the applicants first name';}
		if(!isset($baseData['last_name'])){$error[] = 'Please provide the applicants last name';}
		if(!isset($baseData['custom_fields']['Date of Birth'])){$error[] = 'Please provide the applicants DOB';}
		if(!isset($baseData['email'])){$error[] = 'Please provide the applicants email address';}
		if(!isset($baseData['custom_fields']['Gender'])){$error[] = 'Please provide the applicants gender';}
		if(!isset($baseData['mobile'])){$error[] = 'Please provide the applicants mobile number';}
		if(!isset($baseData['custom_fields']['Marital Status'])){$error[] = 'Please provide the applicants marital status';}
		if(!isset($baseData['custom_fields']['Status at Current Address'])){$error[] = 'Please provide the applicants current address status';}
		if(!isset($baseData['address']['line1'])){$error[] = 'Please provide the applicants Address Line 1';}
		if(!isset($baseData['address']['city'])){$error[] = 'Please provide the applicants Address City';}
		if(!isset($baseData['address']['state'])){$error[] = 'Please provide the applicants Address State';}
		if(!isset($baseData['address']['postal_code'])){$error[] = 'Please provide the applicants Address Post Code';}

		if(isset($baseData['custom_fields']['Applicant 2 - Title'])){
			if(!isset($baseData['custom_fields']['Applicant 2 - DOB'])){$error[] = 'Please enter Applicant 2 - DOB';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Full Name'])){$error[] = 'Please enter Applicant 2 - Full Name';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Email Address'])){$error[] = 'Please enter Applicant 2 - Email Address';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Title'])){$error[] = 'Please enter Applicant 2 - Title';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Gender'])){$error[] = 'Please enter Applicant 2 - Gender';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Email Address'])){$error[] = 'Please enter Applicant 2 - Email Address';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Address'])){$error[] = 'Please enter Applicant 2 - Address';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Address'])){$error[] = 'Please enter Applicant 2 - DOB';}
			if(!isset($baseData['custom_fields']['Applicant 2 - City'])){$error[] = 'Please enter Applicant 2 - City';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Country'])){$error[] = 'Please enter Applicant 2 - Country';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Postal Code'])){$error[] = 'Please enter Applicant 2 - Postal Code';}
			if(!isset($baseData['custom_fields']['Applicant 2 - Status at Current Address'])){$error[] = 'Please enter Applicant 2 - Status at Current Address';}
		}

		if(empty($error)){
			$postdata = array();
			$postdata['lead']['lead'] = array();
			$postdata['lead']['lead']['ExtLeadId'] = time();
			$postdata['lead']['lead']['Comments'] = '';
			$postdata['lead']['lead']['ExtAgentName'] = $client->users->get($baseData['owner_id'])['name'];
			$postdata['lead']['lead']['ExtImportRef'] = time();
			$postdata['lead']['lead']['IntegrationId'] = '4';
			$postdata['lead']['lead']['LeadsourceBranchId'] = '2744';
			$postdata['lead']['lead']['LeadsourceId'] = '6374';
			$postdata['lead']['lead']['PreferredContactDay'] = 'Monday';
			$postdata['lead']['lead']['PreferredContactMethod'] = 'Email';
			$postdata['lead']['lead']['PreferredContactTime'] = 'AM';
			$postdata['lead']['lead']['ReferrerId'] = $midas->getItem('Referrers', $client->users->get($baseData['owner_id'])['name'])['data'];
			$postdata['lead']['lead']['AdviserId'] = '1454';
			$postdata['lead']['lead']['ExtCaseRef'] = time();
			$postdata['lead']['lead']['Clients'] = array(
				array(
					'TitleId' 				=> $midas->getItem('Titles', str_replace('.','', $baseData['title']))['data'] . '',
					'Firstname' 			=> $baseData['first_name'],
					'Lastname' 				=> $baseData['last_name'],
					'DoB' 						=> $midas->dateformat($baseData['custom_fields']['Date of Birth'], TRUE),
					'Email' 					=> $baseData['email'],
					'GenderId' 				=> $midas->getItem('Genders', str_replace('.','', $baseData['custom_fields']['Gender']))['data'] . '',
					'Homenumber' 			=> ($baseData['phone']) ? str_replace(array(' ','(',')'), array('','',''), $baseData['phone']):'',
					'Mobilenumber' 		=> str_replace(array(' ','(',')'), array('','',''), $baseData['mobile']),
					'MaritalStatusId' => $midas->getItem('MaritalStatuses', str_replace('-','', $baseData['custom_fields']['Marital Status']))['data'],
					'ExtClientRef' 		=> time(),
					'ContactMethods' 	=> array(
						array(
							'ContactMethodTypeId' => 5,
							'ContactValue' 				=> $baseData['email'],
							'PreferredMethod' 		=> 'true',
						),
						array(
							'ContactMethodTypeId' => 1,
							'ContactValue' 				=> str_replace(array(' ','(',')'), array('','',''), $baseData['mobile']),
							'PreferredMethod' 		=> 'false',
						),
					),
				),
			);
			$postdata['lead']['lead']['Addresses'] = array(
				array(
					'Address1' 					=> $baseData['address']['line1'],
					'County' 						=> $baseData['address']['state'],
					'ExtAddressRef'			=> time(),
					'Postcode' 					=> $baseData['address']['postal_code'],
					'PropertyStatusId' 	=> 1,
					'Town' 							=> $baseData['address']['city'],
				),
			);

			if(isset($baseData['custom_fields']['Applicant 2 - Title'])){
				$baseData['custom_fields']['Applicant 2 - DOB'] = explode('/', $baseData['custom_fields']['Applicant 2 - DOB']);

				$name = explode(' ', $baseData['custom_fields']['Applicant 2 - Full Name']);
				$postdata['lead']['lead']['Clients'][1] = array(
					'TitleId' 				=> $midas->getItem('Titles', str_replace('.','', $baseData['title']))['data'] . '',
					'Firstname' 			=> $name[0],
					'Lastname' 				=> $name[1],
					'DoB'							=> '/Date(' . (date('U', strtotime($baseData['custom_fields']['Applicant 2 - DOB'][2] . '-' . $baseData['custom_fields']['Applicant 2 - DOB'][1] . '-' . $baseData['custom_fields']['Applicant 2 - DOB'][0])) * 1000) . ')/',
					'Email' 					=> ($baseData['custom_fields']['Applicant 2 - Email Address']) ? $baseData['custom_fields']['Applicant 2 - Email Address']:'',
					'TitleId' 				=> $midas->getItem('Titles', str_replace('.','', $baseData['custom_fields']['Applicant 2 - Title']))['data'],
					'GenderId' 				=> $midas->getItem('Genders', str_replace('.','', $baseData['custom_fields']['Applicant 2 - Gender']))['data'],
					'MaritalStatusId' => $midas->getItem('MaritalStatuses', str_replace('-','', $baseData['custom_fields']['Applicant 2 - Marital Status']))['data'],
					'Mobilenumber' 		=> str_replace(array(' ','(',')'), array('','',''), $baseData['custom_fields']['Applicant 2 - Mobile Number']),
					'ExtClientRef' 		=> time(),
					'ContactMethods' 	=> array(
						array(
							'ContactMethodTypeId' => 5,
							'ContactValue' 				=> $baseData['custom_fields']['Applicant 2 - Email Address'],
							'PreferredMethod' 		=> 'true',
						),
						array(
							'ContactMethodTypeId' => 1,
							'ContactValue' 				=> str_replace(array(' ','(',')'), array('','',''), $baseData['custom_fields']['Applicant 2 - Mobile Number']),
							'PreferredMethod' 		=> 'false',
						),
					)
				);
				if(isset($baseData['custom_fields']['Applicant 2 - Address'])){
					$postdata['lead']['lead']['Addresses'][1] = array(
						'Address1' 					=> ($baseData['custom_fields']['Applicant 2 - Address']) ? $baseData['custom_fields']['Applicant 2 - Address']:'',
						'Town' 							=> ($baseData['custom_fields']['Applicant 2 - City']) ? $baseData['custom_fields']['Applicant 2 - City']:'',
						'County' 						=> ($baseData['custom_fields']['Applicant 2 - Country']) ? $baseData['custom_fields']['Applicant 2 - Country']:'',
						'Postcode' 					=> ($baseData['custom_fields']['Applicant 2 - Postal Code']) ? $baseData['custom_fields']['Applicant 2 - Postal Code']:'',
						'PropertyStatusId' 	=> 1,
						'ExtAddressRef'			=> time(),
					);
				}
			}
			echo '<pre style="display:none;">';
			var_dump($midas->request('POST', 'Lead', $postdata['lead']));
			echo '</pre>';

			// Do the fact factFind

			$postdata['mainFactFind']['factFind'] = array(
				'MidasProCaseId' 	=> $midas->getInternal('MidasProCaseId'),
				'ExternalCaseRef' => $midas->getInternal('ExternalCaseRef'),
				'IDDDeclaration' 	=> true,
				'IntegrationId' 	=> '4',
				'ExtImportRef' 		=> time(),
				'ExtFactFindId' 	=> time(),
			);
			$employment = explode('/',$baseData['custom_fields']['Date Started at Current Employment']);
			$timeWith = $midas->time_elapsed_string("{$employment[1]}/{$employment[0]}/{$employment[2]}");

			$postdata['mainFactFind']['factFind']['FactFindClients'] = array(
				array(
					'TitleId' 													=> $postdata['lead']['lead']['Clients'][0]['TitleId'],
					'FirstName' 												=> $postdata['lead']['lead']['Clients'][0]['Firstname'],
					'LastName' 													=> $postdata['lead']['lead']['Clients'][0]['Lastname'],
					'DateOfBirth' 											=> $postdata['lead']['lead']['Clients'][0]['DoB'],
					'MaritalStatusId' 									=> $postdata['lead']['lead']['Clients'][0]['MaritalStatusId'],
					'GenderId' 													=> $postdata['lead']['lead']['Clients'][0]['GenderId'],
					'NINumber' 													=> '',
					'MidasProClientId' 									=> (isset($postdata['lead']['lead']['Clients'][1])) ? ($midas->getInternal('MidasProClientId') - 1):$midas->getInternal('MidasProClientId'),
					'ExternalClientRef' 								=> $postdata['lead']['lead']['Clients'][0]['ExtClientRef'] . '',
					'ClientSaleFolderId' 								=> time(),
					'FactFindId' 												=> $postdata['mainFactFind']['factFind']['ExtImportRef'] . '',
					'RetirementAge' 										=> 67,
					'ResidentialStatus' 								=> $midas->getItem('ResidentialStatuses', $baseData['custom_fields']['Status at Current Address'])['data'],
					'ResidentialStatusTypeDescription' 	=> $postdata['lead']['lead']['Clients'][0]['TitleId'] . '',
					'UKResident' 												=> true,
					'PermanentRightToReside' 						=> ($baseData['custom_fields']['Indefinite Leave to Remain?'] == 'Yes') ? TRUE:FALSE,
					'ResidentialDetails' 								=> '',
					'Nationality' 											=> $baseData['custom_fields']['Nationality'],
					'Smoker' 														=> ($baseData['custom_fields']['Smoker'] == 'Yes') ? TRUE:FALSE,
					'Guarantor' 												=> false,
					'GIOccupationTypeId' 								=> time(),
					'GIIndustryTypeId' 									=> time(),
					'IDDDeclarationDate' 								=> '/Date(' . (date('U') * 1000) . ')/',
					'AppointmentType' 									=> 1,
					'AppointmentTypeDescription' 				=> '',
					'SalarySacrifices' 									=> ($baseData['custom_fields']['Child Care Costs'] >= 1 || $baseData['custom_fields']['Student Loan Payments'] >= 1) ? TRUE:FALSE,
					// 'SacrificePension' 								=> str_replace(',','',number_format(0, 2)),
					// 'SacrificeStudentLoan' 						=> str_replace(',','',number_format($baseData['custom_fields']['Student Loan Payments'], 2)),
					// 'SacrificeChildcare' 							=> str_replace(',','',number_format($baseData['custom_fields']['Child Care Costs'], 2)),
					// 'SacrificeCarLease' 								=> str_replace(',','',number_format(0, 2)),
					'OtherIncome'												=> array(),
					'EmploymentDetails' 								=> array(
						array(
							'Id' => time(),
							'FactFindClientId' 					=> time(),
							'EmploymentStatus'	 				=> ($baseData['custom_fields']['Self Employed']) ? 1:6,
							'NameOfEmployer' 	 					=> $baseData['custom_fields']['Name of Employer App 1'],
							'EmployersAddress' 					=> $baseData['custom_fields']['Employers Address App 1'],
							'MainEmployment'						=> True,
							'Occupation' 								=> $baseData['custom_fields']['Occupation'],
							'JobTitle' 									=> $baseData['custom_fields']['Occupation'],
							'OccupationId'							=> time() . '',
							'EmploymentStartDate' 			=> $midas->dateformat($baseData['custom_fields']['Date Started at Current Employment'], true),
							'TimeWithEmployerYears'			=> (isset($timeWith['y'])) ? $timeWith['y']:0,
							'TimeWithEmployerMonths'		=> (isset($timeWith['m'])) ? $timeWith['m']:0,
							'Accountant'								=> '',
							'NoOfYearsAccounts'					=> '',
							'NoOfYearsAccounts'					=> '',
							'YearlyAccountsYearEndDate'	=> '',
							'ContractEnds'							=> '',
							'Year1Profit'								=> '',
							'Year2Profit'								=> '',
							'Year3Profit'								=> '',
							'NetMonthlyIncome' 					=> str_replace(',','',number_format(($baseData['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)'] / 12), 2)),
							'EmploymentIncome' 					=> array(
								array(
									'Id' => time(),
									'FactFindClientEmploymentDetailsId' => time(),
									'IncomeType' => 1,
									'FactFindClientEmploymentIncomeTypeDescription' => time(),
									'GrossAnnualIncome' => str_replace(',','',number_format($baseData['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)'],2)),
									'IncomeTypeOtherDescription' => '',
								),
							),
							'EmploymentStatusType' 			=> 'Working',
						),
					),
					'ClientName' => $baseData['title'] .' '. $postdata['lead']['lead']['Clients'][0]['Firstname'] .' '. $postdata['lead']['lead']['Clients'][0]['Lastname'],
				),
			);
			if($baseData['custom_fields']['Other Income'] != 0){
				$postdata['mainFactFind']['factFind']['FactFindClients'][0]['OtherIncome'] = array(
					array(
						'IncomeType' => $midas->getItem('EmploymentOtherIncomeTypes', false)['data'],
						'MonthlyIncomeAmount' => str_replace(',','',number_format($baseData['custom_fields']['Other Income'], 2)),
					)
				);
			}

			if(isset($baseData['custom_fields']['Applicant 2 - Title'])){
				$employment = explode('/', $baseData['custom_fields']['Applicant 2 - Date Started at Current Employment']);
				$timeWith = $midas->time_elapsed_string("{$employment[1]}/{$employment[0]}/{$employment[2]}");
				$postdata['mainFactFind']['factFind']['FactFindClients'][] = array(
					'TitleId' 													=> $postdata['lead']['lead']['Clients'][1]['TitleId'],
					'FirstName' 												=> $postdata['lead']['lead']['Clients'][1]['Firstname'],
					'LastName' 													=> $postdata['lead']['lead']['Clients'][1]['Lastname'],
					'DateOfBirth' 											=> $postdata['lead']['lead']['Clients'][1]['DoB'],
					'MaritalStatusId' 									=> $postdata['lead']['lead']['Clients'][1]['MaritalStatusId'],
					'GenderId' 													=> $postdata['lead']['lead']['Clients'][1]['GenderId'],
					'NINumber' 													=> '',
					'MidasProClientId' 									=> $midas->getInternal('MidasProClientId'),
					'ExternalClientRef' 								=> $postdata['lead']['lead']['Clients'][1]['ExtClientRef'] + 1 . '',
					'ClientSaleFolderId' 								=> time(),
					'FactFindId' 												=> $postdata['mainFactFind']['factFind']['ExtImportRef'],
					'RetirementAge' 										=> 65,
					'ResidentialStatus' 								=> $midas->getItem('ResidentialStatuses', $baseData['custom_fields']['Status at Current Address'])['data'],
					'ResidentialStatusTypeDescription' 	=> $postdata['lead']['lead']['Clients'][1]['TitleId'] . '',
					'UKResident' 												=> true,
					'PermanentRightToReside' 						=> ($baseData['custom_fields']['Applicant 2 - Indefinite Leave to Remain?'] == 'Yes') ? TRUE:FALSE,
					'ResidentialDetails' 								=> '',
					'Nationality' 											=> $baseData['custom_fields']['Applicant 2 - Nationality'],
					'Smoker' 														=> ($baseData['custom_fields']['Applicant 2 - Smoker'] == 'Yes') ? TRUE:FALSE,
					'Guarantor' 												=> false,
					'GIOccupationTypeId' 								=> time(),
					'GIIndustryTypeId' 									=> time(),
					'IDDDeclarationDate' 								=> '/Date(' . (date('U') * 1000) . ')/',
					'AppointmentType' 									=> 1,
					'AppointmentTypeDescription' 				=> '',
					'SalarySacrifices' 									=> ($baseData['custom_fields']['Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)'] >= 1 || $baseData['custom_fields']['Applicant 2 - Student Loan Payments'] >= 1) ? TRUE:FALSE,
					// 'SacrificePension' 									=> str_replace(',','',number_format(0, 2)),
					// 'SacrificeStudentLoan' 							=> str_replace(',','',number_format($baseData['custom_fields']['Applicant 2 - Student Loan Payments'], 2)),
					// 'SacrificeChildcare' 								=> str_replace(',','',number_format($baseData['custom_fields']['Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)'], 2)),
					// 'SacrificeCarLease' 								=> str_replace(',','',number_format(0, 2)),
					'OtherIncome'												=> array(),
					'EmploymentDetails' 								=> array(
						array(
							'Id' => time(),
							'FactFindClientId' 					=> time() + 1,
							'EmploymentStatus'	 				=> ($baseData['custom_fields']['Applicant 2 - Self Employed']) ? 1:6,
							'NameOfEmployer' 	 					=> $baseData['custom_fields']['Name of Employer App 2'],
							'EmployersAddress' 					=> $baseData['custom_fields']['Employers Address App 2'],
							'MainEmployment'						=> True,
							'Occupation' 								=> $baseData['custom_fields']['Applicant 2 - Occupation'],
							'JobTitle' 									=> $baseData['custom_fields']['Applicant 2 - Occupation'],
							'OccupationId'							=> time() . '',
							'EmploymentStartDate' 			=> $midas->dateformat($baseData['custom_fields']['Applicant 2 - Date Started at Current Employment'], true),
							'TimeWithEmployerYears'			=> (isset($timeWith['y'])) ? $timeWith['y']:0,
							'TimeWithEmployerMonths'		=> (isset($timeWith['m'])) ? $timeWith['m']:0,
							'Accountant'								=> '',
							'NoOfYearsAccounts'					=> '',
							'NoOfYearsAccounts'					=> '',
							'YearlyAccountsYearEndDate'	=> '',
							'ContractEnds'							=> '',
							'Year1Profit'								=> '',
							'Year2Profit'								=> '',
							'Year3Profit'								=> '',
							'NetMonthlyIncome' 					=> str_replace(',','',number_format(($baseData['custom_fields']['Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)'] / 12), 2)),
							'EmploymentIncome' 					=> array(
								array(
									'Id' => time(),
									'FactFindClientEmploymentDetailsId' => time(),
									'IncomeType' => 1,
									'FactFindClientEmploymentIncomeTypeDescription' => time(),
									'GrossAnnualIncome' => str_replace(',','',number_format($baseData['custom_fields']['Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)'],2)),
									'IncomeTypeOtherDescription' => '',
								),
							),
							'EmploymentStatusType' 			=> 'Working',
						),
					),
					'ClientName' => $baseData['custom_fields']['Applicant 2 - Title'] .' '. $postdata['lead']['lead']['Clients'][1]['Firstname'] .' '. $postdata['lead']['lead']['Clients'][1]['Lastname'],
				);
				if($baseData['custom_fields']['Applicant 2 - Other Income'] != 0){
					$postdata['mainFactFind']['factFind']['FactFindClients'][1]['OtherIncome'] = array(
						array(
							'IncomeType' => $midas->getItem('EmploymentOtherIncomeTypes', false)['data'],
							'MonthlyIncomeAmount' => str_replace(',','',number_format($baseData['custom_fields']['Applicant 2 - Other Income'], 2)),
						)
					);
				}
			}
			echo '<pre style="display:none;">';
			var_dump($midas->request('POST', 'FactFindClients', $postdata['mainFactFind']));
			echo '</pre>';

			if(!empty($baseData['custom_fields']['Student Loan Payments'])){
				$postdata['studentLoan']['factFindPersonalFinanceStudentLoans'] = array(
					'IntegrationId' 	=> 4,
					'ExtImportRef' 		=> time() . '',
					'ProFactFindId' 	=> $midas->getInternal('MidasProFactFindId'),
					'items' 					=> array(
						array(
							'MonthsLeft' => (int)$baseData['custom_fields']['Term Remaining (months)'],
							'AllocatedFactFindClients' => array(
								array(
									'FactFindClientId' => $midas->getInternal('MidasProFactFindClientId') - 1,
									'Allocated' => true,
								),
							),
							'Repaying' => true,
							'RepayingFromMortgage' => false,
							'MonthlyPayments' => $midas->number_format($baseData['custom_fields']['Student Loan Payments']),
						),
					),
				);
				echo '<pre style="display:none;">';
				var_dump($midas->request('POST', 'factFindPersonalFinanceStudentLoans', $postdata['studentLoan']));
				echo '</pre>';
			}

			$html ="<body style='padding:0;margin:0;height:100vh;' class=''>";
			$html .=" <img src='http://www.tmpmortgages.motivodev.co.uk/wp-content/themes/html5blank-stable/web/img/parrot.png' alt='image' class='parrot' style='float:left;height:calc(130vh);'>";
			$html .="	<div style='display: inline-block;margin: 0px 0px 0px 20px;padding: calc(100vh - 350px) 0px;'>";
			$html .="		<h1><center>Import {$baseData['title']} {$postdata['lead']['lead']['Clients'][0]['Firstname']} {$postdata['lead']['lead']['Clients'][0]['Lastname']}</center></h1>";
			$html .="		<center>";
			$html .='			<strong>MidasPro Case Id: </strong>'.$midas->getInternal('MidasProCaseId') . '<br/>';
			$html .='			<strong>MidasPro Client Id: </strong>'.$midas->getInternal('MidasProClientId') . '<br/>';
			$html .='			<strong>MidasPro Address Id: </strong>'.$midas->getInternal('MidasProAddressId') . '<br/>';
			$html .='			<strong>MidasPro Fact Find Id: </strong>'.$midas->getInternal('MidasProFactFindId') . '<br/>';
			$html .='			<strong>MidasPro Fact Find Client Id: </strong>'.$midas->getInternal('MidasProFactFindClientId') . '<br/>';
			$html .="		</center>";
			$html .="	</div>";
			$html .="</body>";
		} else {
			$html ="<body style='padding:0;margin:0;height:100vh;' class=''>";
			$html .=" <img src='http://www.tmpmortgages.motivodev.co.uk/wp-content/themes/html5blank-stable/web/img/parrot.png' alt='image' class='parrot' style='float:left;height:calc(130vh);'>";
			$html .="	<div style='display: inline-block;margin: 0px 0px 0px 20px;padding: calc(100vh - 350px) 0px;'>";
			$html .="		<h1><center>Import {$baseData['title']} {$postdata['lead']['lead']['Clients'][0]['Firstname']} {$postdata['lead']['lead']['Clients'][0]['Lastname']}</center></h1>";
			$html .="		<center>";
			$html .='			' . implode('<br/>', $error);
			$html .="		</center>";
			$html .="	</div>";
			$html .="</body>";
		}
} else {
	echo '<h1><center>No contact data sent</center></h1>';
}
echo  $html;


?>
