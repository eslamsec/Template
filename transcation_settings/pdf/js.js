function toggle_pdf_form(obj){
    var voucher_type = $(obj).data('voucher-type');
	if($(obj).is(':checked')){
	    $('.print_settings_wrapper').show();
		$('.print_settings_wrapper .voucher-group').hide();
		$('.print_settings_wrapper .voucher-group.'+voucher_type).show();
	} else {
    	$('.print_settings_wrapper').hide();
	}
}

function pdf_show_paper_dimension(){
	var width = $('#papersize').find('option:selected').data('width');
	var height = $('#papersize').find('option:selected').data('height');
	$('#paper_dimension').html('Size : ' + width + ' x ' + height + '(mm)');
}

function pdf_add_column(obj){
	var pos = $(obj).data('pos');
	var action_menu = pdf_get_action_menu();

	var now = Date.now();
	var content = `<td data-col-id="${now}">${action_menu}</td>`;

	if(pos == 'left'){
		$(content).insertBefore($(obj).closest('td'));
	} else if(pos == 'right'){
		$(content).insertAfter($(obj).closest('td'));
	}
}

function pdf_add_row(obj){
	var pos = $(obj).data('pos');
	var action_menu = pdf_get_action_menu();

	var now = Date.now();
	var content = `<table><tr><td data-col-id="${now}">${action_menu}</td></tr></table>`;

	if(pos == 'up'){
		$(content).insertBefore($(obj).closest('table'));
	} else if(pos == 'down'){
		$(content).insertAfter($(obj).closest('table'));
	}
}

function pdf_delete_column(obj){
	var cols = $(obj).closest('td').siblings().length;
	if(cols == 0){
		// if($(obj).closest('.pdf-section').children('table').length > 0){}
		$(obj).closest('table').remove();
	} else {
		$(obj).closest('td').remove();
	}
}

function pdf_content_modal(obj){
	content_form_reset();
	$td = $(obj).closest('td');
	var td_content_type = $(obj).closest('td').data('content-type') || 'text';
	var td_content = $(obj).closest('.action-btn-wrapper').next().clone();
	$('#myModal').modal('show');
	$('#myModal').find('.content_type').val(td_content_type).trigger('change');
	if(td_content.length){
		$('#myModal').find('.content-type-wrapper.'+td_content_type).find('.content').html(td_content);
	}

	// var width = parseFloat($td.prop('width'));
	// var align = $td.prop('align');
	// var fontsize = parseFloat($td.css('font-size'));
	// var fontweight = $td.css('font-weight');
	// var color = $td.css('color');
	// var border_top = $td.closest('table').css('border-top');
	// var border_bottom = $td.closest('table').css('border-bottom');
	// var margin_top = $td.closest('table').css('margin-top');
	// var margin_bottom = $td.closest('table').css('margin-bottom');
	// var align_col_2 = $td.find('table tr td:nth-child(2)').prop('align');
	// var imageheight = $td.find('img').prop('height');
	// var imagewidth = $td.find('img').prop('width');
	
	// $('#myModal').find('.width').val(width);
	// $('#myModal').find('.align').val(align);
	// $('#myModal').find('.font-size').val(fontsize);
	// $('#myModal').find('.font-weight').val(fontweight);
	// $('#myModal').find('.color').val(color);
	// $('#myModal').find('.border-top').val(border_top);
	// $('#myModal').find('.border-bottom').val(border_bottom);
	// $('#myModal').find('.margin-top').val(margin_top);
	// $('#myModal').find('.margin-bottom').val(margin_bottom);
	// $('#myModal').find('.align-col-2').val(align_col_2);
	// $('#myModal').find('.image-height').val(imageheight);
	// $('#myModal').find('.image-width').val(imagewidth);

	$('#myModal').off('click').on('click', '.saveBtn', function(e){
		pdf_content_save(obj);
	});
}

function pdf_content_save(obj){
	var content_type = $('#myModal').find('.content_type').val();
	var $content = $('#myModal').find('.content-type-wrapper.'+ content_type).find('.content');
	var $td = $(obj).closest('td');

	switch(content_type){
		case 'text':
			// content = $content.val().replace(/\n/g, '<br/>');
			// content = `<p>${content}</p>`;
			// $content.find('[contenteditable="true"]').html($content.find('[contenteditable="true"]').text());
			$content.find('[contenteditable="true"] span').css('all','unset');
			content = $content.html().trim();
			break;

		case 'field':
			// $content.find('[contenteditable="true"]').html($content.find('[contenteditable="true"]').text());
			$content.find('[contenteditable="true"] span').css('all','unset');
			var align = $('#myModal').find('.align').val();
			var align_col_2 = $('#myModal').find('.align-col-2').val();
			$content.find('tr td:nth-child(1)').prop('align', align);
			$content.find('tr td:nth-child(2)').prop('align', align_col_2);
			content = $content.html().trim();
			break;

		case 'image':
			if($content.get(0).files.length !== 0){
				col_id = $td.data('col-id');
				$clone = $content.clone();
				// $content.after($clone).prop('name', "image[]").addClass(col_id).appendTo('.image_inputs');
				$content.after($clone.val(''));
				$content.prop('name', "image_file[]").attr('data-col-id',col_id).removeClass('content').appendTo('.image_inputs');
				$('<input type="hidden">').val(col_id).prop('name', "image_name[]").attr('data-col-id',col_id).appendTo('.image_inputs');
				src = $('#content-image-preview').attr('src');
				var imageheight = $('#myModal').find('.image-height').val();
				var imagewidth = $('#myModal').find('.image-width').val();
				content = `<img src="${src}" height="${imageheight}" width="${imagewidth}">`;
			}
			break;
	}

	$td.attr('data-content-type', content_type);
	if(typeof(content) !== 'undefined'){
		$td.html(pdf_get_action_menu() + content);
	}
	
	var width = $('#myModal').find('.width').val();
	var align = $('#myModal').find('.align').val();
	var fontsize = $('#myModal').find('.font-size').val() + 'px';
	var fontweight = $('#myModal').find('.font-weight').val();
	var color = $('#myModal').find('.color').val();

	var border_top = $('#myModal').find('.border-top').val();
	var border_bottom = $('#myModal').find('.border-bottom').val();
	var margin_top = $('#myModal').find('.margin-top').val();
	var margin_bottom = $('#myModal').find('.margin-bottom').val();
	var padding = $('#myModal').find('.padding').val();

	$td.prop('width', width+'%');
	$td.prop('align', align);
	$td.css({'font-size':fontsize, 'font-weight':fontweight, 'color':color, 'padding':padding});
	$td.closest('table').css({'border-top':border_top, 'border-bottom':border_bottom, 'margin-top':margin_top, 'margin-bottom':margin_bottom});

	$('#myModal').modal('hide');
}

function pdf_format_content(section){
	var siteurl  = $('#siteurl').val();
	// var transaction_id = $('#transaction_id').val();

	var $el = $('.pdf-'+section);
	var $res = $el.clone();
		$res.find('.action-btn-wrapper').remove();
		// $res.find('img').each(function(i,v){
		// 	var col_id = $(v).closest('td').data('col-id');
		// 	var ext = $('.'+ col_id).val().split('.').pop();
		// 	$(v).prop('src', siteurl + `upload/printsettings/${transaction_id}/${col_id}.${ext}`);
		// });
	$('.image_inputs').find('input[type="file"]').each(function(i,v){
		var col_id = $(v).data('col-id');
		var ext = $('input[type="file"][data-col-id="'+ col_id +'"]:last').val().split('.').pop();
		// var ext = 'png';
		$res.find('td[data-col-id="'+ col_id +'"]').find('img').prop('src', `{{image_upload_url}}${col_id}.${ext}`);
	});

	return $res.html();
}

function pdf_save_settings(obj){
	var siteurl  = $('#siteurl').val();
	// var preview = $(obj).data('preview') || 0;

	// var $header = $('.pdf-header').clone();
	// 	$header.find('.action-btn-wrapper').remove();
	// 	$header.find('img').each(function(i,v){
	// 		var col_id = $(v).closest('td').data('col-id');
	// 		var ext = $('.'+ col_id).val().split('.').pop();
	// 		var transaction_id = $('#transaction_id').val();
	// 		$(v).prop('src', siteurl + `upload/printsettings/${transaction_id}/${col_id}.${ext}`);
	// 	});
	// var header = $header.html();
	// var $content = $('.pdf-content').clone();
	// 	$content.find('.action-btn-wrapper').remove();
	// var content = $content.html();
	// var $footer = $('.pdf-footer').clone();
	// 	$footer.find('.action-btn-wrapper').remove();
	// var footer = $footer.html();

	var header = pdf_format_content('header');
	var body_1 = pdf_format_content('body-1');
	var body_2 = pdf_format_content('body-2');
	var footer_last_page = pdf_format_content('footer-last-page');
	var footer = pdf_format_content('footer');

	// var formData = $(obj).closest('form').serialize();
	// 	formData += '&header='+ header +'&content='+ content +'&footer='+ footer;
	var formData = new FormData($('#form_printsettings')[0]);
	formData.append('header', header);
	formData.append('body_1', body_1);
	formData.append('body_2', body_2);
	formData.append('footer_last_page', footer_last_page);
	formData.append('footer', footer);
	// formData.append('preview', preview);
	// console.log('formData',formData);

	// $.post(siteurl + 'site/transcation_settings/pdf/ajax/save.php', formData , function(res){
	// 	console.log('res',res);
	// 	if(res.saveStatus){
	// 		successmsg(res.msg);
	// 	}
	// });

	$.ajax({
		method: 'POST',
		processData: false,
		contentType: false,
		cache: false,
		data: formData,
		enctype: 'multipart/form-data',
		url: siteurl + 'site/transcation_settings/pdf/ajax/save.php',
		success: function(res){
			if(res.saveStatus){
				location.reload();
			} else {
				errormsg(res.msg);
			}
		}
	});
}

function pdf_change_content_type(obj){
	var type = $(obj).val();
	$('.content-type-wrapper').hide();
	$('.content-type-wrapper.' + type).show();
	$('.content-style').hide();
	$('.content-style.' + type).show();
}

function pdf_toggle_print_cols(obj){
	var key = $(obj).data('key');
	if($(obj).is(':checked')){
		$('.item-table .'+key).show();
	} else {
		$('.item-table .'+key).hide();
	}

}

function pdf_copy_settings(obj){
	$("#confirmModal").find('.btn-success').html('<i class="far fa-copy"></i> Copy');
	confirmDialog("Are you sure ? This will replace existing settings and cannot be undone!", function(){
		var siteurl = $('#siteurl').val();
		var from = $(obj).data('copy-from');
		var to = $(obj).data('copy-to');
		$.ajax({
			type: "POST",
			dataType: "json",
			url: siteurl + 'site/transcation_settings/pdf/ajax/copy.php',
			data: { from:from, to:to }, 
			success: function(response)  {
				if(response.saveStatus == 1){
					location.reload();
			   }else{
					errormsg(response.msg);
			   }
				
			}
		});
	});
}

function content_form_field_add_row(){
	$el = $('.content-type-wrapper.field .content table tbody');
	length = $el.find('tr:first-child()').find('td').length;
	if(length == 2){
		$el.append('<tr><td contenteditable="true"></td><td contenteditable="true"></td></tr>');
	} else {
		$el.append('<tr><td contenteditable="true"></td></tr>');
	}
}

function content_form_field_add_col(obj){
	$el = $('.content-type-wrapper.field .content table tbody tr');
	$.each($el, function(i,e){
		td = '<td contenteditable="true"></td>';
		$(e).append(td);
	});
	$(obj).closest('td').hide();
}

function content_form_image_preview(obj){
	const [file] = $(obj).prop('files');
	if(file){
		$('#content-image-preview').prop('src', URL.createObjectURL(file));
	}
}

function content_form_reset(){
	$form = $('#modalform');
	$form.find('.content-type-wrapper.field').find('.content').find('tr:gt(0)').remove();
	$form.find('.content-type-wrapper.field').find('.content').find('tr td:nth-child(2)').remove();
	$form.find('.content-type-wrapper.field').find('.content').next('td').show();
	$form.find('.content-type-wrapper').find('[contenteditable="true"]').html('');
	$form.find('#content-image-preview').attr('src','');
}

$(document).ready(function(){
	pdf_show_paper_dimension();

	$('.pdf-section > table > tbody > tr > td:not(:has(.action-btn-wrapper))').prepend(pdf_get_action_menu());

	// $('#item-cols').find('tbody').sortable({
	// 	helper	: function(e, tr) {
	// 		tr.clone().children().each(function(index) {
	// 			$(this).width(tr.children().eq(index).width())
	// 		});
	// 		return tr.clone();
	// 	},
	// 	handle	: '.idrag',
	// 	stop	: function(e, ui) {
	// 		$('td.index', ui.item.parent()).each(function (i) {
	// 			$(this).html(i + 1);
	// 		});
	// 	}
	// }).disableSelection();

	// var pdf_sections = ['.pdf-header', '.pdf-content', '.pdf-footer'];
	// $.each(pdf_sections, function(i,v){
	// 	$el = $(v + ' > table tr > td');
	// 	if($el.find('.action-btn-wrapper').length === 0){
	// 		$el.prepend(pdf_get_action_menu());
	// 	 }
	// });
});
