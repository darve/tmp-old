<?php

	// Ajax Submit

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

	function validate($string){
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

  if(isset($_GET['action'])){
    switch ($_GET['action']) {
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
        echo '<pre>';
        var_dump($item);
        echo '</pre>';
      break;
      case 'post_to_wp':
          $clientPost = array(
            "name"        => $_GET['title'] . ' ' . $_GET['forname'] . ' ' . $_GET['other-names'] . ' ' . $_GET['surname'],
            "title"       => $_GET['title'],
            "first_name"  => $_GET['forname'],
            "last_name"   => $_GET['surname'],
            "description" => "",
            "email"       => $_GET['email_address'],
            "mobile"      => $_GET['mobile_number'],
            "address"     =>  array(
              "line1"       => $_GET['house_and_street'],
              "city"        => $_GET['city'],
              "postal_code" => $_GET['postcode'],
              "state"       => $_GET['county'],
              "country"     => ''
            ),
          );

          $clientPost['custom_fields']['Application Type']                                                          = (validate($_GET['application_type'])) ? $_GET['application_type']:'';
          $clientPost['custom_fields']['Preferred Method of Contact']                                               = (validate($_GET['contact'])) ? $_GET['contact']:'';
          $clientPost['custom_fields']['Other Known Names']                                                         = (validate($_GET['other-names'])) ? $_GET['other-names']:'';
          $clientPost['custom_fields']['Date of Birth']                                                             = $_GET['dob_dd'] . '/' . $_GET['dob_mm'] . '/' . $_GET['dob_yyyy'];
          $clientPost['custom_fields']['Nationality']                                                               = (validate($_GET['nationality'])) ? $_GET['nationality']:'';
          $clientPost['custom_fields']['Indefinite Leave to Remain? ']                                              = (validate($_GET['leave_to_uk'])) ? $_GET['leave_to_uk']:'';
          $clientPost['custom_fields']['Marital Status']                                                            = (validate($_GET['marital_status'])) ? $_GET['marital_status']:'';
          $clientPost['custom_fields']['Gender']                                                                    = (validate($_GET['gender'])) ? $_GET['gender']:'';
          $clientPost['custom_fields']['Smoker']                                                                    = (validate($_GET['smoker'])) ? $_GET['smoker']:'';
          $clientPost['custom_fields']['Status at Current Address']                                                 = (validate($_GET['current_address_status'])) ? $_GET['current_address_status']:'';
          $clientPost['custom_fields']['Date Moved to Current Address']                                             = $_GET['moved_dd'] . '/' . $_GET['moved_mm'] . '/' . $_GET['moved_yyyy'];
          $clientPost['custom_fields']['Self Employed']                                                             = (validate($_GET['self_employed'])) ? $_GET['self_employed']:'';
          $clientPost['custom_fields']['Occupation']                                                                = (validate($_GET['occupation'])) ? $_GET['occupation']:'';
          $clientPost['custom_fields']['Date Started at Current Employment']                                        = $_GET['started_dd'] . '/' . $_GET['started_mm'] . '/'. $_GET['started_yyyy'];
          $clientPost['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)']                          = (validate($_GET['basic_salary'])) ? $_GET['basic_salary']:'';
          $clientPost['custom_fields']['Net Profit Year 2']                                                        = (isset($_GET['year_2'])) ? $_GET['year_2']:'';
          $clientPost['custom_fields']['Overtime']                                                                  = (isset($_GET['overtime'])) ? $_GET['overtime']:'';
          $clientPost['custom_fields']['Benefits']                                                                  = (validate($_GET['state_benefits'])) ? $_GET['state_benefits']:'';
          $clientPost['custom_fields']['Other Income ']                                                             = (isset($_GET['other_income'])) ? $_GET['other_income']:'';
          $clientPost['custom_fields']['# of Dependants']                                                           = (validate($_GET['dependants'])) ? $_GET['dependants']:'';
          $clientPost['custom_fields']['Adverse Credit']                                                            = (validate($_GET['adverse_credit'] )) ? $_GET['adverse_credit'] :'';
          $clientPost['custom_fields']['Total Monthly Loan/HP Repayments']                                          = (validate($_GET['loan'])) ? $_GET['loan']:'';
          $clientPost['custom_fields']['Total Outstanding Credit Card Balances']                                    = (validate($_GET['total_outstanding'])) ? $_GET['total_outstanding']:'';
          $clientPost['custom_fields']['Student Loan Payments']                                                     = (validate($_GET['student_loan'])) ? $_GET['student_loan']:'';
          $clientPost['custom_fields']['Pension Contributions ']                                                    = (validate($_GET['pension_contributions'])) ? $_GET['pension_contributions']:'';
          $clientPost['custom_fields']['Child Care Costs']                                                          = (validate($_GET['childcare_costs'])) ? $_GET['childcare_costs']:'';
          $clientPost['custom_fields']['Maintenance']                                                               = (validate($_GET['maintenance'])) ? $_GET['maintenance']:'';

          if($_GET['application_type'] == 'joint'){
            $clientPost['custom_fields']['Applicant 2 - Title']                                                     = (validate($_GET['applicant_2_title'])) ? $_GET['applicant_2_title']:'';
            $clientPost['custom_fields']['Applicant 2 - Full Name']                                                 = $_GET['applicant_2_forname'] . ' ' . $_GET['applicant_2_surname'];
            $clientPost['custom_fields']['Applicant 2 - Other Known Names']                                         = (validate($_GET['applicant_2_other-names'])) ? $_GET['applicant_2_other-names']:'';
            $clientPost['custom_fields']['Applicant 2 - DOB']                                                       = $_GET['applicant_2_dob_dd'] . '/' . $_GET['applicant_2_dob_mm'] . '/' . $_GET['applicant_2_dob_yyyy'];
            $clientPost['custom_fields']['Applicant 2 - Nationality']                                               = (validate($_GET['applicant_2_nationality'])) ? $_GET['applicant_2_nationality']:'';
            $clientPost['custom_fields']['Applicant 2 - Indefinite Leave to Remain? ']                               = (validate($_GET['applicant_2_leave_to_uk'])) ? $_GET['applicant_2_leave_to_uk']:'';
            $clientPost['custom_fields']['Applicant 2 - Marital Status']                                            = (validate($_GET['applicant_2_marital_status'])) ? $_GET['applicant_2_marital_status']:'';
            $clientPost['custom_fields']['Applicant 2 - Gender']                                                    = (validate($_GET['applicant_2_gender'])) ? $_GET['applicant_2_gender']:'';
            $clientPost['custom_fields']['Applicant 2 - Smoker']                                                    = (validate($_GET['applicant_2_smoker'])) ? $_GET['applicant_2_smoker']:'';
            $clientPost['custom_fields']['Applicant 2 - Address']                                                   = (validate($_GET['applicant_2_house_and_street'])) ? $_GET['applicant_2_house_and_street']:'';
            $clientPost['custom_fields']['Applicant 2 - Town']                                                      = '';
            $clientPost['custom_fields']['Applicant 2 - City']                                                      = (validate($_GET['applicant_2_city'])) ? $_GET['applicant_2_city']:'';
            $clientPost['custom_fields']['Applicant 2 - Postal Code']                                               = (validate($_GET['applicant_2_postcode'])) ? $_GET['applicant_2_postcode']:'';
            $clientPost['custom_fields']['Applicant 2 - Country']                                                   = (validate($_GET['applicant_2_county'])) ? $_GET['applicant_2_county']:'';
            $clientPost['custom_fields']['Applicant 2 - Status at Current Address']                                 = (validate($_GET['applicant_2_current_address_status'])) ? $_GET['applicant_2_current_address_status']:'';
            $clientPost['custom_fields']['Applicant 2 - Date Moved to Current Address']                             = $_GET['applicant_2_moved_dd'] . '/' . $_GET['applicant_2_moved_mm'] . '/' . $_GET['applicant_2_moved_yyyy'];
            $clientPost['custom_fields']['Applicant 2 - Mobile Number']                                             = (validate($_GET['applicant_2_mobile_number'])) ? $_GET['applicant_2_mobile_number']:'';
            $clientPost['custom_fields']['Applicant 2 - Work Number']                                               = '';
            $clientPost['custom_fields']['Applicant 2 - Email Address']                                             = (validate($_GET['applicant_2_email_address'])) ? $_GET['applicant_2_email_address']:'';
            $clientPost['custom_fields']['Applicant 2 - Self Employed']                                             = (validate($_GET['applicant_2_self_employed'])) ? $_GET['applicant_2_self_employed']:'';
            $clientPost['custom_fields']['Applicant 2 - Occupation']                                                = (validate($_GET['applicant_2_occupation'])) ? $_GET['applicant_2_occupation']:'';
            $clientPost['custom_fields']['Applicant 2 - Date Started at Current Employment']                        = $_GET['applicant_2_started_dd'] . '/' . $_GET['applicant_2_started_mm'] . '/' . $_GET['applicant_2_started_yyyy'];
            $clientPost['custom_fields']['Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)']          = (validate($_GET['applicant_2_basic_salary'])) ? $_GET['applicant_2_basic_salary']:'';
            $clientPost['custom_fields']['Applicant 2 - Benefits']                                                  = (validate($_GET['applicant_2_state_benefits'])) ? $_GET['applicant_2_state_benefits']:'';
            $clientPost['custom_fields']['Applicant 2 - Other Income']                                              = (validate($_GET['applicant_2_other_income'])) ? $_GET['applicant_2_other_income']:'';
            $clientPost['custom_fields']['Applicant 2 - Adverse Credit']                                            = (validate($_GET['applicant_2_adverse_credit'])) ? $_GET['applicant_2_adverse_credit']:'';
            $clientPost['custom_fields']['Applicant 2 - # of Dependants (leave blank if the same as applicant 1)']  = (validate($_GET['applicant_2_dependants'])) ? $_GET['applicant_2_dependants']:'';
            $clientPost['custom_fields']['Applicant 2 - Total Monthly Loan/HP Repayments']                          = (validate($_GET['applicant_2_loan'])) ? $_GET['applicant_2_loan']:'';
            $clientPost['custom_fields']['Applicant 2 - Total Outstanding Credit Card Balances']                    = (validate($_GET['applicant_2_total_outstanding'])) ? $_GET['applicant_2_total_outstanding']:'';
            $clientPost['custom_fields']['Applicant 2 - Student Loan Payments']                                     = (validate($_GET['applicant_2_student_loan'])) ? $_GET['applicant_2_student_loan']:'';
            $clientPost['custom_fields']['Applicant 2 - Pension Contribution']                                      = (validate($_GET['applicant_2_pension_contributions'])) ? $_GET['applicant_2_pension_contributions']:'';
            $clientPost['custom_fields']['Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)'] = (validate($_GET['applicant_2_childcare_costs'])) ? $_GET['applicant_2_childcare_costs']:'';
            $clientPost['custom_fields']['Applicant 2 - Maintenance']                                               = (validate($_GET['applicant_2_maintenance'])) ? $_GET['applicant_2_maintenance']:'';
            $clientPost['custom_fields']['Applicant 2 - Net Profit Year 2']                                         = (validate($_GET['applicant_2_year_2'])) ? $_GET['applicant_2_year_2']:'';
          }
          $clientPost['custom_fields']['Housing Association/Agent']                                                 = (validate($_GET['housing_association'])) ? $_GET['housing_association']:'';
          $clientPost['custom_fields']['Name of Site/Development']                                                  = (validate($_GET['site_development'])) ? $_GET['site_development']:'';
          $clientPost['custom_fields']['Full Purchase Price']                                                       = (isset($_GET['property_full_price'])) ? $_GET['property_full_price']:'';
          $clientPost['custom_fields']['% Purchase Share']                                                          = (isset($_GET['property_percent_share'])) ? $_GET['property_percent_share']:'';
          $clientPost['custom_fields']['Share Price']                                                               = (isset($_GET['property_share_price'])) ? $_GET['property_share_price']:'';
          $clientPost['custom_fields']['Loan Amount']                                                               = (isset($_GET['property_loan_amount'])) ? $_GET['property_loan_amount']:'';
          $clientPost['custom_fields']['Shared Ownership Rent ']                                                    = (isset($_GET['property_rent'])) ? $_GET['property_rent']:'';
          $clientPost['custom_fields']['Service Charge']                                                            = (isset($_GET['property_service_charge'])) ? $_GET['property_service_charge']:'';
					$clientPost['custom_fields']['Deposit Amount']                                                            = (validate($_GET['property_deposit'])) ? $_GET['property_deposit']:'';
          $clientPost['custom_fields']['Purchase Property Address']                                                 = (validate($_GET['property_address_line_1'])) ? $_GET['property_address_line_1']:'';
          $clientPost['custom_fields']['Purchase Property Town']                                                    = (validate($_GET['property_address_line_2'])) ? $_GET['property_address_line_2']:'';
          $clientPost['custom_fields']['Purchase Property City']                                                    = (validate($_GET['property_address_line_3'])) ? $_GET['property_address_line_3']:'';
          $clientPost['custom_fields']['Purchase Property Postal Code']                                             = (validate($_GET['property_postcode'])) ? $_GET['property_postcode']:'';
          $clientPost['custom_fields']['Purchase Type ']                                                            = (validate($_GET['purchase_type'])) ? $_GET['purchase_type']:'';
          $clientPost['custom_fields']['Purchase Property Country']                                                 = '';
          $clientPost['custom_fields']['Any Other Information']                                                     = (validate($_GET['other_info'])) ? $_GET['other_info'] . ' - Added via Motivo Mortgage Form':'Added via Motivo Mortgage Form';

					if($_GET['privacy'] == ''){$error[] = 'Please accept our privacy policy to continue';}
					
          if($clientPost['custom_fields']['Application Type'] == 'single'){
            if($_GET['title'] == ''){$error[] = 'Please add applicant 1 title';}
            if($_GET['forname'] == ''){$error[] = 'Please add applicant 1 forname';}
            if($_GET['surname'] == ''){$error[] = 'Please add applicant 1 surname';}

            if($_GET['email_address'] == '') {$error[] = 'Please enter Applicant 1\'s email address';}
            if($_GET['mobile_number'] == '') {$error[] = 'Please enter Applicant 1\'s mobile number';}
            if($_GET['house_and_street'] == '') {$error[] = 'Please enter Applicant 1\'s house & street';}
            if($_GET['city'] == '') {$error[] = 'Please enter Applicant 1\'s city';}
            if($_GET['postcode'] == '') {$error[] = 'Please enter Applicant 1\'s postcode';}
            if($_GET['county'] == '') {$error[] = 'Please enter Applicant 1\'s county';}


            if($clientPost['custom_fields']['Application Type'] == ''){$error[] = 'Please add applicant 1 Application Type information';}
            if($clientPost['custom_fields']['Preferred Method of Contact'] == ''){$error[] = 'Please add applicant 1 Preferred Method of Contact information';}
            if($clientPost['custom_fields']['Date of Birth'] == ''){$error[] = 'Please add applicant 1 Date of Birth information';}
            if($clientPost['custom_fields']['Nationality'] == ''){$error[] = 'Please add applicant 1 Nationality information';}
            if($clientPost['custom_fields']['Indefinite Leave to Remain? '] == ''){$error[] = 'Please add applicant 1 Indefinite Leave to Remain information';}
            if($clientPost['custom_fields']['Marital Status'] == ''){$error[] = 'Please add applicant 1 Marital Status information';}
            if($clientPost['custom_fields']['Gender'] == ''){$error[] = 'Please add applicant 1 Gender';}
            if($clientPost['custom_fields']['Smoker'] == ''){$error[] = 'Please add applicant 1 Smoker information';}
            if($clientPost['custom_fields']['Status at Current Address'] == ''){$error[] = 'Please add applicant 1 Status at Current Address information';}
            if($clientPost['custom_fields']['Date Moved to Current Address'] == ''){$error[] = 'Please add applicant 1 Date Moved to Current Address information';}
            if($clientPost['custom_fields']['Self Employed'] == ''){$error[] = 'Please add applicant 1 Self Employed information';}
            if($clientPost['custom_fields']['Occupation'] == ''){$error[] = 'Please add applicant 1 Occupation information';}
            if($clientPost['custom_fields']['Date Started at Current Employment'] == ''){$error[] = 'Please add applicant 1 Date Started at Current Employment information';}
            if($clientPost['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)'] == ''){$error[] = 'Please add applicant 1 Basic Salary (OR Most Recent Year\'s Net Profit information';}
            if($clientPost['custom_fields']['Benefits'] == ''){$error[] = 'Please add applicant 1 Benefits information';}
            if($clientPost['custom_fields']['Other Income '] == ''){$error[] = 'Please add applicant 1 Other Income  information';}
            if($clientPost['custom_fields']['# of Dependants'] == ''){$error[] = 'Please add applicant 1 # of Dependants information';}
            if($clientPost['custom_fields']['Adverse Credit'] == ''){$error[] = 'Please add applicant 1 Adverse Credit information';}
            if($clientPost['custom_fields']['Total Monthly Loan/HP Repayments'] == ''){$error[] = 'Please add applicant 1 Total Monthly Loan/HP Repayments information';}
            if($clientPost['custom_fields']['Total Outstanding Credit Card Balances'] == ''){$error[] = 'Please add applicant 1 Total Outstanding Credit Card Balances information';}
            if($clientPost['custom_fields']['Student Loan Payments'] == ''){$error[] = 'Please add applicant 1 Student Loan Payments information';}
            if($clientPost['custom_fields']['Pension Contributions '] == ''){$error[] = 'Please add applicant 1 Pension Contributions  information';}
            if($clientPost['custom_fields']['Child Care Costs'] == ''){$error[] = 'Please add applicant 1 Child Care Costs information';}
            if($clientPost['custom_fields']['Maintenance'] == ''){$error[] = 'Please add applicant 1 Maintenance information';}
            if($clientPost['custom_fields']['Deposit Amount'] == ''){$error[] = 'Please tell us your deposit';}

						if($clientPost['custom_fields']['Housing Association/Agent'] == '') {$error[] = 'Please add Housing Association/Agent';}
						if($clientPost['custom_fields']['Name of Site/Development'] == '') {$error[] = 'Please add Name of Site/Development';}
						if($clientPost['custom_fields']['Deposit Amount'] == '') {$error[] = 'Please add Deposit Amount';}

          } elseif($clientPost['custom_fields']['Application Type'] == 'joint') {

            if($_GET['title'] == ''){$error[] = 'Please add applicant 1 title';}
            if($_GET['forname'] == ''){$error[] = 'Please add applicant 1 forname';}
            if($_GET['surname'] == ''){$error[] = 'Please add applicant 1 surname';}
            if($clientPost['custom_fields']['Application Type'] == ''){$error[] = 'Please add applicant 1 Application Type information';}
            if($clientPost['custom_fields']['Preferred Method of Contact'] == ''){$error[] = 'Please add applicant 1 Preferred Method of Contact information';}
            if($clientPost['custom_fields']['Date of Birth'] == ''){$error[] = 'Please add applicant 1 Date of Birth information';}
            if($clientPost['custom_fields']['Nationality'] == ''){$error[] = 'Please add applicant 1 Nationality information';}
            if($clientPost['custom_fields']['Indefinite Leave to Remain?'] == ''){$error[] = 'Please add applicant 1 Indefinite Leave to Remain information';}
            if($clientPost['custom_fields']['Marital Status'] == ''){$error[] = 'Please add applicant 1 Marital Status information';}
            if($clientPost['custom_fields']['Gender'] == ''){$error[] = 'Please add applicant 1 Gender';}
            if($clientPost['custom_fields']['Smoker'] == ''){$error[] = 'Please add applicant 1 Smoker information';}
            if($clientPost['custom_fields']['Status at Current Address'] == ''){$error[] = 'Please add applicant 1 Status at Current Address information';}
            if($clientPost['custom_fields']['Date Moved to Current Address'] == ''){$error[] = 'Please add applicant 1 Date Moved to Current Address information';}
            if($clientPost['custom_fields']['Self Employed'] == ''){$error[] = 'Please add applicant 1 Self Employed information';}
            if($clientPost['custom_fields']['Occupation'] == ''){$error[] = 'Please add applicant 1 Occupation information';}
            if($clientPost['custom_fields']['Date Started at Current Employment'] == ''){$error[] = 'Please add applicant 1 Date Started at Current Employment information';}
            if($clientPost['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)'] == ''){$error[] = 'Please add applicant 1 Basic Salary (OR Most Recent Year\'s Net Profit information';}
            if($clientPost['custom_fields']['Benefits'] == ''){$error[] = 'Please add applicant 1 Benefits information';}
            if($clientPost['custom_fields']['Other Income '] == ''){$error[] = 'Please add applicant 1 Other Income  information';}
            if($clientPost['custom_fields']['# of Dependants'] == ''){$error[] = 'Please add applicant 1 # of Dependants information';}
            if($clientPost['custom_fields']['Adverse Credit'] == ''){$error[] = 'Please add applicant 1 Adverse Credit information';}
            if($clientPost['custom_fields']['Total Monthly Loan/HP Repayments'] == ''){$error[] = 'Please add applicant 1 Total Monthly Loan/HP Repayments information';}
            if($clientPost['custom_fields']['Total Outstanding Credit Card Balances'] == ''){$error[] = 'Please add applicant 1 Total Outstanding Credit Card Balances information';}
            if($clientPost['custom_fields']['Student Loan Payments'] == ''){$error[] = 'Please add applicant 1 Student Loan Payments information';}
            if($clientPost['custom_fields']['Pension Contributions '] == ''){$error[] = 'Please add applicant 1 Pension Contributions  information';}
            if($clientPost['custom_fields']['Child Care Costs'] == ''){$error[] = 'Please add applicant 1 Child Care Costs information';}
            if($clientPost['custom_fields']['Maintenance'] == ''){$error[] = 'Please add applicant 1 Maintenance information';}
            if($clientPost['custom_fields']['Applicant 2 - Title'] == ''){$error[] = 'Please enter Applicant 2 - Title';}
            if($clientPost['custom_fields']['Applicant 2 - DOB'] == ''){$error[] = 'Please enter Applicant 2 - DOB';}
            if($clientPost['custom_fields']['Applicant 2 - Nationality'] == ''){$error[] = 'Please enter Applicant 2 - Nationality';}
            if($clientPost['custom_fields']['Applicant 2 - Indefinite Leave to Remain? '] == ''){$error[] = 'Please enter Applicant 2 - Indefinite Leave to Remain';}
            if($clientPost['custom_fields']['Applicant 2 - Marital Status'] == ''){$error[] = 'Please enter Applicant 2 - Marital Status';}
            if($clientPost['custom_fields']['Applicant 2 - Gender'] == ''){$error[] = 'Please enter Applicant 2 - Gender';}
            if($clientPost['custom_fields']['Applicant 2 - Smoker'] == ''){$error[] = 'Please enter Applicant 2 - Smoker';}
            if($clientPost['custom_fields']['Applicant 2 - Address'] == ''){$error[] = 'Please enter Applicant 2 - Address';}
            if($clientPost['custom_fields']['Applicant 2 - City'] == ''){$error[] = 'Please enter Applicant 2 - City';}
            if($clientPost['custom_fields']['Applicant 2 - Postal Code'] == ''){$error[] = 'Please enter Applicant 2 - Postal Code';}
            if($clientPost['custom_fields']['Applicant 2 - Country'] == ''){$error[] = 'Please enter Applicant 2 - Country';}
            if($clientPost['custom_fields']['Applicant 2 - Status at Current Address'] == ''){$error[] = 'Please enter Applicant 2 - Status at Current Address';}
            if($clientPost['custom_fields']['Applicant 2 - Date Moved to Current Address'] == ''){$error[] = 'Please enter Applicant 2 - Date Moved to Current Address';}
            if($clientPost['custom_fields']['Applicant 2 - Mobile Number'] == ''){$error[] = 'Please enter Applicant 2 - Mobile Number';}
            if($clientPost['custom_fields']['Applicant 2 - Email Address'] == ''){$error[] = 'Please enter Applicant 2 - Email Address';}
            if($clientPost['custom_fields']['Applicant 2 - Self Employed'] == ''){$error[] = 'Please enter Applicant 2 - Self Employed';}
            if($clientPost['custom_fields']['Applicant 2 - Occupation'] == ''){$error[] = 'Please enter Applicant 2 - Occupation';}
            if($clientPost['custom_fields']['Applicant 2 - Date Started at Current Employment'] == ''){$error[] = 'Please enter Applicant 2 - Date Started at Current Employment';}
            if($clientPost['custom_fields']['Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)'] == ''){$error[] = 'Please enter Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit';}
            if($clientPost['custom_fields']['Applicant 2 - Benefits'] == ''){$error[] = 'Please enter Applicant 2 - Benefits';}
            if($clientPost['custom_fields']['Applicant 2 - Other Income'] == ''){$error[] = 'Please enter Applicant 2 - Other Income';}
            if($clientPost['custom_fields']['Applicant 2 - Adverse Credit'] == ''){$error[] = 'Please enter Applicant 2 - Adverse Credit';}
            if($clientPost['custom_fields']['Applicant 2 - # of Dependants (leave blank if the same as applicant 1)'] == ''){$error[] = 'Please enter Applicant 2 - # of Dependants (leave blank if the same as applicant 1';}
            if($clientPost['custom_fields']['Applicant 2 - Total Monthly Loan/HP Repayments'] == ''){$error[] = 'Please enter Applicant 2 - Total Monthly Loan/HP Repayments';}
            if($clientPost['custom_fields']['Applicant 2 - Total Outstanding Credit Card Balances'] == ''){$error[] = 'Please enter Applicant 2 - Total Outstanding Credit Card Balances';}
            if($clientPost['custom_fields']['Applicant 2 - Student Loan Payments'] == ''){$error[] = 'Please enter Applicant 2 - Student Loan Payments';}
            if($clientPost['custom_fields']['Applicant 2 - Pension Contribution'] == ''){$error[] = 'Please enter Applicant 2 - Pension Contribution';}
            if($clientPost['custom_fields']['Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)'] == ''){$error[] = 'Please enter Applicant 2 - Child Care Costs (leave blank if the same as applicant 1';}
            if($clientPost['custom_fields']['Applicant 2 - Maintenance'] == ''){$error[] = 'Please enter Applicant 2 - Maintenance';}

          } else {

          }

          if(!$error){
            $client->leads->create($clientPost);
            $my_post = array(
               'post_title' => $_GET['title'] . ' ' . $_GET['forname'] . ' ' . $_GET['other-names'] . ' ' . $_GET['surname'],
               'post_date' => '',
               'post_content' => json_encode($_GET),
               'post_status' => 'publish',
               'post_type' => 'applications',
            );
            $the_post_id = wp_insert_post( $my_post );

						foreach ($clientPost['custom_fields'] as $key => $value) {
              update_post_meta($the_post_id, $key, $value);
            }

						$responce['status'] = 'Success';
            // $responce['data'] = $clientPost;
            // $responce['posted_data'] = $_GET;

          } else {

            $responce['status'] = 'error';
            $responce['data'] = $error;
            $responce['posted_data'] = '';

          }


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
      echo utf8_encode(trim(json_encode($responce, JSON_UNESCAPED_UNICODE), "\u0"));
    }
  } else {
    echo 'nothing to see here';
  }
?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
