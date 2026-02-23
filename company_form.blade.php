

<div class="">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="tabs active1" style="width: 50%;">
			<a href="#home" class="atabs active" aria-controls="home" id="hometab" role="tab" data-toggle="tab">
				<i class="mdi mdi-view-dashboard"></i> <span>General Info</span>
			</a>
		</li>
		<li role="presentation" class="tabs " style="width: 50%;">
			<a href="#taxform" class="atabs " aria-controls="taxform" role="tab" data-toggle="tab">
				<i class="icon-basket-loaded"></i> <span>Tax Details</span>
			</a>
		</li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active p-0" id="home">
			<div class="row">
				<div class="col-lg-3">

					<div class=" mb-3">
						<label for="validationCustom01">Name</label>
						<input type="text" name="name" id="name" class="form-control form-control-sm" required>
					</div>
					<div class=" mb-3">
						<label for="validationCustom01">Name (Translated)</label>
						<input type="text" name="lan_name" id="lan_name" class="form-control form-control-sm"  >
					</div>
					<div class="mb-3">
						<label for="validationCustom01"> Code</label>
						<input type="text" name="code" id="code" class="form-control form-control-sm"  required>
					</div>
					<div class="mb-3">
						<label for="validationCustom01"> Code (Translated)</label>
						<input type="text" name="lan_code" id="lan_code" class="form-control form-control-sm" >
					</div>

					<div class=" mb-3">
						<label for="validationCustom01">Address 1</label>
						<textarea name="address" id="address" class="form-control form-control-sm" rows="3" required> </textarea>
					</div>
					<div class=" mb-3">
						<label for="validationCustom01">Address 1 (Translated)</label>
						<textarea name="lan_address1" id="lan_address1" class="form-control form-control-sm" rows="3"> </textarea>
					</div>

					<div class=" mb-2">
						<label for="validationCustom01">Address 2</label>
						<textarea name="address2" id="address2" class="form-control form-control-sm" required> </textarea>
					</div>
					<div class=" mb-2">
						<label for="validationCustom01">Address 2 (Translated)</label>
						<textarea name="lan_address2" id="lan_address2" class="form-control form-control-sm" rows="1"> </textarea>
					</div>
					<div class=" mb-2">
						<label for="validationCustom01">Address 3</label>
						<textarea name="address3" id="address3" class="form-control form-control-sm" required> </textarea>
					</div>
					<div class=" mb-2">
						<label for="validationCustom01">Address 3 (Translated)</label>
						<textarea name="lan_address3" id="lan_address3" class="form-control form-control-sm" rows="1"> </textarea>
					</div>

					<div class=" mb-2">
						<label for="validationCustom01">Email</label>
						<input type="text" name="email" id="email" class="form-control form-control-sm"  required>
					</div>

				</div>

				<div class="col-lg-3">
					<div class=" mb-3">
						<label for="validationCustom01">Country</label>
						<select name="countryName" id="country" class="form-control form-control-sm" onfocus="get_current_country(this)" onchange="set_country(this);get_tax_info(this)" required>
							<option value="0" data-dial-code="">Select</option>
							 
						</select>
					</div>

					<div class=" mb-3">
						<label for="validationCustom01">Country Code</label>
						<input type="text" name="countryCode" id="countrycode" class="form-control form-control-sm"  readonly>
					</div>

					<div class=" mb-3">
						<label for="validationCustom01">Region</label>
						<input type="text" name="region" id="region" class="form-control form-control-sm"  readonly>
					</div>

					<div class="row formrow" style="padding-top:0px">
						<div class=" mb-3 col col-sm-6">
							<label for="validationCustom01">Currency Name</label>
							<input type="text" name="currency" id="currency" class="form-control form-control-sm"  readonly>
						</div>
						<div class=" mb-3 col-sm-6">
							<label for="validationCustom01">Symbol</label>
							<input type="text" name="symbol" id="symbol" class="form-control form-control-sm" readonly>
						</div>
					</div>




					<div class=" mb-3">
						<label for="validationCustom01">International Currency Code</label>
						<input type="text" name="currency_code" id="currencyCode" class="form-control form-control-sm"  readonly>
					</div>
					<div class=" mb-3">
						<label for="validationCustom01">Denomination Name</label>
						<input type="text" name="denomination" id="denomination" class="form-control form-control-sm"  readonly>
					</div>

					<div class=" mb-3">
						<label for="validationCustom01">No. Of Decimals</label>
						<input type="text" name="decimals" id="decimals" class="form-control form-control-sm"  readonly>
					</div>

				</div>
				<div class="col-lg-3">

					<div class=" mb-3">
						<label for="validationCustom01">State</label>
						<input type="text" name="state" id="state" class="form-control form-control-sm"  required>
					</div>

					<div class=" mb-3">
						<label for="validationCustom01">City</label>
						<input type="text" name="city" id="city" class="form-control form-control-sm" required>
					</div>
					<div class=" mb-3">
						<label for="validationCustom01"> Location</label>
						<input type="text" name="location" id="location" class="form-control form-control-sm" required>
					</div>

					<div class="row formrow">
						<div class=" mb-3 col col-sm-12">
							<label for="validationCustom01">PO Box</label>
							<input type="text" name="po_box" class="form-control form-control-sm" >
						</div>
					</div>

					<div class="row formrow">
						<div class=" mb-3 col col-sm-6">
							<label for="validationCustom01">PIN</label>
							<input type="text" name="pin" id="pin" class="form-control form-control-sm" required>
						</div>
						<div class=" mb-3 col-sm-6">
							<label for="validationCustom01">Mobile</label>
							<input type="text" name="mobile" id="mobile" class="form-control form-control-sm"  required>
						</div>
					</div>

					<div class="row formrow">
						<div class=" mb-3 col col-sm-12">
							<label for="validationCustom01">License No</label>
							<input type="text" name="license_no" class="form-control form-control-sm" >
						</div>
					</div>

					<div class="row formrow">
						<div class=" mb-3 col col-sm-12">
							<label for="validationCustom01">C.R. No</label>
							<input type="text" name="cr_no" class="form-control form-control-sm" >
						</div>
					</div>






				</div>

				<div class="col-lg-3"> 
					<div class="row formrow">
						<div class="mb-3 col-sm-6">
							<label for="validationCustom01"> Phone</label>
							<input type="text" name="phone" id="phone" class="form-control form-control-sm" required>
						</div>
						<div class="mb-3 col-sm-6">
							<label for="validationCustom01">Fax</label>
							<input type="text" name="fax" id="fax" class="form-control form-control-sm" required>
						</div>
					</div>

					<div class="mb-3">
						<label for="validationCustom01">Financial Year Start With</label>
						<input type="text" data-attr="date" name="financial_year" id="financial_year" class="form-control form-control-sm" required>
					</div>



					<div class=" mb-3">
						<label for="validationCustom01">Book Begining With</label>
						<input type="text" data-attr="date" name="book_begining" id="book_begining" class="form-control form-control-sm"  required>
					</div>

					<div class="row formrow">
						<div class=" mb-3 col-sm-6">
							<label for="validationCustom01">Opening Time</label>
							<input type="time" name="opening_time" id="opening_time" class="form-control form-control-sm" required>
						</div>
						<div class=" mb-3 col-sm-6">
							<label for="validationCustom01">Closing Time</label>
							<input type="time" name="closing_time" id="closing_time" class="form-control form-control-sm" required>
						</div>
					</div>
					<div class="row formrow">
						<div class=" mb-3 col col-sm-12">
							<label for="validationCustom011">Website</label>
							<input type="text" name="website" class="form-control form-control-sm" >
						</div>
					</div>
					<div class="sp-bw-center">
						<div class=" mb-3">
							<label for="validationCustom011">Alternative Language </label>
							<select name="language" id="language" class="form-control form-control-sm" style="width:9pc">
								<option value="en" >English</option>
								<option value="ar" >Arabic</option>
								<option value="zh"  >Mandarin Chinese</option>
								<option value="es" >Spanish</option> 
								<option value="fr" >French</option>
								<option value="ru" >Russian</option>
								<option value="pt" >Portuguese</option> 
								<option value="de"  >German</option>
							</select>
						</div>
					</div>
					<div class=" mb-3" style="display:none">
						<label for="validationCustom01">Time Zone </label>
						<select class="form-control form-control-sm" id="timezone">
							<option value="" selected="selected">Select Time Zone</option>
							<option value="Pacific/Midway">(UTC-11:00) Midway Island</option>
							<option value="Pacific/Samoa">(UTC-11:00) Samoa</option>
							<option value="Pacific/Honolulu">(UTC-10:00) Hawaii</option>
							<option value="US/Alaska">(UTC-09:00) Alaska</option>
							<option value="America/Los_Angeles">(UTC-08:00) Pacific Time (US &amp; Canada)</option>
							<option value="America/Tijuana">(UTC-08:00) Tijuana</option>
							<option value="US/Arizona">(UTC-07:00) Arizona</option>
							<option value="America/Chihuahua">(UTC-07:00) Chihuahua</option>
							<option value="America/Chihuahua">(UTC-07:00) La Paz</option>
							<option value="America/Mazatlan">(UTC-07:00) Mazatlan</option>
							<option value="US/Mountain">(UTC-07:00) Mountain Time (US &amp; Canada)</option>
							<option value="America/Managua">(UTC-06:00) Central America</option>
							<option value="US/Central">(UTC-06:00) Central Time (US &amp; Canada)</option>
							<option value="America/Mexico_City">(UTC-06:00) Guadalajara</option>
							<option value="America/Mexico_City">(UTC-06:00) Mexico City</option>
							<option value="America/Monterrey">(UTC-06:00) Monterrey</option>
							<option value="Canada/Saskatchewan">(UTC-06:00) Saskatchewan</option>
							<option value="America/Bogota">(UTC-05:00) Bogota</option>
							<option value="US/Eastern">(UTC-05:00) Eastern Time (US &amp; Canada)</option>
							<option value="US/East-Indiana">(UTC-05:00) Indiana (East)</option>
							<option value="America/Lima">(UTC-05:00) Lima</option>
							<option value="America/Bogota">(UTC-05:00) Quito</option>
							<option value="Canada/Atlantic">(UTC-04:00) Atlantic Time (Canada)</option>
							<option value="America/Caracas">(UTC-04:30) Caracas</option>
							<option value="America/La_Paz">(UTC-04:00) La Paz</option>
							<option value="America/Santiago">(UTC-04:00) Santiago</option>
							<option value="Canada/Newfoundland">(UTC-03:30) Newfoundland</option>
							<option value="America/Sao_Paulo">(UTC-03:00) Brasilia</option>
							<option value="America/Argentina/Buenos_Aires">(UTC-03:00) Buenos Aires</option>
							<option value="America/Argentina/Buenos_Aires">(UTC-03:00) Georgetown</option>
							<option value="America/Godthab">(UTC-03:00) Greenland</option>
							<option value="America/Noronha">(UTC-02:00) Mid-Atlantic</option>
							<option value="Atlantic/Azores">(UTC-01:00) Azores</option>
							<option value="Atlantic/Cape_Verde">(UTC-01:00) Cape Verde Is.</option>
							<option value="Africa/Casablanca">(UTC+00:00) Casablanca</option>
							<option value="Europe/London">(UTC+00:00) Edinburgh</option>
							<option value="Etc/Greenwich">(UTC+00:00) Greenwich Mean Time : Dublin</option>
							<option value="Europe/Lisbon">(UTC+00:00) Lisbon</option>
							<option value="Europe/London">(UTC+00:00) London</option>
							<option value="Africa/Monrovia">(UTC+00:00) Monrovia</option>
							<option value="UTC">(UTC+00:00) UTC</option>
							<option value="Europe/Amsterdam">(UTC+01:00) Amsterdam</option>
							<option value="Europe/Belgrade">(UTC+01:00) Belgrade</option>
							<option value="Europe/Berlin">(UTC+01:00) Berlin</option>
							<option value="Europe/Berlin">(UTC+01:00) Bern</option>
							<option value="Europe/Bratislava">(UTC+01:00) Bratislava</option>
							<option value="Europe/Brussels">(UTC+01:00) Brussels</option>
							<option value="Europe/Budapest">(UTC+01:00) Budapest</option>
							<option value="Europe/Copenhagen">(UTC+01:00) Copenhagen</option>
							<option value="Europe/Ljubljana">(UTC+01:00) Ljubljana</option>
							<option value="Europe/Madrid">(UTC+01:00) Madrid</option>
							<option value="Europe/Paris">(UTC+01:00) Paris</option>
							<option value="Europe/Prague">(UTC+01:00) Prague</option>
							<option value="Europe/Rome">(UTC+01:00) Rome</option>
							<option value="Europe/Sarajevo">(UTC+01:00) Sarajevo</option>
							<option value="Europe/Skopje">(UTC+01:00) Skopje</option>
							<option value="Europe/Stockholm">(UTC+01:00) Stockholm</option>
							<option value="Europe/Vienna">(UTC+01:00) Vienna</option>
							<option value="Europe/Warsaw">(UTC+01:00) Warsaw</option>
							<option value="Africa/Lagos">(UTC+01:00) West Central Africa</option>
							<option value="Europe/Zagreb">(UTC+01:00) Zagreb</option>
							<option value="Europe/Athens">(UTC+02:00) Athens</option>
							<option value="Europe/Bucharest">(UTC+02:00) Bucharest</option>
							<option value="Africa/Cairo">(UTC+02:00) Cairo</option>
							<option value="Africa/Harare">(UTC+02:00) Harare</option>
							<option value="Europe/Helsinki">(UTC+02:00) Helsinki</option>
							<option value="Europe/Istanbul">(UTC+02:00) Istanbul</option>
							<option value="Asia/Jerusalem">(UTC+02:00) Jerusalem</option>
							<option value="Europe/Helsinki">(UTC+02:00) Kyiv</option>
							<option value="Africa/Johannesburg">(UTC+02:00) Pretoria</option>
							<option value="Europe/Riga">(UTC+02:00) Riga</option>
							<option value="Europe/Sofia">(UTC+02:00) Sofia</option>
							<option value="Europe/Tallinn">(UTC+02:00) Tallinn</option>
							<option value="Europe/Vilnius">(UTC+02:00) Vilnius</option>
							<option value="Asia/Baghdad">(UTC+03:00) Baghdad</option>
							<option value="Asia/Kuwait">(UTC+03:00) Kuwait</option>
							<option value="Europe/Minsk">(UTC+03:00) Minsk</option>
							<option value="Africa/Nairobi">(UTC+03:00) Nairobi</option>
							<option value="Asia/Riyadh">(UTC+03:00) Riyadh</option>
							<option value="Europe/Volgograd">(UTC+03:00) Volgograd</option>
							<option value="Asia/Tehran">(UTC+03:30) Tehran</option>
							<option value="Asia/Muscat">(UTC+04:00) Abu Dhabi</option>
							<option value="Asia/Baku">(UTC+04:00) Baku</option>
							<option value="Europe/Moscow">(UTC+04:00) Moscow</option>
							<option value="Asia/Muscat">(UTC+04:00) Muscat</option>
							<option value="Europe/Moscow">(UTC+04:00) St. Petersburg</option>
							<option value="Asia/Tbilisi">(UTC+04:00) Tbilisi</option>
							<option value="Asia/Yerevan">(UTC+04:00) Yerevan</option>
							<option value="Asia/Kabul">(UTC+04:30) Kabul</option>
							<option value="Asia/Karachi">(UTC+05:00) Islamabad</option>
							<option value="Asia/Karachi">(UTC+05:00) Karachi</option>
							<option value="Asia/Tashkent">(UTC+05:00) Tashkent</option>
							<option value="Asia/Calcutta">(UTC+05:30) Chennai</option>
							<option value="Asia/Kolkata">(UTC+05:30) Kolkata</option>
							<option value="Asia/Calcutta">(UTC+05:30) Mumbai</option>
							<option value="Asia/Calcutta">(UTC+05:30) New Delhi</option>
							<option value="Asia/Calcutta">(UTC+05:30) Sri Jayawardenepura</option>
							<option value="Asia/Katmandu">(UTC+05:45) Kathmandu</option>
							<option value="Asia/Almaty">(UTC+06:00) Almaty</option>
							<option value="Asia/Dhaka">(UTC+06:00) Astana</option>
							<option value="Asia/Dhaka">(UTC+06:00) Dhaka</option>
							<option value="Asia/Yekaterinburg">(UTC+06:00) Ekaterinburg</option>
							<option value="Asia/Rangoon">(UTC+06:30) Rangoon</option>
							<option value="Asia/Bangkok">(UTC+07:00) Bangkok</option>
							<option value="Asia/Bangkok">(UTC+07:00) Hanoi</option>
							<option value="Asia/Jakarta">(UTC+07:00) Jakarta</option>
							<option value="Asia/Novosibirsk">(UTC+07:00) Novosibirsk</option>
							<option value="Asia/Hong_Kong">(UTC+08:00) Beijing</option>
							<option value="Asia/Chongqing">(UTC+08:00) Chongqing</option>
							<option value="Asia/Hong_Kong">(UTC+08:00) Hong Kong</option>
							<option value="Asia/Krasnoyarsk">(UTC+08:00) Krasnoyarsk</option>
							<option value="Asia/Kuala_Lumpur">(UTC+08:00) Kuala Lumpur</option>
							<option value="Australia/Perth">(UTC+08:00) Perth</option>
							<option value="Asia/Singapore">(UTC+08:00) Singapore</option>
							<option value="Asia/Taipei">(UTC+08:00) Taipei</option>
							<option value="Asia/Ulan_Bator">(UTC+08:00) Ulaan Bataar</option>
							<option value="Asia/Urumqi">(UTC+08:00) Urumqi</option>
							<option value="Asia/Irkutsk">(UTC+09:00) Irkutsk</option>
							<option value="Asia/Tokyo">(UTC+09:00) Osaka</option>
							<option value="Asia/Tokyo">(UTC+09:00) Sapporo</option>
							<option value="Asia/Seoul">(UTC+09:00) Seoul</option>
							<option value="Asia/Tokyo">(UTC+09:00) Tokyo</option>
							<option value="Australia/Adelaide">(UTC+09:30) Adelaide</option>
							<option value="Australia/Darwin">(UTC+09:30) Darwin</option>
							<option value="Australia/Brisbane">(UTC+10:00) Brisbane</option>
							<option value="Australia/Canberra">(UTC+10:00) Canberra</option>
							<option value="Pacific/Guam">(UTC+10:00) Guam</option>
							<option value="Australia/Hobart">(UTC+10:00) Hobart</option>
							<option value="Australia/Melbourne">(UTC+10:00) Melbourne</option>
							<option value="Pacific/Port_Moresby">(UTC+10:00) Port Moresby</option>
							<option value="Australia/Sydney">(UTC+10:00) Sydney</option>
							<option value="Asia/Yakutsk">(UTC+10:00) Yakutsk</option>
							<option value="Asia/Vladivostok">(UTC+11:00) Vladivostok</option>
							<option value="Pacific/Auckland">(UTC+12:00) Auckland</option>
							<option value="Pacific/Fiji">(UTC+12:00) Fiji</option>
							<option value="Pacific/Kwajalein">(UTC+12:00) International Date Line West</option>
							<option value="Asia/Kamchatka">(UTC+12:00) Kamchatka</option>
							<option value="Asia/Magadan">(UTC+12:00) Magadan</option>
							<option value="Pacific/Fiji">(UTC+12:00) Marshall Is.</option>
							<option value="Asia/Magadan">(UTC+12:00) New Caledonia</option>
							<option value="Asia/Magadan">(UTC+12:00) Solomon Is.</option>
							<option value="Pacific/Auckland">(UTC+12:00) Wellington</option>
							<option value="Pacific/Tongatapu">(UTC+13:00) Nuku'alofa</option>
						</select>
					</div>

				</div>
			</div>
		</div>

		<div role="tabpanel" class="tab-pane  p-0" id="taxform">

			<div class="row ">
				<div class="col-md-4">
					<div class=" mb-3">
						<label for="validationCustom01">Tax Registration Status</label><br>
						<div class="form-check form-check-inline">
							<input class="form-check-input foc" type="radio" name="reg_tax_status" id="reg_tax_status" value="1"  >
							<label class="form-check-label" for="inlineCheckbox2">Yes</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input foc" type="radio" checked name="reg_tax_status" id="reg_tax_status" value="0" >
							<label class="form-check-label" for="inlineCheckbox3">No</label>
						</div>
					</div>

					<div class=" mb-3  e-inv-div taxinfo d-none">
						<label for="validationCustom01">Enable E-invoice</label><br>
						<div class="form-check form-check-inline">
							<input class="form-check-input"   type="radio" name="e_invoice" id="e_invoice	" value="1"  >
							<label class="form-check-label" for="inlineCheckbox2">Yes</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input"  checked type="radio" name="e_invoice" id="e_invoice" value="0" >
							<label class="form-check-label" for="inlineCheckbox3">No</label>
						</div>
					</div>
					<div class=" mb-3 taxinfo d-none">
						<label for="validationCustom01">VAT No.</label>
						<input type="text" name="vat_no" id="vat_no" class="form-control form-control-sm"  required>
					</div>

					<div class=" mb-3 taxinfo d-none">
						<label for="validationCustom01">Group VAT No.</label>
						<input type="text" name="group_vat_no" id="group_vat_no" class="form-control form-control-sm" required>
					</div>

					<div class="mb-3 taxinfo d-none ">
						<label for="validationCustom01">Tax Registration Date</label>
						<input type="text" data-attr="date" name="tax_reg_date" id="tax_reg_date" class="form-control form-control-sm"  required>
					</div>

					<div class="mb-3 taxinfo2 d-none "> 
						<label for="validationCustom01">Organization Unit Name</label>
						<input type="text" data-attr="organization_unit_name" name="organization_unit_name" id="organization_unit_name" class="form-control form-control-sm" required>
					</div>

					<div class="mb-3 taxinfo2  d-none">
						<label for="validationCustom01">Commercial Registration Number</label>
						<input type="text" data-attr="commercial_registration_number" name="commercial_registration_number" id="commercial_registration_number" class="form-control form-control-sm" >
					</div> 
					<div class="mb-3 taxinfo2 d-none ">
						<label for="validationCustom01">Invoice Type</label>
						<select name="invoice_type" id="invoice_type" class="form-control form-control-sm">
							<option value="1100" disabled>Select Your Invoice Type</option>
							<option value="0100">Simplified Invoice </option>
							<option value="1000">Standard Invoice </option>
							<option value="1100">Both</option>
						</select>
					</div>
					<div class="mb-3 taxinfo2 d-none">
						<label for="validationCustom01">Environment</label>
						<select name="env_type" id="env_type" class="form-control form-control-sm">
							<option value="developer-portal" disabled>Select Your Environment</option>
							<option value="developer-portal">Test</option>
							<option  value="simulation">Simulation</option>
							<option value="core">Core</option>
						</select>
					</div>
					<div class="mb-3 taxinfo2  d-none">
						<label for="validationCustom01">Registered Address</label>
						<input type="text" data-attr="registered_address" name="registered_address" id="registered_address" class="form-control form-control-sm"   required>
					</div>

					<div class="mb-3 taxinfo2  d-none">
						<label for="validationCustom01">Auth Otp</label>
						<input type="text" data-attr="auth_otp" name="auth_otp" id="auth_otp" class="form-control form-control-sm"   required>
					</div>

					<div class="mb-3 taxinfo2 d-none">
						<label for="validationCustom01">Company Category</label>
						<input type="text" data-attr="company_category" name="company_category" id="company_category" class="form-control form-control-sm" required>
					</div>

				</div>
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<div id="tax_table" style="width:130%;background:white;" class="taxinfoo">
						<table class="table table-sm">
							<thead>
								<tr>
									<th scope="col" style="border-top: inherit;">Applicable From</th>
									<th scope="col" style="border-top: inherit;">Taxability</th>
									<th scope="col" style="border-top: inherit;">Tax Rate</th>
								</tr>
							</thead>
							<tbody>

							 
									<tr class=" ">
										<td></td>
										<td></td>
										<td>%</td>
									</tr>
								 
								<tr id="newTax" style="display:none">
									<td>
										<input type="hidden" id="new_tax" value="0" name="new_tax" />
										<input type="text" data-attr="date" class="form-control form-control-sm" name="applicable_from" id="applicable_from" value="<?php echo date('d-m-Y'); ?>">
									</td>
									<td>
										<select name="tax_type" id="tax_type" class="form-control form-control-sm " onChange="erp_company_taxable(this)" readonly>
											 
										</select>
									</td>
									<td>
										<input type="number" class="form-control form-control-sm" name="tax_rate" id="tax_rate"  >
									</td>
								</tr>

							</tbody>
						</table>
					</div>
					 
					<a href="#" data-open='0' onclick="return erp_new_tax(this)" style="padding-left: 10px;">New Tax System</a>
					 
						<a href="#" data-open='0' onclick="return erp_view_all_tax(this)" style="padding-left: 10px;">View All Tax System</a>
					 
				 

				</div>
			</div>

		</div>

	</div>

</div>

<script>
$(document).ready(function () {

    $('input[name="reg_tax_status"]').on('change', function () {

        if ($(this).val() == "1") {
            $('.taxinfo').removeClass('d-none');
        } else {
            $('.taxinfo').addClass('d-none');
        }

    });
    $('input[name="e_invoice"]').on('change', function () {

        if ($(this).val() == "1") {
            $('.taxinfo2').removeClass('d-none');
        } else {
            $('.taxinfo2').addClass('d-none');
        }

    });

});

function erp_new_tax(obj){
	var open = $(obj).attr('data-open');
	if(open == 0){
		$('#newTax').show();
		$(obj).html("Cancel");
		$(obj).attr('data-open',1);
		$('#validity_from').focus();
		$('#new_tax').val(1);
	}else{
		$('#newTax').hide();
		$(obj).html("New Tax System");
		$(obj).attr('data-open',0);
		$('#new_tax').val(0);
	}
	return;
}
var curr_dial_code = '';
function get_current_country(obj){
	curr_dial_code = $(obj).find('option:selected').attr('data-dial-code');
	return;
}

function set_country(obj){
	var countrycode = $(obj).find('option:selected').attr('data-ccode');
	var region = $(obj).find('option:selected').attr('data-region');
	var currency = $(obj).find('option:selected').attr('data-currency');
	var currencyCode = $(obj).find('option:selected').attr('data-currencyCode');
	var symbol = $(obj).find('option:selected').attr('data-symbol');
	var denomination = $(obj).find('option:selected').attr('data-denomination');
	var decimal = $(obj).find('option:selected').attr('data-decimal');
	var dial_code = $(obj).find('option:selected').attr('data-dial-code');
	
	$('#countrycode').val(countrycode);
	$('#region').val(region);
	$('#currency').val(currency);
	$('#symbol').val(symbol);
	$('#currencyCode').val(currencyCode);
	$('#denomination').val(denomination);
	$('#decimals').val(decimal);

	var mobile = $('#mobile').val();
		mobile = (mobile == '') ? dial_code : mobile.replace(curr_dial_code, dial_code);
	$('#mobile').val(mobile);

	var phone = $('#phone').val();
		phone = (phone == '') ? dial_code : phone.replace(curr_dial_code, dial_code);
	$('#phone').val(phone);
	$(obj).blur();
}
function erp_view_all_tax(obj){
	var body = $('#tax_table').html();
	body = body.replaceAll('hide_tax','');
	erp_open_moal(body);
	$('#innerModalLabel').html("Tax Systms");
	$('.modal-footer').hide();
}
</script>