<?php

session_start();

get_header();



$nationality = array('Afghan','Albanian','Algerian','American','Andorran','Angolan','Antiguans','Argentinean','Armenian','Australian','Austrian','Azerbaijani','Bahamian','Bahraini','Bangladeshi','Barbadian','Barbudans','Batswana','Belarusian','Belgian','Belizean','Beninese','Bhutanese','Bolivian','Bosnian','Brazilian','British','Bruneian','Bulgarian','Burkinabe','Burmese','Burundian','Cambodian','Cameroonian','Canadian','Cape Verdean','Central African','Chadian','Chilean','Chinese','Colombian','Comoran','Congolese','Costa Rican','Croatian','Cuban','Cypriot','Czech','Danish','Djibouti','Dominican','Dutch','East Timorese','Ecuadorean','Egyptian','Emirian','Equatorial Guinean','Eritrean','Estonian','Ethiopian','Fijian','Filipino','Finnish','French','Gabonese','Gambian','Georgian','German','Ghanaian','Greek','Grenadian','Guatemalan','Guinea-Bissauan','Guinean','Guyanese','Haitian','Herzegovinian','Honduran','Hungarian','I-Kiribati','Icelander','Indian','Indonesian','Iranian','Iraqi','Irish','Israeli','Italian','Ivorian','Jamaican','Japanese','Jordanian','Kazakhstani','Kenyan','Kittian and Nevisian','Kuwaiti','Kyrgyz','Laotian','Latvian','Lebanese','Liberian','Libyan','Liechtensteiner','Lithuanian','Luxembourger','Macedonian','Malagasy','Malawian','Malaysian','Maldivan','Malian','Maltese','Marshallese','Mauritanian','Mauritian','Mexican','Micronesian','Moldovan','Monacan','Mongolian','Moroccan','Mosotho','Motswana','Mozambican','Namibian','Nauruan','Nepalese','New Zealander','Nicaraguan','Nigerian','Nigerien','North Korean','Northern Irish','Norwegian','Omani','Pakistani','Palauan','Panamanian','Papua New Guinean','Paraguayan','Peruvian','Polish','Portuguese','Qatari','Romanian','Russian','Rwandan','Saint Lucian','Salvadoran','Samoan','San Marinese','Sao Tomean','Saudi','Scottish','Senegalese','Serbian','Seychellois','Sierra Leonean','Singaporean','Slovakian','Slovenian','Solomon Islander','Somali','South African','South Korean','Spanish','Sri Lankan','Sudanese','Surinamer','Swazi','Swedish','Swiss','Syrian','Taiwanese','Tajik','Tanzanian','Thai','Tolgolese','Tongan','Trinidadian or Tobagonian','Tunisian','Turkish','Tuvaluan','Ugandan','Ukranian','Uruguayan','Uzbekistani','Venezuelan','Vietnamese','Welsh','Yemenite','Yugoslav','Zambian','Zimbabwean');

?>

<section id="mortgage-apply-form">

    <section class="stage thankyou" data-id="0">

        <div class="container">

            <div class="row">

                <div class="col-md-5">

                    <img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/chirpy.png';?>" alt=""/>

                </div>

                <div class="col-md-7">

                    <div class="content">

                        <h1 class="page-title"></h1>

                        <p>

                            Welcome to TMP The Mortgage People. Below are a few questions for you to answer. Don’t worry if you’re unsure of any of the answers, our amazingly helpful team are on hand to guide you through registering if you get stuck. Just give us a call on 01604 780586 or drop us a line. Once you have completed all of the questions, your very own Case Manager will be in contact with you within 48 hours to talk you through your options. Simple.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <form action="" class="morg" method="POST" data-submitted="false">

        <section class="stage" data-id="1">

            <div class="container">

                <div class="row">

                    <div class="col-md-5">

                        <img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/chirpy.png';?>" alt=""/>

                    </div>

                    <div class="col-md-7">

                        <div class="content">

                            <h1 class="page-title">Apply.</h1>

                            <p>

                                Welcome to TMP The Mortgage People. Below are a few questions for you to answer. Don’t worry if you’re unsure of any of the answers, our amazingly helpful team are on hand to guide you through registering if you get stuck. Just give us a call on 01604 780586 or drop us a line. Once you have completed all of the questions, your very own Case Manager will be in contact with you within 48 hours to talk you through your options. Simple.

                            </p>

                            <div class="disclamer">

                                <p><strong>Please note that the information you give us will be used to assess your affordability. We will require evidence of this and therefore any incorrect information given at this point will cause delays and may affect your ability to proceed. If you are unable to provide accurate information, please contact us before applying</strong></p>

                                <p>Your home may be repossessed if you do not keep up repayments on your mortgage.</p>

                                <p>I agree with the above statements and that the information I am submitting is true and accurate</p>

                                <div class="slider">

                                    <div class="labelText">Have you applied for an assessment with TMP Mortgages previously?</div>

                                    <div class="slide">

                                        <input type="checkbox" name="existing" id="existing" value="">

                                        <label for="existing"></label>

                                    </div>

                                </div>

                                <div class="slider">

                                    <div class="labelText">I agree with the above statements and that the <br/>information I am submitting is true and accurate</div>

                                    <div class="slide">

                                        <input type="checkbox" name="disclamer" id="disclamer" value="">

                                        <label for="disclamer"></label>

                                    </div>

                                </div>

                                <div class="slider">

                                    <div class="labelText">This form collects your data so that we can proceed with your affordability/mortgage enquiry. Check our <a href="/privacy-policy/">Privacy Policy</a> for all of the information on how we store and manage your submitted data, and your legal rights regarding your data.</div>

                                    I consent to having TMP collect my data &nbsp; 

                                    <div class="slide">

                                        <input type="checkbox" name="privacy" id="privacy" value="checked">

                                        <label for="privacy"></label>

                                    </div>

                                </div>

                            </div>

                            <div class="form-type">

                                <span>I'm applying for</span>

                                <div class="dropdown application_type">

                                    <select name="application_type">

                                        <option value="">Please Select</option>

                                        <option value="single">Myself</option>

                                        <option value="joint">Myself and my partner</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="applicant_page stage">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <h2>Your basic details.</h2>

                    </div>

                </div>

                <div class="row">

                    <div class="form-fields">

                        <div class="col-md-4">

                            <div class="form-field title">

                                <label>My title</label>

                                <div class="dropdown">

                                    <select name="existing_title">

                                        <option value=""></option>

                                        <option value="Mr."> Mr </option>

                                        <option value="Mrs."> Mrs </option>

                                        <option value="Ms."> Ms </option>

                                        <option value="Miss."> Miss </option>

                                        <option value="Dr."> Dr </option>

                                        <option value="Rev."> Rev </option>

                                        <option value="Prof."> Prof </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-field forename">

                                <label>My forename</label>

                                <input type="text" value="" placeholder="" name="existing_forname"/>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-field surname">

                                <label>My surname</label>

                                <input type="text" value="" placeholder="" name="existing_surname"/>

                            </div>

                        </div>

                    </div>

                </div>

                <br/>

                <br/>

                <div class="row">

                    <div class="form-fields">

                        <div class="col-md-6">

                            <div class="form-field mobile_number">

                                <label>Your mobile number</label>

                                <input type="number" value="" placeholder="" name="existing_mobile_number"/>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-field email_address">

                                <label>Your email</label>

                                <input type="email" value="" placeholder="" name="existing_email_address"/>

                            </div>

                        </div>

                    </div>

                </div>

                <br/>

                <br/>

                <div class="row">

                    <div class="col-md-12">

                        <h2>Your requirements.</h2>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-fields">

                            <div class="form-field home_in_mind">

                                <label>Do you have a home in mind</label>

                                <div class="dropdown">

                                    <select name="existing_home">

                                        <option value=""></option>

                                        <option value="Yes">Yes</option>

                                        <option value="No">No</option>

                                    </select>

                                </div>

                            </div>

                            <div class="form-field purchase_type">

                                <label>

									<span class="motivo-tooltip">

										Choose <strong>New Home</strong> if you are looking to buy a new property (new build or second hand)<br/><br/>

										Choose <strong>Remortgage</strong> if your current mortgage deal is coming to an end<br/><br/>

										Choose <strong>Staircasing</strong> if you wish to buy more shares of your current shared ownership property

									</span>

                                    Purchase type <i class="fa fa-question-circle"></i>

                                </label>

                                <div class="dropdown">

                                    <select name="existing_purchase_type">

                                        <option value=""></option>

                                        <option value="Purchase">New Home</option>

                                        <option value="Remortgage">Remortgage</option>

                                        <option value="Staircasing">Staircasing</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <br class=""/>

                        <br class=""/>

                        <div class="form-fields ">

                            <div class="form-field housing_association">

                                <label>Housing association / Agent</label>

                                <div class="dropdown">

                                    <select name="existing_housing_association">

                                        <option value=""></option>

                                        <?php

                                        $terms = get_terms(array('taxonomy' => 'associations','hide_empty' => false,'parent' => 0));

                                        for ($i=0; $i < count($terms); $i++) {

                                            echo '<option value="'. $terms[$i]->name .'" data-id="'. $terms[$i]->term_id .'">'. $terms[$i]->name .'</option>';

                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <div class="form-field site_development">

                                <label>Name of site / Development</label>

                                <div class="dropdown">

                                    <select name="existing_site_development">

                                        <option value=""></option>

                                        <?php

                                        $terms = get_terms(array('taxonomy' => 'associations','hide_empty' => false,'parent' => 0));

                                        for ($i=0; $i < count($terms); $i++) {

                                            $term = get_terms(array('taxonomy' => 'associations','hide_empty' => false,'parent' => $terms[$i]->term_id));

                                            foreach ($term as $development) {

                                                echo '<span data-association="'. $terms[$i]->name .'"><option value="'. $development->name .'" data-association="'. $terms[$i]->name .'">'. $development->name .'</option></span>';

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <div class="form-field property_address_line_1">

                                <label>Property address Line 1 (If known)</label>

                                <input name="existing_property_address_line_1" type="text" value="" />

                            </div>

                        </div>

                        <br/ class="">

                        <br class=""/>

                        <div class="form-fields ">

                            <div class="form-field property_address_line_2">

                                <label>Line 2</label>

                                <input name="existing_property_address_line_2" type="text" value="" />

                            </div>

                            <div class="form-field property_address_line_3">

                                <label>Line 3</label>

                                <input name="existing_property_address_line_3" type="text" value="" />

                            </div>

                            <div class="form-field property_postcode">

                                <label>Postcode</label>

                                <input name="existing_property_postcode" type="text" value="" />

                            </div>

                        </div>

                        <br/>

                        <br/>

                        <div class="form-fields">

                            <div class="form-field property_full_price">

                                <label>

                                  <span class="motivo-tooltip">

                                    if you are remortgaging or staircasing, please add the estimated full value of your property

                                  </span>

                                    Full purchase price <i class="fa fa-question-circle"></i>

                                </label>

                                <input name="existing_property_full_price" type="text" value="" />

                            </div>

                            <div class="form-field property_percent_share">

                                <label>

                                  <span class="motivo-tooltip">

                                    If you are remortgaging or staircasing, please add the percentage share you currently own

                                  </span>

                                    Percent purchase share <i class="fa fa-question-circle"></i>

                                </label>

                                <input name="existing_property_percent_share" type="text" value="" />

                            </div>

                            <div class="form-field property_share_price">

                                <label>Share price</label>

                                <input name="existing_property_share_price" type="text" value="" />

                            </div>

                        </div>

                        <br/>

                        <br/>

                        <div class="form-fields">

                            <div class="form-field property_deposit">

                                <label>

                                  <span class="motivo-tooltip">

                                    If you are remortgaging or staircasing, please add the amount of equity in your share.  If you have additional monies to add to this, please advise in the Any Other Information box at the end of the questionnaire

                                  </span>

                                    Deposit amount <i class="fa fa-question-circle"></i>

                                </label>

                                <input name="existing_property_deposit" type="text" value="" />

                            </div>

                            <div class="form-field property_loan_amount">

                                <label>Loan amount</label>

                                <input name="existing_property_loan_amount" type="text" value="" />

                            </div>

                            <div class="form-field property_rent">

                                <label>Shared ownership rent (monthly)</label>

                                <input name="existing_property_rent" type="text" value="" />

                            </div>

                        </div>

                        <br/>

                        <br/>

                        <div class="form-fields">

                            <div class="form-field property_service_charge">

                                <label>Service charge (monthly)</label>

                                <input name="existing_property_service_charge" type="text" value="" />

                            </div>

                        </div>

                    </div>

                </div>

                <br/>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-type">

                            <button type="submit" class="userForm">

                                Complete & Submit

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <div class="applicant_one">

            <section class="stage" data-id="2"> <!-- Your basic details. -->

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <h2>Your basic details.</h2>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-fields">

                                <div class="form-field title">

                                    <label>My title</label>

                                    <div class="dropdown">

                                        <select name="title">

                                            <option value=""></option>

                                            <option value="Mr."> Mr </option>

                                            <option value="Mrs."> Mrs </option>

                                            <option value="Ms."> Ms </option>

                                            <option value="Miss."> Miss </option>

                                            <option value="Dr."> Dr </option>

                                            <option value="Rev."> Rev </option>

                                            <option value="Prof."> Prof </option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field forename">

                                    <label>My forename</label>

                                    <input type="text" value="" placeholder="" name="forname"/>

                                </div>

                                <div class="form-field surname">

                                    <label>My surname</label>

                                    <input type="text" value="" placeholder="" name="surname"/>

                                </div>

                                <div class="form-field other-names">

                                    <label>Other names</label>

                                    <input type="text" value="" placeholder="" name="other-names"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field dob">

                                    <label>My DOB</label>

                                    <div class="dropdown">

                                        <select name="dob_dd">

                                            <option value="">DD</option>

                                            <?php

                                            for ($i=1; $i < 32; $i++) {

                                                echo '<option value="'. $i .'">'. date('jS', mktime(0, 0, 0, 0, $i)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="dob_mm">

                                            <option value="">MM</option>

                                            <?php

                                            for ($i=1; $i < 13; $i++) {

                                                echo '<option value="'. $i .'">'. date('M', mktime(0, 0, 0, $i, 10)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="dob_yyyy">

                                            <option value="">YYYY</option>

                                            <?php

                                            for ($i=0; $i < 100; $i++) {

                                                echo '<option value="'. date('Y', strtotime('-'. $i .' year')) .'">'. date('Y', strtotime('-'. $i .' year')) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field gender">

                                    <label>My gender</label>

                                    <div class="dropdown">

                                        <select name="gender">

                                            <option value=""></option>

                                            <?php

                                            echo '<option value="Male">Male</option>';

                                            echo '<option value="Female">Female</option>';

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field marital_status">

                                    <label>Marital status</label>

                                    <div class="dropdown">

                                        <select name="marital_status">

                                            <option value=""></option>

                                            <option value="Single">Single</option>

                                            <option value="Married">Married</option>

                                            <option value="Divorced">Divorced</option>

                                            <option value="Co-Habitating">Co-Habitating</option>

                                            <option value="Separated">Separated</option>

                                            <option value="Widowed">Widowed</option>

                                            <option value="Civil Partnership">Civil Partnership</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field nationality">

                                    <label>My nationality</label>

                                    <div class="dropdown">

                                        <select name="nationality">

                                            <option value=""></option>

                                            <?php

                                            for ($i=0; $i < count($nationality); $i++) {

                                                echo '<option value="'. $nationality[$i] .'">'. $nationality[$i] .'</option>' . "\r\n";

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field dob">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Number of dependants <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="name" value="" placeholder="" name="dependants"/>

                                </div>

                                <div class="form-field leave_to_uk">

                                    <label>

                    <span class="motivo-tooltip">

                      If you are not a UK or EU Citizen, please answer this question as NO and provide details of your visa in the notes section

                    </span>

                                        Indefinite leave to remain <i class="fa fa-question-circle"></i>

                                    </label>

                                    <div class="dropdown">

                                        <select name="leave_to_uk">

                                            <option value=""></option>

                                            <option value="Yes">Yes</option>

                                            <option value="No">No</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field smoker">

                                    <label>Are you a smoker</label>

                                    <div class="dropdown">

                                        <select name="smoker">

                                            <option value=""></option>

                                            <option value="Yes">Yes</option>

                                            <option value="No">No</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field contact">

                                    <label>Your preferred method of contact</label>

                                    <div class="dropdown">

                                        <select name="contact">

                                            <option value=""></option>

                                            <option value="Mobile">Mobile</option>

                                            <option value="Email">Email</option>

                                            <option value="Both">Both</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field mobile_number">

                                    <label>Your mobile number</label>

                                    <input type="number" value="" placeholder="" name="mobile_number"/>

                                </div>

                                <div class="form-field email_address">

                                    <label>Your email</label>

                                    <input type="email" value="" placeholder="" name="email_address"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <a href="#" data-next="3" class="motivo-proceed"><strong>Proceed</strong> to the Next Step</a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <section class="stage" data-id="3"> <!-- Your Current Address -->

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <h2>Your Current Address.</h2>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-fields">

                                <div class="form-field house_and_street">

                                    <label>House number & Street</label>

                                    <input type="text" value="" placeholder="" name="house_and_street"/>

                                </div>

                                <div class="form-field city">

                                    <label>City</label>

                                    <input type="text" value="" placeholder="" name="city"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field county">

                                    <label>County</label>

                                    <input type="text" value="" placeholder="" name="county"/>

                                </div>

                                <div class="form-field postcode">

                                    <label>Postcode</label>

                                    <input type="text" value="" placeholder="" name="postcode"/>

                                </div>

                                <div class="form-field country">

                                    <label>Country</label>

                                    <input type="text" value="" placeholder="" name="country"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field moved">

                                    <label>Date moved to address</label>

                                    <div class="dropdown">

                                        <select name="moved_dd">

                                            <option value="">DD</option>

                                            <?php

                                            for ($i=1; $i < 32; $i++) {

                                                echo '<option value="'. $i .'">'. date('jS', mktime(0, 0, 0, 0, $i)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="moved_mm">

                                            <option value="">MM</option>

                                            <?php

                                            for ($i=1; $i < 13; $i++) {

                                                echo '<option value="'. $i .'">'. date('M', mktime(0, 0, 0, $i, 10)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="moved_yyyy">

                                            <option value="">YYYY</option>

                                            <?php

                                            for ($i=0; $i < 100; $i++) {

                                                echo '<option value="'. date('Y', strtotime('-'. $i .' year')) .'">'. date('Y', strtotime('-'. $i .' year')) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field current_address_status">

                                    <label>Status at current address</label>

                                    <div class="dropdown">

                                        <select name="current_address_status">

                                            <option value=""></option>

                                            <option value="Rent">Rent</option>

                                            <option value="Friends and Family">Friends and Family</option>

                                            <option value="Owned">Owned</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <a href="#" data-next="4" class="motivo-proceed"><strong>Proceed</strong> to the Next Step</a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <section class="stage" data-id="4"> <!-- Your Occupation -->

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <h2>Your Occupation.</h2>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-fields">

                                <div class="form-field self_employed">

                                    <label>Are you self employed</label>

                                    <div class="dropdown">

                                        <select name="self_employed">

                                            <option value=""></option>

                                            <option value="Yes">Yes</option>

                                            <option value="No">No</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field city">

                                    <label>Your occupation</label>

                                    <input type="text" value="" placeholder="" name="occupation"/>

                                </div>

                                <div class="form-field work_started">

                                    <label>Date started at this job</label>

                                    <div class="dropdown">

                                        <select name="started_dd">

                                            <option value="">DD</option>

                                            <?php

                                            for ($i=1; $i < 32; $i++) {

                                                echo '<option value="'. $i .'">'. date('jS', mktime(0, 0, 0, 0, $i)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="started_mm">

                                            <option value="">MM</option>

                                            <?php

                                            for ($i=1; $i < 13; $i++) {

                                                echo '<option value="'. $i .'">'. date('M', mktime(0, 0, 0, $i, 10)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="started_yyyy">

                                            <option value="">YYYY</option>

                                            <?php

                                            for ($i=0; $i < 100; $i++) {

                                                echo '<option value="'. date('Y', strtotime('-'. $i .' year')) .'">'. date('Y', strtotime('-'. $i .' year')) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field basic_salary">

                                    <label>Basic Salary (Annual)</label>

                                    <input type="number" value="" placeholder="" name="basic_salary"/>

                                </div>

                                <div class="form-field overtime">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Overtime (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="text" value="" placeholder="" name="overtime"/>

                                </div>

                                <div class="form-field other_income">

                                    <label>

                    <span class="motivo-tooltip">

                      Please provide details, such as source and frequency, of your other income in the Any Other Information box at the end of the form. Please complete with 0 if not applicable to you

                    </span>

                                        Other income (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="other_income"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field state_benefits">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        State Benefits (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="state_benefits"/>

                                </div>

                                <div class="form-field pension_contributions">

                                    <label>

                    <span class="motivo-tooltip">

                      Please add the payment you are making into your pension here. If you are receiving pension income, this should be added to the Basic salary. Please complete with 0 if not applicable to you

                    </span>

                                        Pension contributions (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="pension_contributions"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <a href="#" data-next="5" class="motivo-proceed"><strong>Proceed</strong> to the Next Step</a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <section class="stage" data-id="5"> <!-- Your Financial Info -->

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <h2>Your Financial Info.</h2>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-fields">

                                <div class="form-field adverse_credit">

                                    <label>

                    <span class="motivo-tooltip">

                      Please select yes if you have experienced any financial difficulties in the past 6 years resulting in any of the following: Late/Missed Payments, Defaults, CCJ’s, IVA’s, DMP, Bankruptcy. Please also send us a copy of your credit report by visiting one of the following websites: www.Equifax.co.uk, www.Experian.com, www.noddle.co.uk

                    </span>

                                        Adverse credit <i class="fa fa-question-circle"></i>

                                    </label>

                                    <div class="dropdown">

                                        <select name="adverse_credit">

                                            <option value=""></option>

                                            <option value="Yes">Yes</option>

                                            <option value="No">No</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field loan">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Total loan / HP repayments (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="loan"/>

                                </div>

                                <div class="form-field student_loan">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Student loan payments (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="student_loan"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field childcare_costs">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Child care costs (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="childcare_costs"/>

                                </div>

                                <div class="form-field maintenance">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Are you paying any maintenance (monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="maintenance"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field total_outstanding">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Total outstanding credit card balances <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="total_outstanding"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <a href="#" data-next="6" class="motivo-proceed is-applicant-2"><strong>Proceed</strong> to the Next Step</a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>

        <div class="applicant_two">

            <section class="stage" data-id="7"> <!-- Applicant two personal details -->

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <h2>Applicant 2. <strong>Your basic details</strong>.</h2>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-fields">

                                <div class="form-field title">

                                    <label>My title</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_title">

                                            <option value=""></option>

                                            <option value="Mr."> Mr </option>

                                            <option value="Mrs."> Mrs </option>

                                            <option value="Ms."> Ms </option>

                                            <option value="Miss."> Miss </option>

                                            <option value="Dr."> Dr </option>

                                            <option value="Rev."> Rev </option>

                                            <option value="Prof."> Prof </option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field forename">

                                    <label>My forename</label>

                                    <input type="text" value="" placeholder="" name="applicant_2_forname"/>

                                </div>

                                <div class="form-field surname">

                                    <label>My surname</label>

                                    <input type="text" value="" placeholder="" name="applicant_2_surname"/>

                                </div>

                                <div class="form-field other-names">

                                    <label>Other names</label>

                                    <input type="text" value="" placeholder="" name="applicant_2_other-names"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field dob">

                                    <label>My DOB</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_dob_dd">

                                            <option value="">DD</option>

                                            <?php

                                            for ($i=1; $i < 32; $i++) {

                                                echo '<option value="'. $i .'">'. date('jS', mktime(0, 0, 0, 0, $i)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="applicant_2_dob_mm">

                                            <option value="">MM</option>

                                            <?php

                                            for ($i=1; $i < 13; $i++) {

                                                echo '<option value="'. $i .'">'. date('M', mktime(0, 0, 0, $i, 10)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="applicant_2_dob_yyyy">

                                            <option value="">YYYY</option>

                                            <?php

                                            for ($i=0; $i < 100; $i++) {

                                                echo '<option value="'. date('Y', strtotime('-'. $i .' year')) .'">'. date('Y', strtotime('-'. $i .' year')) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field gender">

                                    <label>My gender</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_gender">

                                            <option value=""></option>

                                            <option value="Male">Male</option>

                                            <option value="Female">Female</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field marital_status">

                                    <label>Marital status</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_marital_status">

                                            <option value=""></option>

                                            <option value="Single">Single</option>

                                            <option value="Married">Married</option>

                                            <option value="Divorced">Divorced</option>

                                            <option value="Co-Habitating">Co-Habitating</option>

                                            <option value="Separated">Separated</option>

                                            <option value="Widowed">Widowed</option>

                                            <option value="Civil Partnership">Civil Partnership</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field nationality">

                                    <label>My nationality</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_nationality">

                                            <option value=""></option>

                                            <?php

                                            for ($i=0; $i < count($nationality); $i++) {

                                                echo '<option value="'. $nationality[$i] .'">'. $nationality[$i] .'</option>' . "\r\n";

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field dob">

                                    <label>Number of dependants</label>

                                    <input type="name" value="" placeholder="" name="applicant_2_dependants"/>

                                </div>

                                <div class="form-field leave_to_uk">

                                    <label>

                    <span class="motivo-tooltip">

                      If you are not a UK or EU Citizen, please answer this question as NO and provide details of your visa in the notes section

                    </span>

                                        Indefinite leave to remain <i class="fa fa-question-circle"></i>

                                    </label>

                                    <div class="dropdown">

                                        <select name="applicant_2_leave_to_uk">

                                            <option value=""></option>

                                            <option value="Yes">Yes</option>

                                            <option value="No">No</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field smoker">

                                    <label>Are you a smoker</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_smoker">

                                            <option value=""></option>

                                            <option value="Yes">Yes</option>

                                            <option value="No">No</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field applicant_2_method_of_contact">

                                    <label>Your preferred method of contact</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_method_of_contact">

                                            <option value=""></option>

                                            <option value="Mobile">Mobile</option>

                                            <option value="Email">Email</option>

                                            <option value="Both">Both</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field mobile_number">

                                    <label>Your mobile number</label>

                                    <input type="number" value="" placeholder="" name="applicant_2_mobile_number"/>

                                </div>

                                <div class="form-field email_address">

                                    <label>Your email</label>

                                    <input type="email" value="" placeholder="" name="applicant_2_email_address"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <a href="#" data-next="8" class="motivo-proceed"><strong>Proceed</strong> to the Next Step</a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <section class="stage" data-id="8"> <!-- Applicant two address -->

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <h2>Applicant 2. <strong>Your Current Address.</strong></h2>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-fields">

                                <div class="form-field house_and_street">

                                    <label>House number & Street</label>

                                    <input type="text" value="" placeholder="" name="applicant_2_house_and_street"/>

                                </div>

                                <div class="form-field city">

                                    <label>City</label>

                                    <input type="text" value="" placeholder="" name="applicant_2_city"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field county">

                                    <label>County</label>

                                    <input type="text" value="" placeholder="" name="applicant_2_county"/>

                                </div>

                                <div class="form-field postcode">

                                    <label>Postcode</label>

                                    <input type="text" value="" placeholder="" name="applicant_2_postcode"/>

                                </div>

                                <div class="form-field country">

                                    <label>Country</label>

                                    <input type="text" value="" placeholder="" name="applicant_2_country"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field moved">

                                    <label>Date moved to address</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_moved_dd">

                                            <option value="">DD</option>

                                            <?php

                                            for ($i=1; $i < 32; $i++) {

                                                echo '<option value="'. $i .'">'. date('jS', mktime(0, 0, 0, 0, $i)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="applicant_2_moved_mm">

                                            <option value="">MM</option>

                                            <?php

                                            for ($i=1; $i < 13; $i++) {

                                                echo '<option value="'. $i .'">'. date('M', mktime(0, 0, 0, $i, 10)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="applicant_2_moved_yyyy">

                                            <option value="">YYYY</option>

                                            <?php

                                            for ($i=0; $i < 100; $i++) {

                                                echo '<option value="'. date('Y', strtotime('-'. $i .' year')) .'">'. date('Y', strtotime('-'. $i .' year')) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field current_address_status">

                                    <label>Status at current address</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_current_address_status">

                                            <option value=""></option>

                                            <option value="Rent">Rent</option>

                                            <option value="Friends and Family">Friends and Family</option>

                                            <option value="Owned">Owned</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <a href="#" data-next="9" class="motivo-proceed"><strong>Proceed</strong> to the Next Step</a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <section class="stage" data-id="9"> <!-- Occupation -->

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <h2>Applicant 2. <strong>Your Occupation.</strong></h2>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-fields">

                                <div class="form-field applicant_2_self_employed">

                                    <label>Are you self employed</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_self_employed">

                                            <option value=""></option>

                                            <option value="Yes">Yes</option>

                                            <option value="No">No</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field city">

                                    <label>Your occupation</label>

                                    <input type="text" value="" placeholder="" name="applicant_2_occupation"/>

                                </div>

                                <div class="form-field work_started">

                                    <label>Date started at this job</label>

                                    <div class="dropdown">

                                        <select name="applicant_2_started_dd">

                                            <option value="">DD</option>

                                            <?php

                                            for ($i=1; $i < 32; $i++) {

                                                echo '<option value="'. $i .'">'. date('jS', mktime(0, 0, 0, 0, $i)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="applicant_2_started_mm">

                                            <option value="">MM</option>

                                            <?php

                                            for ($i=1; $i < 13; $i++) {

                                                echo '<option value="'. $i .'">'. date('M', mktime(0, 0, 0, $i, 10)) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                    <div class="dropdown">

                                        <select name="applicant_2_started_yyyy">

                                            <option value="">YYYY</option>

                                            <?php

                                            for ($i=0; $i < 100; $i++) {

                                                echo '<option value="'. date('Y', strtotime('-'. $i .' year')) .'">'. date('Y', strtotime('-'. $i .' year')) .'</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field applicant_2_basic_salary">

                                    <label>Basic Salary (Annual)</label>

                                    <input type="number" value="" placeholder="" name="applicant_2_basic_salary"/>

                                </div>

                                <div class="form-field applicant_2_overtime">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Overtime (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="text" value="" placeholder="" name="applicant_2_overtime"/>

                                </div>

                                <div class="form-field other_income">

                                    <label>

                    <span class="motivo-tooltip">

                      Please provide details, such as source and frequency, of your other income in the Any Other Information box at the end of the form. Please complete with 0 if not applicable to you

                    </span>

                                        Other income (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="applicant_2_other_income"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field state_benefits">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        State Benefits (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="applicant_2_state_benefits"/>

                                </div>

                                <div class="form-field pension_contributions">

                                    <label>

                    <span class="motivo-tooltip">

                      Please add the payment you are making into your pension here. If you are receiving pension income, this should be added to the Basic salary. Please complete with 0 if not applicable to you

                    </span>

                                        Pension contributions (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="applicant_2_pension_contributions"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <a href="#" data-next="10" class="motivo-proceed"><strong>Proceed</strong> to the Next Step</a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

            <section class="stage" data-id="10"> <!-- Applicatnt 2 finacial info -->

                <div class="container">

                    <div class="row">

                        <div class="col-md-12">

                            <h2>Applicant 2. <strong>Your Financial Info.</strong></h2>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-fields">

                                <div class="form-field adverse_credit">

                                    <label>

                    <span class="motivo-tooltip">

                      Please select yes if you have experienced any financial difficulties in the past 6 years resulting in any of the following: Late/Missed Payments, Defaults, CCJ’s, IVA’s, DMP, Bankruptcy. Please also send us a copy of your credit report by visiting one of the following websites: www.Equifax.co.uk, www.Experian.com, www.noddle.co.uk

                    </span>

                                        Adverse credit <i class="fa fa-question-circle"></i>

                                    </label>

                                    <div class="dropdown">

                                        <select name="applicant_2_adverse_credit">

                                            <option value=""></option>

                                            <option value="Yes">Yes</option>

                                            <option value="No">No</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-field loan">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Total loan / HP repayments (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="applicant_2_loan"/>

                                </div>

                                <div class="form-field student_loan">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Student loan payments (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="applicant_2_student_loan"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field childcare_costs">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Child care costs (Monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="applicant_2_childcare_costs"/>

                                </div>

                                <div class="form-field maintenance">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Are you paying any maintenance (monthly) <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="applicant_2_maintenance"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <div class="form-field total_outstanding">

                                    <label>

                    <span class="motivo-tooltip">

                      Please complete with 0 if not applicable to you

                    </span>

                                        Total outstanding credit card balances <i class="fa fa-question-circle"></i>

                                    </label>

                                    <input type="number" value="" placeholder="" name="applicant_2_total_outstanding"/>

                                </div>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-fields">

                                <a href="#" data-next="6" class="motivo-proceed"><strong>Proceed</strong> to the Next Step</a>

                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>

        <section class="stage" data-id="6"> <!-- Your requirements -->

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <h2>Your requirements.</h2>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-fields">

                            <div class="form-field home_in_mind">

                                <label>Do you have a home in mind</label>

                                <div class="dropdown">

                                    <select name="home">

                                        <option value=""></option>

                                        <option value="Yes">Yes</option>

                                        <option value="No">No</option>

                                    </select>

                                </div>

                            </div>

                            <div class="form-field purchase_type">

                                <label>

									<span class="motivo-tooltip">

										Choose <strong>New Home</strong> if you are looking to buy a new property (new build or second hand)<br/><br/>

										Choose <strong>Remortgage</strong> if your current mortgage deal is coming to an end<br/><br/>

										Choose <strong>Staircasing</strong> if you wish to buy more shares of your current shared ownership property

									</span>

                                    Purchase type <i class="fa fa-question-circle"></i>

                                </label>

                                <div class="dropdown">

                                    <select name="purchase_type">

                                        <option value=""></option>

                                        <option value="Purchase">New Home</option>

                                        <option value="Remortgage">Remortgage</option>

                                        <option value="Staircasing">Staircasing</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <br class=""/>

                        <br class=""/>

                        <div class="form-fields ">

                            <div class="form-field housing_association">

                                <label>Housing association / Agent</label>

                                <div class="dropdown">

                                    <select name="housing_association">

                                        <option value=""></option>

                                        <?php

                                        $terms = get_terms(array('taxonomy' => 'associations','hide_empty' => false,'parent' => 0));

                                        for ($i=0; $i < count($terms); $i++) {

                                            echo '<option value="'. $terms[$i]->name .'" data-id="'. $terms[$i]->term_id .'">'. $terms[$i]->name .'</option>';

                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <div class="form-field site_development">

                                <label>Name of site / Development</label>

                                <div class="dropdown">

                                    <select name="site_development">

                                        <option value=""></option>

                                        <?php

                                        $terms = get_terms(array('taxonomy' => 'associations','hide_empty' => false,'parent' => 0));

                                        for ($i=0; $i < count($terms); $i++) {

                                            $term = get_terms(array('taxonomy' => 'associations','hide_empty' => false,'parent' => $terms[$i]->term_id));

                                            foreach ($term as $development) {

                                                echo '<span data-association="'. $terms[$i]->name .'"><option value="'. $development->name .'" data-association="'. $terms[$i]->name .'">'. $development->name .'</option></span>';

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>

                            </div>

                            <div class="form-field property_address_line_1">

                                <label>Property address Line 1 (If known)</label>

                                <input name="property_address_line_1" type="text" value="" />

                            </div>

                        </div>

                        <br/ class="">

                        <br class=""/>

                        <div class="form-fields ">

                            <div class="form-field property_address_line_2">

                                <label>Line 2</label>

                                <input name="property_address_line_2" type="text" value="" />

                            </div>

                            <div class="form-field property_address_line_3">

                                <label>Line 3</label>

                                <input name="property_address_line_3" type="text" value="" />

                            </div>

                            <div class="form-field property_postcode">

                                <label>Postcode</label>

                                <input name="property_postcode" type="text" value="" />

                            </div>

                        </div>

                        <br/>

                        <br/>

                        <div class="form-fields">

                            <div class="form-field property_full_price">

                                <label>

                                  <span class="motivo-tooltip">

                                    if you are remortgaging or staircasing, please add the estimated full value of your property

                                  </span>

                                    Full purchase price <i class="fa fa-question-circle"></i>

                                </label>

                                <input name="property_full_price" type="text" value="" />

                            </div>

                            <div class="form-field property_percent_share">

                                <label>

                                  <span class="motivo-tooltip">

                                    If you are remortgaging or staircasing, please add the percentage share you currently own

                                  </span>

                                    Percent purchase share <i class="fa fa-question-circle"></i>

                                </label>

                                <input name="property_percent_share" type="text" value="" />

                            </div>

                            <div class="form-field property_share_price">

                                <label>Share price</label>

                                <input name="property_share_price" type="text" value="" />

                            </div>

                        </div>

                        <br/>

                        <br/>

                        <div class="form-fields">

                            <div class="form-field property_deposit">

                                <label>

                                  <span class="motivo-tooltip">

                                    If you are remortgaging or staircasing, please add the amount of equity in your share.  If you have additional monies to add to this, please advise in the Any Other Information box at the end of the questionnaire

                                  </span>

                                    Deposit amount <i class="fa fa-question-circle"></i>

                                </label>

                                <input name="property_deposit" type="text" value="" />

                            </div>

                            <div class="form-field property_loan_amount">

                                <label>Loan amount</label>

                                <input name="property_loan_amount" type="text" value="" />

                            </div>

                            <div class="form-field property_rent">

                                <label>Shared ownership rent (monthly)</label>

                                <input name="property_rent" type="text" value="" />

                            </div>

                        </div>

                        <br/>

                        <br/>

                        <div class="form-fields">

                            <div class="form-field property_service_charge">

                                <label>Service charge (monthly)</label>

                                <input name="property_service_charge" type="text" value="" />

                            </div>

                        </div>

                        <br/>

                        <br/>

                        <div class="form-fields">

                            <a href="#" data-next="11" class="motivo-proceed"><strong>Proceed</strong> to the Next Step</a>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="stage" data-id="11">

            <div class="container">

                <div class="row">

                    <div class="col-md-12">

                        <div class="content">

                            <div class="form-type">

                                <h2>Form Completion.</h2>

                                <p>By submitting my details you will hold my personal data on your database. An advisor may then be in touch by telephone or email to discuss my potential requirements.</p>

                            </div>

                            <br/>

                            <div class="form-type">

                                <textarea name="other_info" placeholder="Any Other Information"></textarea>

                            </div>

                            <br/>

                            <br/>

                            <div class="form-type">

                                <button type="submit" class="morgform">

                                    Complete & Submit

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </form>

</section>

<?php get_footer(); ?>