<div class="dropdown dropdown action-btn-wrapper hidden">
	<a class="action-btn" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
		<i class="fas fa-ellipsis-v"></i>
	</a>
	<div class="dropdown-menu dropdown-menu-right profile-dropdown">
		<a href="javascript:void(0)" class="dropdown-item" onclick="pdf_content_modal(this)">
			<i class="fas fa-plus-circle"></i> Content
		</a>
		<a href="javascript:void(0)" class="dropdown-item" data-pos="left" onclick="pdf_add_column(this)">
			<i class="fas fa-columns"></i> Add Column Left
		</a>
		<a href="javascript:void(0)" class="dropdown-item" data-pos="right" onclick="pdf_add_column(this)">
			<i class="fas fa-columns"></i> Add Column Right
		</a>
		<a href="javascript:void(0)" class="dropdown-item" data-pos="up" onclick="pdf_add_row(this)">
			<i class="fas fa-arrows-alt-v"></i> Add Section Up
		</a>
		<a href="javascript:void(0)" class="dropdown-item" data-pos="down" onclick="pdf_add_row(this)">
			<i class="fas fa-arrows-alt-v"></i> Add Section Down
		</a>
		<a href="javascript:void(0)" class="dropdown-item" onclick="pdf_delete_column(this)">
			<i class="fas fa-trash"></i> Delete Column
		</a>
	</div>
</div>