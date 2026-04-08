<?php
    header("Access-Control-Allow-Origin: *");
    header("content-type:application/json");
    require('../../../../lib/settings.php');

    if(!isset($_POST['custom_format'])){
        $json['saveStatus'] = 0;
        $json['msg'] = 'Nothing to save.';
        echo json_encode($json);
        exit;
    }

    $data = $_POST;

    // $preview = $data['preview'];

    $header = $data['header'];
    $body_1 = $data['body_1'];
    $body_2 = $data['body_2'];
    $footer_last_page = $data['footer_last_page'];
    $footer = $data['footer'];

    $inArray['voucher_guid'] = $data['voucher_guid'];
    $inArray['papersize'] = $data['papersize'];

    $inArray['margin_top'] = $data['margin_top'];
    $inArray['margin_bottom'] = $data['margin_bottom'];
    $inArray['margin_left'] = $data['margin_left'];
    $inArray['margin_right'] = $data['margin_right'];
    $inArray['style'] = serialize($data['style']);
    $inArray['settings'] = serialize($data['settings']);
    // $inArray['header_h'] = $data['header_h'];
    // $inArray['footer_h'] = $data['footer_h'];

    foreach($data['item_table_cols'] as $key=>$item_table){
        $data['item_table_cols'][$key]['width'] = ($data['item_table_cols'][$key]['width']) ? $data['item_table_cols'][$key]['width'].'%' : '';
    }
    $inArray['item_table'] = serialize($data['item_table_cols']);

    $transaction_ids = $data['transaction_ids'];
    foreach($transaction_ids as $t){
        $inArray['header'] = trim(str_replace('{{image_upload_url}}', siteurl."upload/printsettings/$t/", $header));
        $inArray['body_1'] = trim(str_replace('{{image_upload_url}}', siteurl."upload/printsettings/$t/", $body_1));
        $inArray['body_2'] = trim(str_replace('{{image_upload_url}}', siteurl."upload/printsettings/$t/", $body_2));
        $inArray['footer_last_page'] = trim(str_replace('{{image_upload_url}}', siteurl."upload/printsettings/$t/", $footer_last_page));
        $inArray['footer'] = trim(str_replace('{{image_upload_url}}', siteurl."upload/printsettings/$t/", $footer));

        $inArray['transaction_id'] = $t;

        $print_setting = findOne("SELECT id FROM erp_print_formats WHERE transaction_id=".(int)$t);
        saveArray('erp_print_formats', $inArray, (int)$print_setting['id']);

        $trsArray['custom_pdf_enabled'] = 1;
        saveArray('erp_transaction_settings', $trsArray, (int)$t);

        $target = upload_folder."printsettings/$t/";
        if(!file_exists($target)) {
            mkdir($target, 0777, true);
        }
    }

    if(isset($_FILES['image_file'])){
        foreach($_FILES['image_file']['name'] as $i=>$file){
		    $ext = strtolower(pathinfo($_FILES['image_file']['name'][$i], PATHINFO_EXTENSION));
    		$filename = $_POST['image_name'][$i].'.'.$ext;

            $target = upload_folder.'printsettings/'.$transaction_ids[0].'/'.$filename;
	    	move_uploaded_file($_FILES['image_file']['tmp_name'][$i], $target);
            for($i = 1; $i<count($transaction_ids); $i++){
                copy($target, upload_folder.'printsettings/'.$transaction_ids[$i].'/'.$filename);
            }
        }
	}

    $msg = 'Settings saved successfully';
    $json['saveStatus'] = 1;
    $json['msg'] = $msg;
    register_msg($msg);
    echo json_encode($json);
    exit;
?>