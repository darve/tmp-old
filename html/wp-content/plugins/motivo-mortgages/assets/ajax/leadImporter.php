<?php

class LeadImporterClient {

	private $privateConfig;

	function __construct($config){
		$this->privateConfig['username'] = $config['username'];
		$this->privateConfig['password'] = $config['password'];
		$this->privateConfig['secret'] = $config['secret'];
		$this->privateConfig['url'] = 'https://apis.mab.org.uk/Midas.WS.LeadImporter.Test/ImportServiceRest.svc/';
	}

	private function make_base_auth($u, $p){
		return base64_encode($u . ':' . $p);
	}

	private function encodeQueryParams($params){
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

	public function request($method, $path, $params = null){
		// POST, GET, PUT, Set to lowercase
		$method = strtolower($method);

		// build the url for requests
		$this->privateConfig['url'] .= $path;

		// Main set of headers
		$defaultHeaders = [
			'Authorization' => "Basic {$this->make_base_auth($this->privateConfig['username'], $this->privateConfig['password'])}", // base64 encoded login credentials
			'Accept' => 'application/json', 																															// Headers to accept
			'Content-Type' => 'application/json', 																												// Content type sent
			'Stamp' => date('U'), 																																				// Time stamp
			'Params' => json_encode($params, JSON_UNESCAPED_SLASHES), 																														// json encoded post/get data
			'Signature' => hash_hmac('sha256', json_encode($params, JSON_UNESCAPED_SLASHES), $this->privateConfig['secret']), 									// sha256 hashed post/get data with secret key
		];

		$rawHeaders = array();
		// Build the headers up for the request
		foreach ($defaultHeaders as $header => $value){
			$rawHeaders[] = $header . ': ' . $value;
		}

		//Open up the connection
		$curl = curl_init();

		switch ($method){
			case "post":
				// set the post
				curl_setopt($curl, CURLOPT_POST, TRUE);
				if ($params){
					// set the post data
					curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params));
				}
			break;
			default:
				if($params){
					//set the get query
					$query = http_build_query($this->encodeQueryParams($params));
					$this->privateConfig['url'] = "{$this->privateConfig['url']}?{$query}";
				}
			break;
		}

		// set the final url
		curl_setopt($curl, CURLOPT_VERBOSE, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HEADER, 1);
		curl_setopt($curl, CURLOPT_USERPWD, $this->privateConfig['username'] . ':' . $this->privateConfig['password']); // username and password key
		curl_setopt($curl, CURLOPT_URL, $this->privateConfig['url']); // url to call
		curl_setopt($curl, CURLOPT_HTTPHEADER, $rawHeaders); // send headers
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // return the data
		curl_setopt($curl, CURLINFO_HEADER_OUT, true);

		// $resp = curl_exec($curl);
		// $information = curl_getinfo($curl);
		// $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		// curl_close($curl);

		$array = array(
			'url' 				=> $this->config['url'],
			'headers'			=> $defaultHeaders,
			'POST'				=> $params,
			'MidasConfig' => $midasConfig,
		);
		return $array;
	}

	public function send($method, $path, $params = null){

		 // send the request and return a code
		$response = $this->request($method, $path, $params);

		return "Response: " . $response;
	}
}

// Config global variable
$leadImporterConfig = array(
	'username' 	=> 'themortgagepeople',
	'password' 	=> 'aZQ63BdwhUWSr6bQ',
	'secret' 		=> 'jg84wfafwahjhkfy54y54y54h4h3j8i23ktliliuk23mjn32nt32kmnwg289u27t',
);

// Initiate Class
$midas = new LeadImporterClient($leadImporterConfig);

// GET Titles
if (isset($_GET["action"]) && $_GET["action"]=="Titles")
{
	$getdata['Timestamp'] = date('U');
	echo $midas->send('get', 'Titles', $getdata);
}

// POST Lead
if (isset($_GET["action"]) && $_GET["action"]=="Lead")
{
	$postdata['lead']['ExtLeadId'] = time();
	$postdata['lead']['Comments'] = 'Test API PHP Rest Script';
	$postdata['lead']['ExtAgentName'] = 'Joe Bloggs';
	$postdata['lead']['ExtImportRef'] = time();
	$postdata['lead']['IntegrationId'] = '1';
	$postdata['lead']['LeadsourceBranchId'] = '1';
	$postdata['lead']['LeadsourceId'] = '7365';
	$postdata['lead']['PreferredContactDay'] = 'Monday';
	$postdata['lead']['PreferredContactMethod'] = 'Email';
	$postdata['lead']['PreferredContactTime'] = 'AM';
	$postdata['lead']['ReferrerId'] = '1';
	$postdata['lead']['AdviserId'] = 0;
	$postdata['lead']['ExtCaseRef'] = time();
	$postdata['lead']['Clients'][0]['TitleId'] = '5';
	$postdata['lead']['Clients'][0]['Firstname'] = 'Joe';
	$postdata['lead']['Clients'][0]['Lastname'] = 'Smith';
	$postdata['lead']['Clients'][0]['DoB'] = '/Date(521161200000)/';
	$postdata['lead']['Clients'][0]['MaritalStatusId'] = '1';
	$postdata['lead']['Clients'][0]['NINumber'] = 'QQ123456C';
	$postdata['lead']['Clients'][0]['ExtClientRef'] = time();
	$postdata['lead']['Clients'][0]['GenderId'] = "1";
	$postdata['lead']['Clients'][0]['ContactMethods'][0]['ContactMethodTypeId'] = 5;
	$postdata['lead']['Clients'][0]['ContactMethods'][0]['ContactValue'] = 'test@test.com';
	$postdata['lead']['Clients'][0]['ContactMethods'][0]['PreferredMethod'] = 'true';
	$postdata['lead']['Clients'][0]['ContactMethods'][1]['ContactMethodTypeId'] = 1;
	$postdata['lead']['Clients'][0]['ContactMethods'][1]['ContactValue'] = '1234';
	$postdata['lead']['Clients'][0]['ContactMethods'][1]['PreferredMethod'] = 'false';

	$postdata['lead']['Addresses'][0]['Address1'] = 'Capital House';
	$postdata['lead']['Addresses'][0]['Address2'] = '2 Pride Place';
	$postdata['lead']['Addresses'][0]['Address3'] = 'Derby';
	$postdata['lead']['Addresses'][0]['Address4'] = 'Test';
	$postdata['lead']['Addresses'][0]['County'] = 'Derbyshire';
	$postdata['lead']['Addresses'][0]['ExtAddressRef'] = time();
	$postdata['lead']['Addresses'][0]['Postcode'] = 'DE24 8QR';
	$postdata['lead']['Addresses'][0]['PropertyStatusId'] = '1';
	$postdata['lead']['Addresses'][0]['Town'] = '1';

	$postdata['Timestamp'] = date('U');
	$postdata['testMode'] = false;
	echo '<pre>';
	var_dump($midas->request('POST', 'Lead', $postdata));
	echo '</pre>';
	// echo $midas->send('POST', 'Lead', $postdata);
}

if (!isset($_GET["action"])){
	echo "Please provide action";
}
?>
