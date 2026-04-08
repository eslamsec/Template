<script>
currentinput="";
jQuery('body').on('click','.tsfilter',function(){
	return erp_filter_transaction(this);
});

jQuery('body').on('click','.ledgerdata',function(){
	return erp_select_ledger(this);
});

jQuery('body').on('keyup','.ts',function(){
	return result();
});
jQuery('body').on('change','#prefilwithzero',function(){
	return result();
});
jQuery('body').on('click','#tax_applicable',function(){
	return erp_set_taxable_amount(this);
});
jQuery('body').on('keyup','input#group_name',function(){
	erp_copy_name(this);
});

function containsWord(haystack, needle) {
    return (" " + haystack + " ").indexOf(" " + needle + " ") !== -1;
}
function erp_expand_node_byid(node_id) {
	$('#treeview_json').treeview('revealNode', [ node_id, { silent: true } ]);
	$('#treeview_json').treeview('expandNode', [node_id]);
}

function erp_clear_ledger_search(){
	$('#ledger_search_info').html("");
	$('#keywords').val('');
	$('#treeview_json').treeview('collapseAll', { silent: true });
	$('#keywords').focus();
	$('.list-group-item').removeAttr('style');
	
}
function myFunction() {
	var input, filter, div, ul, li, a, i;
	var pattern = $('#keywords').val();
	if(pattern == ""){
		erp_clear_ledger_search();
		return;
	}
	var options = {
		ignoreCase: true,
		exactMatch: false,
		revealResults: true,
	};
	$('#treeview_json').treeview('collapseAll', { silent: true });
	$('#treeview_json').treeview('search', [pattern, options]);
	input = document.getElementById("keywords");
	filter = input.value.toUpperCase();
	div = document.getElementById("treeview_json");
	li = div.getElementsByTagName("li");
	var n=0;
	for (i = 0; i < li.length; i++) {
		a = li[i];
		if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
			$(a).css({'background-color':'#c5dbef'});
			n++;
		}
	}
	if(n>0){
		$('#info').html(n+" Results Found");
	}else{
		$('#info').html("");
		errormsg("Can't find any group and ledger");
	}
	for (i = 0; i < li.length; i++) {
		a = li[i];
		if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
			li[i].scrollIntoView(false)[0];
		}
	}
	
	return;
	var keywords = $('#keywords').val();
	$('#treeview_json').treeview('expandAll', { silent: false });
	if(keywords==""){
		$('#ledger_search_info').html("");
		$('#treeview_json').treeview('collapseAll', { silent: true });
		return;
	}
	var nodes = [];
	var guids = [];
		keywords = keywords.toLowerCase();
		keywords = keywords.replace(/\s+/g, "");
		
	$('.ledger_class').each(function(index) {
		var name = $(this).attr('data-name');
		name = name.toLowerCase();
		var status = containsWord(name,keywords);
		if (name.indexOf(keywords) >= 0){	
			var nodeId = $(this).closest('li').attr('data-nodeid');
			var guid = $(this).attr('id');
			nodes.push(nodeId);
			guids.push(guid);
		}
		
	});
	$('#treeview_json').treeview('collapseAll', { silent: true });
	if(nodes.length>0){
		$('#ledger_search_info').html(nodes.length+" Results Fund");
		for(var i=0;i<nodes.length;i++){
			erp_expand_node_byid(parseInt(nodes[i]));
		}
		for(var i=0;i<guids.length;i++){
			var inputId = guids[i];
			$('#'+inputId).css({'color':'red','font-weight':'bold'});
		}
	}else{
		$('#ledger_search_info').html("");
		errormsg("Can't find any group and ledger");
	}
	return;
	
	var input, filter, ul, li, a, i, txtValue;
	input = document.getElementById("keywords");
	console.log(input.value);
	filter = input.value.toUpperCase();
	ul = $('.list-group')[0];
	li = ul.getElementsByTagName("li");
	for (i = 0; i < li.length; i++) {
		a = li[i].getElementsByTagName("a")[0];
		txtValue = a.textContent || a.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			li[i].style.display = "";
		} else {
			li[i].style.display = "none";
		}
	}
}

function erp_copy_name(obj){
	var str = $(obj).val();
	$('#alias').val(str);
}

function erp_set_taxable_amount(obj){
	if ($(obj).is(':checked')) {
		$('.taxAmount').show();
	}else{
		$('.taxAmount').hide();
		$('#tax_amount').val('');
	}
}

function result() {
	var start_num = $("#start_num").val();
	var total_digit = $("#total_digit").val();
	var prefix = $("#prefix").val();
	var suffix = $("#suffix").val();
	var prefilwithzero = $("#prefilwithzero").val();
	var new_start_num = '';
	if(prefilwithzero == 'yes' && start_num !=''){
		new_start_num = prependZeros(start_num,total_digit);
	}
	if(new_start_num =='' && start_num !=''){
		new_start_num = start_num;
	}	
	var result = prefix+new_start_num+suffix;
	$("#result").val(result);
}

function prependZeros(num,digit){
	if(num == '' || digit == ''){
		return '';
	}
    var str = ("" + num);
    var digit = parseInt(digit) + parseInt(1);
    return (Array(Math.max(digit-str.length, 0)).join("0") + str);
}

function erp_filter_transaction(obj){
	var st = $(obj).attr('data-status');
	var name = $(obj).attr('data-name');
	$('#fmenu').html(name+'<i class="icon-arrow-down-circle"></i>');
	$('#voucher_guid_filter').val(st);
	filter_page(0,0);
}

function erp_select_ledger(obj){
	var vouchertype = $("#voucher_guid option:selected").attr("data-type");
	if(vouchertype ==0){
		errormsg("Select voucher type");
		return;
	}
	var type = $(obj).attr('data-type');
	var actual_id = $(obj).attr('data-actualid');
	var guid = $(obj).attr('data-id');
	var siteurl = $(obj).attr('data-siteurl');
		currentinput = $(obj).attr('id');
	var url = siteurl+"site/transcation_settings/ledger/get_data.php";
	$('#Search_myModal').modal('show');
	
	$('#treeview_json').html("Loading...");
	var keywords = "";
	var selected_node = 0;
	var privilage_ledger = 1;
	var privilage_group = 1;
	$.ajax({ 
		url: url,
		method:"POST",
		dataType: "json",
		data:{privilage_ledger:privilage_ledger,privilage_group:privilage_group,guid:guid,vouchertype:vouchertype,type:type,actual_id:actual_id},	
		success: function(data)   {
			console.log(data);
				$('#search_box_div').css('display','flex');
				$('#treeview_json').treeview({data: data, showIcon: false, showCheckbox: true,onNodeChecked: function(event, node) { // Selected node 
												

                         var selectNodes = getChildNodeIdArr(node);
                         if (selectNodes) { 
                             $('#treeview_json').treeview('checkNode', [selectNodes, { silent: true }]);
                             //setTimeout(() => myFunction(),100);
                         }
                         var parentNode = $("#treeview_json").treeview("getNode", node.parentId);
                         setParentNodeCheck(node);
                         
						
                     },
					  onNodeUnchecked: function(event, node) {
					   
                         var selectNodes = getChildNodeIdArr(node); 
                         if (selectNodes) { 
                             $('#treeview_json').treeview('uncheckNode', [selectNodes, { silent: true }]);
                              //setTimeout(() => myFunction(),100);
                         }
                     },
              onNodeExpanded : function (event,node){
              	//setTimeout(() => myFunction(),100);
              },
              onNodeCollapsed : function (event,node){
              	//setTimeout(() => myFunction(),100);
              }
					 });
			$('#treeview_json').treeview('collapseAll', { silent: true });
			erp_set_selected_ledger(obj);
			//$('.list-group-item').css({'padding':'0px'}) ;
			//$('.node-treeview_json').css({'padding':'0px'}) ;
		}   
	});
	return false;
}
function findCheckableNodess(text) {
     return $('#treeview_json').treeview('search', [ text, { ignoreCase: false, exactMatch: false } ]);
}

function erp_set_selected_ledger(obj){
	var texts = $(obj).val();
	if(texts !=''){
		var textsArray = texts.split(',');
		for(var i=0;i<textsArray.length;i++){
			var text = textsArray[i];
			var checkableNodes = findCheckableNodess(text);
			console.log(checkableNodes);
			$('#treeview_json').treeview('checkNode', [ checkableNodes, { silent: true }]);
		}
	}
}

function getChildNodeIdArr(node) {
	 var ts = [];
	 if (node.nodes) {
		 for (x in node.nodes) {
			 ts.push(node.nodes[x].nodeId);
			 if (node.nodes[x].nodes) {
				 var getNodeDieDai = getChildNodeIdArr(node.nodes[x]);
				 for (j in getNodeDieDai) {
					 ts.push(getNodeDieDai[j]);
				 }
			 }
		 }
	 } else {
		 ts.push(node.nodeId);
	 }
	
	 return ts;
}

function setParentNodeCheck(node) {
	var parentNode = $("#treeview_json").treeview("getNode", node.parentId);
	if (parentNode.nodes) {
		var checkedCount = 0;
		for (x in parentNode.nodes) {
				if (parentNode.nodes[x].state.checked) {
				 checkedCount ++;
			} else {
				 break;
			 }
		}
		if (checkedCount === parentNode.nodes.length) {
			$("#treeview_json").treeview("checkNode", parentNode.nodeId);
			setParentNodeCheck(parentNode);
		}

	}

}
function erp_select_node(){
	var checked = $('#treeview_json').treeview('getChecked');
	var message = "";
	var guids =[];
	var texts = []
	for (var i = 0; i < checked.length; i++) {
		var txt = checked[i].text;
		var ledgername = $(txt).attr('data-name');
		var guid = $(txt).attr('data-guid');
		guids.push(guid);
		texts.push(ledgername);
	}	
	$('#'+currentinput).val(texts.join(','));
	$('#hidden_'+currentinput).val(guids.join(','));
	$('#Search_myModal').modal('hide');	
	return false;
}
// $(document).on('change','#voucher_guid',function(){
// 	if(this.value == '17'){
// 		showPOSCheckbox();
// 	}
// 	else{
// 		showPOSCheckbox('hide');
// 	}
// 	if(this.value == '19'){
// 		showStockTransferCheckbox();
// 	}
// 	else{
// 		showStockTransferCheckbox('hide');
// 	}
// 	if(this.value == '5'){
// 		showCreditSalesCheckbox();
// 		showLedgerOnInvoice();
// 	}
// 	else{
// 		showCreditSalesCheckbox('hide');
// 		showLedgerOnInvoice('hide');
// 	}
// 	if(this.value == '4'){
		
// 		showAutoDeliveredCheckbox();
// 	}
// 	else{
// 		alert(this.value);
// 		showAutoDeliveredCheckbox('hide');
// 	}
	
// 	if($(this).find('option:selected').attr('data-type') == 1 ){
// 		showSalesDetailsCheckbox();
// 	}else{
// 		showSalesDetailsCheckbox('hide');
// 	}
// })
// function showPOSCheckbox(type = 'show'){
// 	if( type == 'hide') $('#showposcheckbox').hide();
// 	else  $('#showposcheckbox').css('display','flex');
// }
// function showSalesDetailsCheckbox(type = 'show'){
// 	if( type == 'hide') $('#showSalesDetailsCheckbox').hide();
// 	else  $('#showSalesDetailsCheckbox').css('display','flex');
// }
// function  showStockTransferCheckbox(type = 'show'){
// 	if( type == 'hide') $('#showStockTransferCheckbox').hide();
// 	else  $('#showStockTransferCheckbox').css('display','flex');
// }
// function showCreditSalesCheckbox(type = 'show'){
// 	if( type == 'hide') $('#showCreditSalesCheckbox').hide();
// 	else  $('#showCreditSalesCheckbox').css('display','flex');
// }
// function showAutoDeliveredCheckbox(type = 'show'){
// 	if( type == 'hide') $('#showAutoDeliveredCheckbox').hide();
// 	else  $('#showAutoDeliveredCheckbox').css('display','flex');
// }
// function showLedgerOnInvoice(type = 'show'){
// 	if( type == 'hide') $('#showLedgerOnInvoice').hide();
// 	else  $('#showLedgerOnInvoice').css('display','block');
// }
$('body').on('hidden.bs.modal', function () {
		if ($('.modal.show').length > 0) {
			$('body').addClass('modal-open');
		}
	});
	
	$('.modal').on('show.bs.modal', function (event) {
		var idx = $('.modal:visible').length;
		$(this).css('z-index', 1040 + (10 * idx));
	});
	$('.modal').on('shown.bs.modal', function (event) {
		var idx = ($('.modal:visible').length) - 1; // raise backdrop after animation.
		$('.modal-backdrop').not('.stacked').css('z-index', 1039 + (10 * idx));
		$('.modal-backdrop').not('.stacked').addClass('stacked');
	});
</script>