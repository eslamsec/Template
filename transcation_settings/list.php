<?php
if(!isset($option)){
	return;
}
$limit=10;
$page = $option['page'];
$table = 'erp_transaction_settings';
$owner_guid = owner_guid();
$were = " id != 0 ";
$filter = $option['filter'];
$counter = (int)$filter['counter'];
$editPrivilage = (int)$_SESSION['privilages']['transcation_settings']['privilage'];
if($voucher_guid = $filter['voucher_guid']){
	$were .= " and voucher_guid = $voucher_guid ";
}
$data = findQuery("select *from erp_transaction_settings where $were   order by voucher_guid asc limit ".($counter*$limit).",$limit ");
if($counter && !$data){
	$counter = $counter-1;
	$data = findQuery("select *from erp_transaction_settings where $were order by voucher_guid asc limit ".($counter*$limit).",$limit ");
}
// dev-6 - to get coating voucher details
$settings = findQuery("SELECT * from erp_settings limit 1");
$settingsData = unserialize($settings[0]['manufacturing_settings']);
$coating_voucher = $settingsData['coating_factory'];
$option['coating_voucher'] = $coating_voucher;
//dev-6
if(!$data){
	page($page.'/no-result',$option);
	return;
}
$totalrow = numofrow($table, $were);
$paginate['counter'] = $counter;
$paginate['limit'] = $limit;
$paginate['totalrow'] = $totalrow;
$paginate['paginate_url'] = siteurl.'quotationmaster/search';
$paginate['products'] = 1;
$paginate['param'] = $filter;
?>
<div class="header-title" style="float:right"><?php page($page.'/filter_action_menu',$option); ?></div>	


<table class="table table-bordered">

	<thead>
		<tr>
			<th class="center">SL.No</th>
			<th class="center">Name</th>
			<th class="center">Voucher Type </th>
			<th class="center" style="width: 100px;">Date</th>
			<th class="center" style="width: 80px;">No Digit</th>
			<th class="center">Start </th>
			<th class="center">Prefix</th>
			<th class="center">Sufix</th>
			<th class="center">Result</th>
			<th style="text-align:center;width: 90px;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			for($i=0;$i<count($data);$i++){
				$slno =  $totalrow - (($i) + ( $limit * $counter));
				$option['data'] = $data[$i]['id'];
				$voucher_guid = (int)$data[$i]['voucher_guid'];
				$option['voucher_guid'] = $voucher_guid;
				$today = date('Y-m-d');
				$ref = findOne("SELECT * FROM erp_transaction_ref WHERE voucher_id=".(int)$data[$i]['id']." AND date <= '$today' ORDER BY date DESC LIMIT 1");
				
				$param3 = array();
				$param3['guid'] = base64_encode((int)$data[$i]['id']);
				$parameter3 = base64_encode(json_encode($param3));
		?>
		<tr>
			<td scope="row" width="5%"><?php echo $slno; ?></td>
			<td>
				<a href="#" 
					style="color: #17a6e7;text-decoration: underline;"
					data-id="<?php echo base64_encode((int)$data[$i]['id']); ?>" 
					data-url="<?php echo base64_encode(siteurl.'site/'.$page.'/edit.php') ?>"
					data-param="<?php echo $parameter3 ?>"
					data-title="Update Transaction Settings"
					data-action="<?php echo base64_encode(siteurl.'site/'.$page.'/save.php') ?>"
					data-btnlabel = "Update"
					data-modalwidth = "75"
					<?php if($editPrivilage < 4) { ?>
						data-hidesavebutton="1"
					<?php } ?>
					onclick="return edit_form(this)">
						<?= $data[$i]['title']?>
				</a>
			</td>
			<td><?php if($voucher_guid) echo rowvalue($voucher_guid,'erp_vouchers','name'); ?></td>

			<!-- <td><?php if($data[$i]['date'] !='1970-01-01') echo date('d-m-Y',strtotime($data[$i]['date'])); ?></td> -->
			<!-- <td><?php if($data[$i]['total_digit']) echo $data[$i]['total_digit']; else echo '###'; ?></td> -->
			<!-- <td><?php if($data[$i]['start_num']) echo $data[$i]['start_num']; else echo '###'; ?></td> -->
			<!-- <td><?php if($data[$i]['prefix']) echo $data[$i]['prefix']; else echo '###'; ?></td> -->
			<!-- <td><?php if($data[$i]['suffix']) echo $data[$i]['suffix']; else echo '###'; ?></td> -->
			<!-- <td><?php if($data[$i]['result']) echo $data[$i]['result']; else echo '###'; ?></td> -->

			<td><?php if($ref['date'] !='1970-01-01') echo date('d-m-Y',strtotime($ref['date'])); ?></td>
			<td><?php if($ref['total_digit']) echo $ref['total_digit']; else echo '###'; ?></td>
			<td><?php if($ref['start_num']) echo $ref['start_num']; else echo '###'; ?></td>
			<td><?php if($ref['prefix']) echo $ref['prefix']; else echo '###'; ?></td>
			<td><?php if($ref['suffix']) echo $ref['suffix']; else echo '###'; ?></td>
			<td><?php if($ref['result']) echo $ref['result']; else echo '###'; ?></td>
			<td><?php page($page.'/action_menu',$option); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<nav aria-label="Page navigation">
  <ul class="pagination">
	<?php  if($totalrow > $limit ) paginate_ajax($paginate);?>
  </ul>
</nav>                                        












