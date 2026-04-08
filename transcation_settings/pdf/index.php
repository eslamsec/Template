<?php
require_once(root.'classes/class/PDFSettings.php');
$page = $option['page'];
?>
<link rel="stylesheet" href="<?= siteurl."site/$page/css.css?time=".time() ?>" type="text/css"/>
<script src="<?= siteurl."site/$page/js.js?time=".time() ?>"></script>
<?php page($page.'/modal',$option);  ?>
<div class="content">
	<div class="container-fluid">
	<?php page($page.'/bdc',$option); ?>   
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card-box" id="filter_div">
					<?php page($page.'/form',$option); ?>
				</div>
			</div>
		</div>
	</div> 
</div>