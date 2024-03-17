<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add New</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <style>
        <?php include "boilerplate.css" ?>
    </style>
    <body>
        <!--Navbar-->
        <div class="topnav">
            <a class="filename" id="FilenameOnNavbar">Template</a>
            <a class="Publish" style="float:right; cursor: pointer;" onclick="showSavePopup()">Save</a>
        </div>
        <div class="hide" id="savedScreen" style="background-color: lightgreen; color: white; padding: 10px; padding-left: 20px;">Saved Form ✓</div>
        <!--Div containing everything else-->
        <div class="container-fluid" id="main-plugin-container">

            <!--An overlay/grey screen appearing when clicking Save button on top right of the screen-->
            <div class="overlay" id="overlay"></div>

            <!--Pop up that appears after clicking the Save button-->
            <div class="savePopup hide" id="savePopup">
                <div class="row" style="flex-direction: row;">
                    <div class="col">
                        <h5 class="saveFormTitle">Save Form</h5>
                    </div>
                    <div class="col">
                        <i class="fa fa-close" style="font-size: 24px; cursor: pointer;" onclick="closeSavePopup()"></i>
                    </div>
                </div>
                <div class="row" style="justify-content: center;">
                    <div class="col-sm-11" style="padding-top: 20px; margin-left: 5vh; margin-right: 5vh; max-width: 90%;">
                        <input type="text" class="form-control" id="inputSaveFileName" value="ContactMe" required>
                        <button type="submit" id="SaveFormButton" class="btn btn-primary mb-3" style="float:right; width: 125px; margin-top: 25px;" onclick="saveChanges()">Save Changes</button>
                    </div>
                </div>
            </div>

            <!--Using flexbox to create 1 row overseeing the form editor-->
            <div class="row layout-row">
                <!--First column for sidebar-->
                <div class="col" id="sidebar">
                    <!--First column for sidebar-->
                    <div class="row" id="doneButton" onclick="hideSidebar(this)">
                        <!--Done button that opens/closes the sidebar-->
                        <button type="button" class="btn btn-primary mb-3">Done</button>
                    </div>
                    <!--row for the search bar-->
                    <div class="row">
                        <div class="search-wrapper mb-3" id="searchElement">
                            <label for="inputSearch" class="col-sm-2 col-form-label">Filter Elements</label>
                            <div class="col-sm-10">
                                <input type="search" class="form-control" id="inputSearch" data-search>
                            </div>
                        </div>
                    </div>
                    <!--row containing all the draggable elements-->
                    <div class="row" id="draggableElements">
                        <h5 class="titles">User Information Fields</h5>
                        <!--each row containing a specific element within it-->
                        <div class="row drag-row" id="name">
                            <!--unique column that is draggable. *NOTE, the parent of this column is NOT draggable-->
                            <div class="col drag-col" id="name" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputName" class="col-sm-2 col-form-label grab">Name</label>
                                <div class="col-sm-12">
                                    <input name="name" type="text" class="form-control" id="inputName" required>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="surname">
                            <div class="col drag-col" id="surname" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputLastName" class="col-sm-2 col-form-label grab">Surname</label>
                                <div class="col-sm-12">
                                    <input name="surname" type="text" class="form-control" id="inputLastName" required>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="email">
                            <div class="col drag-col" id="email" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputEmail" class="col-sm-2 col-form-label grab">Email</label>
                                <div class="col-sm-12">
                                    <input name="email" type="email" class="form-control" id="inputEmail" autocomplete="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="mobile phone number">
                            <div class="col drag-col" id="mobile phone number" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputTel" class="col-sm-2 col-form-label grab">Mobile</label>
                                <div class="col-sm-12">
                                    <input name="phone" type="tel" class="form-control" id="inputTel" required>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="address">
                            <div class="col drag-col" id="address" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputAddress" class="col-sm-2 col-form-label grab">Address</label>
                                <div class="col-sm-12">
                                    <input name="address" class="form-control" type="text" id="inputAddress" required>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="city">
                            <div class="col drag-col" id="city" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputCity" class="col-sm-2 col-form-label grab">City</label>
                                <div class="col-sm-12">
                                    <input name="city" class="form-control" type="text" id="inputCity" required>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="zip">
                            <div class="col drag-col" id="zip" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputZip" class="col-sm-2 col-form-label grab">Zip</label>
                                <div class="col-sm-12">
                                    <input name="zip" class="form-control" type="text" id="inputZip">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="password">
                            <div class="col drag-col" id="password" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label grab">Password</label>
                                <div class="col-sm-12">
                                    <input name="password" type="password" class="form-control" id="inputPassword" required>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="country">
                            <div class="col drag-col" id="country" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <select name="selectCountry" class="form-select" aria-label="Country select">
                                    <option value="0" label="Select a country ... " selected="selected">Select a country ... </option>
                                    <optgroup id="country-optgroup-Africa" label="Africa">
                                        <option value="DZ" label="Algeria">Algeria</option>
                                        <option value="AO" label="Angola">Angola</option>
                                        <option value="BJ" label="Benin">Benin</option>
                                        <option value="BW" label="Botswana">Botswana</option>
                                        <option value="BF" label="Burkina Faso">Burkina Faso</option>
                                        <option value="BI" label="Burundi">Burundi</option>
                                        <option value="CM" label="Cameroon">Cameroon</option>
                                        <option value="CV" label="Cape Verde">Cape Verde</option>
                                        <option value="CF" label="Central African Republic">Central African Republic</option>
                                        <option value="TD" label="Chad">Chad</option>
                                        <option value="KM" label="Comoros">Comoros</option>
                                        <option value="CG" label="Congo - Brazzaville">Congo - Brazzaville</option>
                                        <option value="CD" label="Congo - Kinshasa">Congo - Kinshasa</option>
                                        <option value="CI" label="Côte d’Ivoire">Côte d’Ivoire</option>
                                        <option value="DJ" label="Djibouti">Djibouti</option>
                                        <option value="EG" label="Egypt">Egypt</option>
                                        <option value="GQ" label="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="ER" label="Eritrea">Eritrea</option>
                                        <option value="ET" label="Ethiopia">Ethiopia</option>
                                        <option value="GA" label="Gabon">Gabon</option>
                                        <option value="GM" label="Gambia">Gambia</option>
                                        <option value="GH" label="Ghana">Ghana</option>
                                        <option value="GN" label="Guinea">Guinea</option>
                                        <option value="GW" label="Guinea-Bissau">Guinea-Bissau</option>
                                        <option value="KE" label="Kenya">Kenya</option>
                                        <option value="LS" label="Lesotho">Lesotho</option>
                                        <option value="LR" label="Liberia">Liberia</option>
                                        <option value="LY" label="Libya">Libya</option>
                                        <option value="MG" label="Madagascar">Madagascar</option>
                                        <option value="MW" label="Malawi">Malawi</option>
                                        <option value="ML" label="Mali">Mali</option>
                                        <option value="MR" label="Mauritania">Mauritania</option>
                                        <option value="MU" label="Mauritius">Mauritius</option>
                                        <option value="YT" label="Mayotte">Mayotte</option>
                                        <option value="MA" label="Morocco">Morocco</option>
                                        <option value="MZ" label="Mozambique">Mozambique</option>
                                        <option value="NA" label="Namibia">Namibia</option>
                                        <option value="NE" label="Niger">Niger</option>
                                        <option value="NG" label="Nigeria">Nigeria</option>
                                        <option value="RW" label="Rwanda">Rwanda</option>
                                        <option value="RE" label="Réunion">Réunion</option>
                                        <option value="SH" label="Saint Helena">Saint Helena</option>
                                        <option value="SN" label="Senegal">Senegal</option>
                                        <option value="SC" label="Seychelles">Seychelles</option>
                                        <option value="SL" label="Sierra Leone">Sierra Leone</option>
                                        <option value="SO" label="Somalia">Somalia</option>
                                        <option value="ZA" label="South Africa">South Africa</option>
                                        <option value="SD" label="Sudan">Sudan</option>
                                        <option value="SZ" label="Swaziland">Swaziland</option>
                                        <option value="ST" label="São Tomé and Príncipe">São Tomé and Príncipe</option>
                                        <option value="TZ" label="Tanzania">Tanzania</option>
                                        <option value="TG" label="Togo">Togo</option>
                                        <option value="TN" label="Tunisia">Tunisia</option>
                                        <option value="UG" label="Uganda">Uganda</option>
                                        <option value="EH" label="Western Sahara">Western Sahara</option>
                                        <option value="ZM" label="Zambia">Zambia</option>
                                        <option value="ZW" label="Zimbabwe">Zimbabwe</option>
                                    </optgroup>
                                    <optgroup id="country-optgroup-Americas" label="Americas">
                                        <option value="AI" label="Anguilla">Anguilla</option>
                                        <option value="AG" label="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="AR" label="Argentina">Argentina</option>
                                        <option value="AW" label="Aruba">Aruba</option>
                                        <option value="BS" label="Bahamas">Bahamas</option>
                                        <option value="BB" label="Barbados">Barbados</option>
                                        <option value="BZ" label="Belize">Belize</option>
                                        <option value="BM" label="Bermuda">Bermuda</option>
                                        <option value="BO" label="Bolivia">Bolivia</option>
                                        <option value="BR" label="Brazil">Brazil</option>
                                        <option value="VG" label="British Virgin Islands">British Virgin Islands</option>
                                        <option value="CA" label="Canada">Canada</option>
                                        <option value="KY" label="Cayman Islands">Cayman Islands</option>
                                        <option value="CL" label="Chile">Chile</option>
                                        <option value="CO" label="Colombia">Colombia</option>
                                        <option value="CR" label="Costa Rica">Costa Rica</option>
                                        <option value="CU" label="Cuba">Cuba</option>
                                        <option value="DM" label="Dominica">Dominica</option>
                                        <option value="DO" label="Dominican Republic">Dominican Republic</option>
                                        <option value="EC" label="Ecuador">Ecuador</option>
                                        <option value="SV" label="El Salvador">El Salvador</option>
                                        <option value="FK" label="Falkland Islands">Falkland Islands</option>
                                        <option value="GF" label="French Guiana">French Guiana</option>
                                        <option value="GL" label="Greenland">Greenland</option>
                                        <option value="GD" label="Grenada">Grenada</option>
                                        <option value="GP" label="Guadeloupe">Guadeloupe</option>
                                        <option value="GT" label="Guatemala">Guatemala</option>
                                        <option value="GY" label="Guyana">Guyana</option>
                                        <option value="HT" label="Haiti">Haiti</option>
                                        <option value="HN" label="Honduras">Honduras</option>
                                        <option value="JM" label="Jamaica">Jamaica</option>
                                        <option value="MQ" label="Martinique">Martinique</option>
                                        <option value="MX" label="Mexico">Mexico</option>
                                        <option value="MS" label="Montserrat">Montserrat</option>
                                        <option value="AN" label="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="NI" label="Nicaragua">Nicaragua</option>
                                        <option value="PA" label="Panama">Panama</option>
                                        <option value="PY" label="Paraguay">Paraguay</option>
                                        <option value="PE" label="Peru">Peru</option>
                                        <option value="PR" label="Puerto Rico">Puerto Rico</option>
                                        <option value="BL" label="Saint Barthélemy">Saint Barthélemy</option>
                                        <option value="KN" label="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="LC" label="Saint Lucia">Saint Lucia</option>
                                        <option value="MF" label="Saint Martin">Saint Martin</option>
                                        <option value="PM" label="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="VC" label="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                        <option value="SR" label="Suriname">Suriname</option>
                                        <option value="TT" label="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="TC" label="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="VI" label="U.S. Virgin Islands">U.S. Virgin Islands</option>
                                        <option value="US" label="United States">United States</option>
                                        <option value="UY" label="Uruguay">Uruguay</option>
                                        <option value="VE" label="Venezuela">Venezuela</option>
                                    </optgroup>
                                    <optgroup id="country-optgroup-Asia" label="Asia">
                                        <option value="AF" label="Afghanistan">Afghanistan</option>
                                        <option value="AM" label="Armenia">Armenia</option>
                                        <option value="AZ" label="Azerbaijan">Azerbaijan</option>
                                        <option value="BH" label="Bahrain">Bahrain</option>
                                        <option value="BD" label="Bangladesh">Bangladesh</option>
                                        <option value="BT" label="Bhutan">Bhutan</option>
                                        <option value="BN" label="Brunei">Brunei</option>
                                        <option value="KH" label="Cambodia">Cambodia</option>
                                        <option value="CN" label="China">China</option>
                                        <option value="GE" label="Georgia">Georgia</option>
                                        <option value="HK" label="Hong Kong SAR China">Hong Kong SAR China</option>
                                        <option value="IN" label="India">India</option>
                                        <option value="ID" label="Indonesia">Indonesia</option>
                                        <option value="IR" label="Iran">Iran</option>
                                        <option value="IQ" label="Iraq">Iraq</option>
                                        <option value="IL" label="Israel">Israel</option>
                                        <option value="JP" label="Japan">Japan</option>
                                        <option value="JO" label="Jordan">Jordan</option>
                                        <option value="KZ" label="Kazakhstan">Kazakhstan</option>
                                        <option value="KW" label="Kuwait">Kuwait</option>
                                        <option value="KG" label="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="LA" label="Laos">Laos</option>
                                        <option value="LB" label="Lebanon">Lebanon</option>
                                        <option value="MO" label="Macau SAR China">Macau SAR China</option>
                                        <option value="MY" label="Malaysia">Malaysia</option>
                                        <option value="MV" label="Maldives">Maldives</option>
                                        <option value="MN" label="Mongolia">Mongolia</option>
                                        <option value="MM" label="Myanmar [Burma]">Myanmar [Burma]</option>
                                        <option value="NP" label="Nepal">Nepal</option>
                                        <option value="NT" label="Neutral Zone">Neutral Zone</option>
                                        <option value="KP" label="North Korea">North Korea</option>
                                        <option value="OM" label="Oman">Oman</option>
                                        <option value="PK" label="Pakistan">Pakistan</option>
                                        <option value="PS" label="Palestinian Territories">Palestinian Territories</option>
                                        <option value="YD" label="People's Democratic Republic of Yemen">People's Democratic Republic of Yemen</option>
                                        <option value="PH" label="Philippines">Philippines</option>
                                        <option value="QA" label="Qatar">Qatar</option>
                                        <option value="SA" label="Saudi Arabia">Saudi Arabia</option>
                                        <option value="SG" label="Singapore">Singapore</option>
                                        <option value="KR" label="South Korea">South Korea</option>
                                        <option value="LK" label="Sri Lanka">Sri Lanka</option>
                                        <option value="SY" label="Syria">Syria</option>
                                        <option value="TW" label="Taiwan">Taiwan</option>
                                        <option value="TJ" label="Tajikistan">Tajikistan</option>
                                        <option value="TH" label="Thailand">Thailand</option>
                                        <option value="TL" label="Timor-Leste">Timor-Leste</option>
                                        <option value="TR" label="Turkey">Turkey</option>
                                        <option value="TM" label="Turkmenistan">Turkmenistan</option>
                                        <option value="AE" label="United Arab Emirates">United Arab Emirates</option>
                                        <option value="UZ" label="Uzbekistan">Uzbekistan</option>
                                        <option value="VN" label="Vietnam">Vietnam</option>
                                        <option value="YE" label="Yemen">Yemen</option>
                                    </optgroup>
                                    <optgroup id="country-optgroup-Europe" label="Europe">
                                        <option value="AL" label="Albania">Albania</option>
                                        <option value="AD" label="Andorra">Andorra</option>
                                        <option value="AT" label="Austria">Austria</option>
                                        <option value="BY" label="Belarus">Belarus</option>
                                        <option value="BE" label="Belgium">Belgium</option>
                                        <option value="BA" label="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="BG" label="Bulgaria">Bulgaria</option>
                                        <option value="HR" label="Croatia">Croatia</option>
                                        <option value="CY" label="Cyprus">Cyprus</option>
                                        <option value="CZ" label="Czech Republic">Czech Republic</option>
                                        <option value="DK" label="Denmark">Denmark</option>
                                        <option value="DD" label="East Germany">East Germany</option>
                                        <option value="EE" label="Estonia">Estonia</option>
                                        <option value="FO" label="Faroe Islands">Faroe Islands</option>
                                        <option value="FI" label="Finland">Finland</option>
                                        <option value="FR" label="France">France</option>
                                        <option value="DE" label="Germany">Germany</option>
                                        <option value="GI" label="Gibraltar">Gibraltar</option>
                                        <option value="GR" label="Greece">Greece</option>
                                        <option value="GG" label="Guernsey">Guernsey</option>
                                        <option value="HU" label="Hungary">Hungary</option>
                                        <option value="IS" label="Iceland">Iceland</option>
                                        <option value="IE" label="Ireland">Ireland</option>
                                        <option value="IM" label="Isle of Man">Isle of Man</option>
                                        <option value="IT" label="Italy">Italy</option>
                                        <option value="JE" label="Jersey">Jersey</option>
                                        <option value="LV" label="Latvia">Latvia</option>
                                        <option value="LI" label="Liechtenstein">Liechtenstein</option>
                                        <option value="LT" label="Lithuania">Lithuania</option>
                                        <option value="LU" label="Luxembourg">Luxembourg</option>
                                        <option value="MK" label="Macedonia">Macedonia</option>
                                        <option value="MT" label="Malta">Malta</option>
                                        <option value="FX" label="Metropolitan France">Metropolitan France</option>
                                        <option value="MD" label="Moldova">Moldova</option>
                                        <option value="MC" label="Monaco">Monaco</option>
                                        <option value="ME" label="Montenegro">Montenegro</option>
                                        <option value="NL" label="Netherlands">Netherlands</option>
                                        <option value="NO" label="Norway">Norway</option>
                                        <option value="PL" label="Poland">Poland</option>
                                        <option value="PT" label="Portugal">Portugal</option>
                                        <option value="RO" label="Romania">Romania</option>
                                        <option value="RU" label="Russia">Russia</option>
                                        <option value="SM" label="San Marino">San Marino</option>
                                        <option value="RS" label="Serbia">Serbia</option>
                                        <option value="CS" label="Serbia and Montenegro">Serbia and Montenegro</option>
                                        <option value="SK" label="Slovakia">Slovakia</option>
                                        <option value="SI" label="Slovenia">Slovenia</option>
                                        <option value="ES" label="Spain">Spain</option>
                                        <option value="SJ" label="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="SE" label="Sweden">Sweden</option>
                                        <option value="CH" label="Switzerland">Switzerland</option>
                                        <option value="UA" label="Ukraine">Ukraine</option>
                                        <option value="SU" label="Union of Soviet Socialist Republics">Union of Soviet Socialist Republics</option>
                                        <option value="GB" label="United Kingdom">United Kingdom</option>
                                        <option value="VA" label="Vatican City">Vatican City</option>
                                        <option value="AX" label="Åland Islands">Åland Islands</option>
                                    </optgroup>
                                    <optgroup id="country-optgroup-Oceania" label="Oceania">
                                        <option value="AS" label="American Samoa">American Samoa</option>
                                        <option value="AQ" label="Antarctica">Antarctica</option>
                                        <option value="AU" label="Australia">Australia</option>
                                        <option value="BV" label="Bouvet Island">Bouvet Island</option>
                                        <option value="IO" label="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="CX" label="Christmas Island">Christmas Island</option>
                                        <option value="CC" label="Cocos [Keeling] Islands">Cocos [Keeling] Islands</option>
                                        <option value="CK" label="Cook Islands">Cook Islands</option>
                                        <option value="FJ" label="Fiji">Fiji</option>
                                        <option value="PF" label="French Polynesia">French Polynesia</option>
                                        <option value="TF" label="French Southern Territories">French Southern Territories</option>
                                        <option value="GU" label="Guam">Guam</option>
                                        <option value="HM" label="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                        <option value="KI" label="Kiribati">Kiribati</option>
                                        <option value="MH" label="Marshall Islands">Marshall Islands</option>
                                        <option value="FM" label="Micronesia">Micronesia</option>
                                        <option value="NR" label="Nauru">Nauru</option>
                                        <option value="NC" label="New Caledonia">New Caledonia</option>
                                        <option value="NZ" label="New Zealand">New Zealand</option>
                                        <option value="NU" label="Niue">Niue</option>
                                        <option value="NF" label="Norfolk Island">Norfolk Island</option>
                                        <option value="MP" label="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="PW" label="Palau">Palau</option>
                                        <option value="PG" label="Papua New Guinea">Papua New Guinea</option>
                                        <option value="PN" label="Pitcairn Islands">Pitcairn Islands</option>
                                        <option value="WS" label="Samoa">Samoa</option>
                                        <option value="SB" label="Solomon Islands">Solomon Islands</option>
                                        <option value="GS" label="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                        <option value="TK" label="Tokelau">Tokelau</option>
                                        <option value="TO" label="Tonga">Tonga</option>
                                        <option value="TV" label="Tuvalu">Tuvalu</option>
                                        <option value="UM" label="U.S. Minor Outlying Islands">U.S. Minor Outlying Islands</option>
                                        <option value="VU" label="Vanuatu">Vanuatu</option>
                                        <option value="WF" label="Wallis and Futuna">Wallis and Futuna</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row drag-row" id="terms of service">
                            <div class="col drag-col" id="terms of service" draggable="true" style="flex-direction: row;" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <input name="ToS" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label grab" for="flexCheckDefault" required>Agree to Terms of Service</label>
                                <div class="col-sm-1 trash" style="float: right;">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                            </div>
                        </div>
                        <h5 class="titles">Common Fields</h5>
                        <div class="row drag-row" id="search">
                            <div class="col drag-col" id="search" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputSearch" class="col-sm-2 col-form-label grab">Search</label>
                                <div class="col-sm-12">
                                    <input name="search" type="search" class="form-control" id="inputSearch">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="message">
                            <div class="col drag-col" id="message" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputMessage" class="col-sm-2 col-form-label grab">Message</label>
                                <div class="col-sm-12">
                                    <input name="message" class="form-control" type="text" id="inputMessage">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="paragaph text">
                            <div class="col drag-col" id="paragaph text" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputParagraph" class="col-sm-2 col-form-label grab">Paragraph Text</label>
                                <div class="col-sm-12">
                                    <textarea name="paragraph" id="inputParagraph" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="url">
                            <div class="col drag-col" id="url" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputURL" class="col-sm-2 col-form-label grab">URL</label>
                                <div class="col-sm-12">
                                    <input name="url" type="url" class="form-control" id="inputURL">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="radio">
                            <div class="col drag-col" id="radio" draggable="true" style="flex-direction: row;" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <input name="radio" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label grab" for="flexRadioDefault1" contenteditable="true">Radio</label>
                                <div class="col-sm-8 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="check">
                            <div class="col drag-col" id="check" draggable="true" style="flex-direction: row;" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <input name="checkbox" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label grab" for="flexCheckDefault" contenteditable="true">Checkbox</label>
                                <div class="col-sm-8 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="edit checkbox">
                            <div class="col drag-col input-group" id="edit checkbox" draggable="true" style="flex-direction: row;" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <div class="input-group-text grab">
                                  <input name="editableCheckbox" class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                </div>
                                <input type="text" class="form-control" aria-label="Text input with checkbox">
                            </div>
                        </div>
                        <div class="row drag-row" id="edit radio">
                            <div class="col drag-col input-group" id="edit radio" draggable="true" style="flex-direction: row;" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <div class="input-group-text grab">
                                    <input name="editableRadio" class="form-check-input mt-0" type="radio" value="" aria-label="Radio button for following text input">
                                </div>
                                <input type="text" class="form-control" aria-label="Text input with radio button">
                            </div>
                        </div>
                        <div class="row drag-row" id="switch" style="flex-direction: row;">
                            <div class="col drag-col form-switch" id="switch" draggable="true" style="flex-direction: row; padding-left: 50px;" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <input name="switch" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label grab" for="flexSwitchCheckDefault" contenteditable="true">Switch</label>
                                <div class="col-sm-8 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="submit">
                            <div class="col drag-col" id="submit" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <button name="submit" type="submit" class="btn btn-primary grab">Submit</button>
                            </div>
                        </div>
                        <div class="row drag-row" id="reset">
                            <div class="col drag-col" id="reset" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <button name="reset" type="reset" class="btn btn-primary grab">Reset</button>
                            </div>
                        </div>
                        <div class="row drag-row" id="button">
                            <div class="col drag-col" id="button" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <button name="button" type="button" class="btn btn-primary grab">Button</button>
                            </div>
                        </div>
                        <div class="row drag-row" id="upload">
                            <div class="col drag-col" id="upload" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <div class="mb-3 input-group">
                                    <input name="upload" type="file" class="form-control grab" id="inputGroupFile02">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="file input">
                            <div class="col drag-col" id="file input" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label grab">File input</label>
                                    <input name="file" class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="files input">
                            <div class="col drag-col" id="files input" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileMultiple" class="form-label">Files input</label>
                                    <input name="multipleFiles" class="form-control" type="file" id="formFileMultiple" multiple>
                                </div>
                            </div>
                        </div>
                        <h5 class="titles">Miscellaneous Fields</h5>
                        <div class="row drag-row" id="number">
                            <div class="col drag-col" id="number" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="entity" class="col-sm-2 col-form-label grab">Number</label>
                                <div class="col-sm-12">
                                    <input name="number" type="number" class="form-control" id="entity">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="range">
                            <div class="col drag-col" id="range" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="customRange1" class="col-sm-2 form-label">Range</label>
                                <div class="col-sm-12">
                                    <input name="range" type="range" class="form-range" id="customRange1">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="date/time">
                            <div class="col drag-col" id="date/time" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="date-time" class="col-sm-2 form-label grab">Date/Time</label>
                                <div class="col-sm-12">
                                    <input name="date" type="datetime-local" class="datetime" id="date-time">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="month">
                            <div class="col drag-col" id="month" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputMonth" class="col-sm-2 form-label grab">Month</label>
                                <div class="col-sm-12">
                                    <input name="month" type="month" class="month" id="inputMonth">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="week">
                            <div class="col drag-col" id="week" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputWeek" class="col-sm-2 form-label grab">Week</label>
                                <div class="col-sm-12">
                                    <input name="week" type="week" class="week" id="inputWeek">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="time">
                            <div class="col drag-col" id="time" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="inputTime" class="col-sm-2 form-label grab">Time</label>
                                <div class="col-sm-12">
                                    <input name="time" type="time" class="time" id="inputTime">
                                </div>
                            </div>
                        </div>
                        <div class="row drag-row" id="color picker">
                            <div class="col drag-col" id="color picker" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <label for="exampleColorInput" class="form-label grab">Color picker</label>
                                <input name="color" type="color" class="form-control form-control-color" id="exampleColorInput" value="#000000" title="Choose your color">
                            </div>
                        </div>
                        <div class="row drag-row" id="select menu">
                            <div class="col drag-col" id="select menu" draggable="true" onmouseover="showTrashIcon(this)" onmouseout="hideTrashIcon(this)">
                                <div class="col-sm-12 trash">
                                    <i class="fa fa-trash-o col-sm-1 click hide" id="trash" onclick="remove(this)"></i>
                                </div>
                                <select name="select" class="form-select" aria-label="Default select">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Second column for the editing side-->
                <div class="col" id="editside">
                    <!--Form inside the editside-->
                    <form action="" class="container-fluid" id="form">
                        <!--Editable title within the form-->
                        <h2 contenteditable="true" oninput="limitCharacters(this, 30)">Enter Title</h2>
                        <!--First row that is loaded when you create a new form-->
                        <div class="row edit-row trashRow" id="editRow" onmouseover="handleMouseOver(this)" onclick="removeRow(this)">
                        </div>
                        <!--placeholder row is only seen when in the process of dragging-->
                        <div class="row edit-row hide" id="placeholderRow">
                        </div>
                    </form>
                    <!--Button to unhide the sidebar-->
                    <div class="row hide" id="addButton" onclick="showSidebar(this)">
                        <button type="button" class="btn btn-primary mb-3">
                            <i class="fa fa-plus" style="font-size: 48px; padding: 0.5vh;" ></i>
                        </button>
                    </div>
                </div>
                <!--Hidden column for the saveable dom to database-->
                <div class="col hide" id="savedSection">
                    <div class="hide" id="fileNameDiv"></div>
                    <form action="" class="container-fluid" id="savedForm">

                        <!--Saved title within the form-->
                        <h2 id="savedTitle">Template</h2>
                        <!--First row that is loaded when you create a new form-->
                        <div class="row save-row" id="savedRow">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            <?php include "boilerplate.js" ?>
        </script>
    </body>
</html>