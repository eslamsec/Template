<?php
    header("Access-Control-Allow-Origin: *");
    header("content-type:application/json");
    require('../../../../lib/settings.php');

    if(!isset($_POST['from']) || !isset($_POST['to'])){
        $json['saveStatus'] = 0;
        $json['msg'] = 'Incomplete information.';
        echo json_encode($json);
        exit;
    }

    $from = (int)$_POST['from'];
    $to = (int)$_POST['to'];

    $save_id = findOne("SELECT id FROM erp_print_formats WHERE transaction_id=$to");
    $save_id = (int)$save_id['id'];

    $print_format = findOne("SELECT * FROM erp_print_formats WHERE transaction_id=$from");

    $inArray['papersize'] = $print_format['papersize'];
    $inArray['header'] = $print_format['header'];
    $inArray['body_1'] = $print_format['body_1'];
    $inArray['body_2'] = $print_format['body_2'];
    $inArray['footer_last_page'] = $print_format['footer_last_page'];
    $inArray['footer'] = $print_format['footer'];
    $inArray['style'] = $print_format['style'];
    $inArray['settings'] = $print_format['settings'];
    $inArray['margin_top'] = $print_format['margin_top'];
    $inArray['margin_bottom'] = $print_format['margin_bottom'];
    $inArray['margin_left'] = $print_format['margin_left'];
    $inArray['margin_right'] = $print_format['margin_right'];

    saveArray('erp_print_formats', $inArray, $save_id);

    $msg = 'Settings copied successfully';
    $json['saveStatus'] = 1;
    register_msg($msg);
    echo json_encode($json);
    exit;
?>