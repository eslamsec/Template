<?php
if(!isset($option)){
	return;
}
$page = $option['page'];
$heading = "You haven't add any transaction  yet";
$content = 'Full transaction list will show up here';
if($option['heading']){
	$heading = $option['heading'];
}
if($option['content']){
	$content = $option['content'];
}
?>
<div class="col-md-12 col-md-12-padding">
  <div class="box ">
	<div class="box-body">
	 
     <div class="intro text-center"><div class="videoimg"> </div> <h3><?php echo $heading  ?></h3> 
     <p class="text-muted">
	 <?php page($page.'/filter_action_menu',$option); ?>
	 <?php echo $content  ?></p> 
     
     </div>
	</div>
	
	 <div class="box-footer clearfix">
	 
	</div>
  </div>
</div>