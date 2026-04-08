currentinput="";
clicktext="";
jQuery('body').on('click','.tsfilter',function(){
	return erp_filter_transaction(this);
});
//mukesh promotion select js
$('body').on("click", ".dropdown-menu", function (e) {
    $(this).parent().is(".open") && e.stopPropagation();
});

$('body').on("click",'.mselectall',function() {
    if ($(this).is(':checked')) {
        $('.moption').prop('checked', true);
        var total = $('input[name="moptions[]"]:checked').length;
        $(".mdropdown-text").html('(' + total + ') Promotion Selected');
        $(".mselect-text").html(' Deselect');
    } else {
        $('.moption').prop('checked', false);
        $(".mdropdown-text").html('(0) Promotion Selected');
        $(".mselect-text").html(' Select');
    }
});
$('body').on("change","input[type='checkbox'].justone",function(){
    var a = $("input[type='checkbox'].justone");
    if(a.length == a.filter(":checked").length){
        $('.mselectall').prop('checked', true);
        $(".mselect-text").html(' Deselect');
    }
    else {
        $('.mselectall').prop('checked', false);
        $(".mselect-text").html(' Select');
    }
  var total = $('input[name="moptions[]"]:checked').length;
  $(".mdropdown-text").html('(' + total + ') Selected');
});

$('body').on("click",'.cselectall',function() {
    if ($(this).is(':checked')) {
        $('.cardOptions').prop('checked', true);
        var total = $('input.cardOptions:checked').length;
        $(".cdropdown-text").html('(' + total + ') Ledger Selected');
        $(".cselect-text").html(' Deselect');
    } else {
        $('.cardOptions').prop('checked', false);
        $(".cdropdown-text").html('(0) Ledger Selected');
        $(".cselect-text").html(' Select');
    }
});
$('body').on("change","input[type='checkbox'].justone2",function(){
    var a = $("input[type='checkbox'].justone2");
    if(a.length == a.filter(":checked").length){
        $('.cselectall').prop('checked', true);
        $(".cselect-text").html(' Deselect');
    }
    else {
        $('.cselectall').prop('checked', false);
        $(".cselect-text").html(' Select');
    }
  var total = $('input.cardOptions:checked').length;
  $(".cdropdown-text").html('(' + total + ') Selected');
});


$('body').on("click",'.dselectall',function() {
    if ($(this).is(':checked')) {
        $('.dcardOptions').prop('checked', true);
        var total = $('input.dcardOptions:checked').length;
        $(".ddropdown-text").html('(' + total + ') Ledger Selected');
        $(".dselect-text").html(' Deselect');
    } else {
        $('.dcardOptions').prop('checked', false);
        $(".ddropdown-text").html('(0) Ledger Selected');
        $(".dselect-text").html(' Select');
    }
});
$('body').on("change","input[type='checkbox'].justone3",function(){
    var a = $("input[type='checkbox'].justone3");
    if(a.length == a.filter(":checked").length){
        $('.dselectall').prop('checked', true);
        $(".dselect-text").html(' Deselect');
    }
    else {
        $('.dselectall').prop('checked', false);
        $(".dselect-text").html(' Select');
    }
  var total = $('input.dcardOptions:checked').length;
  $(".ddropdown-text").html('(' + total + ') Selected');
});


$('body').on("click",'.wselectall',function() {
    if ($(this).is(':checked')) {
        $('.wcardOptions').prop('checked', true);
        var total = $('input.wcardOptions:checked').length;
        $(".wdropdown-text").html('(' + total + ') Ledger Selected');
        $(".wselect-text").html(' Deselect');
    } else {
        $('.wcardOptions').prop('checked', false);
        $(".wdropdown-text").html('(0) Ledger Selected');
        $(".wselect-text").html(' Select');
    }
});
$('body').on("change","input[type='checkbox'].justone4",function(){
    var a = $("input[type='checkbox'].justone4");
    if(a.length == a.filter(":checked").length){
        $('.wselectall').prop('checked', true);
        $(".wselect-text").html(' Deselect');
    }
    else {
        $('.wselectall').prop('checked', false);
        $(".wselect-text").html(' Select');
    }
  var total = $('input.wcardOptions:checked').length;
  $(".wdropdown-text").html('(' + total + ') Selected');
});

//end mukesh
jQuery('body').on('click','.ledgerdata',function(){
	//return erp_select_ledger(this);
	var id=$(this).attr('data-type');
	clicktext=id;
	$(".ledgerdata"+id).trigger('click');
});
jQuery('body').on('click','.ledgerdata1',function(){
	
	return erp_select_ledger(this);
});
jQuery('body').on('click','.ledgerdata2',function(){
	return erp_select_ledger(this);
});
jQuery('body').on('click','.ledgerdata3',function(){
	return erp_select_ledger(this);
});
jQuery('body').on('click','.ledgerdata4',function(){
	return erp_select_ledger(this);
});

jQuery('body').on('click','.ledgerdata5',function(){
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
$(document).ready(function(){
	$('#req_confirmation').trigger('click');
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
	var attrID = $(obj).attr('id');
	console.log(attrID);
	var siteurl = $(obj).attr('data-siteurl');
		currentinput = $(obj).attr('id');
	var url = siteurl+"site/transcation_settings/ledger/get_data.php";
	$('#Search_myModal').modal('show');
	$('#treeview_json').html("Loading...");
	var keywords = "";
	var selected_node = 0;
	var privilage_ledger = 1;
	var privilage_group = 1;
	// alert(actual_id);
	$.ajax({ 
		url: url,
		method:"POST",
		dataType: "json",
		data:{privilage_ledger:privilage_ledger,privilage_group:privilage_group,guid:guid,vouchertype:vouchertype,type:type,actual_id:actual_id},	
		success: function(data)   {
			console.log(data);
				$('#search_box_div').css('display','flex');
				$('#treeview_json').treeview({data: data, showIcon: false, showCheckbox: true,
					onNodeChecked: function(event, node) { // Selected node 
												

                         var selectNodes = getChildNodeIdArr(node);
                         if (selectNodes) { 
                             $('#treeview_json').treeview('checkNode', [selectNodes, { silent: true }]);
                             //setTimeout(() => myFunction(),100);
                         }
                         var parentNode = $("#treeview_json").treeview("getNode", node.parentId);
						//  console.log(parentNode.state);
                         setParentNodeCheck(node);

						 var parentNode = $('#treeview_json').treeview('getParent', node.nodeId);

						if (parentNode) {
							// Check the parent node's checkbox
							$('#treeview_json').treeview('checkNode', [parentNode.nodeId, { silent: true }]);
						}
                         
						
                     },
					  onNodeUnchecked: function(event, node) {
					   
                         var selectNodes = getChildNodeIdArr(node); 
                         if (selectNodes) { 
                             $('#treeview_json').treeview('uncheckNode', [selectNodes, { silent: true }]);
                              //setTimeout(() => myFunction(),100);
                         }
						 var childNodes = $('#treeview_json').treeview('getSiblings', node.nodeId);

						 // Check if all child nodes are unchecked
						 var allUnchecked = true;
						 for (var i = 0; i < childNodes.length; i++) {
							 if (childNodes[i].state.checked) {
								 allUnchecked = false;
								 break;
							 }
						 }
			 
						 // If all child nodes are unchecked, uncheck the parent node
						 if (allUnchecked) {
							 var parentNode = $('#treeview_json').treeview('getParent', node.nodeId);
							 if (parentNode) {
								 $('#treeview_json').treeview('uncheckNode', [parentNode.nodeId, { silent: true }]);
							 }
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
			// erp_set_selected_ledger(obj);
			if(attrID == 'm_credit_ledgers'){
				erp_Set_ledger_ONID(document.getElementById('hidden_credit_ledgers'));
			}
			if(attrID == 'm_debit_ledgers'){
				erp_Set_ledger_ONID(document.getElementById('hidden_debit_ledgers'));
			}
			if(attrID == 'm_vat_ledgers'){
				erp_Set_ledger_ONID(document.getElementById('hidden_vat_ledgers'));
			}
			if(attrID == 'm_other_ledgers'){
				erp_Set_ledger_ONID(document.getElementById('hidden_other_ledgers'));
			}
			if(attrID == 'm_cash_bank_ledgers'){
				erp_Set_ledger_ONID(document.getElementById('hidden_cash_bank_ledgers'));
			}
			
			
			
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
			var checkableNodes1=[];
			checkableNodes1[0]=checkableNodes[0];
			// console.log("mukesh");console.log(checkableNodes1);
			$('#treeview_json').treeview('checkNode', [ checkableNodes1, { silent: true }]);
		}
	}

}
function erp_Set_ledger_ONID(obj){
	var ids = $(obj).val();
	if(ids !=''){

		// Example usage:
var targetNodeIds = ids; // Replace with your comma-separated nodeIds
// Example usage:
var attributeToSearch = "id"; // Replace with your custom attribute name
var targetValue = ids ; // Replace with the value you want to search for
var tree = $('#treeview_json').treeview(true);
console.log(tree);
// Get all nodes in the tree
var allNodes = tree.getUnchecked();

// Search for nodes matching the attribute and value
var matchingNodes = searchNodesByAttribute(allNodes, attributeToSearch, targetValue);

if (matchingNodes.length > 0) {
    // console.log("Matching nodes found:", matchingNodes);
	$('#treeview_json').treeview('checkNode', [ matchingNodes, { silent: true }]);
} else {
    console.log("No matching nodes found.");
}
	
	}
}


function searchNodesByAttribute(node, attribute, value) {
    var matchingNodes = [];

    // Check the current node
	// console.log(node);
	// console.log(node[attribute]);
    // if (node[attribute] === value) {
    //     matchingNodes.push(node);
    // }


	
    // Split the targetValues into an array
    var valuesToMatch = value.split(",");

    // Check if the current node's attribute matches any of the target values
    if (valuesToMatch.includes(node[attribute])) {
        matchingNodes.push(node);
    }
    // Recursively search in child nodes
    if (node.length) {
        for (var i = 0; i < node.length; i++) {
			console.log(node[i]);
            var childMatchingNodes = searchNodesByAttribute(node[i], attribute, value);
            matchingNodes = matchingNodes.concat(childMatchingNodes);
        }
    }

    return matchingNodes;
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
			}else {
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
	var m_texts = []
	var arrcredit={};var index=0;
	for (var i = 0; i < checked.length; i++) {
		var txt = checked[i].text;
		var ledgername = $(txt).attr('data-name');
		var groupname = $(txt).attr('data-groupname');
		var guid = $(txt).attr('data-guid');
		var is_ledger = $(txt).data('isledger');
		// if(!is_ledger){
		// 	//guids.push(guid);
		// 	texts.push(ledgername);
		// }
		if(groupname.length>0 )
		{
			texts.push(groupname);
		}
		
		guids.push(guid);
		m_texts.push(ledgername);

		if(is_ledger){
			arrcredit[index]={'id':guid,'title':ledgername,'is_ledger':is_ledger};
			index++;
		}
	}	
	var finalgroup=removeDuplicates(texts)
	var arr=currentinput.split('m_');
	currentinput=arr[1];
	var guidv=$('#voucher_guid').val();
	if(clicktext=="1")
	{
	if( guidv == 4 )	defaultSalesLedgerOptions(arrcredit,1);
	if( guidv == 5 )	defaultSalesLedgerOptions(arrcredit,1);
	if( guidv == 6 )	defaultSalesLedgerOptions(arrcredit,1);
	if( guidv == 7 )	defaultSalesLedgerOptions(arrcredit,1);
	if( guidv == 17 )	defaultSalesLedgerOptions(arrcredit,1);
	if( guidv == 18 )	defaultSalesLedgerOptions(arrcredit,1);
	if( guidv == 13 )	defaultSalesLedgerOptions(arrcredit,2);
	if( guidv == 28 )	defaultSalesLedgerOptions(arrcredit,2);
	
	}
	if(clicktext=="2"){
		if( guidv == 12 )defaultSalesLedgerOptions(arrcredit,2);
		if( guidv == 9 )defaultSalesLedgerOptions(arrcredit,2);
		if( guidv == 10 )defaultSalesLedgerOptions(arrcredit,2);
		if( guidv == 11 )defaultSalesLedgerOptions(arrcredit,2);
	

	}
	$('#'+currentinput).val(finalgroup.join(','));
	$('#hidden_'+currentinput).val(guids.join(','));
	$('#m_'+currentinput).val(m_texts.join(',')+","+finalgroup.join(','));
	$('#Search_myModal').modal('hide');	
	return false;
}

function removeDuplicates(arr) {
	return [...new Set(arr)];
}


$(document).on('change','#voucher_guid',function(){
	var $form = $(this).closest('form');
	var voucher_guid = this.value;

	$('.related-fields').hide();
	$('.related-fields.'+voucher_guid).css('display','flex');

	$('.related-field-blocks').hide();
	$('.related-field-blocks.'+voucher_guid).show();
	$('#req_confirmation').removeAttr('checked');
	$('#recurring').removeAttr('checked');

	$('.form-settings').hide();
	$('.form-settings.'+voucher_guid).show();

	if(this.value == 29 || this.value == 15){
		if(this.value == 29) $('.pr-ir-span').html('IR');
		if(this.value == 15) $('.pr-ir-span').html('PR');
	}
	if(this.value == '17' || this.value == '18'){
		showPOSCheckbox();
		showPOSSalesReturnDiv();
	}else if(this.value == '3') {
		showPOSCheckbox('hide');
		showPOSSalesReturnDiv('hide');
		$('#showposcheckboxid').css('display',"flex") ;
	}
	else{
		showPOSCheckbox('hide');
		showPOSSalesReturnDiv('hide');
	} 
	if(this.value == '9' || this.value == '10' || this.value == '11'){
		showProcessPurchaseDiv();
	}else {
		showProcessPurchaseDiv('hide');
	}
	if(this.value == 17 || this.value == 13 ) showComplimentButton('show',this.value);
	else showComplimentButton('hide',this.value);
	// dev-6
	if(voucher_guid == '3'){
		showRecurringCheckBox();
	}
	else{
		showRecurringCheckBox('hide');
	}
	// dev-6
	if(this.value == '19'){
		showStockTransferCheckbox();
		$form.find('select[name="stocktransfer_type"]').trigger('change');
	}
	else{
		showStockTransferCheckbox('hide');
	}
	if(this.value == '118'){
		show_change_store_during_txn();
		show_only_manufacture_item();
		show_manufacture_on_sales();
		$(".voucher118").show();
		$(".store").hide();
	}
	else{
		show_change_store_during_txn('hide');
		show_only_manufacture_item('hide');
		show_manufacture_on_sales('hide');
		$(".voucher118").hide();
		$(".store").show();
	}

	if(this.value == '5'    || this.value == '6'  || this.value == '17' || this.value == '18' || this.value == '25'  ){
		showCashLedger();
	}else{
		showCashLedger('hide');
	}

	if(this.value == '5' || this.value == '7'  || this.value == '4'  || this.value == '6'  || this.value == '17' || this.value == '18' || this.value == '3' || this.value == '25' || this.value == '26' ){
		if(this.value == '5'  || this.value == '12') showCreditSalesCheckbox('show',this.value);
		else showCreditSalesCheckbox('hide');
		if(this.value == '5' || this.value == '7'  || this.value == '3' || this.value == '25' || this.value == '26' ) showLedgerOnInvoice();
		else showLedgerOnInvoice('hide');
		// if(this.value != '3') showLedgerOnInvoice2(); else  showLedgerOnInvoice2('hide');
		// showDefaultDelivered();
	}
	else{
		if( this.value == '12') showCreditSalesCheckbox('show',this.value);
		else showCreditSalesCheckbox('hide');
		// showCreditSalesCheckbox('hide');
		if( this.value == '12') showLedgerOnInvoice();
		else showLedgerOnInvoice('hide');
		// showLedgerOnInvoice2('hide');
		// showDefaultDelivered('hide');
	}

	if($.inArray(parseInt(this.value), [3,4,5,6,7,17,18]) !== -1){
		$('#showLedgerOnInvoice2').show();
	} else {
		$('#showLedgerOnInvoice2').hide();
	}

	if($.inArray(parseInt(this.value), [3]) !== -1){
		$('#sales_ledger_allow_all').show();
	} else {
		$('#sales_ledger_allow_all').hide();
	}

	if(this.value == '4' || this.value == '5' || this.value == '7'){
		showAutoDeliveredCheckbox();
	}
	else{
		showAutoDeliveredCheckbox('hide');
	}
	if($(this).find('option:selected').attr('data-type') == 1 ){
		showSalesDetailsCheckbox();
	}else{
		showSalesDetailsCheckbox('hide');
	}

	if(($(this).find('option:selected').attr('data-type') == 1))
	{
		showVoucherCoatingCheckbox();
	}
	else
	{
		showVoucherCoatingCheckbox('hide');
	}
	if(this.value == '17' || this.value == '18'){
		showOutletDiv();
	}else{
		showOutletDiv('hide');
	}
	if(this.value == 18) showKotVoucherDiv();
	else showKotVoucherDiv('hide');
	if(this.value == '12' || this.value == '13' || this.value == '28' || this.value == '10' || this.value == '9'){
		showLedgerOnInvoice3();
		$('#AutoPurchaseDeliveryNote').closest('.form-check').show();
		$('#ShowCustomerDetails').closest('.form-check').show();
	}else{
		showLedgerOnInvoice3('hide');
		$('#AutoPurchaseDeliveryNote').closest('.form-check').hide();
		$('#ShowCustomerDetails').closest('.form-check').hide();
	}
	if(this.value == '18'){
		showKOTDiv();
	}
	if(this.value == '3'){
		showIsJobCardSetting();
		showIsPullQtyCostSetting();
		showWholeSales();
		showContract();
		showMargin();
		showCrLmtCheckSOCheckbox();
	} else{
		showIsJobCardSetting('hide');
		showIsPullQtyCostSetting('hide');
		showWholeSales('hide');
		showContract('hide');
		showMargin('hide');
		showCrLmtCheckSOCheckbox('hide');
	}
	if(this.value == '4'){
		showCrLmtCheckDNCheckbox();
	} else{
		showCrLmtCheckDNCheckbox('hide');
	}

	if(this.value == '3' || (this.value == '5' && !$('#creditSalesSwitch').is(':checked'))){
		$('#receipt_voucher').closest('.form-group').show();
	} else {
		$('#receipt_voucher').closest('.form-group').hide();
	}
	if(this.value == '9')  showProcessPOtoGRN();
	else showProcessPOtoGRN('hide');
	if(this.value == '15' ) showProcessPRtoPO();
	else showProcessPRtoPO('hide');
	if(this.value == '9' || this.value == '10' || this.value == '11' || this.value == '12' || this.value == '13' || this.value == '28'){
		$('#dynamicplTable').show();
	}else $('#dynamicplTable').hide();
	erp_get_default_ledgers(this);
	// $('#custom_format').prop('checked', false).trigger('change');
	// default_pdf_format();
	$('#default_pdf_format').val(null).trigger('change');
});

$(document).on('change', '#creditSalesSwitch', function(){
	if($('#voucher_guid').val() == '5'){
		if($('#creditSalesSwitch').is(':checked')){
			$('#receipt_voucher').closest('.form-group').hide();
		} else {
			$('#receipt_voucher').closest('.form-group').show();
		}
	}
});

function getTempTransactionVoucher(obj){
	if(obj.checked == true){
		getTransactionList(obj);
		$(".tempVoucherDiv").css("display","block");
	}else{
		$(".tempVoucherDiv").css("display","none");
	}
}
function getTransactionList(obj)
{
	var siteurl = $(obj).attr('data-siteurl');
	var vouchertype = $("#voucher_guid option:selected").val();
	if(vouchertype ==0){
		errormsg("Select voucher type");
		return;
	}
	var url = siteurl+"site/transcation_settings/get_temp_transaction.php";
	$.ajax({ 
		url: url,
		method:"POST",
		dataType: "json",
		data:{vouchertype:vouchertype},	
			success: function(data){
					var temp_vouchers = data.temp_vouchers;
					var html = "<option value='0'>Select Voucher Number </option>";
					$.each(temp_vouchers, function(i, field) {
						var id = field.id;
						var voucher_number = field.voucher_number;
						html += `<option value="${id}">${voucher_number}</option>`; 
					});
						$('#temp_transaction_number').html(html);
			}   
	});
	return false;
}
function showKOTDiv(){
	$('#kot_div').show();
}
function showPOSCheckbox(type = 'show'){
	if( type == 'hide') $('.showposcheckbox').hide();
	else  $('.showposcheckbox').css('display','flex');
}
function showComplimentButton(type = 'show',voucher = 17){
	
	if( type == 'hide') {
		$('#showComplimentButton').addClass('hidden');
		$('#showSvcButton').addClass('hidden');
	}
	else  {
		if(voucher == 17){
			 $('#dbn_gl_label').html('Compliment Ledger');
			 $('#showComplimentButton').removeClass('hidden');
			$('#showSvcButton').removeClass('hidden');
		}
		if(voucher == 13) {
			$('#dbn_gl_label').html('DBN Ledger');
			$('#showComplimentButton').removeClass('hidden');
		}
		
	}
}
function showPOSSalesReturnDiv(type = 'show'){
	if( type == 'hide') $('#sales_return_voucher_div').hide();
	else  $('#sales_return_voucher_div').css('display','block');
}
function showProcessPOtoGRN(type=''){
	if( type == 'hide') $('.process_po_voucher_div').hide();
	else	 $('.process_po_voucher_div').css('display','block');   
}
function showProcessPRtoPO(type=''){
	if( type == 'hide') $('.process_pr_voucher_div').hide();
	else	 $('.process_pr_voucher_div').css('display','block');   
}
function showProcessPurchaseDiv(type = 'show'){
	if( type == 'hide'){
		 $('#process_purchase_voucher_div').hide();
		 $('#process_purchase_voucher_div2').hide();

	}
	else{
		  $('#process_purchase_voucher_div').css('display','block');
		  $('#process_purchase_voucher_div2').css('display','block');
	}
}
function showOutletDiv(type = 'show'){
	if( type == 'hide') $('#outlet_div').hide();
	else  $('#outlet_div').css('display','block');
}
function showKotVoucherDiv(type = 'show'){
	if( type == 'hide') $('#kot_voucher_div').hide();
	else  $('#kot_voucher_div').css('display','block');
}
function showSalesDetailsCheckbox(type = 'show'){
	if( type == 'hide') $('#showSalesDetailsCheckbox').hide();
	else  $('#showSalesDetailsCheckbox').css('display','flex');
}
function  showStockTransferCheckbox(type = 'show'){
	if( type == 'hide') $('#showStockTransferCheckbox').hide();
	else  $('#showStockTransferCheckbox').css('display','flex');
}
function showRecurringCheckBox(type = 'show')
{
	if(type == 'hide')
	{
		 $('#recurringDiv').css('display','none');
	}
	else
	{
		$('#recurringDiv').css('display','flex');
	}
}
function  show_change_store_during_txn(type = 'show'){
	if( type == 'hide') $('#show_change_store_during_txn').hide();
	else  $('#show_change_store_during_txn').css('display','flex');
}
function  show_only_manufacture_item(type = 'show'){
	if( type == 'hide') $('#show_only_manufacture_item').hide();
	else  $('#show_only_manufacture_item').css('display','flex');
}
function  show_manufacture_on_sales(type = 'show'){
	if( type == 'hide') {
		$('#show_manufacture_on_sales').hide();
	}
	else  {
		$('#show_manufacture_on_sales').css('display','flex');
		
	}
}
$(document).on('click','#customSwitches_p212',function(){
	if(this.checked == true) {
		$('#sales_voucher_list').removeClass('hidden');
		$('#productionStore').css('filter','blur(1px)');
	}
	else {
		$('#sales_voucher_list').addClass('hidden');
		$('#productionStore').css('filter','blur(0px)');
	}
})

function showCreditSalesCheckbox(type = 'show', voucher=5){
	if( type == 'hide') $('#showCreditSalesCheckbox').hide();
	else  $('#showCreditSalesCheckbox').css('display','flex');
	if(voucher == '5') $('#dual_name').html('Sales ');
	if(voucher == '12') {
		$('#dual_name').html('Purchase ');
		$('#creditSalesSwitch').prop('checked',true);
	}else $('#creditSalesSwitch').prop('checked',false);

}
function showAutoDeliveredCheckbox(type = 'show'){
	if( type == 'hide') $('#showAutoDeliveredCheckbox').hide();
	else  $('#showAutoDeliveredCheckbox').css('display','flex');
}
function showVoucherCoatingCheckbox(type= 'show'){
		if( type == 'hide') $('#showVoucherCoatingCheckbox').hide();
	else  $('#showVoucherCoatingCheckbox').css('display','flex');
}
function showLedgerOnInvoice(type = 'show'){
	if( type == 'hide') $('#showLedgerOnInvoice').hide();
	else  $('#showLedgerOnInvoice').css('display','block');
}
function showCashLedger(type = 'show'){
	if( type == 'hide') $('.cash_gl_div').hide();
	else  $('.cash_gl_div').css('display','block');
}
// function showLedgerOnInvoice2(type = 'show'){
// 	if( type == 'hide') $('#showLedgerOnInvoice2').hide();
// 	else {
// 		$('#showLedgerOnInvoice2').css('display','block');
// 	} 
// }
// function showDefaultDelivered(type = 'show'){
// 	if( type == 'hide') $('#showDefaultDelivered').hide();
// 	else {
// 		$('#showDefaultDelivered').css('display','block');
// 	} 
// }
function showLedgerOnInvoice3(type = 'show'){
	if( type == 'hide') $('#showLedgerOnInvoice3').hide();
	else {
		$('#showLedgerOnInvoice3').css('display','block');
	} 
}
function showIsJobCardSetting(type = 'show'){
	if( type == 'hide') $('#showIsJobCardSetting').hide();
	else  $('#showIsJobCardSetting').css('display','flex');
}
function showIsPullQtyCostSetting(type = 'show'){
	if( type == 'hide') $('#showIsPullQtyCostSetting').hide();
	else  $('#showIsPullQtyCostSetting').css('display','flex');
}
function showWholeSales(type = 'show'){
	if( type == 'hide') $('#showWholeSales').hide();
	else  $('#showWholeSales').css('display','flex');
}
function showContract(type = 'show'){
	if( type == 'hide') $('#showContractSalesOrder').hide();
	else  $('#showContractSalesOrder').css('display','flex');
}
function showMargin(type = 'show'){
	if( type == 'hide') $('#showMargin').hide();
	else  $('#showMargin').css('display','flex');
}
function showCrLmtCheckSOCheckbox(type = 'show'){
	if( type == 'hide') $('#showCrLmtCheckSOCheckbox').hide();
	else  $('#showCrLmtCheckSOCheckbox').css('display','flex');
}
function showCrLmtCheckDNCheckbox(type = 'show'){
	if( type == 'hide') $('#showCrLmtCheckDNCheckbox').hide();
	else  $('#showCrLmtCheckDNCheckbox').css('display','flex');
}

function ShowAutoDeliveryNoteVoucher(obj){
	if($(obj).is(':checked')){
		$('#auto_deliverynote_voucher').closest('.form-group').show();
	} else {
		$('#auto_deliverynote_voucher').closest('.form-group').hide();
	}
}
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
	// default_pdf_format();

	$('.journal_debit_ledgers').multiselect({
		buttonWidth: '100%',
		enableFiltering: true,
		dropRight: true,
		maxHeight: 200,
		buttonText: function(options, select) {
			if(options.length === 0) {
				return 'Select Ledger';
			} else if(options.length > 2) {
				return 'Multiple Ledger Selected';
			} else {
				var labels = [];
				options.each(function () {
					if($(this).attr('label') !== undefined) {
						labels.push($(this).attr('label'));
					} else {
						labels.push($(this).html());
					}
				});
				return labels.join(', ') + '';
			}
		}
	});
	$('.journal_debit_ledgers').hide();

	$('.product_groups').multiselect({
		buttonWidth: '100%',
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		dropRight: true,
		maxHeight: 200,
		buttonText: function(options, select) {
			if(options.length === 0) {
				return 'Select Product Group';
			} else if(options.length > 2) {
				return 'Multiple Groups Selected';
			} else {
				var labels = [];
				options.each(function () {
					if($(this).attr('label') !== undefined) {
						labels.push($(this).attr('label'));
					} else {
						labels.push($(this).html());
					}
				});
				return labels.join(', ') + '';
			}
		}
	});
	$('.product_groups').hide();
});

// function default_pdf_format(){
// 	var voucher_guid = $('#voucher_guid').val();
// 	if(voucher_guid == 0) return;

// 	$.each($('#default_pdf_format option'), function(i,e){
// 		if(i == 0) return;

// 		var vouchers = String($(e).data('vouchers')).split(',');
// 		if($.inArray(voucher_guid, vouchers) !== -1){
// 			$(e).show();
// 		} else {
// 			$(e).hide();
// 		}
// 	});
// }

function erp_get_default_ledgers(obj){
	$('.ledgerdata').val('');
	$('.hledgerdata').val('');
	var vouchertype = $("#voucher_guid option:selected").attr("data-type");
	if(vouchertype ==0){
		errormsg("Select voucher type");
		return;
	}
	var type = 1;
	var guid = $(obj).val();
	var siteurl = $(obj).attr('data-siteurl');
	var currentinput = $(obj).attr('id');
	var url = siteurl+"site/transcation_settings/ledger/get_data.php";
	$.ajax({ 
		url: url,
		method:"POST",
		dataType: "json",
		data:{vouchertype:vouchertype,type:type,get_all:1,guid:guid},	
			success: function(data){
				//credt Ledger
				const ids = [];
				const titles = [];
				const m_titles = [];
				// if( guid == 6  || guid == 13){
				// 	var creditLedger = data.debitLedger;
				// 	var debitLedger = data.creditLedger;
				// }else{
					var creditLedger = data.creditLedger;
					var debitLedger = data.debitLedger;
				// }
				$.each(creditLedger, function(i, field) {
					var is_ledger = parseInt(field.is_ledger);
					if(!is_ledger){
						// ids[i] = field.id;
						// titles[i] = field.title;
						//ids.push(field.id);
						titles.push(field.title);
					}
					ids.push(field.id);
					m_titles.push(field.title);
					
				});
				$('#hidden_credit_ledgers').val(ids.join(','));
				$('#credit_ledgers').val(titles.join(','));
				$('#credit_ledgers').attr('data-actualid',guid);
				$('#m_credit_ledgers').attr('data-actualid',guid);
				$('#m_credit_ledgers').val(m_titles.join(','));
				//debit ledger
				const debitids = [];
				const debittitles = [];
				const m_debittitles = [];
			
				$.each(debitLedger, function(i, field) {
					var is_ledger = parseInt(field.is_ledger);
					if(!is_ledger){
						// debitids[i] = field.id;
						// debittitles[i] = field.title;
						//debitids.push(field.id);
						debittitles.push(field.title);
					}
					debitids.push(field.id);
					m_debittitles.push(field.title);
				});
				$('#hidden_debit_ledgers').val(debitids.join(','));
				$('#debit_ledgers').val(debittitles.join(','));
				$('#debit_ledgers').attr('data-actualid',guid);
				$('#m_debit_ledgers').val(m_debittitles.join(','));
				$('#m_debit_ledgers').attr('data-actualid',guid);
				//vat ledger
				const vatids = [];
				const vattitles = [];
				const m_vattitles = [];
				var vatLedger = data.vatLedger;
				$.each(vatLedger, function(i, field) {
					var is_ledger = parseInt(field.is_ledger);
					if(is_ledger){
						// vatids[i] = field.id;
						// vattitles[i] = field.title;
						//vatids.push(field.id);
						vattitles.push(field.title);
					}
					vatids.push(field.id);
					m_vattitles.push(field.title);
				});
				$('#hidden_vat_ledgers').val(vatids.join(','));
				$('#vat_ledgers').val(vattitles.join(','));
				$('#m_vat_ledgers').val(m_vattitles.join(','));
				//other ledger
				/*
					const otherids = [];
					const othertitles = [];
					var otherLedger = data.otherLedger;
					$.each(otherLedger, function(i, field) {
						otherids[i] = field.id;
						othertitles[i] = field.title;
					});
					$('#hidden_other_ledgers').val(otherids.join(','));
					$('#other_ledgers').val(othertitles.join(','));
				*/
				console.log(vouchertype);
				if( guid == 4 )	defaultSalesLedgerOptions(creditLedger,1);
				if( guid == 5 )	defaultSalesLedgerOptions(creditLedger,1);
				if( guid == 6 )	defaultSalesLedgerOptions(debitLedger,1);
				if( guid == 7 )	defaultSalesLedgerOptions(creditLedger,1);
				if( guid == 17 )	defaultSalesLedgerOptions(creditLedger,1);
				if( guid == 18 )	defaultSalesLedgerOptions(creditLedger,1);
				if( guid == 12 )defaultSalesLedgerOptions(debitLedger,2);
				if( guid == 11 )defaultSalesLedgerOptions(debitLedger,2);
				if( guid == 9 )defaultSalesLedgerOptions(debitLedger,2);
				if( guid == 10 )defaultSalesLedgerOptions(debitLedger,2);
				if( guid == 13 )defaultSalesLedgerOptions(creditLedger,2);
				if( guid == 28 )defaultSalesLedgerOptions(creditLedger,2);
				
			}   
	});
	return false;
}

function defaultSalesLedgerOptions(creditLedger,type=1){
	var html =``;
	// console.log(creditLedger);
	$.each(creditLedger, function(i, field) {
		var id = field.id;
		var title = field.title;
		var is_ledger = field.is_ledger;
		if(is_ledger == 1) html += `<option value="${id}">${title}</option>`; 
	});
	// console.log(html);
	if(type == 1) $('#default_sales_ledger').html(html);
	if(type == 2) {
		$('#default_purchase_ledger').html(html);
	}
}


// $('#myModal').on('change', '#custom_format', function(e){
// 	var vouchers_available = [2,4,5];
// 	var voucher_id = parseInt($('#voucher_guid').val());

// 	if($(this).is(':checked')){
// 		if($.inArray(voucher_id, vouchers_available) == -1){
// 			errormsg('Custom format not available for the selected voucher type');
// 			$('#custom_format').prop('checked', false);
// 			return false;
// 		}
// 	    $('.print_settings_wrapper').show();
// 		$('.print_settings_wrapper .voucher-group').hide();
// 		$('.print_settings_wrapper .voucher-group.'+voucher_id).show();
// 	} else {
//     	$('.print_settings_wrapper').hide();
// 	}
// });

// $('#myModal').on('change', '#papersize', function(e){
// 	var papersize = $(this).val();
// 	var width = $(this).find('option:selected').data('width');
// 	var height = $(this).find('option:selected').data('height');
// 	$('#paper_dimension').html('Size : ' + width + ' x ' + height + '(mm)');
// });

// $(document).on('shown.bs.modal','#myModal', function() {
// 	$('#myModal').find('#papersize').trigger('change');
// })

// $('#myModal').on('click', '.switch_content_type', function(e){
// 	var type = $(this).data('type');
// 	if(type == 'text'){
// 		$(this).closest('.wrapper').find('textarea').val('').hide();
// 		$(this).closest('.wrapper').find('input').show();
// 		$(this).closest('.wrapper').find('.content_type').val('image');
// 		$(this).data('type', 'image');
// 		$(this).text('Insert text');
// 	} else {
// 		$(this).closest('.wrapper').find('textarea').show();
// 		$(this).closest('.wrapper').find('input').val('').hide();
// 		$(this).closest('.wrapper').find('.content_type').val('text');
// 		$(this).closest('.wrapper').find('img').hide();
// 		$(this).data('type', 'text');
// 		$(this).text('Insert image');
// 	}
// });





function get_remote_vouchers(obj){
	var branch = $(obj).find('option:selected').val();
	var db_name = $(obj).find('option:selected').attr('data-db');
	var siteurl = atob($(obj).attr('data-siteurl'));
	// var currentinput = $(obj).attr('id');
	// var url = siteurl+"site/transcation_settings/ledger/get_data.php";
	$.ajax({ 
		url: siteurl,
		method:"POST",
		dataType: "json",
		data:{branch:branch},	
			success: function(data){
				if(data.saveStatus == '1'){
					$('#remote_vouchers').html(data.options);
					$('#remote_customers').html(data.customer_options);
					$('#remote_vendors').html(data.vendor_options);
					$('#remote_users').html(data.user_options);
				}else{
					$('#remote_vouchers').html('');
					$('#remote_customers').html('');
					$('#remote_vendors').html('');
					$('#remote_users').html('');
					errormsg(data.msg);
				}
			}
		});
}

function changeItemControl(obj){
	if(obj.checked == true){
		$('.item-control-div').css('display','flex');
	}else{
		$('.item-control-div').css('display','none');
	}
}

function erp_new_voucher_ref(obj){
	var open = $(obj).data('open');
	
	$('#trn_ref_id').val('0');
	$('#date_qutref').val('');
	$('#prefix').val('');
	$('#suffix').val('');
	$('#start_num').val('').removeAttr('readonly');
	$('#total_digit').val('');
	$('#result').val('');
	$('#prefilwithzero').val('yes').trigger('change');
	$('#revision_prefix').val('');

	if(open == '0'){
		$('#new_trn_ref').val('1');
		$('.new_voucher_ref').removeClass('dis-none');
		$(obj).data('open','1').text('Cancel');
	} else {
		$('#new_trn_ref').val('0');
		$('.new_voucher_ref').addClass('dis-none');
		$(obj).data('open','0').text('New Voucher Ref');
	}
}

function erp_edit_voucher_ref(obj){
	var id = $(obj).data('id');
	var date = $(obj).data('date');
	var prefix = $(obj).data('prefix');
	var suffix = $(obj).data('suffix');
	var start_num = $(obj).data('start_num');
	var total_digit = $(obj).data('total_digit');
	var result = $(obj).data('result');
	var prefilwithzero = $(obj).data('prefilwithzero');
	var revision_prefix = $(obj).data('revision-prefix');

	$('#trn_ref_id').val(id);
	$('#date_qutref').val(date);
	$('#prefix').val(prefix);
	$('#suffix').val(suffix);
	$('#start_num').val(start_num).attr('readonly','true');
	$('#total_digit').val(total_digit);
	$('#prefilwithzero').val(prefilwithzero).trigger('change');
	$('#result').val(result);
	$('#revision_prefix').val(revision_prefix);

	$('.new_voucher_ref').removeClass('dis-none');
}

// function erp_get_accounts_group(){
// 	var status = $('#compliment-gl').attr('data-status');
// 	var selected = $('#compliment-gl').attr('data-selected');
// 	var arr_selected = (selected) ? selected.split(',') : '';
// 	if(status==1){
// 	//		return;
// 	}
// 	var siteurl = $('#siteurl').val();
// 	var url = siteurl+"site/products/account_group/get_data.php";
// 	$('#compliment-gl option:not(:first)').remove();
// 	var type = 'service';
// 	$.ajax({ 
// 		url: url,
// 		method:"POST",
// 		dataType: "json",
// 		data:{type:type},	
// 		success: function(data)   {
// 			var html = "";
// 			$.each(data, function(i, field) {
// 				if(i == 0)
// 				{
// 					var option = '<option value="0" selected>Select Ledger</option>';
// 					$("#compliment-gl").append(option);
// 				}
// 				var name = field.name;
// 				var code = field.code;
// 				var id = field.id;
// 				var is_ledger = field.is_ledger;
// 				var parent_guid =  field.parent_guid;
// 				var main_guid =  field.main_guid;
// 				var disabled= '';
// 				var Optionclass="";
// 				if(is_ledger != 1){
// 					// disabled = 'disabled'; // later we make it enabled
// 				}
// 				if(is_ledger == 1)
// 				{
// 					Optionclass="class='red' data-color='red'";
// 				}
// 				else if(main_guid == 1)
// 				{
// 					Optionclass="class='blue' data-color='blue'";
// 				}
// 				else
// 				{
// 					Optionclass="class='grey' data-color='grey'";
// 				}
// 				var main_guid = field.main_guid;

// 				if(arr_selected.includes(id)){
// 					var option = '<option '+disabled+' '+Optionclass+' data-name="'+name+'" data-ledger="'+is_ledger+'" value="'+id+'" selected>'+name+' ('+code+')</option>';
// 				}else{
// 					var option = '<option '+disabled+' '+Optionclass+' data-name="'+name+'" data-ledger="'+is_ledger+'" value="'+id+'" >'+name+' ('+code+')</option>';
// 				}
// 				$("#compliment-gl").append(option);

// 			});	
// 			$('#compliment-gl').attr('data-status',1);
// 		}   
// 	});
// }
function erp_get_accounts_group(element,       type = 0) {
    var status = element.attr('data-status');
    var selected = element.attr('data-selected');
    var arr_selected = (selected) ? selected.split(',') : [];
    if (status == 1 && type == 0) return;

    var siteurl = $('#siteurl').val();
    var url = siteurl + "site/products/account_group/get_data.php";
    element.find('option:not(:first)').remove();
    // var type = 'service';
	 var optionHTML = '';
    $.ajax({
        url: url,
        method: "POST",
        dataType: "json",
		async: (type == 1 ? false : true), // ✅ sync only for return case
        data: { type: 'service' },
        success: function(data) {
            optionHTML += '<option value="0">Select Ledger</option>';
            $.each(data, function(i, field) {
                var optionClass = (field.is_ledger == 1) ? 'red' : (field.main_guid == 1) ? 'blue' : 'grey';
				var disbaledClasss = (field.is_ledger == 0 || field.main_guid == 1 ) ? 'disabled' : '';
                var selectedAttr = arr_selected.includes(field.id) ? 'selected' : '';
                // var option = `<option data-color="${optionClass}" ${disbaledClasss} value="${field.id}" data-name="${field.name}" data-ledger="${field.is_ledger}" ${selectedAttr}>
                //                 ${field.name} (${field.code})
                //               </option>`;
                // element.append(option);
				  optionHTML += `
                    <option data-color="${optionClass}" ${disbaledClasss}
                        value="${field.id}"
                        data-name="${field.name}"
                        data-ledger="${field.is_ledger}"
                        ${selectedAttr}>
                        ${field.name} (${field.code})
                    </option>`;
            });
            if (type == 0) {
                element.find('option:not(:first)').remove();
                element.append(optionHTML);
                element.attr('data-status', 1);
            }
        }
    });
	 if (type == 1) {
        return optionHTML;
    }
}



$(document).ready(function () {
	if($('.select2-item').length) erp_get_nt_items();
});
$(document).on('shown.bs.modal', '#myModal', function () {
	setTimeout ( () => { if($('.select2-item').length) erp_get_nt_items(); } ,200);
});
function erp_get_nt_items(){
	// var searchUrl = atob($('#search-the-gl').val());
	var siteurl = $('#siteurl').val();
	var searchUrl = siteurl+"pos/ajax/search-item.php";
	   $("select.select2-item").select2({
		  placeholder: 'Search for NT Item',
		  minimumInputLength: 2,
		 ajax: {
			url: function(params) {
                // 'this' refers to the select element within this context
                var selectedValue = $(this).data('selected');
                return searchUrl + '?selected=' + selectedValue;
            },
			 dataType: 'json',
			 delay: 250,
			 data: function (params) {
				 return {
					 q: params.term, // search term
					 page: params.page,
					 only_nt:1,
				 };
			 },
			 processResults: function (data, params) {
				 params.page = params.page || 1;
				 return {
					 results: data.items,
					 pagination: {
						 more: (params.page * 10) < data.total_count 
					 }
				 };
			 },
			 cache: true,
			 
		 },
		   templateResult: function(data) {
			 // Check if data has data-color attribute
			 if ($(data.element).data('color')) {
				return $('<span class="' + $(data.element).data('color') + '-color">' + $(data.element).text() + '</span>');
			 }
			 return data.text;
			 },
			 templateResult: formatResult, // Function to format the results
		 templateSelection: formatSelection // Function to format the selection
		});
	
}

$(document).on('click', '.addplRow', function() {
    var newRow = $('#dynamicplTable tbody tr:first').clone();
    newRow.find('select').val('').removeAttr('data-status').removeAttr('data-selected').removeClass('hidden');
	newRow.find('select.ledger').addClass('compliment-gl').attr('name', 'pur_ledgr[]');
	newRow.find('select.cgroup-demo').addClass('cgroup').attr('name','sup_grp[]');
    newRow.find('.addplRow').removeClass('addplRow').addClass('removeplRow').text('–');
    $('#dynamicplTable tbody').append(newRow);

    // Initialize Select2 for new elements
    newRow.find('.compliment-gl').select2({
		templateResult: function(data) {
			// Check if data has data-color attribute
			if ($(data.element).data('color')) {
				return $('<span class="' + $(data.element).data('color') + '-color">' + $(data.element).text() + '</span>');
			}
			return data.text;
			},
			templateSelection: function(data) {
			// Check if data has data-color attribute
			if ($(data.element).data('color')) {
				return $('<span class="' + $(data.element).data('color') + '-color">' + $(data.element).text() + '</span>');
			}
			return data.text;
			}
	});
	newRow.find('.cgroup').select2({
		templateResult: function(data) {
			// Check if data has data-color attribute
			if ($(data.element).data('color')) {
				return $('<span class="' + $(data.element).data('color') + '-color">' + $(data.element).text() + '</span>');
			}
			return data.text;
			},
			templateSelection: function(data) {
			// Check if data has data-color attribute
			if ($(data.element).data('color')) {
				return $('<span class="' + $(data.element).data('color') + '-color">' + $(data.element).text() + '</span>');
			}
			return data.text;
			}
	});

    // Fetch data for the new select
    newRow.find('.compliment-gl').each(function() {
        erp_get_accounts_group($(this));
    });
});

// Remove row functionality
$(document).on('click', '.removeplRow', function() {
    $(this).closest('tr').remove();
});


$('body').on('change', '.ptype-select', function(){
	$container = $(this).closest('.dropdown');
	var total_selected = $container.find('input[type="checkbox"]:checked').length;
	var text = 'Select Project Type';
	if(total_selected == 1){
		text = $container.find('input[type="checkbox"]:checked').closest('.checkbox-group').find('label').text();
	} else if(total_selected > 1){
		text = `${total_selected} Selected`;
	}
	$container.find('.button-text').html(text);
});
$(document).on('change','#outlet_guid', function () {
    let outlet_guid = $(this).find('option:selected').val();
					 $('#kot_voucher').html('');

    if (outlet_guid) {
		var site = $('#siteurl').val();
		var url  = site + 'site/transcation_settings/ajax/fnb.php';
        $.get(url, { outlet_guid: outlet_guid }, function (response) {
             $.each(response, function (index, item) {
                $('#kot_voucher').append(
                    $('<option>', {
                        value: item.id,
                        text: item.title
                    })
                );
            });
        },'json');
    }
});
$(document).on('change', '#kotCustomSwitches2',function () {
    if ($(this).is(':checked')) {
        $('#kot_voucher').closest('div').hide();
    } else {
        $('#kot_voucher').closest('div').show();
    }
});

$(document).on('change', 'select[name="stocktransfer_type"], input[name="project_stock_consumption"]', function(){
	var stocktransfer_type = $('select[name="stocktransfer_type"]').val();
	var project_stock_consumption = $('input[name="project_stock_consumption"]').is(':checked');

	$('#showProjectStockConsumptionSwitch').css('display','none');
	$('select[name="transit_store_guid"]').closest('.form-group').css('display','none');
	$('[name="def_accept_stocktransfer"]').closest('.form-group').addClass('dis-none');
	$('select[name="journal_voucher"]').closest('.form-group').css('display','none');
	$('select[name="journal_credit_ledger"]').closest('.form-group').css('display','none');
	$('select[name="journal_debit_ledger_group"]').closest('.form-group').css('display','none');
	$('select[name="journal_debit_ledgers[]"]').closest('.form-group').css('display','none');
	$('select[name="journal_admin_oh_ledger"]').closest('.form-group').css('display','none');
	$('select[name="journal_factory_oh_ledger"]').closest('.form-group').css('display','none');
	$('select[name="journal_other_oh_ledger"]').closest('.form-group').css('display','none');
	// $('select[name="journal_debit_ledger"]').closest('.form-group').css('display','none');

	if(stocktransfer_type == 0){
		$('select[name="transit_store_guid"]').closest('.form-group').css('display','block');
		$('[name="def_accept_stocktransfer"]').closest('.form-group').removeClass('dis-none');
	}
	else if(stocktransfer_type == 2){
		$('select[name="journal_voucher"]').closest('.form-group').css('display','block');
		$('select[name="journal_credit_ledger"]').closest('.form-group').css('display','block');
		$('select[name="journal_debit_ledgers[]"]').closest('.form-group').css('display','block');
	}
	else if(stocktransfer_type == 4){
		$('#showProjectStockConsumptionSwitch').css('display','flex');
		$('select[name="journal_voucher"]').closest('.form-group').css('display','block');
		$('select[name="journal_credit_ledger"]').closest('.form-group').css('display','block');

		if(project_stock_consumption){
			$('select[name="journal_debit_ledger_group"]').closest('.form-group').css('display','block');
			$('select[name="journal_admin_oh_ledger"]').closest('.form-group').css('display','block');
			$('select[name="journal_factory_oh_ledger"]').closest('.form-group').css('display','block');
			$('select[name="journal_other_oh_ledger"]').closest('.form-group').css('display','block');
		} else {
			$('select[name="journal_debit_ledgers[]"]').closest('.form-group').css('display','block');
		}
	}
})

$(document).on('change', 'input[name="project_physicalstock"]', function(){
	var project_physicalstock = $('input[name="project_physicalstock"]').is(':checked');

	$('select[name="journal_debit_ledger_group"]').closest('.form-group').css('display','none');
	$('select[name="journal_debit_ledgers[]"]').closest('.form-group').css('display','none');
	$('select[name="journal_admin_oh_ledger"]').closest('.form-group').css('display','none');
	$('select[name="journal_factory_oh_ledger"]').closest('.form-group').css('display','none');
	$('select[name="journal_other_oh_ledger"]').closest('.form-group').css('display','none');

	if(project_physicalstock){
		$('select[name="journal_debit_ledger_group"]').closest('.form-group').css('display','block');
		$('select[name="journal_admin_oh_ledger"]').closest('.form-group').css('display','block');
		$('select[name="journal_factory_oh_ledger"]').closest('.form-group').css('display','block');
		$('select[name="journal_other_oh_ledger"]').closest('.form-group').css('display','block');
	} else {
		$('select[name="journal_debit_ledgers[]"]').closest('.form-group').css('display','block');
	}
})

$(document).on('shown.bs.modal', '#myModal', function(){
	$('#default_pdf_format').select2({
		width: '100%',
		multiple: false,
		closeOnSelect: true,
		minimumResultsForSearch: Infinity,
		ajax: {
			url: site_url + 'site/transcation_settings/ajax/get_pdf_formats.php',
			dataType: 'json',
			delay: 100,
			data: function(params){
				$form = $(this).closest('form');

				var settings = {};
				settings['voucher_guid'] = $form.find('[name="voucher_guid"]').val();
				settings['is_job_card'] = $form.find('[name="is_job_card"]').is(':checked') ? 1 : 0;
				settings['coating_voucher'] = $form.find('[name="coating_voucher"]').is(':checked') ? 1 : 0;

				return { settings:settings, search:params.term, page:params.page || 1 };
			},
			processResults: function(data, params){
				params.page = params.page || 1;
				return {
					results: $.map(data.formats, function(url, key){
						return { id:key, text:'Format '+ key };
					})
				};
			},
			cache: true
		},
		placeholder: 'Search',
		minimumInputLength: 0,
		allowClear: true
	});
});

function voucher_sorting_form(){
    var url = 'site/transcation_settings/ajax/voucher_sorting_form.php';
	var modal = erp_create_modal(url, { }, { width:50, height:'60vh', title:'Set Voucher Order' });
    var $modal = $('#'+ modal);

    $modal.find('.voucher-type').on('change', function(){
		$('#pageLoader').show();
		var voucher_type = $(this).val();
		$modal.find('.voucher-list').html('');

        var url = site_url + 'site/transcation_settings/ajax/get_vouchers_by_type.php';
        $.ajaxSetup({ async:true });
        $.post(url, { voucher_type:voucher_type }, function(res){
            $('#pageLoader').hide();
			if(!res.vouchers.length) return;

			$modal.find('.voucher-list').append(`<div class="text-danger mb-2"><i>* Drag and rearrage to order the vouchers</i></div>`);
			$.each(res.vouchers, function(i, v){
				$html = `<div>
						 	<span class="number" style="display:inline-block;">${i+1}</span>
							<span style="display:inline-block; width:80%; padding:6px 8px; margin-bottom:4px; margin-left:4px; border:1px solid #ced4da; border-radius:.2rem; cursor:pointer;">
								<i class="fas fa-arrows-alt-v"></i>
								<span class="ml-2">${v.title}</span>
								<input type="hidden" name="voucher_ids[]" value="${v.id}">
							</span>
						 </div>`;
				$modal.find('.voucher-list').append($html);
			});

			$modal.find('.voucher-list').sortable({
				update: function(event, ui){
					var sl_no = 1;
					const order = $(".voucher-list .number").map(function() {
						$(this).text(sl_no);
						sl_no++;
					}).get();
				}
			});

			$modal.find('.voucher-list').disableSelection();
        });
	});

    $modal.find('.saveBtn').on('click', function(){
		$('#pageLoader').show();
        var $form = $(this).closest('form');
        var formData = $form.serialize();

        var url = site_url + 'site/transcation_settings/ajax/voucher_sorting_save.php';
        $.ajaxSetup({ async:true });
        $.post(url, formData, function(res){
            $('#pageLoader').hide();
            if(res.status == 1){
                toastr.success(res.msg);
                $modal.modal('hide');
            } else {
                toastr.error(res.msg);
            }
        });
	});
}