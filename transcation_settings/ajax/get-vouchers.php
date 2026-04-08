<?php
header("Access-Control-Allow-Origin: *");
header("content-type:application/json");
require('../../../lib/settings.php');
$data = $_POST;
if (!isset($_POST['branch'])) {
    $json['saveStatus'] = 0;
    $json['msg'] = 'Nothing to get.';
    echo json_encode($json);
    exit;
}

$branch = $data['branch'];
if($branch == '1011'){
    define('DB_USERNAME_1011','user_1024');
    define('DB_PASSWORD_1011','2fUqb2eqXW2Ebo7rT8TA');
    define('DB_NAME_1011','db_1024');
    define('DB_HOSTNAME_1011','prod.mysql.finexerp.com');
    try {
        $con_1011 = mysqli_connect(DB_HOSTNAME_1011, DB_USERNAME_1011, DB_PASSWORD_1011, DB_NAME_1011);
    }catch(mysqli_sql_exception $e){
        $json['saveStatus'] = 0;
        $json['msg'] = $e->getMessage();
        echo json_encode($json);
        exit;
    }
    if ($con_1011->connect_error) {
        $json['saveStatus'] = 0;
        $json['msg'] = 'Not able to connect to branch database.';
        echo json_encode($json);
        exit;
    }else{
        $sql="SELECT * FROM db_1024.erp_transaction_settings where db_1024.erp_transaction_settings.status > 0  and     db_1024.erp_transaction_settings.voucher_guid != 20   ";
        $data = mysqli_query($con_1011,$sql);
        $customer="SELECT id,name FROM db_1024.erp_customer where  ( db_1024.erp_customer.name LIKE  '%UAE%'  ||  db_1024.erp_customer.name LIKE  '%Saudi%' ||  db_1024.erp_customer.name LIKE  '%Bahrain%')     ";
        $customers = mysqli_query($con_1011,$customer);
        $vendor ="SELECT id,name FROM db_1024.erp_customer where  ( db_1024.erp_customer.name LIKE  '%UAE%'  ||  db_1024.erp_customer.name LIKE  '%Saudi%' ||  db_1024.erp_customer.name LIKE  '%Bahrain%') and db_1024.erp_customer.type = 1     ";
        $vendors = mysqli_query($con_1011,$vendor);
        $userArr ="SELECT id,name FROM db_1024.erp_user 
                                where  (            db_1024.erp_user.name LIKE  '%UAE%'  
                                                    ||  db_1024.erp_user.name LIKE  '%Saudi%' 
                                                    ||  db_1024.erp_user.name LIKE  '%Bahrain%')     ";
        $users = mysqli_query($con_1011,$userArr);
        $option = '';
        $customer_options = '';
        $vendor_options = '';
        $user_options = '';
       
        if(mysqli_num_rows($data) > 0){
            while($row = mysqli_fetch_assoc($data)) {
                $option .= '<option value="'.$row['id'].'">'.$row['title'].'</option>';
            }
            while($cust = mysqli_fetch_assoc($customers)) {
                $customer_options .= '<option value="'.$cust['id'].'">'.$cust['name'].'</option>';
            }
            while($vend = mysqli_fetch_assoc($vendors)) {
                $vendor_options .= '<option value="'.$vend['id'].'">'.$vend['name'].'</option>';
            }
            while($user = mysqli_fetch_assoc($users)) {
                $user_options .= '<option value="'.$user['id'].'">'.$user['name'].'</option>';
            }
            $json['saveStatus'] = 1;
            $json['options'] = $option;
            $json['customer_options'] = $customer_options;
            $json['vendor_options'] = $vendor_options;
            $json['user_options'] = $user_options;
            echo json_encode($json);
            exit;
        }else{
            $json['saveStatus'] = 0;
            $json['msg'] = 'No vouchers found.';
            echo json_encode($json);
            exit;
        }
    }
}
if($branch == '1010'){
    define('DB_USERNAME_1010','user_1023');
    define('DB_PASSWORD_1010','i0AV47W7bOEEdd7P');
    define('DB_NAME_1010','db_1023');
    define('DB_HOSTNAME_1010','prod.mysql.finexerp.com');
    try {
        $con_1010 = mysqli_connect(DB_HOSTNAME_1010, DB_USERNAME_1010, DB_PASSWORD_1010, DB_NAME_1010);
    }catch(mysqli_sql_exception $e){
        $json['saveStatus'] = 0;
        $json['msg'] = $e->getMessage();
        echo json_encode($json);
        exit;
    }
    if ($con_1010->connect_error) {
        $json['saveStatus'] = 0;
        $json['msg'] = 'Not able to connect to branch database.';
        echo json_encode($json);
        exit;
    }else{
        $sql="SELECT * FROM db_1023.erp_transaction_settings where db_1023.erp_transaction_settings.status > 0  and     db_1023.erp_transaction_settings.voucher_guid != 20   ";
        $data = mysqli_query($con_1010,$sql);
        $vendor ="SELECT id,name FROM db_1023.erp_customer where  ( db_1023.erp_customer.name LIKE  '%UAE%'  ||  db_1023.erp_customer.name LIKE  '%Saudi%' ||  db_1023.erp_customer.name LIKE  '%Bahrain%')  and db_1023.erp_customer.type = 1    ";
        $vendors = mysqli_query($con_1010,$vendor);
        $customer="SELECT id,name FROM db_1023.erp_customer where  ( db_1023.erp_customer.name LIKE  '%UAE%'  ||  db_1023.erp_customer.name LIKE  '%Saudi%' ||  db_1023.erp_customer.name LIKE  '%Bahrain%')     ";
        $customers = mysqli_query($con_1010,$customer);
        $userArr="SELECT id,name FROM db_1023.erp_user where  
                                        ( db_1023.erp_user.name LIKE  '%UAE%'  
                                        ||  db_1023.erp_user.name LIKE  '%Saudi%' 
                                        ||  db_1023.erp_user.name LIKE  '%Bahrain%')     ";
        $users = mysqli_query($con_1010,$userArr);
        $option = '';
        $vendor_options = '';
        $customer_options = '';
        $user_options = '';
        if(mysqli_num_rows($data) > 0){
            while($row = mysqli_fetch_assoc($data)) {
                $option .= '<option value="'.$row['id'].'">'.$row['title'].'</option>';
            }
            while($vend = mysqli_fetch_assoc($vendors)) {
                $vendor_options .= '<option value="'.$vend['id'].'">'.$vend['name'].'</option>';
            }
            while($cust = mysqli_fetch_assoc($customers)) {
                $customer_options .= '<option value="'.$cust['id'].'">'.$cust['name'].'</option>';
            }
            while($user = mysqli_fetch_assoc($users)) {
                $user_options .= '<option value="'.$user['id'].'">'.$user['name'].'</option>';
            }
            $json['saveStatus'] = 1;
            $json['options'] = $option;
            $json['vendor_options'] = $vendor_options;
            $json['customer_options'] = $customer_options;
            $json['user_options'] = $user_options;
            echo json_encode($json);
            exit;
        }else{
            $json['saveStatus'] = 0;
            $json['msg'] = 'No vouchers found.';
            echo json_encode($json);
            exit;
        }
    }
}
if($branch == '1012'){
    define('DB_USERNAME_1012','user_1025');
    define('DB_PASSWORD_1012','HABzoyMHTRrRJWzf8CY3');
    define('DB_NAME_1012','db_1025');
    define('DB_HOSTNAME_1012','prod.mysql.finexerp.com');
    try {
        $con_1012 = mysqli_connect(DB_HOSTNAME_1012, DB_USERNAME_1012, DB_PASSWORD_1012, DB_NAME_1012);
    }catch(mysqli_sql_exception $e){
        $json['saveStatus'] = 0;
        $json['msg'] = $e->getMessage();
        echo json_encode($json);
        exit;
    }
    if ($con_1012->connect_error) {
        $json['saveStatus'] = 0;
        $json['msg'] = 'Not able to connect to branch database.';
        echo json_encode($json);
        exit;
    }else{
        $sql="SELECT * FROM db_1025.erp_transaction_settings where db_1025.erp_transaction_settings.status > 0  and     db_1025.erp_transaction_settings.voucher_guid != 20   ";
        $data = mysqli_query($con_1012,$sql);
        $customer="SELECT id,name FROM db_1025.erp_customer where  ( db_1025.erp_customer.name LIKE  '%UAE%'  ||  db_1025.erp_customer.name LIKE  '%Saudi%' ||  db_1025.erp_customer.name LIKE  '%Bahrain%')     ";
        $customers = mysqli_query($con_1012,$customer);
        $vendor ="SELECT id,name FROM db_1025.erp_customer where  ( db_1025.erp_customer.name LIKE  '%UAE%'  ||  db_1025.erp_customer.name LIKE  '%Saudi%' ||  db_1025.erp_customer.name LIKE  '%Bahrain%')   and db_1025.erp_customer.type= 1   ";
        $vendors = mysqli_query($con_1012,$vendor);
        $userArr ="SELECT id,name FROM db_1025.erp_user where  ( 
                                        db_1025.erp_user.name LIKE  '%UAE%'  
                                        ||  db_1025.erp_user.name LIKE  '%Saudi%' 
                                        ||  db_1025.erp_user.name LIKE  '%Bahrain%')     ";
        $users = mysqli_query($con_1012,$userArr);
        $option = '';
        $customer_options = '';
        $vendor_options = '';
        $user_options = '';
        if(mysqli_num_rows($data) > 0){
            while($row = mysqli_fetch_assoc($data)) {
                $option .= '<option value="'.$row['id'].'">'.$row['title'].'</option>';
            }
            while($cust = mysqli_fetch_assoc($customers)) {
                $customer_options .= '<option value="'.$cust['id'].'">'.$cust['name'].'</option>';
            }
            while($vend = mysqli_fetch_assoc($vendors)) {
                $vendor_options .= '<option value="'.$vend['id'].'">'.$vend['name'].'</option>';
            }
            while($user = mysqli_fetch_assoc($users)) {
                $user_options .= '<option value="'.$user['id'].'">'.$user['name'].'</option>';
            }
            $json['saveStatus'] = 1;
            $json['options'] = $option;
            $json['customer_options'] = $customer_options;
            $json['vendor_options'] = $vendor_options;
            $json['user_options'] = $user_options;
            echo json_encode($json);
            exit;
        }else{
            $json['saveStatus'] = 0;
            $json['msg'] = 'No vouchers found.';
            echo json_encode($json);
            exit;
        }
    }
}
if($branch == 'ghcbah'){
    define('DB_USERNAME_bah','ghcbah_user');
    define('DB_PASSWORD_bah','ghcbah!!uT!!ZAA2315');
    define('DB_NAME_bah','ghcbah_DB');
    define('DB_HOSTNAME_bah','10.0.1.124');
    try {
        $con_bah = mysqli_connect(DB_HOSTNAME_bah, DB_USERNAME_bah, DB_PASSWORD_bah, DB_NAME_bah);
    }catch(mysqli_sql_exception $e){
        $json['saveStatus'] = 0;
        $json['msg'] = $e->getMessage();
        echo json_encode($json);
        exit;
    }
    if ($con_bah->connect_error) {
        $json['saveStatus'] = 0;
        $json['msg'] = 'Not able to connect to branch database.';
        echo json_encode($json);
        exit;
    }else{
        $sql="SELECT * FROM ghcbah_DB.erp_transaction_settings where ghcbah_DB.erp_transaction_settings.status > 0  and     ghcbah_DB.erp_transaction_settings.voucher_guid != 20   ";
        $data = mysqli_query($con_bah,$sql);
        $customer="SELECT id,name FROM ghcbah_DB.erp_customer where   ghcbah_DB.erp_customer.type = 0 and ( ghcbah_DB.erp_customer.name LIKE  '%UAE%'  ||  ghcbah_DB.erp_customer.name LIKE  '%Saudi%' ||  ghcbah_DB.erp_customer.name LIKE  '%Bahrain%')     ";
        $customers = mysqli_query($con_bah,$customer);
        $vendor ="SELECT id,name FROM ghcbah_DB.erp_customer where  ( ghcbah_DB.erp_customer.name LIKE  '%UAE%'  ||  ghcbah_DB.erp_customer.name LIKE  '%Saudi%' ||  ghcbah_DB.erp_customer.name LIKE  '%Bahrain%')   and ghcbah_DB.erp_customer.type= 1  ";
        $vendors = mysqli_query($con_bah,$vendor);
        $userArr ="SELECT id,name FROM ghcbah_DB.erp_user 
                                where  (            ghcbah_DB.erp_user.name LIKE  '%UAE%'  
                                                    ||  ghcbah_DB.erp_user.name LIKE  '%Saudi%' 
                                                    ||  ghcbah_DB.erp_user.name LIKE  '%Bahrain%')     ";
        $users = mysqli_query($con_bah,$userArr);
        $option = '';
        $customer_options = '';
        $vendor_options = '';
        $user_options = '';
       
        if(mysqli_num_rows($data) > 0){
            while($row = mysqli_fetch_assoc($data)) {
                $option .= '<option value="'.$row['id'].'">'.$row['title'].'</option>';
            }
            while($cust = mysqli_fetch_assoc($customers)) {
                $customer_options .= '<option value="'.$cust['id'].'">'.$cust['name'].'</option>';
            }
            while($vend = mysqli_fetch_assoc($vendors)) {
                $vendor_options .= '<option value="'.$vend['id'].'">'.$vend['name'].'</option>';
            }
            while($user = mysqli_fetch_assoc($users)) {
                $user_options .= '<option value="'.$user['id'].'">'.$user['name'].'</option>';
            }
            $json['saveStatus'] = 1;
            $json['options'] = $option;
            $json['customer_options'] = $customer_options;
            $json['vendor_options'] = $vendor_options;
            $json['user_options'] = $user_options;
            echo json_encode($json);
            exit;
        }else{
            $json['saveStatus'] = 0;
            $json['msg'] = 'No vouchers found.';
            echo json_encode($json);
            exit;
        }
    }
}

if($branch == 'ghcuae'){
    define('DB_USERNAME_uae','ghcuae_user');
    define('DB_PASSWORD_uae','ghcuae!!uTZAA7865!!');
    define('DB_NAME_uae','ghcuae_DB');
    define('DB_HOSTNAME_uae','10.0.1.124');
    try {
        $con_uae = mysqli_connect(DB_HOSTNAME_uae, DB_USERNAME_uae, DB_PASSWORD_uae, DB_NAME_uae);
    }catch(mysqli_sql_exception $e){
        $json['saveStatus'] = 0;
        $json['msg'] = $e->getMessage();
        echo json_encode($json);
        exit;
    }
    if ($con_uae->connect_error) {
        $json['saveStatus'] = 0;
        $json['msg'] = 'Not able to connect to branch database.';
        echo json_encode($json);
        exit;
    }else{
        $sql="SELECT * FROM ghcuae_DB.erp_transaction_settings where ghcuae_DB.erp_transaction_settings.status > 0  and     ghcuae_DB.erp_transaction_settings.voucher_guid != 20   ";
        $data = mysqli_query($con_uae,$sql);
        $customer="SELECT id,name FROM ghcuae_DB.erp_customer where  ghcuae_DB.erp_customer.type = 0  and ( ghcuae_DB.erp_customer.name LIKE  '%UAE%'  ||  ghcuae_DB.erp_customer.name LIKE  '%Saudi%' ||  ghcuae_DB.erp_customer.name LIKE  '%Bahrain%')     ";
        $customers = mysqli_query($con_uae,$customer);
        $vendor ="SELECT id,name FROM ghcuae_DB.erp_customer where  ( ghcuae_DB.erp_customer.name LIKE  '%UAE%'  ||  ghcuae_DB.erp_customer.name LIKE  '%Saudi%' ||  ghcuae_DB.erp_customer.name LIKE  '%Bahrain%')    and ghcuae_DB.erp_customer.type= 1  ";
        $vendors = mysqli_query($con_uae,$vendor);
        $userArr ="SELECT id,name FROM ghcuae_DB.erp_user 
                                where  (            ghcuae_DB.erp_user.name LIKE  '%UAE%'  
                                                    ||  ghcuae_DB.erp_user.name LIKE  '%Saudi%' 
                                                    ||  ghcuae_DB.erp_user.name LIKE  '%Bahrain%')     ";
        $users = mysqli_query($con_uae,$userArr);
        $option = '';
        $customer_options = '';
        $vendor_options = '';
        $user_options = '';
       
        if(mysqli_num_rows($data) > 0){
            while($row = mysqli_fetch_assoc($data)) {
                $option .= '<option value="'.$row['id'].'">'.$row['title'].'</option>';
            }
            while($cust = mysqli_fetch_assoc($customers)) {
                $customer_options .= '<option value="'.$cust['id'].'">'.$cust['name'].'</option>';
            }
            while($vend = mysqli_fetch_assoc($vendors)) {
                $vendor_options .= '<option value="'.$vend['id'].'">'.$vend['name'].'</option>';
            }
            while($user = mysqli_fetch_assoc($users)) {
                $user_options .= '<option value="'.$user['id'].'">'.$user['name'].'</option>';
            }
            $json['saveStatus'] = 1;
            $json['options'] = $option;
            $json['customer_options'] = $customer_options;
            $json['vendor_options'] = $vendor_options;
            $json['user_options'] = $user_options;
            echo json_encode($json);
            exit;
        }else{
            $json['saveStatus'] = 0;
            $json['msg'] = 'No vouchers found.';
            echo json_encode($json);
            exit;
        }
    }
}

if($branch == 'ghcksa'){
    define('DB_USERNAME_ksa','ghcksa_user');
    define('DB_PASSWORD_ksa','ghcuksa!!uT!!Z234AA');
    define('DB_NAME_ksa','ghcksa_DB');
    define('DB_HOSTNAME_ksa','10.0.1.124');
    try {
        $con_ksa = mysqli_connect(DB_HOSTNAME_ksa, DB_USERNAME_ksa, DB_PASSWORD_ksa, DB_NAME_ksa);
    }catch(mysqli_sql_exception $e){
        $json['saveStatus'] = 0;
        $json['msg'] = $e->getMessage();
        echo json_encode($json);
        exit;
    }
    if ($con_ksa->connect_error) {
        $json['saveStatus'] = 0;
        $json['msg'] = 'Not able to connect to branch database.';
        echo json_encode($json);
        exit;
    }else{
        $sql="SELECT * FROM ghcksa_DB.erp_transaction_settings where ghcksa_DB.erp_transaction_settings.status > 0  and     ghcksa_DB.erp_transaction_settings.voucher_guid != 20   ";
        $data = mysqli_query($con_ksa,$sql);
        $customer="SELECT id,name FROM ghcksa_DB.erp_customer where ghcksa_DB.erp_customer.type = 0 and   ( ghcksa_DB.erp_customer.name LIKE  '%UAE%'  ||  ghcksa_DB.erp_customer.name LIKE  '%Saudi%' ||  ghcksa_DB.erp_customer.name LIKE  '%Bahrain%')     ";
        $customers = mysqli_query($con_ksa,$customer);
        $vendor ="SELECT id,name FROM ghcksa_DB.erp_customer where  ( ghcksa_DB.erp_customer.name LIKE  '%UAE%'  ||  ghcksa_DB.erp_customer.name LIKE  '%Saudi%' ||  ghcksa_DB.erp_customer.name LIKE  '%Bahrain%')  and ghcksa_DB.erp_customer.type = 1    ";
        $vendors = mysqli_query($con_ksa,$vendor);
        $userArr ="SELECT id,name FROM ghcksa_DB.erp_user 
                                where  (            ghcksa_DB.erp_user.name LIKE  '%UAE%'  
                                                    ||  ghcksa_DB.erp_user.name LIKE  '%Saudi%' 
                                                    ||  ghcksa_DB.erp_user.name LIKE  '%Bahrain%')     ";
        $users = mysqli_query($con_ksa,$userArr);
        $option = '';
        $customer_options = '';
        $vendor_options = '';
        $user_options = '';
       
        if(mysqli_num_rows($data) > 0){
            while($row = mysqli_fetch_assoc($data)) {
                $option .= '<option value="'.$row['id'].'">'.$row['title'].'</option>';
            }
            while($cust = mysqli_fetch_assoc($customers)) {
                $customer_options .= '<option value="'.$cust['id'].'">'.$cust['name'].'</option>';
            }
            while($vend = mysqli_fetch_assoc($vendors)) {
                $vendor_options .= '<option value="'.$vend['id'].'">'.$vend['name'].'</option>';
            }
            while($user = mysqli_fetch_assoc($users)) {
                $user_options .= '<option value="'.$user['id'].'">'.$user['name'].'</option>';
            }
            $json['saveStatus'] = 1;
            $json['options'] = $option;
            $json['customer_options'] = $customer_options;
            $json['vendor_options'] = $vendor_options;
            $json['user_options'] = $user_options;
            echo json_encode($json);
            exit;
        }else{
            $json['saveStatus'] = 0;
            $json['msg'] = 'No vouchers found.';
            echo json_encode($json);
            exit;
        }
    }
}