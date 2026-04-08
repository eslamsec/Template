<?php
require('../../../lib/settings.php');
$link = dblink();

function accountGroupTreeLedger($parent = array(0), $spacing = '-', $category_tree_array = '',$sp=1) {
	if (!is_array($category_tree_array))
		$category_tree_array = array();
		$link = dblink();
		if($parent)
			$parent_string = implode(',',$parent);
		else
			$parent_string = implode(',',array(0));

		$sqlCategory = "SELECT id,name,parent_guid,is_default,nature,is_ledger FROM erp_ledgers WHERE parent_guid IN ( $parent_string )  ORDER BY id ASC";
		$resCategory = mysqli_query($link,$sqlCategory);
		
	if (mysqli_num_rows($resCategory) > 0) {
		
		while($rowCategories = mysqli_fetch_assoc($resCategory)) {
			$gname_trim="";
			if($rowCategories["is_ledger"])
			{
				$sqlCategory = "SELECT id,name FROM erp_ledgers WHERE id = '".$rowCategories['parent_guid']."'";
				$Category = mysqli_query($link,$sqlCategory);
				$Category=mysqli_fetch_assoc($Category);
				$gname_trim = $Category["name"];
				// $gname_trim = trim($Category["name"]);
				// $gname_trim = preg_replace('/\s+/', '', $gname_trim);
			}
			else{
				$gname_trim = $rowCategories['name'];
				// $gname_trim = trim($rowCategories['name']);
				// $gname_trim = preg_replace('/\s+/', '', $gname_trim);
			}


			$name = $rowCategories['name'];
			$name_trim = $rowCategories["name"];
			// $name_trim = trim($rowCategories["name"]);
			// $name_trim = preg_replace('/\s+/', '', $name);
			$ledgerid = $rowCategories['id'];
			$is_ledger = $rowCategories['is_ledger'];
			$close_parent = $rowCategories['parent_guid'];
			$category_tree_array[] = array(
							"id" => $rowCategories['id'],
							"title" => $rowCategories['name'],
							"default_ledger" => $rowCategories['is_default'], 
							"parent_guid" => $rowCategories['parent_guid'], 
							"parent_id" => $rowCategories['parent_guid'], 
							"is_ledger" => $rowCategories['is_ledger'], 
							"nature" => $rowCategories['nature'], 
							"name" =>$name,
							"text" =>'<a href="javascript:void(0)" data-parent-id="'.$close_parent.'" id="ledger_item_'.$ledgerid.'" class = "ledger_class" data-groupName="'.$gname_trim.'" data-title="'.$name.'" data-guid="'.$ledgerid.'" data-name="'.$name_trim.'" data-isledger="'.$is_ledger.'">'.$name.'&nbsp;&nbsp;<font class="hidden_ledger_'.$ledgerid.'" style="display:none"></font></a>',
							"tags"=>$rowCategories['id'],
							);
			$category_tree_array = accountGroupTreeLedger(array($rowCategories['id']), '&nbsp;&nbsp;&nbsp;'.$spacing . '&nbsp;&nbsp;', $category_tree_array,$sp);
			
		}
	}
	return $category_tree_array;
}

function filter_data($data){
	return array_values(array_filter($data));
}

$type = (int)$_REQUEST['type'];
$vouchertype = (int)$_REQUEST['vouchertype'];
$guid = (int)$_REQUEST['guid'];
$get_all = (int)$_REQUEST['get_all'];
if(!$get_all){
	$reverseVoucherType = (int)$_REQUEST['actual_id'];
	if($vouchertype==1 || $vouchertype==3){
		if($reverseVoucherType == 6 || $reverseVoucherType == 13 || $reverseVoucherType == 28){
			$tempType = $type;
			if($tempType == 1) $type = 2;
			if($tempType == 2) $type = 1;
			
		}
		if($type == 1){
			//$data = accountGroupTreeLedger(array(31,20,23,21));
			$data1 = accountGroupTreeLedger(array(31));
			$data2 = accountGroupTreeLedger(array(23));
			$data3 = accountGroupTreeLedger(array(20));
			$data4 = accountGroupTreeLedger(array(21));
			$data = array_merge($data1,$data2,$data3,$data4);
		}else if($type == 2){
			//$data = accountGroupTreeLedger(array(14,10,5));
			$data1 = accountGroupTreeLedger(array(14));
			$data2 = accountGroupTreeLedger(array(10));
			$data3 = accountGroupTreeLedger(array(5));
			$data = array_merge($data1,$data2,$data3);
		}else if($type == 3){
			$data = accountGroupTreeLedger(array(16));
		}else if($type ==  5){
			$data1 = accountGroupTreeLedger(array(5));
			$data2 = accountGroupTreeLedger(array(10));
			//$data = accountGroupTreeLedger(array(5,10));
			$data = array_merge($data1,$data2);
		}
		else{
			$data = accountGroupTreeLedger(array(0));
		}
	}else{
		if($reverseVoucherType == 6 || $reverseVoucherType == 13 || $reverseVoucherType == 28){
			$tempType = $type;
			if($tempType == 1) $type = 2;
			if($tempType == 2) $type = 1;
			
		}
		if($type == 1){
			//$data = accountGroupTreeLedger(array(18,10,5));
			$data1 = accountGroupTreeLedger(array(18));
			$data2 = accountGroupTreeLedger(array(10));
			$data3 = accountGroupTreeLedger(array(5));
			$data = array_merge($data1,$data2,$data3);
		}else if($type == 2){
			//$data = accountGroupTreeLedger(array(19,22,30,21));
			$data1 = accountGroupTreeLedger(array(19));
			$data2 = accountGroupTreeLedger(array(22));
			$data3 = accountGroupTreeLedger(array(30));
			$data4 = accountGroupTreeLedger(array(21));
			$data = array_merge($data1,$data2,$data3,$data4);
		}else if($type == 3){
			$data = accountGroupTreeLedger(array(16));
		}else{
			$data = accountGroupTreeLedger(array(0));
		}
	}
	
	foreach($data as $key => &$value){
		$output[$value["id"]] = &$value;
	}
	foreach($data as $key => &$value){
		if($value["parent_id"] && isset($output[$value["parent_id"]])){
			$output[$value["parent_id"]]["nodes"][] = &$value;
		}
	}
	foreach($data as $key => &$value){
		if($value["parent_id"] && isset($output[$value["parent_id"]])) {
			unset($data[$key]);
		}
	}
	$data = array_values(array_filter($data));
	echo json_encode($data);
	return;
}else{
	$group1 = array(2,3,4,5,6,7,14,15,17,18,19,20);
	$group2 = array(8,9,10,11,12,13,16,22,28);
	if(in_array($guid,$group1)){
		$data = accountGroupTreeLedger(array(31));
		$creditLedger = filter_data($data);
		$info['creditLedger'] = $creditLedger;
		$data = accountGroupTreeLedger(array(14));
		$debitLedger = filter_data($data);
		$info['debitLedger'] = $debitLedger;
		if( $guid == 6) {
			$info['debitLedger'] = $creditLedger;
			$info['creditLedger'] = $debitLedger;
		}
		$data = accountGroupTreeLedger(array(16));
		$vatLedger = filter_data($data);
		foreach($vatLedger as $i=>$ledger){
			if(strtolower($ledger['title']) != 'output vat'){
				unset($vatLedger[$i]);
			}
		}
		$info['vatLedger'] = $vatLedger;
		echo json_encode($info);
		return;
	}
	if(in_array($guid,$group2)){
		$data = accountGroupTreeLedger(array(18));
		$creditLedger = filter_data($data);
		$info['creditLedger'] = $creditLedger;
		$data = accountGroupTreeLedger(array(30));
		$debitLedger = filter_data($data);
		$info['debitLedger'] = $debitLedger;
		if( $guid == 13 || $guid == 28) {
			$info['debitLedger'] = $creditLedger;
			$info['creditLedger'] = $debitLedger;
		}
		$data = accountGroupTreeLedger(array(16));
		$vatLedger = filter_data($data);
		foreach($vatLedger as $i=>$ledger){
			if(strtolower($ledger['title']) != 'input vat'){
				unset($vatLedger[$i]);
			}
		}
		$info['vatLedger'] = $vatLedger;
		echo json_encode($info);
		return;
	}
	
}
//--------------
?>