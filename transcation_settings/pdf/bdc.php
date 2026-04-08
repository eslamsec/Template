<?php
if(!isset($option)){
	return;
}
$page = $option['page'];
$transaction_id = (int)base64_decode($option[2]);
$custom_pdf_enabled = rowvalue($transaction_id, 'erp_transaction_settings', 'custom_pdf_enabled');
$voucher_title = rowvalue($transaction_id, 'erp_transaction_settings', 'title');
$print_formats = findQuery("SELECT t.id,t.title FROM erp_print_formats p INNER JOIN erp_transaction_settings t ON t.id=p.transaction_id WHERE p.transaction_id!=$transaction_id");
?>
<div class="page-title-box">
	<div class="row">
		<div class="col-md-8">
			<h4 class="page-title"><i class="far fa-file-pdf"></i> Print Settings (<?= $voucher_title ?>)</h4>
		</div>
		<?php if($custom_pdf_enabled){ ?>
			<div class="col-md-4 right" style="line-height:60px;">
				<div class="dropdown dropdown">
					<a class="btn btn-secondary" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						Copy From <i class="fas fa-sort-down"></i>
					</a>
						<div class="dropdown-menu dropdown-menu-right profile-dropdown">
						<?php foreach($print_formats as $format){ ?>
							<a href="javascript:void(0)" class="dropdown-item" data-copy-from="<?= $format['id'] ?>" data-copy-to="<?= $transaction_id ?>" onclick="pdf_copy_settings(this)">
								<?= $format['title'] ?>
							</a>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>  
