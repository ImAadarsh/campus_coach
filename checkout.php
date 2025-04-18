<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Coach | Guiding Future </title>
    <link rel="shortcut icon" type="image/x-icon" href="assets_cc/images/fav.png">
    <!-- fontawesome 6.4.2 -->
    <link rel="stylesheet" href="assets_cc/css/plugins/fontawesome-6.css">
    <!-- swiper Css 10.2.0 -->
    <link rel="stylesheet" href="assets_cc/css/plugins/swiper.min.css">
    <!-- magnific popup css -->
    <link rel="stylesheet" href="assets_cc/css/vendor/magnific-popup.css">
    <!-- Bootstrap 5.0.2 -->
    <link rel="stylesheet" href="assets_cc/css/vendor/bootstrap.min.css">
    <!-- jquery ui css -->
    <link rel="stylesheet" href="assets_cc/css/vendor/jquery-ui.css">
    <!-- metismenu scss -->
    <link rel="stylesheet" href="assets_cc/css/vendor/metismenu.css">
    <!-- custom style css -->
    <link rel="stylesheet" href="assets_cc/css/style.css">
</head>

<body>

    <!-- header style one -->
    <!-- header style one -->
<?php include "include_cc/header.php"; ?>
    <!-- header style end -->
    <!-- header style end -->


    <!-- bread crumb area -->
    <div class="rts-bread-crumbarea-1 rts-section-gap bg_image">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-main-wrapper">
                        <h1 class="title">Checkout</h1>
                        <!-- breadcrumb pagination area -->
                        <div class="pagination-wrapper">
                            <a href="index.php">Home</a>
                            <i class="fa-regular fa-chevron-right"></i>
                            <a class="active" href="Instructor.php">Checkout</a>
                        </div>
                        <!-- breadcrumb pagination area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- bread crumb area end -->


    <!-- Shop area start -->
    <main class="ms-main">
        <div class="ms-page-content">

            <!--================= Checkout Area Start =================-->
            <article id="post-284" class="page checkout-area type-page status-publish hentry">
                <header class="ms-sp--header container">
                    <h1 class="ms-sp--title">Checkout</h1>
                </header>
                <div class="ms-default-page container entry-content">
                    <div class="woocommerce">
                        <div class="coupon-toggle">
                            <div id="accordion" class="accordion">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <div class="card-title">
                                            <span><i class="fa fa-window-maximize"></i> Have a coupon?</span>
                                            <button class="accordion-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Click here to enter your code</button>
                                        </div>
                                    </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion" style="">
                                        <div class="card-body">
                                            <p>If you have a coupon code, please apply it below.</p>
                                            <div class="coupon-code-input">
                                                <input type="text" name="coupon_code" placeholder="Coupon code" required="">
                                            </div>
                                            <button class="add-btn rts-btn btn-primary" type="submit">Apply Coupon</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="woocommerce-notices-wrapper"></div>
                        <form name="checkout" method="post" class="checkout woocommerce-checkout ms-woocommerce-checkout" action="#" enctype="multipart/form-data" novalidate="novalidate">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="full-grid">
                                        <div class="billing-fields">
                                            <div class="checkout-title">
                                                <h3 class="animated fadeIn">Billing details</h3>
                                            </div>
                                            <div class="form-content-box">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>First Name *</label>
                                                            <input id="fname" name="fname" class="form-control-mod" type="text" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Last Name *</label>
                                                            <input id="lname" name="lname" class="form-control-mod" type="text" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Company name (optional)</label>
                                                            <input id="cname" name="cname" class="form-control-mod" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>District*</label>
                                                            <select class="d-block" required="">
                                                                <option value="">Select a countryâ€¦</option>
                                                                <option value="AX">Ã…land Islands</option>
                                                                <option value="AF">Afghanistan</option>
                                                                <option value="AL">Albania</option>
                                                                <option value="DZ">Algeria</option>
                                                                <option value="AS">American Samoa</option>
                                                                <option value="AD">Andorra</option>
                                                                <option value="AO">Angola</option>
                                                                <option value="AI">Anguilla</option>
                                                                <option value="AQ">Antarctica</option>
                                                                <option value="AG">Antigua and Barbuda</option>
                                                                <option value="AR">Argentina</option>
                                                                <option value="AM">Armenia</option>
                                                                <option value="AW">Aruba</option>
                                                                <option value="AU">Australia</option>
                                                                <option value="AT">Austria</option>
                                                                <option value="AZ">Azerbaijan</option>
                                                                <option value="BS">Bahamas</option>
                                                                <option value="BH">Bahrain</option>
                                                                <option value="BD" selected="selected">Bangladesh</option>
                                                                <option value="BB">Barbados</option>
                                                                <option value="BY">Belarus</option>
                                                                <option value="PW">Belau</option>
                                                                <option value="BE">Belgium</option>
                                                                <option value="BZ">Belize</option>
                                                                <option value="BJ">Benin</option>
                                                                <option value="BM">Bermuda</option>
                                                                <option value="BT">Bhutan</option>
                                                                <option value="BO">Bolivia</option>
                                                                <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                                                <option value="BA">Bosnia and Herzegovina</option>
                                                                <option value="BW">Botswana</option>
                                                                <option value="BV">Bouvet Island</option>
                                                                <option value="BR">Brazil</option>
                                                                <option value="IO">British Indian Ocean Territory</option>
                                                                <option value="VG">British Virgin Islands</option>
                                                                <option value="BN">Brunei</option>
                                                                <option value="BG">Bulgaria</option>
                                                                <option value="BF">Burkina Faso</option>
                                                                <option value="BI">Burundi</option>
                                                                <option value="KH">Cambodia</option>
                                                                <option value="CM">Cameroon</option>
                                                                <option value="CA">Canada</option>
                                                                <option value="CV">Cape Verde</option>
                                                                <option value="KY">Cayman Islands</option>
                                                                <option value="CF">Central African Republic</option>
                                                                <option value="TD">Chad</option>
                                                                <option value="CL">Chile</option>
                                                                <option value="CN">China</option>
                                                                <option value="CX">Christmas Island</option>
                                                                <option value="CC">Cocos (Keeling) Islands</option>
                                                                <option value="CO">Colombia</option>
                                                                <option value="KM">Comoros</option>
                                                                <option value="CG">Congo (Brazzaville)</option>
                                                                <option value="CD">Congo (Kinshasa)</option>
                                                                <option value="CK">Cook Islands</option>
                                                                <option value="CR">Costa Rica</option>
                                                                <option value="HR">Croatia</option>
                                                                <option value="CU">Cuba</option>
                                                                <option value="CW">CuraÃ§ao</option>
                                                                <option value="CY">Cyprus</option>
                                                                <option value="CZ">Czech Republic</option>
                                                                <option value="DK">Denmark</option>
                                                                <option value="DJ">Djibouti</option>
                                                                <option value="DM">Dominica</option>
                                                                <option value="DO">Dominican Republic</option>
                                                                <option value="EC">Ecuador</option>
                                                                <option value="EG">Egypt</option>
                                                                <option value="SV">El Salvador</option>
                                                                <option value="GQ">Equatorial Guinea</option>
                                                                <option value="ER">Eritrea</option>
                                                                <option value="EE">Estonia</option>
                                                                <option value="ET">Ethiopia</option>
                                                                <option value="FK">Falkland Islands</option>
                                                                <option value="FO">Faroe Islands</option>
                                                                <option value="FJ">Fiji</option>
                                                                <option value="FI">Finland</option>
                                                                <option value="FR">France</option>
                                                                <option value="GF">French Guiana</option>
                                                                <option value="PF">French Polynesia</option>
                                                                <option value="TF">French Southern Territories</option>
                                                                <option value="GA">Gabon</option>
                                                                <option value="GM">Gambia</option>
                                                                <option value="GE">Georgia</option>
                                                                <option value="DE">Germany</option>
                                                                <option value="GH">Ghana</option>
                                                                <option value="GI">Gibraltar</option>
                                                                <option value="GR">Greece</option>
                                                                <option value="GL">Greenland</option>
                                                                <option value="GD">Grenada</option>
                                                                <option value="GP">Guadeloupe</option>
                                                                <option value="GU">Guam</option>
                                                                <option value="GT">Guatemala</option>
                                                                <option value="GG">Guernsey</option>
                                                                <option value="GN">Guinea</option>
                                                                <option value="GW">Guinea-Bissau</option>
                                                                <option value="GY">Guyana</option>
                                                                <option value="HT">Haiti</option>
                                                                <option value="HM">Heard Island and McDonald Islands</option>
                                                                <option value="HN">Honduras</option>
                                                                <option value="HK">Hong Kong</option>
                                                                <option value="HU">Hungary</option>
                                                                <option value="IS">Iceland</option>
                                                                <option value="IN">India</option>
                                                                <option value="ID">Indonesia</option>
                                                                <option value="IR">Iran</option>
                                                                <option value="IQ">Iraq</option>
                                                                <option value="IE">Ireland</option>
                                                                <option value="IM">Isle of Man</option>
                                                                <option value="IL">Israel</option>
                                                                <option value="IT">Italy</option>
                                                                <option value="CI">Ivory Coast</option>
                                                                <option value="JM">Jamaica</option>
                                                                <option value="JP">Japan</option>
                                                                <option value="JE">Jersey</option>
                                                                <option value="JO">Jordan</option>
                                                                <option value="KZ">Kazakhstan</option>
                                                                <option value="KE">Kenya</option>
                                                                <option value="KI">Kiribati</option>
                                                                <option value="KW">Kuwait</option>
                                                                <option value="KG">Kyrgyzstan</option>
                                                                <option value="LA">Laos</option>
                                                                <option value="LV">Latvia</option>
                                                                <option value="LB">Lebanon</option>
                                                                <option value="LS">Lesotho</option>
                                                                <option value="LR">Liberia</option>
                                                                <option value="LY">Libya</option>
                                                                <option value="LI">Liechtenstein</option>
                                                                <option value="LT">Lithuania</option>
                                                                <option value="LU">Luxembourg</option>
                                                                <option value="MO">Macao S.A.R., China</option>
                                                                <option value="MK">Macedonia</option>
                                                                <option value="MG">Madagascar</option>
                                                                <option value="MW">Malawi</option>
                                                                <option value="MY">Malaysia</option>
                                                                <option value="MV">Maldives</option>
                                                                <option value="ML">Mali</option>
                                                                <option value="MT">Malta</option>
                                                                <option value="MH">Marshall Islands</option>
                                                                <option value="MQ">Martinique</option>
                                                                <option value="MR">Mauritania</option>
                                                                <option value="MU">Mauritius</option>
                                                                <option value="YT">Mayotte</option>
                                                                <option value="MX">Mexico</option>
                                                                <option value="FM">Micronesia</option>
                                                                <option value="MD">Moldova</option>
                                                                <option value="MC">Monaco</option>
                                                                <option value="MN">Mongolia</option>
                                                                <option value="ME">Montenegro</option>
                                                                <option value="MS">Montserrat</option>
                                                                <option value="MA">Morocco</option>
                                                                <option value="MZ">Mozambique</option>
                                                                <option value="MM">Myanmar</option>
                                                                <option value="NA">Namibia</option>
                                                                <option value="NR">Nauru</option>
                                                                <option value="NP">Nepal</option>
                                                                <option value="NL">Netherlands</option>
                                                                <option value="NC">New Caledonia</option>
                                                                <option value="NZ">New Zealand</option>
                                                                <option value="NI">Nicaragua</option>
                                                                <option value="NE">Niger</option>
                                                                <option value="NG">Nigeria</option>
                                                                <option value="NU">Niue</option>
                                                                <option value="NF">Norfolk Island</option>
                                                                <option value="KP">North Korea</option>
                                                                <option value="MP">Northern Mariana Islands</option>
                                                                <option value="NO">Norway</option>
                                                                <option value="OM">Oman</option>
                                                                <option value="PK">Pakistan</option>
                                                                <option value="PS">Palestinian Territory</option>
                                                                <option value="PA">Panama</option>
                                                                <option value="PG">Papua New Guinea</option>
                                                                <option value="PY">Paraguay</option>
                                                                <option value="PE">Peru</option>
                                                                <option value="PH">Philippines</option>
                                                                <option value="PN">Pitcairn</option>
                                                                <option value="PL">Poland</option>
                                                                <option value="PT">Portugal</option>
                                                                <option value="PR">Puerto Rico</option>
                                                                <option value="QA">Qatar</option>
                                                                <option value="RE">Reunion</option>
                                                                <option value="RO">Romania</option>
                                                                <option value="RU">Russia</option>
                                                                <option value="RW">Rwanda</option>
                                                                <option value="ST">SÃ£o TomÃ© and PrÃ­ncipe</option>
                                                                <option value="BL">Saint BarthÃ©lemy</option>
                                                                <option value="SH">Saint Helena</option>
                                                                <option value="KN">Saint Kitts and Nevis</option>
                                                                <option value="LC">Saint Lucia</option>
                                                                <option value="SX">Saint Martin (Dutch part)</option>
                                                                <option value="MF">Saint Martin (French part)</option>
                                                                <option value="PM">Saint Pierre and Miquelon</option>
                                                                <option value="VC">Saint Vincent and the Grenadines</option>
                                                                <option value="WS">Samoa</option>
                                                                <option value="SM">San Marino</option>
                                                                <option value="SA">Saudi Arabia</option>
                                                                <option value="SN">Senegal</option>
                                                                <option value="RS">Serbia</option>
                                                                <option value="SC">Seychelles</option>
                                                                <option value="SL">Sierra Leone</option>
                                                                <option value="SG">Singapore</option>
                                                                <option value="SK">Slovakia</option>
                                                                <option value="SI">Slovenia</option>
                                                                <option value="SB">Solomon Islands</option>
                                                                <option value="SO">Somalia</option>
                                                                <option value="ZA">South Africa</option>
                                                                <option value="GS">South Georgia/Sandwich Islands</option>
                                                                <option value="KR">South Korea</option>
                                                                <option value="SS">South Sudan</option>
                                                                <option value="ES">Spain</option>
                                                                <option value="LK">Sri Lanka</option>
                                                                <option value="SD">Sudan</option>
                                                                <option value="SR">Suriname</option>
                                                                <option value="SJ">Svalbard and Jan Mayen</option>
                                                                <option value="SZ">Swaziland</option>
                                                                <option value="SE">Sweden</option>
                                                                <option value="CH">Switzerland</option>
                                                                <option value="SY">Syria</option>
                                                                <option value="TW">Taiwan</option>
                                                                <option value="TJ">Tajikistan</option>
                                                                <option value="TZ">Tanzania</option>
                                                                <option value="TH">Thailand</option>
                                                                <option value="TL">Timor-Leste</option>
                                                                <option value="TG">Togo</option>
                                                                <option value="TK">Tokelau</option>
                                                                <option value="TO">Tonga</option>
                                                                <option value="TT">Trinidad and Tobago</option>
                                                                <option value="TN">Tunisia</option>
                                                                <option value="TR">Turkey</option>
                                                                <option value="TM">Turkmenistan</option>
                                                                <option value="TC">Turks and Caicos Islands</option>
                                                                <option value="TV">Tuvalu</option>
                                                                <option value="UG">Uganda</option>
                                                                <option value="UA">Ukraine</option>
                                                                <option value="AE">United Arab Emirates</option>
                                                                <option value="GB">United Kingdom (UK)</option>
                                                                <option value="US">United States (US)</option>
                                                                <option value="UM">United States (US) Minor Outlying Islands</option>
                                                                <option value="VI">United States (US) Virgin Islands</option>
                                                                <option value="UY">Uruguay</option>
                                                                <option value="UZ">Uzbekistan</option>
                                                                <option value="VU">Vanuatu</option>
                                                                <option value="VA">Vatican</option>
                                                                <option value="VE">Venezuela</option>
                                                                <option value="VN">Vietnam</option>
                                                                <option value="WF">Wallis and Futuna</option>
                                                                <option value="EH">Western Sahara</option>
                                                                <option value="YE">Yemen</option>
                                                                <option value="ZM">Zambia</option>
                                                                <option value="ZW">Zimbabwe</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Street address *</label>
                                                            <input id="hnumber" name="hnumber" class="form-control-mod margin-bottom" type="text" placeholder="House number and street name" required="">
                                                            <input id="hnumber-2" name="hnumber" class="form-control-mod" type="text" placeholder="Apartment, suite, unit etc. (optional)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Town / City *</label>
                                                            <input id="city" name="city" class="form-control-mod" type="text" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>District *</label>
                                                            <select class="d-block" required="">
                                                                <option value="">Select an option</option>
                                                                <option value="BD-05">Bagerhat</option>
                                                                <option value="BD-01">Bandarban</option>
                                                                <option value="BD-02">Barguna</option>
                                                                <option value="BD-06">Barishal</option>
                                                                <option value="BD-07">Bhola</option>
                                                                <option value="BD-03">Bogura</option>
                                                                <option value="BD-04">Brahmanbaria</option>
                                                                <option value="BD-09">Chandpur</option>
                                                                <option value="BD-10">Chattogram</option>
                                                                <option value="BD-12">Chuadanga</option>
                                                                <option value="BD-11">Cox's Bazar</option>
                                                                <option value="BD-08">Cumilla</option>
                                                                <option value="BD-13">Dhaka</option>
                                                                <option value="BD-14">Dinajpur</option>
                                                                <option value="BD-15">Faridpur </option>
                                                                <option value="BD-16">Feni</option>
                                                                <option value="BD-19">Gaibandha</option>
                                                                <option value="BD-18">Gazipur</option>
                                                                <option value="BD-17">Gopalganj</option>
                                                                <option value="BD-20">Habiganj</option>
                                                                <option value="BD-21">Jamalpur</option>
                                                                <option value="BD-22">Jashore</option>
                                                                <option value="BD-25">Jhalokati</option>
                                                                <option value="BD-23">Jhenaidah</option>
                                                                <option value="BD-24">Joypurhat</option>
                                                                <option value="BD-29">Khagrachhari</option>
                                                                <option value="BD-27">Khulna</option>
                                                                <option value="BD-26">Kishoreganj</option>
                                                                <option value="BD-28">Kurigram</option>
                                                                <option value="BD-30">Kushtia</option>
                                                                <option value="BD-31">Lakshmipur</option>
                                                                <option value="BD-32">Lalmonirhat</option>
                                                                <option value="BD-36">Madaripur</option>
                                                                <option value="BD-37">Magura</option>
                                                                <option value="BD-33">Manikganj </option>
                                                                <option value="BD-39">Meherpur</option>
                                                                <option value="BD-38">Moulvibazar</option>
                                                                <option value="BD-35">Munshiganj</option>
                                                                <option value="BD-34">Mymensingh</option>
                                                                <option value="BD-48">Naogaon</option>
                                                                <option value="BD-43">Narail</option>
                                                                <option value="BD-40">Narayanganj</option>
                                                                <option value="BD-42">Narsingdi</option>
                                                                <option value="BD-44">Natore</option>
                                                                <option value="BD-45">Nawabganj</option>
                                                                <option value="BD-41">Netrakona</option>
                                                                <option value="BD-46">Nilphamari</option>
                                                                <option value="BD-47">Noakhali</option>
                                                                <option value="BD-49">Pabna</option>
                                                                <option value="BD-52">Panchagarh</option>
                                                                <option value="BD-51">Patuakhali</option>
                                                                <option value="BD-50">Pirojpur</option>
                                                                <option value="BD-53">Rajbari</option>
                                                                <option value="BD-54">Rajshahi</option>
                                                                <option value="BD-56">Rangamati</option>
                                                                <option value="BD-55">Rangpur</option>
                                                                <option value="BD-58">Satkhira</option>
                                                                <option value="BD-62">Shariatpur</option>
                                                                <option value="BD-57">Sherpur</option>
                                                                <option value="BD-59">Sirajganj</option>
                                                                <option value="BD-61">Sunamganj</option>
                                                                <option value="BD-60">Sylhet</option>
                                                                <option value="BD-63">Tangail</option>
                                                                <option value="BD-64">Thakurgaon</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Postcode / ZIP (optional)</label>
                                                            <input id="pcode" name="pcode" class="form-control-mod" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Phone *</label>
                                                            <input id="number" name="number" class="form-control-mod" type="text" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Email address *</label>
                                                            <input id="email" name="email" class="form-control-mod" type="email" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- .billing-fields -->
                                        <div class="additional-fields">
                                            <div class="form-content-box">
                                                <div class="checkout-title">
                                                    <h3 class="animated fadeIn">Additional information</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Order notes (optional)</label>
                                                            <textarea placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ordered-product">
                                            <div class="checkout-title">
                                                <h3 class="animated fadeIn">Your order</h3>
                                            </div>
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Product</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Safety Helmet <strong><i class="fa fa-close"></i> 1</strong></td>
                                                        <td>$30.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sledge Hammer <strong><i class="fa fa-close"></i> 1</strong></td>
                                                        <td>$30.00</td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Subtotal</th>
                                                        <th>$60.00</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Total</th>
                                                        <th>$60.00</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="payment-method mt-40 md-mt-20">
                                            <div class="top-area">
                                                <div class="payment-co"><span>PayPal</span> <img src="assets_cc/images/paypal.png" alt="PayPal Logo"></div>
                                                <div class="p-msg">Pay via PayPal you can pay with your credit card if you dont have a
                                                    PayPal account.</div>
                                            </div>
                                            <div class="bottom-area">
                                                <p class="mt-15">Your personal data will be used to process your order, support your
                                                    experience throughout this website, and for other purposes described in our privacy
                                                    policy.</p>
                                                <button class="add-btn rts-btn btn-primary" type="submit">Continue to payment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 pl--30 pl_sm--15 pl_md--15">
                                    <h3 id="order_review_heading" class="animated fadeIn">Your order</h3>
                                    <div id="order_review" class="woocommerce-checkout-review-order">
                                        <table class="ms-checkout-review-order-table shop_table woocommerce-checkout-review-order-table">
                                            <tbody>
                                                <tr class="cart_item">
                                                    <td colspan="2">
                                                        <div class="ms-checkout-product">
                                                            <div class="ms-checkout-product__thumbnail">
                                                                <img src="assets_cc/images/shop/01.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="Shop Image">
                                                            </div>
                                                            <div class="ms-checkout-product__content">
                                                                <h5>How can change your mind<span class="product-quantity">× 1</span> </h5>
                                                                <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>120.00</bdi></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="cart_item">
                                                    <td colspan="2">
                                                        <div class="ms-checkout-product">
                                                            <div class="ms-checkout-product__thumbnail">
                                                                <img src="assets_cc/images/shop/02.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="Shop Image">
                                                            </div>
                                                            <div class="ms-checkout-product__content">
                                                                <h5>The Alchemist<span class="product-quantity">× 1</span></h5>
                                                                <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>180.00</bdi></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="cart_item">
                                                    <td colspan="2">
                                                        <div class="ms-checkout-product">
                                                            <div class="ms-checkout-product__thumbnail">
                                                                <img src="assets_cc/images/shop/03.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="Shop Image">
                                                            </div>
                                                            <div class="ms-checkout-product__content">
                                                                <h5>Spies Sadists & Sorcerers<span class="product-quantity">× 1</span> </h5>
                                                                <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>80.00</bdi></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="cart_item">
                                                    <td colspan="2">
                                                        <div class="ms-checkout-product">
                                                            <div class="ms-checkout-product__thumbnail">
                                                                <img src="assets_cc/images/shop/04.jpg" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="Shop Image">
                                                            </div>
                                                            <div class="ms-checkout-product__content">
                                                                <h5>Cannibalism <span class="product-quantity">× 1</span></h5>
                                                                <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>139.00</bdi></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>519.00</bdi></span>
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td><strong><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">$</span>519.00</bdi></span></strong>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <div id="payment" class="woocommerce-checkout-payment">
                                            <ul class="wc_payment_methods payment_methods methods">
                                                <li class="woocommerce-notice woocommerce-notice--info woocommerce-info">
                                                    Sorry, it seems that there are no available payment methods for your
                                                    state. Please contact us if you require assistance or wish to make
                                                    alternate arrangements.
                                                </li>
                                            </ul>
                                            <div class="form-row place-order">
                                                <noscript>
                                                    Since your browser does not support JavaScript, or it is disabled,
                                                    please ensure you click the <em>Update Totals</em> button before
                                                    placing your order. You may be charged more than the amount stated
                                                    above if you fail to do so. <br />
                                                    <button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals">Update totals</button>
                                                </noscript>
                                                <div class="woocommerce-terms-and-conditions-wrapper">
                                                    <div class="woocommerce-privacy-policy-text">
                                                        <p>Your personal data will be used to process your order,
                                                            support your experience throughout this website, and for
                                                            other purposes described in our
                                                            <a href="#0" class="woocommerce-privacy-policy-link" target="_blank">privacy policy</a>.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="ms-proceed-to-checkout wc-proceed-to-checkout">
                                                    <a href="#" class="rts-btn btn-primary button"> Place Order</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </article>
            <!--================= Checkout Area End =================-->
        </div>
    </main>
    <!-- Shop area end -->

    <!-- footer call to action area start -->
<?php include "include_cc/footer.php"; ?> 
    <!-- footer call to action area end -->
    <!-- cart area start -->

    <!-- cart area start -->
<?php include "include_cc/cart.php"; ?>
    <!-- cart area edn -->
    <!-- cart area edn -->

    <!-- header style two -->
    <div id="side-bar" class="side-bar header-two">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <!-- inner menu area desktop start -->
        <div class="inner-main-wrapper-desk">
            <div class="thumbnail">
                <img src="assets_cc/images/banner/04.jpg" alt="elevate">
            </div>
            <div class="inner-content">
                <h4 class="title">We Build Building and Great Constructive Homes.</h4>
                <p class="disc">
                    We successfully cope with tasks of varying complexity, provide long-term guarantees and regularly master new technologies.
                </p>
                <div class="footer">
                    <h4 class="title">Got a project in mind?</h4>
                    <a href="contact.php" class="rts-btn btn-primary">Let's talk</a>
                </div>
            </div>
        </div>
        <!-- mobile menu area start -->
        <div class="mobile-menu-main">
            <nav class="nav-main mainmenu-nav mt--30">
                <ul class="mainmenu metismenu" id="mobile-menu-active">
                    <li class="has-droupdown">
                        <a href="#" class="main">Home</a>
                        <ul class="submenu mm-collapse">
                            <li><a class="mobile-menu-link" href="index.php">Main Home</a></li>
                            <li><a class="mobile-menu-link" href="index-two.php">Online Course</a></li>
                            <li><a class="mobile-menu-link" href="index-three.php">Course Hub</a></li>
                            <li><a class="mobile-menu-link" href="index-four.php">Distance Learning</a></li>
                            <li><a class="mobile-menu-link" href="index-five.php">Single Instructor</a></li>
                            <li><a class="mobile-menu-link" href="index-six.php">Language Academy</a></li>
                            <li><a class="mobile-menu-link" href="index-seven.php">Gym Instructor</a></li>
                            <li><a class="mobile-menu-link" href="index-eight.php">Kitchen Coach</a></li>
                            <li><a class="mobile-menu-link" href="index-nine.php">Course Portal</a></li>
                            <li><a class="mobile-menu-link" href="index-ten.php">Business Coach</a></li>
                        </ul>
                    </li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Pages</a>
                        <ul class="submenu mm-collapse">
                            <li><a class="mobile-menu-link" href="about.php">About Us</a></li>
                            <li><a class="mobile-menu-link" href="about-two.php">About Us Two</a></li>
                            <li><a class="mobile-menu-link" href="instructor-profile.php">Profile</a></li>
                            <li><a class="mobile-menu-link" href="contact.php">Contact</a></li>
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Zoom</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="zoom-meeting.php"></a>Zoom Meeting</li>
                                    <li><a href="zoom-details.php"></a>Zoom Details</li>
                                </ul>
                            </li>
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Event</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="event.php"></a>Event</li>
                                    <li><a href="event-two.php"></a>Event Two</li>
                                    <li><a href="event-details.php"></a>Event Details</li>
                                </ul>
                            </li>
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Shop</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="shop.php"></a>Shop</li>
                                    <li><a href="product-details.php"></a>Product Details</li>
                                    <li><a href="checkout.php"></a>Checkout</li>
                                    <li><a href="cart.php"></a>Cart</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Course</a>
                        <ul class="submenu mm-collapse">
                            <li><a href="#" class="tag">Courses</a></li>
                            <li><a class="mobile-menu-link" href="course-one.php">Courses</a></li>
                            <li><a class="mobile-menu-link" href="course-two.php">Course List</a></li>
                            <li><a class="mobile-menu-link" href="course-three.php">Course Grid</a></li>
                            <li><a class="mobile-menu-link" href="course-four.php">Course List Two</a></li>
                            <li><a class="mobile-menu-link" href="course-five.php">Course Grid Two</a></li>
                            <li><a class="mobile-menu-link" href="course-six.php">Course Filter</a></li>
                        </ul>
                        <ul class="submenu mm-collapse">
                            <li><a href="#" class="tag">Courses Details</a></li>
                            <li><a class="mobile-menu-link" href="single-course.php">Courses Details</a></li>
                            <li><a class="mobile-menu-link" href="single-course-two.php">Courses Details V2</a></li>
                            <li><a class="mobile-menu-link" href="single-course-three.php">Courses Details V3</a></li>
                            <li><a class="mobile-menu-link" href="single-course-four.php">Courses Details V4</a></li>
                            <li><a class="mobile-menu-link" href="single-course-five.php">Courses Details V5</a></li>
                            <li><a class="mobile-menu-link" href="single-course-free.php">Courses Details Free</a></li>
                        </ul>
                        <ul class="submenu mm-collapse">
                            <li><a href="#" class="tag">Others</a></li>
                            <li><a class="mobile-menu-link" href="become-instructor.php">Become an Instructor</a></li>
                            <li><a class="mobile-menu-link" href="instructor-profile.php">Instructor Profile</a></li>
                            <li><a class="mobile-menu-link" href="instructor.php">Instructor</a></li>
                            <li><a class="mobile-menu-link" href="pricing.php">Membership Plan</a></li>
                            <li><a class="mobile-menu-link" href="log-in.php">Log In</a></li>
                            <li><a class="mobile-menu-link" href="registration.php">Registration</a></li>
                        </ul>
                    </li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Dashboard</a>
                        <ul class="submenu mm-collapse">
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Instructor Dashboard</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="dashboard.php"></a>Dashboard</li>
                                    <li><a href="my-profile.php"></a>My Profile</li>
                                    <li><a href="enroll-course.php"></a>Enroll Course</li>
                                    <li><a href="wishlist.php"></a>Wishlist</li>
                                    <li><a href="reviews.php"></a>Reviews</li>
                                    <li><a href="quick-attempts.php"></a>Quick Attempts</li>
                                    <li><a href="order-history.php"></a>Order History</li>
                                    <li><a href="question-answer.php"></a>Question Answer</li>
                                    <li><a href="calender.php"></a>Calender</li>
                                    <li><a href="my-course.php"></a>My Course</li>
                                    <li><a href="announcement.php"></a>Announcement</li>
                                    <li><a href="assignments.php"></a>Assignments</li>
                                    <li><a href="certificate.php"></a>Certificate</li>
                                </ul>
                            </li>
                            <li class="has-droupdown third-lvl">
                                <a class="main" href="#">Students Dashboard</a>
                                <ul class="submenu-third-lvl mm-collapse">
                                    <li><a href="student-dashboard.php"></a>Dashboard</li>
                                    <li><a href="student-profile.php"></a>My Profile</li>
                                    <li><a href="student-enroll-course.php"></a>Enroll Course</li>
                                    <li><a href="student-wishlist.php"></a>Wishlist</li>
                                    <li><a href="student-reviews.php"></a>Reviews</li>
                                    <li><a href="student-quick-attempts.php"></a>Quick Attempts</li>
                                    <li><a href="student-order-history.php"></a>Order History</li>
                                    <li><a href="student-question-answer.php"></a>Question Answer</li>
                                    <li><a href="student-calender.php"></a>Calender</li>
                                    <li><a href="student-settings.php"></a>Students Settings</li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="has-droupdown">
                        <a href="#" class="main">Blog</a>
                        <ul class="submenu mm-collapse">
                            <li><a class="mobile-menu-link" href="blog.php">Blog</a></li>
                            <li><a class="mobile-menu-link" href="blog-grid.php">Blog Grid</a></li>
                            <li><a class="mobile-menu-link" href="blog-list.php">Blog List</a></li>
                            <li><a class="mobile-menu-link" href="blog-right-sidebar.php">Blog Right Sidebar</a></li>
                            <li><a class="mobile-menu-link" href="blog-left-sidebar.php">Blog Left Sidebar</a></li>
                            <li><a class="mobile-menu-link" href="blog-details.php">Blog Details</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <div class="buttons-area">
                <a href="#" class="rts-btn btn-border">Log In</a>
                <a href="#" class="rts-btn btn-primary">Sign Up</a>
            </div>

            <div class="rts-social-style-one pl--20 mt--50">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- mobile menu area end -->
    </div>
    <!-- header style two End -->

    <!-- modal -->
    <div id="myModal-1" class="modal fade" role="dialog">
        <div class="modal-dialog bg_image">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal"><i class="fa-light fa-x"></i></button>
                </div>
                <div class="modal-body text-center">
                    <div class="inner-content">
                        <div class="title-area">
                            <span class="pre">Get Our Courses Free</span>
                            <h4 class="title">Wonderful for Learning</h4>
                        </div>
                        <form action="#">
                            <input type="text" placeholder="Your Mail.." required>
                            <button>Download Now</button>
                            <span>Your information will never be shared with any third party</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts backto top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>
    <!-- rts backto top end -->

    <!-- offcanvase search -->
    <div class="search-input-area">
        <div class="container">
            <div class="search-input-inner">
                <div class="input-div">
                    <input class="search-input autocomplete" type="text" placeholder="Search by keyword or #">
                    <button><i class="far fa-search"></i></button>
                </div>
            </div>
        </div>
        <div id="close" class="search-close-icon"><i class="far fa-times"></i></div>
    </div>
    <!-- offcanvase search -->
    <div id="anywhere-home" class="">
    </div>

<?php include "include_cc/script.php"; ?>

</body>

</html>