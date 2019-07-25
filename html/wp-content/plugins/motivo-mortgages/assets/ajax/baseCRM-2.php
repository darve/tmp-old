<?php

	// Ajax Submit

	define('WP_DEBUG', true);

	error_reporting(-1);
	ini_set('display_errors', 1);

	header("Content-Type: application/json");

	require '../api/vendor/autoload.php';

  $accessToken = '07628ce2f159982af41e49eb66e01eb083a47ce8fd175c2bb919f3211a416175';
  $client = new \BaseCRM\Client(['accessToken' => $accessToken]);

  require($_SERVER['DOCUMENT_ROOT'] . '/wp-blog-header.php' );
  define('WP_USE_THEMES', false);
  $responce = array(
    'status' => '',
    'data' => '',
    'posted_data' => ''
  );

	function validate($string = false){
		if(isset($string)){
			if(1 === preg_match('~[A-Za-z0-9]~', $string)){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function postcodestrip($postcode){
		$postcode = str_replace(' ', '', $postcode);
		switch (strlen($postcode)) {
			case 7:
				$postcode = substr($postcode, 0, 4);
			break;
			case 6:
				$postcode = substr($postcode, 0, 3);
			break;
			case 5:
				$postcode = substr($postcode, 0, 2);
			break;
			default:
				$postcode = $postcode;
			break;
		}
		return strtoupper($postcode);
	}

  if(isset($_GET['action'])){
    switch ($_GET['action']) {
      case 'data_dump':
        $responce = postcodestrip($_GET['p']);
      break;
      case 'get_association':
        $terms = get_terms( array(
          'taxonomy' => 'associations',
          'hide_empty' => false,
          'parent' => 0,
        ));
        $responce = $terms;
      break;
      case 'get_development':
        $terms = get_terms( array(
          'taxonomy' => 'associations',
          'hide_empty' => false,
          'parent' => $_GET['id'],
        ));
        $responce = $terms;
      break;
      case 'clients':
        $item = $client->contacts->all();
      break;
      case 'post_to_wp':
          $clientPost = array(
            "name"        => $_POST['title'] . ' ' . $_POST['forname'] . ' ' . $_POST['other-names'] . ' ' . $_POST['surname'],
            "title"       => $_POST['title'],
            "first_name"  => $_POST['forname'],
            "last_name"   => $_POST['surname'],
            "description" => "",
            "email"       => $_POST['email_address'],
            "mobile"      => $_POST['mobile_number'],
            "address"     =>  array(
              "line1"       => $_POST['house_and_street'],
              "city"        => $_POST['city'],
              "postal_code" => $_POST['postcode'],
              "state"       => $_POST['county'],
              "country"     => ''
            ),
          );

          $clientPost['custom_fields']['Post Code App 1']                                                          	= (validate(isset($_POST['postcode']))) ? $_POST['postcode']:'';
          $clientPost['custom_fields']['Application Type']                                                          = (validate(isset($_POST['application_type']))) ? $_POST['application_type']:'';
          $clientPost['custom_fields']['Preferred Method of Contact']                                               = (validate(isset($_POST['contact']))) ? $_POST['contact']:'';
          $clientPost['custom_fields']['Other Known Names']                                                         = (validate(isset($_POST['other-)names']))) ? $_POST['other-names']:'';
          $clientPost['custom_fields']['Date of Birth']                                                             = $_POST['dob_dd'] . '/' . $_POST['dob_mm'] . '/' . $_POST['dob_yyyy'];
          $clientPost['custom_fields']['Nationality']                                                               = (validate(isset($_POST['nationality']))) ? $_POST['nationality']:'';
          $clientPost['custom_fields']['Indefinite Leave to Remain?']                                               = (validate(isset($_POST['leave_to_uk']))) ? $_POST['leave_to_uk']:'';
          $clientPost['custom_fields']['Marital Status']                                                            = (validate(isset($_POST['marital_status']))) ? $_POST['marital_status']:'';
          $clientPost['custom_fields']['Gender']                                                                    = (validate(isset($_POST['gender']))) ? $_POST['gender']:'';
          $clientPost['custom_fields']['Smoker']                                                                    = (validate(isset($_POST['smoker']))) ? $_POST['smoker']:'';
          $clientPost['custom_fields']['Status at Current Address']                                                 = (validate(isset($_POST['current_address_status']))) ? $_POST['current_address_status']:'';
          $clientPost['custom_fields']['Date Moved to Current Address']                                             = $_POST['moved_dd'] . '/' . $_POST['moved_mm'] . '/' . $_POST['moved_yyyy'];
          $clientPost['custom_fields']['Self Employed']                                                             = (validate(isset($_POST['self_employed']))) ? $_POST['self_employed']:'';
          $clientPost['custom_fields']['Occupation']                                                                = (validate(isset($_POST['occupation']))) ? $_POST['occupation']:'';
          $clientPost['custom_fields']['Date Started at Current Employment']                                        = $_POST['started_dd'] . '/' . $_POST['started_mm'] . '/'. $_POST['started_yyyy'];
          $clientPost['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)']                          = (validate(isset($_POST['basic_salary']))) ? $_POST['basic_salary']:'';
          $clientPost['custom_fields']['Net Profit Year 2']                                                        = (validate(isset($_POST['year_2']))) ? $_POST['year_2']:'';
          $clientPost['custom_fields']['Overtime']                                                                  = (validate(isset($_POST['overtime']))) ? $_POST['overtime']:'';
          $clientPost['custom_fields']['Benefits']                                                                  = (validate(isset($_POST['state_benefits']))) ? $_POST['state_benefits']:'';
          $clientPost['custom_fields']['Other Income']                                                              = (validate(isset($_POST['other_income']))) ? $_POST['other_income']:'';
          $clientPost['custom_fields']['# of Dependants']                                                           = (validate(isset($_POST['dependants']))) ? $_POST['dependants']:'';
          $clientPost['custom_fields']['Adverse Credit']                                                            = (validate(isset($_POST['adverse_credit']) )) ? $_POST['adverse_credit'] :'';
          $clientPost['custom_fields']['Total Monthly Loan/HP Repayments']                                          = (validate(isset($_POST['loan']))) ? $_POST['loan']:'';
          $clientPost['custom_fields']['Total Outstanding Credit Card Balances']                                    = (validate(isset($_POST['total_outstanding']))) ? $_POST['total_outstanding']:'';
          $clientPost['custom_fields']['Student Loan Payments']                                                     = (validate(isset($_POST['student_loan']))) ? $_POST['student_loan']:'';
          $clientPost['custom_fields']['Pension Contributions']                                                    = (validate(isset($_POST['pension_contributions']))) ? $_POST['pension_contributions']:'';
          $clientPost['custom_fields']['Child Care Costs']                                                          = (validate(isset($_POST['childcare_costs']))) ? $_POST['childcare_costs']:'';
          $clientPost['custom_fields']['Maintenance']                                                               = (validate(isset($_POST['maintenance']))) ? $_POST['maintenance']:'';

          if($_POST['application_type'] == 'joint'){
            $clientPost['custom_fields']['Applicant 2 - Title']                                                     = (validate(isset($_POST['applicant_2_title']))) ? $_POST['applicant_2_title']:'';
            $clientPost['custom_fields']['Applicant 2 - Full Name']                                                 = $_POST['applicant_2_forname'] . ' ' . $_POST['applicant_2_surname'];
            $clientPost['custom_fields']['Applicant 2 - Other Known Names']                                         = (validate(isset($_POST['applicant_2_other-)names']))) ? $_POST['applicant_2_other-names']:'';
            $clientPost['custom_fields']['Applicant 2 - DOB']                                                       = $_POST['applicant_2_dob_dd'] . '/' . $_POST['applicant_2_dob_mm'] . '/' . $_POST['applicant_2_dob_yyyy'];
            $clientPost['custom_fields']['Applicant 2 - Nationality']                                               = (validate(isset($_POST['applicant_2_nationality']))) ? $_POST['applicant_2_nationality']:'';
            $clientPost['custom_fields']['Applicant 2 - Indefinite Leave to Remain?']                               = (validate(isset($_POST['applicant_2_leave_to_uk']))) ? $_POST['applicant_2_leave_to_uk']:'';
            $clientPost['custom_fields']['Applicant 2 - Marital Status']                                            = (validate(isset($_POST['applicant_2_marital_status']))) ? $_POST['applicant_2_marital_status']:'';
            $clientPost['custom_fields']['Applicant 2 - Gender']                                                    = (validate(isset($_POST['applicant_2_gender']))) ? $_POST['applicant_2_gender']:'';
            $clientPost['custom_fields']['Applicant 2 - Smoker']                                                    = (validate(isset($_POST['applicant_2_smoker']))) ? $_POST['applicant_2_smoker']:'';
            $clientPost['custom_fields']['Applicant 2 - Address']                                                   = (validate(isset($_POST['applicant_2_house_and_street']))) ? $_POST['applicant_2_house_and_street']:'';
            $clientPost['custom_fields']['Applicant 2 - Town']                                                      = '';
            $clientPost['custom_fields']['Applicant 2 - City']                                                      = (validate(isset($_POST['applicant_2_city']))) ? $_POST['applicant_2_city']:'';
            $clientPost['custom_fields']['Applicant 2 - Postal Code']                                               = (validate(isset($_POST['applicant_2_postcode']))) ? $_POST['applicant_2_postcode']:'';
            $clientPost['custom_fields']['Applicant 2 - Country']                                                   = (validate(isset($_POST['applicant_2_county']))) ? $_POST['applicant_2_county']:'';
            $clientPost['custom_fields']['Applicant 2 - Status at Current Address']                                 = (validate(isset($_POST['applicant_2_current_address_status']))) ? $_POST['applicant_2_current_address_status']:'';
            $clientPost['custom_fields']['Applicant 2 - Date Moved to Current Address']                             = $_POST['applicant_2_moved_dd'] . '/' . $_POST['applicant_2_moved_mm'] . '/' . $_POST['applicant_2_moved_yyyy'];
            $clientPost['custom_fields']['Applicant 2 - Mobile Number']                                             = (validate(isset($_POST['applicant_2_mobile_number']))) ? $_POST['applicant_2_mobile_number']:'';
            $clientPost['custom_fields']['Applicant 2 - Work Number']                                               = '';
            $clientPost['custom_fields']['Applicant 2 - Email Address']                                             = (validate(isset($_POST['applicant_2_email_address']))) ? $_POST['applicant_2_email_address']:'';
            $clientPost['custom_fields']['Applicant 2 - Self Employed']                                             = (validate(isset($_POST['applicant_2_self_employed']))) ? $_POST['applicant_2_self_employed']:'';
            $clientPost['custom_fields']['Applicant 2 - Occupation']                                                = (validate(isset($_POST['applicant_2_occupation']))) ? $_POST['applicant_2_occupation']:'';
            $clientPost['custom_fields']['Applicant 2 - Date Started at Current Employment']                        = $_POST['applicant_2_started_dd'] . '/' . $_POST['applicant_2_started_mm'] . '/' . $_POST['applicant_2_started_yyyy'];
            $clientPost['custom_fields']['Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)']          = (validate(isset($_POST['applicant_2_basic_salary']))) ? $_POST['applicant_2_basic_salary']:'';
            $clientPost['custom_fields']['Applicant 2 - Benefits']                                                  = (validate(isset($_POST['applicant_2_state_benefits']))) ? $_POST['applicant_2_state_benefits']:'';
            $clientPost['custom_fields']['Applicant 2 - Other Income']                                              = (validate(isset($_POST['applicant_2_other_income']))) ? $_POST['applicant_2_other_income']:'';
            $clientPost['custom_fields']['Applicant 2 - Adverse Credit']                                            = (validate(isset($_POST['applicant_2_adverse_credit']))) ? $_POST['applicant_2_adverse_credit']:'';
            $clientPost['custom_fields']['Applicant 2 - # of Dependants (leave blank if the same as applicant 1)']  = (validate(isset($_POST['applicant_2_dependants']))) ? $_POST['applicant_2_dependants']:'';
            $clientPost['custom_fields']['Applicant 2 - Total Monthly Loan/HP Repayments']                          = (validate(isset($_POST['applicant_2_loan']))) ? $_POST['applicant_2_loan']:'';
            $clientPost['custom_fields']['Applicant 2 - Total Outstanding Credit Card Balances']                    = (validate(isset($_POST['applicant_2_total_outstanding']))) ? $_POST['applicant_2_total_outstanding']:'';
            $clientPost['custom_fields']['Applicant 2 - Student Loan Payments']                                     = (validate(isset($_POST['applicant_2_student_loan']))) ? $_POST['applicant_2_student_loan']:'';
            $clientPost['custom_fields']['Applicant 2 - Pension Contribution']                                      = (validate(isset($_POST['applicant_2_pension_contributions']))) ? $_POST['applicant_2_pension_contributions']:'';
            $clientPost['custom_fields']['Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)'] = (validate(isset($_POST['applicant_2_childcare_costs']))) ? $_POST['applicant_2_childcare_costs']:'';
            $clientPost['custom_fields']['Applicant 2 - Maintenance']                                               = (validate(isset($_POST['applicant_2_maintenance']))) ? $_POST['applicant_2_maintenance']:'';
            $clientPost['custom_fields']['Applicant 2 - Net Profit Year 2']                                         = (validate(isset($_POST['applicant_2_year_2']))) ? $_POST['applicant_2_year_2']:'';
						$clientPost['custom_fields']['Email Address App 2']                                                     = (validate(isset($_POST['applicant_2_email_address']))) ? $_POST['applicant_2_email_address']:'';
          }
          $clientPost['custom_fields']['Housing Association/Agent']                                                 = (validate(isset($_POST['housing_association']))) ? $_POST['housing_association']:'';
          $clientPost['custom_fields']['Name of Site/Development']                                                  = (validate(isset($_POST['site_development']))) ? $_POST['site_development']:'';
          $clientPost['custom_fields']['Full Purchase Price']                                                       = (validate(isset($_POST['property_full_price']))) ? $_POST['property_full_price']:'';
          $clientPost['custom_fields']['% Purchase Share']                                                          = (validate(isset($_POST['property_percent_share']))) ? $_POST['property_percent_share']:'';
          $clientPost['custom_fields']['Share Price']                                                               = (validate(isset($_POST['property_share_price']))) ? $_POST['property_share_price']:'';
          $clientPost['custom_fields']['Loan Amount']                                                               = (validate(isset($_POST['property_loan_amount']))) ? $_POST['property_loan_amount']:'';
          $clientPost['custom_fields']['Shared Ownership Rent ']                                                    = (validate(isset($_POST['property_rent']))) ? $_POST['property_rent']:'';
          $clientPost['custom_fields']['Service Charge']                                                            = (validate(isset($_POST['property_service_charge']))) ? $_POST['property_service_charge']:'';
					$clientPost['custom_fields']['Deposit Amount']                                                            = (validate(isset($_POST['property_deposit']))) ? $_POST['property_deposit']:'';
          $clientPost['custom_fields']['Purchase Property Address']                                                 = (validate(isset($_POST['property_address_line_1']))) ? $_POST['property_address_line_1']:'';
          $clientPost['custom_fields']['Purchase Property Town']                                                    = (validate(isset($_POST['property_address_line_2']))) ? $_POST['property_address_line_2']:'';
          $clientPost['custom_fields']['Purchase Property City']                                                    = (validate(isset($_POST['property_address_line_3']))) ? $_POST['property_address_line_3']:'';
          $clientPost['custom_fields']['Purchase Property Postal Code']                                             = (validate(isset($_POST['property_postcode']))) ? $_POST['property_postcode']:'';
          $clientPost['custom_fields']['Purchase Type ']                                                            = (validate(isset($_POST['purchase_type']))) ? $_POST['purchase_type']:'';
          $clientPost['custom_fields']['Purchase Property Country']                                                 = '';
          $clientPost['custom_fields']['Any Other Information']                                                     = (validate(isset($_POST['other_info']))) ? $_POST['other_info'] . ' - Added via Motivo Mortgage Form':'Added via Motivo Mortgage Form';
          $clientPost['custom_fields']['Email Address App 1']                                                     	= (validate(isset($_POST['email_address']))) ? $_POST['email_address']:'';

          if($clientPost['custom_fields']['Application Type'] == 'single'){
            if($_POST['title'] == ''){
              $error[] = 'Please add applicant 1 title';
            }
            if($_POST['forname'] == ''){
              $error[] = 'Please add applicant 1 forname';
            }
            if($_POST['surname'] == ''){
              $error[] = 'Please add applicant 1 surname';
            }
            if($_POST['email_address'] == '') {
              $error[] = 'Please enter Applicant 1\'s email address';
            }
            if($_POST['mobile_number'] == '') {
              $error[] = 'Please enter Applicant 1\'s mobile number';
            }
            if($_POST['house_and_street'] == '') {
              $error[] = 'Please enter Applicant 1\'s house & street';
            }
            if($_POST['city'] == '') {
              $error[] = 'Please enter Applicant 1\'s city';
            }
            if($_POST['postcode'] == '') {
              $error[] = 'Please enter Applicant 1\'s postcode';
            }
            if($_POST['county'] == '') {
              $error[] = 'Please enter Applicant 1\'s county';
            }
            if($clientPost['custom_fields']['Application Type'] == ''){
              $error[] = 'Please add applicant 1 Application Type information';
            }
            if($clientPost['custom_fields']['Preferred Method of Contact'] == ''){
              $error[] = 'Please add applicant 1 Preferred Method of Contact information';
            }
            if($clientPost['custom_fields']['Date of Birth'] == ''){
              $error[] = 'Please add applicant 1 Date of Birth information';
            }
            if($clientPost['custom_fields']['Nationality'] == ''){
              $error[] = 'Please add applicant 1 Nationality information';
            }
            if($clientPost['custom_fields']['Indefinite Leave to Remain?'] == ''){
              $error[] = 'Please add applicant 1 Indefinite Leave to Remain information';
            }
            if($clientPost['custom_fields']['Marital Status'] == ''){
              $error[] = 'Please add applicant 1 Marital Status information';
            }
            if($clientPost['custom_fields']['Gender'] == ''){
              $error[] = 'Please add applicant 1 Gender';
            }
            if($clientPost['custom_fields']['Smoker'] == ''){
              $error[] = 'Please add applicant 1 Smoker information';
            }
            if($clientPost['custom_fields']['Status at Current Address'] == ''){
              $error[] = 'Please add applicant 1 Status at Current Address information';
            }
            if($clientPost['custom_fields']['Date Moved to Current Address'] == ''){
              $error[] = 'Please add applicant 1 Date Moved to Current Address information';
            }
            if($clientPost['custom_fields']['Self Employed'] == ''){
              $error[] = 'Please add applicant 1 Self Employed information';
            }
            if($clientPost['custom_fields']['Occupation'] == ''){
              $error[] = 'Please add applicant 1 Occupation information';
            }
            if($clientPost['custom_fields']['Date Started at Current Employment'] == '//'){
              $error[] = 'Please add applicant 1 Date Started at Current Employment information';
            }
            if($clientPost['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)'] == ''){
              $error[] = 'Please add applicant 1 Basic Salary (OR Most Recent Year\'s Net Profit information';
            }
            if($clientPost['custom_fields']['Benefits'] == ''){
              $error[] = 'Please add applicant 1 Benefits information';
            }
            if($clientPost['custom_fields']['Other Income'] == ''){
              $error[] = 'Please add applicant 1 Other Income information';
            }
            if($clientPost['custom_fields']['# of Dependants'] == ''){
              $error[] = 'Please add applicant 1 # of Dependants information';
            }
            if($clientPost['custom_fields']['Adverse Credit'] == ''){
              $error[] = 'Please add applicant 1 Adverse Credit information';
            }
            if($clientPost['custom_fields']['Total Monthly Loan/HP Repayments'] == ''){
              $error[] = 'Please add applicant 1 Total Monthly Loan/HP Repayments information';
            }
            if($clientPost['custom_fields']['Total Outstanding Credit Card Balances'] == ''){
              $error[] = 'Please add applicant 1 Total Outstanding Credit Card Balances information';
            }
            if($clientPost['custom_fields']['Student Loan Payments'] == ''){
              $error[] = 'Please add applicant 1 Student Loan Payments information';
            }
            if($clientPost['custom_fields']['Pension Contributions'] == ''){
              $error[] = 'Please add applicant 1 Pension Contributions information';
            }
            if($clientPost['custom_fields']['Child Care Costs'] == ''){
              $error[] = 'Please add applicant 1 Child Care Costs information';
            }
            if($clientPost['custom_fields']['Maintenance'] == ''){
              $error[] = 'Please add applicant 1 Maintenance information';
            }
            if($clientPost['custom_fields']['Deposit Amount'] == ''){
              $error[] = 'Please tell us your deposit';
            }
						if($clientPost['custom_fields']['Housing Association/Agent'] == '') {
              $error[] = 'Please add Housing Association/Agent';
            }
						if($clientPost['custom_fields']['Name of Site/Development'] == '') {
              $error[] = 'Please add Name of Site/Development';
            }
						if($clientPost['custom_fields']['Deposit Amount'] == '') {
              $error[] = 'Please add Deposit Amount';
            }
          } elseif($clientPost['custom_fields']['Application Type'] == 'joint') {

            if($_POST['title'] == ''){
              $error[] = 'Please add applicant 1 title';
            }
            if($_POST['forname'] == ''){
              $error[] = 'Please add applicant 1 forname';
            }
            if($_POST['surname'] == ''){
              $error[] = 'Please add applicant 1 surname';
            }
            if($clientPost['custom_fields']['Application Type'] == ''){
              $error[] = 'Please add applicant 1 Application Type information';
            }
            if($clientPost['custom_fields']['Preferred Method of Contact'] == ''){
              $error[] = 'Please add applicant 1 Preferred Method of Contact information';
            }
            if($clientPost['custom_fields']['Date of Birth'] == ''){
              $error[] = 'Please add applicant 1 Date of Birth information';
            }
            if($clientPost['custom_fields']['Nationality'] == ''){
              $error[] = 'Please add applicant 1 Nationality information';
            }
            if($clientPost['custom_fields']['Indefinite Leave to Remain?'] == ''){
              $error[] = 'Please add applicant 1 Indefinite Leave to Remain information';
            }
            if($clientPost['custom_fields']['Marital Status'] == ''){
              $error[] = 'Please add applicant 1 Marital Status information';
            }
            if($clientPost['custom_fields']['Gender'] == ''){
              $error[] = 'Please add applicant 1 Gender';
            }
            if($clientPost['custom_fields']['Smoker'] == ''){
              $error[] = 'Please add applicant 1 Smoker information';
            }
            if($clientPost['custom_fields']['Status at Current Address'] == ''){
              $error[] = 'Please add applicant 1 Status at Current Address information';
            }
            if($clientPost['custom_fields']['Date Moved to Current Address'] == ''){
              $error[] = 'Please add applicant 1 Date Moved to Current Address information';
            }
            if($clientPost['custom_fields']['Self Employed'] == ''){
              $error[] = 'Please add applicant 1 Self Employed information';
            }
            if($clientPost['custom_fields']['Occupation'] == ''){
              $error[] = 'Please add applicant 1 Occupation information';
            }
            if($clientPost['custom_fields']['Date Started at Current Employment'] == '//'){
              $error[] = 'Please add applicant 1 Date Started at Current Employment information';
            }
            if($clientPost['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)'] == ''){
              $error[] = 'Please add applicant 1 Basic Salary (OR Most Recent Year\'s Net Profit information';
            }
            if($clientPost['custom_fields']['Benefits'] == ''){
              $error[] = 'Please add applicant 1 Benefits information';
            }
            if($clientPost['custom_fields']['Other Income'] == ''){
              $error[] = 'Please add applicant 1 Other Income information';
            }
            if($clientPost['custom_fields']['# of Dependants'] == ''){
              $error[] = 'Please add applicant 1 # of Dependants information';
            }
            if($clientPost['custom_fields']['Adverse Credit'] == ''){
              $error[] = 'Please add applicant 1 Adverse Credit information';
            }
            if($clientPost['custom_fields']['Total Monthly Loan/HP Repayments'] == ''){
              $error[] = 'Please add applicant 1 Total Monthly Loan/HP Repayments information';
            }
            if($clientPost['custom_fields']['Total Outstanding Credit Card Balances'] == ''){
              $error[] = 'Please add applicant 1 Total Outstanding Credit Card Balances information';
            }
            if($clientPost['custom_fields']['Student Loan Payments'] == ''){
              $error[] = 'Please add applicant 1 Student Loan Payments information';
            }
            if($clientPost['custom_fields']['Pension Contributions'] == ''){
              $error[] = 'Please add applicant 1 Pension Contributions information';
            }
            if($clientPost['custom_fields']['Child Care Costs'] == ''){
              $error[] = 'Please add applicant 1 Child Care Costs information';
            }
            if($clientPost['custom_fields']['Maintenance'] == ''){
              $error[] = 'Please add applicant 1 Maintenance information';
            }
            if($clientPost['custom_fields']['Applicant 2 - Title'] == ''){
              $error[] = 'Please enter Applicant 2 - Title';
            }
            if($clientPost['custom_fields']['Applicant 2 - DOB'] == ''){
              $error[] = 'Please enter Applicant 2 - DOB';
            }
            if($clientPost['custom_fields']['Applicant 2 - Nationality'] == ''){
              $error[] = 'Please enter Applicant 2 - Nationality';
            }
            if($clientPost['custom_fields']['Applicant 2 - Indefinite Leave to Remain?'] == ''){
              $error[] = 'Please enter Applicant 2 - Indefinite Leave to Remain';
            }
            if($clientPost['custom_fields']['Applicant 2 - Marital Status'] == ''){
              $error[] = 'Please enter Applicant 2 - Marital Status';
            }
            if($clientPost['custom_fields']['Applicant 2 - Gender'] == ''){
              $error[] = 'Please enter Applicant 2 - Gender';
            }
            if($clientPost['custom_fields']['Applicant 2 - Smoker'] == ''){
              $error[] = 'Please enter Applicant 2 - Smoker';
            }
            if($clientPost['custom_fields']['Applicant 2 - Address'] == ''){
              $error[] = 'Please enter Applicant 2 - Address';
            }
            if($clientPost['custom_fields']['Applicant 2 - City'] == ''){
              $error[] = 'Please enter Applicant 2 - City';
            }
            if($clientPost['custom_fields']['Applicant 2 - Postal Code'] == ''){
              $error[] = 'Please enter Applicant 2 - Postal Code';
            }
            if($clientPost['custom_fields']['Applicant 2 - Country'] == ''){
              $error[] = 'Please enter Applicant 2 - Country';
            }
            if($clientPost['custom_fields']['Applicant 2 - Status at Current Address'] == ''){
              $error[] = 'Please enter Applicant 2 - Status at Current Address';
            }
            if($clientPost['custom_fields']['Applicant 2 - Date Moved to Current Address'] == ''){
              $error[] = 'Please enter Applicant 2 - Date Moved to Current Address';
            }
            if($clientPost['custom_fields']['Applicant 2 - Mobile Number'] == ''){
              $error[] = 'Please enter Applicant 2 - Mobile Number';
            }
            if($clientPost['custom_fields']['Applicant 2 - Email Address'] == ''){
              $error[] = 'Please enter Applicant 2 - Email Address';
            }
            if($clientPost['custom_fields']['Applicant 2 - Self Employed'] == ''){
              $error[] = 'Please enter Applicant 2 - Self Employed';
            } elseif($clientPost['custom_fields']['Applicant 2 - Self Employed'] == 'Yes'){
              if($clientPost['custom_fields']['Applicant 2 - Net Profit Year 2'] == ''){
                $error[] = 'Please enter Applicant 2 - Net Profit Year 2';
              }
            }
            if($clientPost['custom_fields']['Applicant 2 - Occupation'] == ''){
              $error[] = 'Please enter Applicant 2 - Occupation';
            }
            if($clientPost['custom_fields']['Applicant 2 - Date Started at Current Employment'] == '//'){
              $error[] = 'Please enter Applicant 2 - Date Started at Current Employment';
            }
            if($clientPost['custom_fields']['Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)'] == ''){
              $error[] = 'Please enter Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit';
            }
            if($clientPost['custom_fields']['Applicant 2 - Benefits'] == ''){
              $error[] = 'Please enter Applicant 2 - Benefits';
            }
            if($clientPost['custom_fields']['Applicant 2 - Other Income'] == ''){
              $error[] = 'Please enter Applicant 2 - Other Income';
            }
            if($clientPost['custom_fields']['Applicant 2 - Adverse Credit'] == ''){
              $error[] = 'Please enter Applicant 2 - Adverse Credit';
            }
            if($clientPost['custom_fields']['Applicant 2 - # of Dependants (leave blank if the same as applicant 1)'] == ''){
              $error[] = 'Please enter Applicant 2 - # of Dependants (leave blank if the same as applicant 1';
            }
            if($clientPost['custom_fields']['Applicant 2 - Total Monthly Loan/HP Repayments'] == ''){
              $error[] = 'Please enter Applicant 2 - Total Monthly Loan/HP Repayments';
            }
            if($clientPost['custom_fields']['Applicant 2 - Total Outstanding Credit Card Balances'] == ''){
              $error[] = 'Please enter Applicant 2 - Total Outstanding Credit Card Balances';
            }
            if($clientPost['custom_fields']['Applicant 2 - Student Loan Payments'] == ''){
              $error[] = 'Please enter Applicant 2 - Student Loan Payments';
            }
            if($clientPost['custom_fields']['Applicant 2 - Pension Contribution'] == ''){
              $error[] = 'Please enter Applicant 2 - Pension Contribution';
            }
            if($clientPost['custom_fields']['Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)'] == ''){
              $error[] = 'Please enter Applicant 2 - Child Care Costs (leave blank if the same as applicant 1';
            }
            if($clientPost['custom_fields']['Applicant 2 - Maintenance'] == ''){
              $error[] = 'Please enter Applicant 2 - Maintenance';
            }
            if($clientPost['custom_fields']['Housing Association/Agent'] == '') {
              $error[] = 'Please add Housing Association/Agent';
            }
            if($clientPost['custom_fields']['Name of Site/Development'] == '') {
              $error[] = 'Please add Name of Site/Development';
            }
            if($clientPost['custom_fields']['Deposit Amount'] == '') {
              $error[] = 'Please add Deposit Amount';
            }
          } else {

          }

					if($_POST['privacy'] == ''){$error[] = 'Please accept our privacy policy to continue';}

          $my_post = array(
            'post_title' => $_POST['title'] . ' ' . $_POST['forname'] . ' ' . $_POST['other-names'] . ' ' . $_POST['surname'],
            'post_date' => '',
            'post_content' => json_encode($_POST),
            'post_status' => 'publish',
            'post_type' => 'applications',
          );
          $the_post_id = wp_insert_post($my_post);
					$clientPost['custom_fields']['Post Code App 1'] = postcodestrip($clientPost['custom_fields']['Post Code App 1']);

          foreach ($clientPost['custom_fields'] as $key => $value) {
            update_post_meta($the_post_id, $key, $value);
          }
          if(!$error){
            try {
              $client->leads->create($clientPost);
              $responce['status'] = 'Success';
              update_post_meta($the_post_id, 'Error', 'No Errors');
							$subject = 'Thank you';
							$headers  = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= 'From: TMP Mortgages <chirpy@tmpmortgages.co.uk>' . "\r\n";
							$html = '';
							$html .= 'Hi '. $_POST['forname'] .',<br/>';
							$html .= "Hurrah - you're all registered and we're already working on your affordability assessment.<br/><br/>";
							$html .= "That's the painful bit done now, and let's face it, it wasn't even painful!<br/><br/>";
							$html .= "Sit back and relax while our Amazingly Helpful team get to work crunching numbers, balancing shares and generally being awesome with Shared Ownership. It won't take us long either, you'll hear from us within 24 hours* with the outcome of your assessment, then we can help you with the next steps towards Home Ownership.<br/><br/>";
							$html .= "If you've got anything you wanted to add or forgot, just reply to this email and we'll be sure to take that into account too.<br/><br/>";
							$html .= "While we're at it, one of our Expert Mortgage Advisers will be allocated to you to help you sort out the mortgage too – not bad hey? I'd say that's the most valuable 5 minutes you've ever spent online.<br/><br/>";
							$html .= "It's likely that we will call you to run through your figures so please try and answer, we don't get too offended when you don't, we'll just pop you an email with our contact details and you can call us back when you're free to chat.<br/><br/>";
							$html .= "Thanks for choosing The Mortgage People, we're glad you did.<br/><br/>";
							$html .= "*Office Opening Hours are 9-5 Monday to Friday. Any assessments received outside of those hours will be contacted the next working day<br/><br/>";
							$html .= '<br/><br/>Kind regards,<br/>';
							$html .= 'Chirpy';
							$html .= '<p style="text-align:left;"><img src="http://www.tmpmortgages.co.uk/wp-content/plugins/motivo-mortgages/assets/images/signature.png" alt=""/></p>';
							wp_mail($_POST['email_address'], $subject, $html, $headers);
            } catch (Exception $e) {
              $responce['status'] = 'error';
              $responce['data'] = $e;
              $responce['posted_data'] = '';
              update_post_meta($the_post_id, 'Error', json_encode($e));
            }
          } else {
            $responce['status'] = 'error';
            $responce['data'] = $error;
            $responce['posted_data'] = '';
            update_post_meta($the_post_id, 'Error', json_encode($error));
          }
      break;
      case 'send_to_base':

        if($_GET['id']){

          $item = get_post($_GET['id']);

					$item->post_content = str_replace("\'s",'', $item->post_content);
					$item->post_content = json_decode($item->post_content);


          $clientPost = array(
            "name"        => $item->post_content->title . ' ' . $item->post_content->forname . ' ' . $item->post_content->surname,
            "title"       => $item->post_content->title,
            "first_name"  => $item->post_content->forname,
            "last_name"   => $item->post_content->surname,
            "description" => "",
            "email"       => $item->post_content->email_address,
            "mobile"      => $item->post_content->mobile_number,
            "address"     =>  array(
              "line1"       => $item->post_content->house_and_street,
              "city"        => $item->post_content->city,
              "postal_code" => $item->post_content->postcode,
              "state"       => $item->post_content->county,
              "country"     => ''
            ),
            'custom_fields' => '',
          );
            
            file_put_contents('testpost.txt', $clientPost);

          //foreach ($_POST as $key => $value) {
          //  update_post_meta($_GET['id'], $key, $value);
          //}

          $clientPost['custom_fields']['Post Code App 1'] = $item->post_content->postcode;
          $clientPost['custom_fields']['Application Type'] = $item->post_content->application_type;
          $clientPost['custom_fields']['Preferred Method of Contact'] = $_POST['Preferred_Method_of_Contact'];
          $clientPost['custom_fields']['Date of Birth'] = $_POST['Date_of_Birth'];
          $clientPost['custom_fields']['Nationality'] = $_POST['Nationality'];
          $clientPost['custom_fields']['Indefinite Leave to Remain? '] = $_POST['Indefinite_Leave_to_Remain?'];
          $clientPost['custom_fields']['Marital Status'] = $_POST['Marital_Status'];
          $clientPost['custom_fields']['Gender'] = $_POST['Gender'];
          $clientPost['custom_fields']['Smoker'] = $_POST['Smoker'];
          $clientPost['custom_fields']['Status at Current Address'] = $_POST['Status_at_Current_Address'];
          $clientPost['custom_fields']['Date Moved to Current Address'] = $_POST['Date_Moved_to_Current_Address'];
          $clientPost['custom_fields']['Self Employed'] = $_POST['Self_Employed'];
          $clientPost['custom_fields']['Occupation'] = $_POST['Occupation'];
          $clientPost['custom_fields']['Date Started at Current Employment'] = $_POST['Date_Started_at_Current_Employment'];
          $clientPost['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)'] = $_POST['Basic_Salary_(OR_Most_Recent_Year\'s_Net_Profit)'];
          $clientPost['custom_fields']['Net Profit Year 2 '] = $_POST['Net_Profit_Year_2_'];
          $clientPost['custom_fields']['Overtime'] = $_POST['Overtime'];
          $clientPost['custom_fields']['Benefits'] = $_POST['Benefits'];
          $clientPost['custom_fields']['Other Income '] = $_POST['Other_Income_'];
          $clientPost['custom_fields']['# of Dependants'] = $_POST['#_of_Dependants'];
          $clientPost['custom_fields']['Adverse Credit'] = $_POST['Adverse_Credit'];
          $clientPost['custom_fields']['Total Monthly Loan/HP Repayments'] = $_POST['Total_Monthly_Loan/HP_Repayments'];
          $clientPost['custom_fields']['Total Outstanding Credit Card Balances'] = $_POST['Total_Outstanding_Credit_Card_Balances'];
          $clientPost['custom_fields']['Student Loan Payments'] = $_POST['Student_Loan_Payments'];
          $clientPost['custom_fields']['Pension Contributions'] = $_POST['Pension_Contributions_'];
          $clientPost['custom_fields']['Child Care Costs'] = $_POST['Child_Care_Costs'];
          $clientPost['custom_fields']['Maintenance'] = $_POST['Maintenance'];
          if($item->post_content->application_type == 'joint'){
            $clientPost['custom_fields']['Applicant 2 - Title'] = $_POST['Applicant_2_-_Title'];
            $clientPost['custom_fields']['Applicant 2 - Full Name'] = $_POST['Applicant_2_-_Full_Name'];
            $clientPost['custom_fields']['Applicant 2 - Other Known Names'] = $_POST['Applicant_2_-_Other_Known_Names'];
            $clientPost['custom_fields']['Applicant 2 - DOB'] = $_POST['Applicant_2_-_DOB'];
            $clientPost['custom_fields']['Applicant 2 - Nationality'] = $_POST['Applicant_2_-_Nationality'];
            $clientPost['custom_fields']['Applicant 2 - Indefinite Leave to Remain? '] = $_POST['Applicant_2_-_Indefinite_Leave_to_Remain?_'];
            $clientPost['custom_fields']['Applicant 2 - Marital Status'] = $_POST['Applicant_2_-_Marital_Status'];
            $clientPost['custom_fields']['Applicant 2 - Gender'] = $_POST['Applicant_2_-_Gender'];
            $clientPost['custom_fields']['Applicant 2 - Smoker'] = $_POST['Applicant_2_-_Smoker'];
            $clientPost['custom_fields']['Applicant 2 - Address'] = $_POST['Applicant_2_-_Address'];
            $clientPost['custom_fields']['Applicant 2 - Town'] = $_POST['Applicant_2_-_Town'];
            $clientPost['custom_fields']['Applicant 2 - City'] = $_POST['Applicant_2_-_City'];
            $clientPost['custom_fields']['Applicant 2 - Postal Code'] = $_POST['Applicant_2_-_Postal_Code'];
            $clientPost['custom_fields']['Applicant 2 - Country'] = $_POST['Applicant_2_-_Country'];
            $clientPost['custom_fields']['Applicant 2 - Status at Current Address'] = $_POST['Applicant_2_-_Status_at_Current_Address'];
            $clientPost['custom_fields']['Applicant 2 - Date Moved to Current Address'] = $_POST['Applicant_2_-_Date_Moved_to_Current_Address'];
            $clientPost['custom_fields']['Applicant 2 - Mobile Number'] = $_POST['Applicant_2_-_Mobile_Number'];
            $clientPost['custom_fields']['Applicant 2 - Work Number'] = $_POST['Applicant_2_-_Work_Number'];
            $clientPost['custom_fields']['Applicant 2 - Email Address'] = $_POST['Applicant_2_-_Email_Address'];
            $clientPost['custom_fields']['Applicant 2 - Self Employed'] = $_POST['Applicant_2_-_Self_Employed'];
            $clientPost['custom_fields']['Applicant 2 - Occupation'] = $_POST['Applicant_2_-_Occupation'];
            $clientPost['custom_fields']['Applicant 2 - Date Started at Current Employment'] = $_POST['Applicant_2_-_Date_Started_at_Current_Employment'];
            $clientPost['custom_fields']['Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)'] = $_POST['Applicant_2_-_Basic_Salary_(OR_Most_Recent_Year\'s_Net_Profit)'];
            $clientPost['custom_fields']['Applicant 2 - Benefits'] = $_POST['Applicant_2_-_Benefits'];
            $clientPost['custom_fields']['Applicant 2 - Other Income'] = $_POST['Applicant_2_-_Other_Income'];
            $clientPost['custom_fields']['Applicant 2 - Adverse Credit'] = $_POST['Applicant_2_-_Adverse_Credit'];
            $clientPost['custom_fields']['Applicant 2 - # of Dependants (leave blank if the same as applicant 1)'] = $_POST['Applicant_2_-_#_of_Dependants_(leave_blank_if_the_same_as_applicant_1)'];
            $clientPost['custom_fields']['Applicant 2 - Total Monthly Loan/HP Repayments'] = $_POST['Applicant_2_-_Total_Monthly_Loan/HP_Repayments'];
            $clientPost['custom_fields']['Applicant 2 - Total Outstanding Credit Card Balances'] = $_POST['Applicant_2_-_Total_Outstanding_Credit_Card_Balances'];
            $clientPost['custom_fields']['Applicant 2 - Student Loan Payments'] = $_POST['Applicant_2_-_Student_Loan_Payments'];
            $clientPost['custom_fields']['Applicant 2 - Pension Contribution'] = $_POST['Applicant_2_-_Pension_Contribution'];
            $clientPost['custom_fields']['Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)'] = $_POST['Applicant_2_-_Child_Care_Costs_(leave_blank_if_the_same_as_applicant_1)'];
            $clientPost['custom_fields']['Applicant 2 - Maintenance'] = $_POST['Applicant_2_-_Maintenance'];
            $clientPost['custom_fields']['Applicant 2 - Net Profit Year 2'] = $_POST['Applicant_2_-_Net_Profit_Year_2'];
            $clientPost['custom_fields']['Email Address App 2'] = $_POST['Applicant_2_-_Email_Address'];
          }
          $clientPost['custom_fields']['Housing Association/Agent'] = $_POST['Housing_Association/Agent'];
          $clientPost['custom_fields']['Name of Site/Development'] = $_POST['Name_of_Site/Development'];
          $clientPost['custom_fields']['Full Purchase Price'] = $_POST['Full_Purchase_Price'];
          $clientPost['custom_fields']['% Purchase Share'] = $_POST['%_Purchase_Share'];
          $clientPost['custom_fields']['Share Price'] = $_POST['Share_Price'];
          $clientPost['custom_fields']['Loan Amount'] = $_POST['Loan_Amount'];
          $clientPost['custom_fields']['Shared Ownership Rent '] = $_POST['Shared_Ownership_Rent_'];
          $clientPost['custom_fields']['Service Charge'] = $_POST['Service_Charge'];
          $clientPost['custom_fields']['Deposit Amount'] = $_POST['Deposit_Amount'];
          $clientPost['custom_fields']['Purchase Property Address'] = $_POST['Purchase_Property_Address'];
          $clientPost['custom_fields']['Purchase Property Town'] = $_POST['Purchase_Property_Town'];
          $clientPost['custom_fields']['Purchase Property City'] = $_POST['Purchase_Property_City'];
          $clientPost['custom_fields']['Purchase Property Postal Code'] = $_POST['Purchase_Property_Postal_Code'];
          $clientPost['custom_fields']['Purchase Type '] = $_POST['Purchase_Type_'];
          $clientPost['custom_fields']['Purchase Property Country'] = $_POST['Purchase_Property_Country'];
          $clientPost['custom_fields']['Any Other Information'] = $_POST['Any_Other_Information'];
          $clientPost['custom_fields']['Email Address App 1'] = $item->post_content->email_address;
					$clientPost['custom_fields']['Post Code App 1'] = postcodestrip($clientPost['custom_fields']['Post Code App 1']);
            file_put_contents('post.txt', json_encode($clientPost));

            $client->leads->create($clientPost);
        }
      break;
			case 'send_to_tmp':
				$data['existing_title'] 									= $_POST['existing_title'];
				$data['existing_forname'] 								= $_POST['existing_forname'];
				$data['existing_surname'] 								= $_POST['existing_surname'];
				$data['existing_mobile_number'] 					=	$_POST['existing_mobile_number'];
				$data['existing_email_address'] 					= $_POST['existing_email_address'];
				$data['existing_home'] 										= $_POST['existing_home'];
				$data['existing_purchase_type'] 					= $_POST['existing_purchase_type'];
				$data['existing_housing_association'] 		= $_POST['existing_housing_association'];
				$data['existing_site_development'] 				= $_POST['existing_site_development'];
				$data['existing_property_address_line_1'] = $_POST['existing_property_address_line_1'];
				$data['existing_property_address_line_2'] = $_POST['existing_property_address_line_2'];
				$data['existing_property_address_line_3'] = $_POST['existing_property_address_line_3'];
				$data['existing_property_postcode'] 			= $_POST['existing_property_postcode'];
				$data['existing_property_full_price'] 		= $_POST['existing_property_full_price'];
				$data['existing_property_percent_share'] 	= $_POST['existing_property_percent_share'];
				$data['existing_property_share_price'] 		= $_POST['existing_property_share_price'];
				$data['existing_property_deposit'] 				= $_POST['existing_property_deposit'];
				$data['existing_property_loan_amount'] 		= $_POST['existing_property_loan_amount'];
				$data['existing_property_rent'] 					= $_POST['existing_property_rent'];
				$data['existing_property_service_charge'] = $_POST['existing_property_service_charge'];


				$data['existing_title'] = (validate(isset($data['existing_title']))) ? $data['existing_title']:'';
				$data['existing_forname'] = (validate(isset($data['existing_forname']))) ? $data['existing_forname']:'';
				$data['existing_surname'] = (validate(isset($data['existing_surname']))) ? $data['existing_surname']:'';
				$data['existing_mobile_number'] = (validate(isset($data['existing_mobile_number']))) ? $data['existing_mobile_number']:'';
				$data['existing_email_address'] = (validate(isset($data['existing_email_address']))) ? $data['existing_email_address']:'';
				$data['existing_home'] = (validate(isset($data['existing_home']))) ? $data['existing_home']:'';
				$data['existing_purchase_type'] = (validate(isset($data['existing_purchase_type']))) ? $data['existing_purchase_type']:'';
				$data['existing_housing_association'] = (validate(isset($data['existing_housing_association']))) ? $data['existing_housing_association']:'';
				$data['existing_site_development'] = (validate(isset($data['existing_site_development']))) ? $data['existing_site_development']:'';
				$data['existing_property_address_line_1'] = (validate(isset($data['existing_property_address_line_1']))) ? $data['existing_property_address_line_1']:'';
				$data['existing_property_address_line_2'] = (validate(isset($data['existing_property_address_line_2']))) ? $data['existing_property_address_line_2']:'';
				$data['existing_property_address_line_3'] = (validate(isset($data['existing_property_address_line_3']))) ? $data['existing_property_address_line_3']:'';
				$data['existing_property_postcode'] = (validate(isset($data['existing_property_postcode']))) ? $data['existing_property_postcode']:'';
				$data['existing_property_full_price'] = (validate(isset($data['existing_property_full_price']))) ? $data['existing_property_full_price']:'';
				$data['existing_property_percent_share'] = (validate(isset($data['existing_property_percent_share']))) ? $data['existing_property_percent_share']:'';
				$data['existing_property_share_price'] = (validate(isset($data['existing_property_share_price']))) ? $data['existing_property_share_price']:'';
				$data['existing_property_deposit'] = (validate(isset($data['existing_property_deposit']))) ? $data['existing_property_deposit']:'';
				$data['existing_property_loan_amount'] = (validate(isset($data['existing_property_loan_amount']))) ? $data['existing_property_loan_amount']:'';
				$data['existing_property_rent'] = (validate(isset($data['existing_property_rent']))) ? $data['existing_property_rent']:'';
				$data['existing_property_service_charge'] = (validate(isset($data['existing_property_service_charge']))) ? $data['existing_property_service_charge']:'';

				$validate = array(
					'existing_title',
					'existing_forname',
					'existing_surname',
					'existing_mobile_number',
					'existing_email_address',
					'existing_home',
					'existing_purchase_type',
					'existing_housing_association',
					'existing_site_development',
					'existing_property_share_price',
					'existing_property_deposit',
					'existing_property_loan_amount',
					'existing_property_rent',
					'existing_property_service_charge',
				);
				foreach ($validate as $value) {
					if($data[$value] == ''){
						$error[] = 'Please add ' . str_replace(array('existing_', '_'),array('',' '), $value);
					}
				}
        if(!$error){
          $responce['status'] = 'Success';
          $responce['data'] = $data;
					$subject = 'New Assessment Required for '. $data['existing_title'] . ' ' .	$data['existing_forname'] . ' ' .	$data['existing_surname'] .'.';
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: TMP Mortgages <chirpy@tmpmortgages.co.uk>' . "\r\n";
					$html = '';
					$html .= 'Hi,<br/>';
					$html .= 'Please get in contact with '. $data['existing_title'] . ' ' .	$data['existing_forname'] . ' ' .	$data['existing_surname'] .'.<br/><br/>';
					$html .= '<strong>Name:</strong> '. $data['existing_title'] . ' ' .	$data['existing_forname'] . ' ' .	$data['existing_surname'] .'<br/>';
					if($data['existing_mobile_number'] != ''){$html .= '<strong>Mobile Number:</strong> '. $data['existing_mobile_number'] .'<br/>';}
					if($data['existing_email_address'] != ''){$html .= '<strong>Email Address:</strong> '. $data['existing_email_address'] .'<br/>';}
					if($data['existing_home'] != ''){$html .= '<strong>Have A Home In Mind:</strong> '. $data['existing_home'] .'<br/>';}
					if($data['existing_purchase_type'] != ''){$html .= '<strong>Purchase Type:</strong> '. $data['existing_purchase_type'] .'<br/>';}
					if($data['existing_housing_association'] != ''){$html .= '<strong>Housing Association:</strong> '. $data['existing_housing_association'] .'<br/>';}
					if($data['existing_property_address_line_1'] != ''){$html .= '<strong>New Address Line 1:</strong> '. $data['existing_property_address_line_1'] .'<br/>';}
					if($data['existing_property_address_line_2'] != ''){$html .= '<strong>New Address Line 2:</strong> '. $data['existing_property_address_line_2'] .'<br/>';}
					if($data['existing_property_postcode'] != ''){$html .= '<strong>New Address Postcode:</strong> '. $data['existing_property_postcode'] .'<br/>';}
					if($data['existing_property_share_price'] != ''){$html .= '<strong>Share Price:</strong> '. $data['existing_property_share_price'] .'<br/>';}
					if($data['existing_property_deposit'] != ''){$html .= '<strong>Deposit:</strong> '. $data['existing_property_deposit'] .'<br/>';}
					if($data['existing_property_loan_amount'] != ''){$html .= '<strong>Loan Amount:</strong> '. $data['existing_property_loan_amount'] .'<br/>';}
					if($data['existing_property_rent'] != ''){$html .= '<strong>Rent:</strong> '. $data['existing_property_rent'] .'<br/>';}
					if($data['existing_property_service_charge'] != ''){$html .= '<strong>Service Charge:</strong> '. $data['existing_property_service_charge'] .'<br/>';}
					$html .= '<br/>Kind regards,<br/>';
					$html .= 'Chirpy';

					wp_mail('chirpy@tmpmortgages.co.uk', $subject, $html, $headers);

					$subject2 = 'Thank you '. $_POST['forname'];
					$html2 = '';
					$html2 .= 'Hi '. $_POST['forname'] .',<br/>';
					$html2 .= "Hurrah - we've received your request for a reassessment!.<br/><br/>";
					$html2 .= "That's the painful bit done now, and let's face it, it wasn't even painful!<br/><br/>";
					$html2 .= "Sit back and relax while our Amazingly Helpful team get to work crunching numbers, balancing shares and generally being awesome with Shared Ownership. It won't take us long either, you'll hear from us within 24 hours* with the outcome of your assessment, then we can help you with the next steps towards Home Ownership.<br/><br/>";
					$html2 .= "If you've got anything you wanted to add or forgot, just reply to this email and we'll be sure to take that into account too.<br/><br/>";
					$html2 .= "It's likely that we will call you to run through your figures so please try and answer, we don't get too offended when you don't, we'll just pop you an email with our contact details and you can call us back when you're free to chat.<br/><br/>";
					$html2 .= "Thanks for choosing The Mortgage People, we're glad you did.<br/><br/>";
					$html2 .= "*Office Opening Hours are 9-5 Monday to Friday. Any assessments received outside of those hours will be contacted the next working day<br/><br/>";
					$html2 .= '<br/><br/>Kind regards,<br/>';
					$html2 .= 'Chirpy';
					$html2 .= '<p style="text-align:left;"><img src="http://www.tmpmortgages.co.uk/wp-content/plugins/motivo-mortgages/assets/images/signature.png" alt=""/></p>';
					wp_mail($data['existing_email_address'], $subject2, $html2, $headers);

        } else {
          $responce['status'] = 'error';
          $responce['data'] = $error;
        }
      break;
      case 'get_details':
        if($_GET['id']){
          $item = get_post($_GET['id']);
					$item->post_content = str_replace("\'s",'', $item->post_content);
					$item->post_content = json_decode($item->post_content);
        }
				$responce['id'] = $_GET['id'];
				$responce['data'] = $item->post_content;
      break;
      default:
      	# code...
      break;
    }

    if(isset($_GET['dev'])){
      echo '<pre>';
      var_dump($responce);
      echo '</pre>';
    } else {
      echo json_encode($responce);
    }
  } else {
    echo 'nothing to see here';
  }
?>
