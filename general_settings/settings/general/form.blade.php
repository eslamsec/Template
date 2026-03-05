<p class="setting-title">General Settings</p>
<hr>
<form method="post" id="setting" action=" "> 

	<div class="card-body row">
		<div class="col-sm-6 ">
			<div class="row formrow">
				<div class="col-sm-5">Name	</div>
				<div class="col-sm-7">
					<input type="text" class="form-control form-control-sm" name="title" id="title" value=" " autocomplete="nope" required>
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">Type of Business	</div>
				<div class="col-sm-7">
					<select name="business_type" id="business_type" class="form-control form-control-sm" >
						 
					</select>
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">Mailing Name</div>
				<div class="col-sm-7">
					<input type="text" class="form-control form-control-sm" name="mailing_name" id="mailing_name" data-copy="branch_name" value=" " autocomplete="nope" >
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">SCR Integration Path</div>
				<div class="col-sm-7">
					<input type="text" class="form-control form-control-sm address" name="scr_integrate_path" id="scr_integrate_path" value=" " autocomplete="nope" >
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">SCR Integration Path 2 (Categorywise POS)</div>
				<div class="col-sm-7">
					<input type="text" class="form-control form-control-sm address" name="scr_integrate_path2" id="scr_integrate_path2" value=" " autocomplete="nope" >
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">SCR Integration Path 3 (Categorywise Credit Sales)</div>
				<div class="col-sm-7">
					<input type="text" class="form-control form-control-sm address" name="scr_integrate_path3" id="scr_integrate_path3" value=" " autocomplete="nope" >
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">SCR Integration Host</div>
				<div class="col-sm-7">
					<input type="text" class="form-control form-control-sm address" name="scr_integrate_host" id="scr_integrate_host" value=" " autocomplete="nope" >
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">SCR Integration User</div>
				<div class="col-sm-7">
					<input type="text" class="form-control form-control-sm address" name="scr_integrate_user" id="scr_integrate_user" value=" " autocomplete="nope" >
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">SCR Integration Password</div>
				<div class="col-sm-7">
					<input type="password" class="form-control form-control-sm address" name="scr_integrate_pwd" id="scr_integrate_pwd" value=" " autocomplete="nope" >
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">Auto Integration Enable</div>
				<div class="col-sm-7">
					<input type="checkbox" checked  name="auto_integrate"  value=" " >
				</div>
			</div>
			<hr>
			<div class="row formrow">
				<div class="col-sm-5">Time Zone</div>
				<div class="col-sm-7">
					<select class="form-control form-control-sm" name="timezone" id="timezone">
					<option value="" selected="selected">Select Time Zone</option>
					<option value="Pacific/Midway">Midway Island (UTC-11:00)</option>
					<option value="Pacific/Samoa">Samoa (UTC-11:00)</option>
					<option value="Pacific/Honolulu">Hawaii (UTC-10:00)</option>
					<option value="US/Alaska">Alaska (UTC-09:00)</option>
					<option value="America/Los_Angeles">Pacific Time (US &amp; Canada) (UTC-08:00) </option>
					<option value="America/Tijuana">Tijuana (UTC-08:00) </option>
					<option value="US/Arizona">Arizona (UTC-07:00) </option>
					<option value="America/Chihuahua">Chihuahua (UTC-07:00) </option>
					<option value="America/Chihuahua">La Paz (UTC-07:00) </option>
					<option value="America/Mazatlan">Mazatlan (UTC-07:00) </option>
					<option value="US/Mountain">Mountain Time (US &amp; Canada) (UTC-07:00) </option>
					<option value="America/Managua">Central America (UTC-06:00) </option>
					<option value="US/Central">Central Time (US &amp; Canada) (UTC-06:00)</option>
					<option value="America/Mexico_City">Guadalajara (UTC-06:00) </option>
					<option value="America/Mexico_City">Mexico City (UTC-06:00) </option>
					<option value="America/Monterrey">Monterrey (UTC-06:00) </option>
					<option value="Canada/Saskatchewan">Saskatchewan (UTC-06:00) </option>
					<option value="America/Bogota">Bogota (UTC-05:00) </option>
					<option value="US/Eastern">Eastern Time (US &amp; Canada) (UTC-05:00) </option>
					<option value="US/East-Indiana">Indiana (East) (UTC-05:00)</option>
					<option value="America/Lima">Lima (UTC-05:00) </option>
					<option value="America/Bogota">Quito (UTC-05:00) </option>
					<option value="Canada/Atlantic">Atlantic Time (Canada) (UTC-04:00)</option>
					<option value="America/Caracas">Caracas (UTC-04:30) </option>
					<option value="America/La_Paz">La Paz (UTC-04:00) </option>
					<option value="America/Santiago">Santiago (UTC-04:00) </option>
					<option value="Canada/Newfoundland">Newfoundland (UTC-03:30) </option>
					<option value="America/Sao_Paulo">Brasilia (UTC-03:00) </option>
					<option value="America/Argentina/Buenos_Aires">Buenos Aires (UTC-03:00) </option>
					<option value="America/Argentina/Buenos_Aires">Georgetown (UTC-03:00) </option>
					<option value="America/Godthab">Greenland (UTC-03:00) </option>
					<option value="America/Noronha">Mid-Atlantic (UTC-02:00) </option>
					<option value="Atlantic/Azores">Azores (UTC-01:00) </option>
					<option value="Atlantic/Cape_Verde">Cape Verde Is.(UTC-01:00) </option>
					<option value="Africa/Casablanca">Casablanca (UTC+00:00) </option>
					<option value="Europe/London">Edinburgh (UTC+00:00) </option>
					<option value="Etc/Greenwich">Greenwich Mean Time : Dublin (UTC+00:00) </option>
					<option value="Europe/Lisbon">Lisbon (UTC+00:00) </option>
					<option value="Europe/London">London(UTC+00:00) </option>
					<option value="Africa/Monrovia">Monrovia (UTC+00:00) </option>
					<option value="UTC">UTC (UTC+00:00) </option>
					<option value="Europe/Amsterdam">Amsterdam (UTC+01:00) </option>
					<option value="Europe/Belgrade">Belgrade (UTC+01:00) </option>
					<option value="Europe/Berlin">Berlin (UTC+01:00) </option>
					<option value="Europe/Berlin">Bern (UTC+01:00) </option>
					<option value="Europe/Bratislava">Bratislava (UTC+01:00) </option>
					<option value="Europe/Brussels">Brussels (UTC+01:00) </option>
					<option value="Europe/Budapest">Budapest (UTC+01:00) </option>
					<option value="Europe/Copenhagen">Copenhagen (UTC+01:00) </option>
					<option value="Europe/Ljubljana">Ljubljana (UTC+01:00) </option>
					<option value="Europe/Madrid">Madrid (UTC+01:00) </option>
					<option value="Europe/Paris">Paris (UTC+01:00) </option>
					<option value="Europe/Prague">Prague (UTC+01:00) </option>
					<option value="Europe/Rome">Rome (UTC+01:00) </option>
					<option value="Europe/Sarajevo">Sarajevo (UTC+01:00) </option>
					<option value="Europe/Skopje">Skopje (UTC+01:00) </option>
					<option value="Europe/Stockholm">Stockholm (UTC+01:00) </option>
					<option value="Europe/Vienna">Vienna (UTC+01:00) </option>
					<option value="Europe/Warsaw">Warsaw (UTC+01:00) </option>
					<option value="Africa/Lagos">West Central Africa (UTC+01:00) </option>
					<option value="Europe/Zagreb">Zagreb (UTC+01:00) </option>
					<option value="Europe/Athens">Athens (UTC+02:00) </option>
					<option value="Europe/Bucharest" >Bucharest (UTC+02:00) </option>
					<option value="Africa/Cairo">Cairo (UTC+02:00) </option>
					<option value="Africa/Harare">Harare (UTC+02:00) </option>
					<option value="Europe/Helsinki">Helsinki (UTC+02:00) </option>
					<option value="Europe/Istanbul">Istanbul (UTC+02:00) </option>
					<option value="Asia/Jerusalem">Jerusalem (UTC+02:00) </option>
					<option value="Europe/Helsinki">Kyiv (UTC+02:00) </option>
					<option value="Africa/Johannesburg">Pretoria (UTC+02:00) </option>
					<option value="Europe/Riga">Riga (UTC+02:00) </option>
					<option value="Europe/Sofia">Sofia (UTC+02:00) </option>
					<option value="Europe/Tallinn">Tallinn (UTC+02:00) </option>
					<option value="Europe/Vilnius">Vilnius (UTC+02:00) </option>
					<option value="Asia/Baghdad">Baghdad (UTC+03:00) </option>
					<option value="Asia/Kuwait">Kuwait (UTC+03:00) </option>
					<option value="Europe/Minsk">Minsk (UTC+03:00) </option>
					<option value="Africa/Nairobi">Nairobi (UTC+03:00) </option>
					<option value="Asia/Riyadh">Riyadh (UTC+03:00) </option>
					<option value="Europe/Volgograd">Volgograd (UTC+03:00) </option>
					<option value="Asia/Tehran">Tehran (UTC+03:30) </option>
					<option value="Asia/Muscat">Abu Dhabi (UTC+04:00) </option>
					<option value="Asia/Baku">Baku (UTC+04:00) </option>
					<option value="Europe/Moscow">Moscow (UTC+04:00) </option>
					<option value="Asia/Muscat">Muscat (UTC+04:00) </option>
					<option value="Europe/Moscow">St. Petersburg (UTC+04:00) </option>
					<option value="Asia/Tbilisi">Tbilisi (UTC+04:00) </option>
					<option value="Asia/Yerevan">Yerevan (UTC+04:00) </option>
					<option value="Asia/Kabul">Kabul (UTC+04:30) </option>
					<option value="Asia/Karachi">Islamabad (UTC+05:00) </option>
					<option value="Asia/Karachi">Karachi (UTC+05:00) </option>
					<option value="Asia/Tashkent">Tashkent (UTC+05:00) </option>
					<option value="Asia/Calcutta">Chennai (UTC+05:30) </option>
					<option value="Asia/Kolkata">Kolkata (UTC+05:30) </option>
					<option value="Asia/Calcutta">Mumbai (UTC+05:30) </option>
					<option value="Asia/Calcutta">New Delhi (UTC+05:30)</option>
					<option value="Asia/Calcutta">Sri Jayawardenepura (UTC+05:30) </option>
					<option value="Asia/Katmandu">Kathmandu (UTC+05:45) </option>
					<option value="Asia/Almaty">Almaty (UTC+06:00) </option>
					<option value="Asia/Dhaka">Astana (UTC+06:00) </option>
					<option value="Asia/Dhaka">Dhaka (UTC+06:00) </option>
					<option value="Asia/Yekaterinburg">Ekaterinburg (UTC+06:00) </option>
					<option value="Asia/Rangoon">Rangoon (UTC+06:30) </option>
					<option value="Asia/Bangkok">Bangkok (UTC+07:00) </option>
					<option value="Asia/Bangkok">Hanoi (UTC+07:00) </option>
					<option value="Asia/Jakarta">Jakarta (UTC+07:00) </option>
					<option value="Asia/Novosibirsk">Novosibirsk (UTC+07:00) </option>
					<option value="Asia/Hong_Kong">Beijing (UTC+08:00) </option>
					<option value="Asia/Chongqing">Chongqing (UTC+08:00) </option>
					<option value="Asia/Hong_Kong">Hong Kong (UTC+08:00) </option>
					<option value="Asia/Krasnoyarsk">Krasnoyarsk (UTC+08:00) </option>
					<option value="Asia/Kuala_Lumpur">Kuala Lumpur (UTC+08:00) </option>
					<option value="Australia/Perth">Perth (UTC+08:00) </option>
					<option value="Asia/Singapore">Singapore (UTC+08:00) </option>
					<option value="Asia/Taipei">Taipei (UTC+08:00) </option>
					<option value="Asia/Ulan_Bator">Ulaan Bataar (UTC+08:00) </option>
					<option value="Asia/Urumqi">Urumqi (UTC+08:00) </option>
					<option value="Asia/Irkutsk">Irkutsk (UTC+09:00) </option>
					<option value="Asia/Tokyo">Osaka (UTC+09:00) </option>
					<option value="Asia/Tokyo">Sapporo (UTC+09:00) </option>
					<option value="Asia/Seoul">Seoul (UTC+09:00) </option>
					<option value="Asia/Tokyo">Tokyo (UTC+09:00) </option>
					<option value="Australia/Adelaide">Adelaide (UTC+09:30) </option>
					<option value="Australia/Darwin">Darwin (UTC+09:30) </option>
					<option value="Australia/Brisbane">Brisbane (UTC+10:00) </option>
					<option value="Australia/Canberra">Canberra (UTC+10:00) </option>
					<option value="Pacific/Guam">Guam (UTC+10:00) </option>
					<option value="Australia/Hobart">Hobart (UTC+10:00) </option>
					<option value="Australia/Melbourne">Melbourne (UTC+10:00) </option>
					<option value="Pacific/Port_Moresby">Port Moresby (UTC+10:00) </option>
					<option value="Australia/Sydney">Sydney (UTC+10:00) </option>
					<option value="Asia/Yakutsk">Yakutsk (UTC+10:00) </option>
					<option value="Asia/Vladivostok">Vladivostok (UTC+11:00) </option>
					<option value="Pacific/Auckland">Auckland (UTC+12:00) </option>
					<option value="Pacific/Fiji">Fiji (UTC+12:00) </option>
					<option value="Pacific/Kwajalein">International Date Line West (UTC+12:00) </option>
					<option value="Asia/Kamchatka">Kamchatka (UTC+12:00) </option>
					<option value="Asia/Magadan">Magadan (UTC+12:00) </option>
					<option value="Pacific/Fiji">Marshall Is. (UTC+12:00) </option>
					<option value="Asia/Magadan">New Caledonia (UTC+12:00) </option>
					<option value="Asia/Magadan">Solomon Is. (UTC+12:00) </option>
					<option value="Pacific/Auckland">Wellington (UTC+12:00)</option>
					<option value="Pacific/Tongatapu">Nuku'alofa (UTC+13:00) </option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-sm-6 ">
			<div class="row formrow">
				<div class="col-sm-5">Logo Width 	</div>
				<div class="col-sm-7">
					<input type="text" class="form-control form-control-sm" name="side_logo[logo_width]"  value=" " autocomplete="nope" required>
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">Logo Height 	</div>
				<div class="col-sm-7">
					<input type="text" class="form-control form-control-sm" name="side_logo[logo_height]"  value=" " autocomplete="nope" required>
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-12 mb-1">
					<input type="checkbox" class="settings" data-index="3"  checked > 
					<input type="hidden" name="customer[auto_credit_limit]" id="settings_3" value=" ">
					Enable credit limit for all new customers
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">Default Credit Limit</div>
				<div class="col-sm-7">
					<input type="number" class="form-control form-control-sm" name="customer[def_credit_amount]"  value=" " autocomplete="nope" >
				</div>
			</div>
			<div class="row formrow">
				<div class="col-sm-5">Default Credit Days</div>
				<div class="col-sm-7">
					<input type="number" class="form-control form-control-sm" name="customer[def_credit_days]"  value=" " autocomplete="nope" >
				</div>
			</div>
        	<div class="row formrow">
            	<div class="col-sm-5">
                	<label>Default Printer</label>
	            </div>
    	        <div class="col-sm-7 mb-1">
        	        <select name="default_printer" id="general_printers" class="form-control form-control-sm"> 
                	    <option value=""  >Select Printer</option>
                    	 
                        	<option value=" " selected> </option>
	                     
    	            </select>
        	        <a href="#" onclick="getPrintersList()">Load Installed Printers</a>
            	</div>
	        </div>

			<hr>
			<h5>Approval Process</h5>
			<div class="row formrow">
				<div class="col-sm-12 checkbox-group">
					<input type="checkbox" name="sent_mail_on_approval_process" value="1" onchange="$('.send-mail-on-approval-process').toggleClass('dis-none')"  checked >
					<label>Send Email for Approval Process</label>
				</div>
			</div>

			<div class="row formrow send-mail-on-approval-process  ">
				<div class="col-sm-12 checkbox-group">
					<input type="checkbox" name="purchase_order_create_pdf_save_time" value="1" checked >
					<label>Generate PDF on Save for Approval Email Attachment</label>
				</div>
			</div>

			<div class="row formrow send-mail-on-approval-process  ">
				<div class="col-sm-12 checkbox-group">
					<input type="checkbox" name="use_system_mail_config" value="1"  checked >
					<label>Use System Email if User Email Not Configured</label>
				</div>
			</div>

			<div class="row formrow send-mail-on-approval-process ">
				<div class="col-sm-5">Default CC for Every Approval Mail</div>
				<div class="col-sm-7">
					<input type="email" class="form-control form-control-sm" name="config[ap_def_cc_mail]" value=" " autocomplete="off">
				</div>
			</div>

			<hr>
			<h5>Stock Control</h5>
			<div class="row formrow">
				<div class="col-sm-12 checkbox-group">
					<input type="checkbox" name="config[disallow_stock_posting_before_last_txn_date]" value="1"  checked  >
					<label>Prevent Stock Transactions Before Last Entry Date</label>
				</div>
			</div>
		</div>
	</div>
	

<div class="text-right card-footer">
<div id="product_error_message" ></div>					
<button class="btn  btn-success"  type="submit" data-status='1' > 
<i class="fa fa-plus-circle"></i> Save </button>

</div>

</form>
<script type="text/javascript" src="{{ asset(main_path('js/JSPrintManager.js')) }}"></script>
<script>
	setTimeout(settimezone, 100);
	function settimezone(){
		$('#timezone').val(' ')
	}

    function getPrintersList() {
        JSPM.JSPrintManager.auto_reconnect = false;
        JSPM.JSPrintManager.start();
        // JSPM.JSPrintManager.WS.onStatusChanged = function() {
        //     if (JSPM.JSPrintManager.websocket_status == JSPM.WSStatus.Open) {
        //         JSPM.JSPrintManager.getPrinters().then(function(arguments) {
        //             if (arguments.length > 0) {
        //                 for (var i = 0; i < arguments.length; i++) {
        //                     $('#general_printers').append('<option value="' + arguments[i] + '">' + arguments[i] + '</option>');
        //                 }
        //                 successmsg('Printers loaded successfully.');
        //             } else {
        //                 errormsg("No printers are installed in your system.");
        //             }
        //         });
        //     }
        // };
    }
</script>