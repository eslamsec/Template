<?php
require('../../lib/settings.php');
extract($_POST);
$data = $_POST;
$option['page'] = basename(dirname(__FILE__));
$option['filter'] = $data;
$option['privilages']['transcation_settings']['privilage'] = (int)$data['privilage'];
page($option['page'].'/list',$option);
?>	   
