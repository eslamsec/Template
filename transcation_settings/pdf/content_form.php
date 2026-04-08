<?php
	$transaction_id = (int)base64_decode($option[2]);
	$voucher_guid = rowValue($transaction_id, 'erp_transaction_settings', 'voucher_guid');
?>

<div class="row">
	<div class="col-sm-4">
		<div class="row formrow">
			<div class="col-sm-12">
				<label>Content Type</label>
				<select class="form-control form-control-sm content_type" onchange="pdf_change_content_type(this)">
					<option value="text">Text</option>
					<option value="field">List</option>
					<option value="image">Image</option>
				</select>
			</div>
		</div>

		<div class="content-type-wrapper text">
			<div class="row formrow">
				<div class="col-sm-12">
					<label>Text</label>
					<div class="content">
						<p contenteditable="true"></p>
					</div>
				</div>
			</div>
		</div>

		<div class="content-type-wrapper image" style="display:none">
			<div class="row formrow">
				<div class="col-sm-12">
					<input accept="image/*" type="file" class="content" onchange="content_form_image_preview(this)" />
					<img id="content-image-preview" style="height:100px; width:auto; max-width:100%;" />
				</div>
			</div>
		</div>

		<div class="content-type-wrapper field" style="display:none">
			<div class="row formrow">
				<div class="col-sm-12">
					<table>
						<tr>
							<td class="content">
								<table>
									<tbody>
										<tr><td contenteditable="true"></td></tr>
									</tbody>
								</table>
							</td>
							<td rowspan="99" align="center">
								<a class="btn" onclick="content_form_field_add_col(this)"><i class="fa fa-plus-circle"></i></a>
							</td>
						</tr>
						<tr>
							<td>
								<a href="#" onclick="content_form_field_add_row()">Add New Line</a>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-5">
		<div class="row formrow content-style text field image">
			<div class="col-sm-4">
				<label>Column Width (%)</label>
			</div>
			<div class="col-sm-8">
				<input type="number" class="form-control form-control-sm width">
			</div>
		</div>

		<div class="row formrow content-style text field image">
			<div class="col-sm-4">
				<label>Border Top</label>
			</div>
			<div class="col-sm-8">
				<input type="text" class="form-control form-control-sm border-top">
			</div>
		</div>

		<div class="row formrow content-style text field image">
			<div class="col-sm-4">
				<label>Border Bottom</label>
			</div>
			<div class="col-sm-8">
				<input type="text" class="form-control form-control-sm border-bottom">
			</div>
		</div>

		<div class="row formrow content-style text field image">
			<div class="col-sm-4">
				<label>Alignment</label>
			</div>
			<div class="col-sm-8">
				<select class="form-control form-control-sm align">
					<option value="left">Left</option>
					<option value="center">Center</option>
					<option value="right">Right</option>
				</select>
			</div>
		</div>

		<div class="row formrow content-style field">
			<div class="col-sm-4">
				<label>Alignment (Right Col)</label>
			</div>
			<div class="col-sm-8">
				<select class="form-control form-control-sm align-col-2">
					<option value="left">Left</option>
					<option value="center">Center</option>
					<option value="right">Right</option>
				</select>
			</div>
		</div>

		<div class="row formrow content-style text field">
			<div class="col-sm-4">
				<label>Font Size (px)</label>
			</div>
			<div class="col-sm-8">
				<input type="number" class="form-control form-control-sm font-size">
			</div>
		</div>

		<div class="row formrow content-style text field">
			<div class="col-sm-4">
				<label>Font Weight</label>
			</div>
			<div class="col-sm-8">
				<select class="form-control form-control-sm font-weight">
					<option value="normal">Normal</option>
					<option value="bold">Bold</option>
				</select>
			</div>
		</div>

		<!-- <div class="row formrow content-style text field image">
			<div class="col-sm-4">
				<label>Padding Top (mm,px)</label>
			</div>
			<div class="col-sm-8">
				<input type="number" class="form-control form-control-sm padding-top">
			</div>
		</div>

		<div class="row formrow content-style text field image">
			<div class="col-sm-4">
				<label>Padding Bottom (mm,px)</label>
			</div>
			<div class="col-sm-8">
				<input type="number" class="form-control form-control-sm padding-bottom">
			</div>
		</div> -->

		<div class="row formrow content-style text field image">
			<div class="col-sm-4">
				<label>Margin Top (mm,px)</label>
			</div>
			<div class="col-sm-8">
				<input type="text" class="form-control form-control-sm margin-top">
			</div>
		</div>

		<div class="row formrow content-style text field image">
			<div class="col-sm-4">
				<label>Margin Bottom (mm,px)</label>
			</div>
			<div class="col-sm-8">
				<input type="text" class="form-control form-control-sm margin-bottom">
			</div>
		</div>

		<div class="row formrow content-style text field image">
			<div class="col-sm-4">
				<label>Padding</label>
			</div>
			<div class="col-sm-8">
				<input type="text" class="form-control form-control-sm padding">
			</div>
		</div>

		<!-- <div class="row formrow content-style text field">
			<div class="col-sm-4">
				<label>Font Color</label>
			</div>
			<div class="col-sm-8">
				<input type="text" class="form-control form-control-sm color">
			</div>
		</div> -->

		<div class="row formrow content-style image">
			<div class="col-sm-4">
				<label>Image Width (mm, px, %, auto)</label>
			</div>
			<div class="col-sm-8">
				<input type="text" class="form-control form-control-sm image-width">
			</div>
		</div>

		<div class="row formrow content-style image">
			<div class="col-sm-4">
				<label>Image Height (mm, px, %, auto)</label>
			</div>
			<div class="col-sm-8">
				<input type="text" class="form-control form-control-sm image-height">
			</div>
		</div>
	</div>

	<div class="col-sm-3 placeholders">
		<h6>Placeholders</h6>
		<small>Click to copy the placeholder</small>
		<ul>
			<?php foreach(PDFSettings::get_placeholders($voucher_guid) as $ph){
				echo "<li onclick=\"navigator.clipboard.writeText($(this).text()); successmsg('Text copied to clipboard!')\" title='Click to Copy'>$ph</li>";
			} ?>
		</ul>
	</div>
</div>
