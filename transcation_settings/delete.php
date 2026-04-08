<?php
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");
require('../../lib/settings.php');
require(root.'site/auth/validate.php');
$data = $_POST;
$id = base64_decode($data['id']);
if (strtolower( $_SESSION['TALLY_ADMIN_PROFILE']['username']) != 'finexadmin')  exit;

// $qry_voucher="select voucher_type from erp_vouchers where id in(select voucher_guid from erp_transaction_settings where id=$id)";

$data = findQuery(" SELECT * from erp_transaction_settings where id = $id ");
$voucher_guid = $data[0]['voucher_guid'];
if($voucher_guid)
    $voucher_type = rowvalue($voucher_guid,'erp_vouchers','voucher_type');

 
        if($voucher_type==1){
            if($voucher_guid == 2)
                $table = 'erp_quotation_master';
            if($voucher_guid == 3)
                $table = 'erp_salesorder_master';
            if($voucher_guid == 4)
                $table = 'erp_deliverynote_master';
            if($voucher_guid == 5)
                $table = 'erp_sales_sales_master';
            if($voucher_guid == 6)
                $table = 'erp_sales_return_master';
            if($voucher_guid == 7)
                $table = 'erp_sales_sales_master';

            $qry_status=findQuery("SELECT status,start_num from $table where voucher_id = $id order by id desc LIMIT 1");
            $voucher_status=$qry_status[0]['status'];
            $voucher_start_num=$qry_status[0]['start_num'];
            $transaction_setting_voucher_start_num = $data[0]['start_num'];
            if(($voucher_status== 1)  &&  ( $voucher_start_num ==  $transaction_setting_voucher_start_num) ){
                         
                        $sql = "delete from erp_transaction_settings where id=$id";
                        updateQuery($sql);
    
                        $json['deletStatus']=1;
                        $json['returnpage']='quotationmaster';
                        $json['successmsg']='Successfully Deleted';
                        $json['trigger'] = 'menu_quotationmaster';
                        echo json_encode($json);
                        return;
                        
            }
            else{
                        /*echo "Deletion will be failure";
                        exit();*/
                        $json['deletStatus']=0;
                        $json['returnpage']='quotationmaster';
                        $json['errormsg']="Can't delete this voucher. Transactions exists";
                        $json['trigger'] = 'menu_category';
                        echo json_encode($json);
                        return;
                    
            }

        }
        else if($voucher_type==2 || $voucher_type == 3)
        {
            
                    $current_index = $data[0]['current_index'];
          
                    if($currentIndex > 1)
                    {
                        $json['deletStatus']=0;
                        $json['returnpage']='quotationmaster';
                        $json['errormsg']="Can't delete this voucher. relation exists";
                        $json['trigger'] = 'menu_category';
                        echo json_encode($json);
                        return;
                    }
                    else
                    {
                        updateQuery("DELETE from erp_transaction_settings where id=$id");
    
                        $json['deletStatus']=1;
                        $json['returnpage']='quotationmaster';
                        $json['successmsg']='Successfully Deleted';
                        $json['trigger'] = 'menu_quotationmaster';
                        echo json_encode($json);
                        return;
                       
                    }
             
            } else {
                /*echo "No index";
                exit();*/
                        $json['deletStatus']=0;
                        $json['returnpage']='quotationmaster';
                        $json['errormsg']="This voucher is not valid voucher.";
                        $json['trigger'] = 'menu_category';
                        echo json_encode($json);
                        return;

            }
        