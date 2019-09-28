<link href="<?php echo site_url('mods/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo site_url('mods/dropzone/dropzone.min.css'); ?>" rel="stylesheet" type="text/css" />
<style>
	#datatables_wrapper .row:last-child {
		background-color: #FFF;
		border-bottom: none;
	}
	#datatables_wrapper .row:first-child {
		display: none;
	}
	#datatables thead {
		display: none;
	}
	.thumbnail {
		position: relative;
		height: 150px;
		overflow: hidden;
		padding: 0;
	}
	.popover {
		z-index: 99999;
	}
	.caption {
		position:absolute;
		top:0;
		right:0;
		background:rgba(0, 0, 0, 0.75);
		width:100%;
		height:100%;
		padding:1%;
		display: none;
		text-align:center;
		color:#fff !important;
		z-index:2;
	}
	.btn-image {
		font-size: .8em;
		padding: 1px;
	}
</style>
<div class="modal-header">
	<h5 class="modal-title" id="modalLabel"><?php echo $page_heading?></h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">	
	<div class="nav-tabs-custom bottom-margin">
		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Upload Images</a></li>
			<li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Add Existing Image</a></li>
		</ul>
		<div class="tab-content">
			<br>
			<div class="tab-pane active" id="tab_1">
				<div class="form-horizontal top-margin3">
					<div class="col-sm-6">
						<div class="form-group">
							<?php echo form_open(site_url('files/images/upload'), array('class'=>'dropzone', 'id'=>'dropzone'));?>
							<div class="fallback">
								<input name="file" type="file" class="hide" />
							</div>
							<?php echo form_close();?>
						</div>
					</div>
					<div class="col-sm-8 text-center">
						<div id="image_sizes"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="tab-pane" id="tab_2">
				<table class="table table-striped table-bordered table-hover dt-responsive" id="datatables">
					<thead>
						<tr>
							<th class="all"><?php echo lang('index_id')?></th>
							<th class="min-desktop"><?php echo lang('index_width'); ?></th>
							<th class="min-desktop"><?php echo lang('index_height'); ?></th>
							<th class="min-desktop"><?php echo lang('index_name'); ?></th>
							<th class="min-desktop"><?php echo lang('index_file'); ?></th>
							<th class="min-desktop"><?php echo lang('index_file'); ?></th>
							<th class="min-desktop"><?php echo lang('index_file'); ?></th>
							<th class="min-desktop"><?php echo lang('index_file'); ?></th>
							<th class="min-desktop"><?php echo lang('index_thumb'); ?></th>

							<th class="none"><?php echo lang('index_created_on')?></th>
							<th class="none"><?php echo lang('index_created_by')?></th>
							<th class="none"><?php echo lang('index_modified_on')?></th>
							<th class="none"><?php echo lang('index_modified_by')?></th>
							<th class="none"><?php echo lang('index_action')?></th>
						</tr>
					</thead>
				</table>
				<div id="thumbnails" class="row text-center"></div>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo site_url('mods/dropzone/dropzone.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo site_url('mods/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>" type="text/javascript"></script>
<script>
var image_field_id = "<?php echo $field_id; ?>";
</script>

<script>
Dropzone.autoDiscover = false;

$(function() {

	var myDropzone = new Dropzone("#dropzone");
	
	myDropzone.on("success", function(file, response) {

		var response = jQuery.parseJSON(response);

		if (response.status == 'failed') {
			alert(jQuery(response.error).text());
		} else {

			var html = '<h3>Select the image size to insert</h3><div class="btn-group" role="group">';
			if (response.small) {
				html += '<button class="btn btn-default btn-image" data-thumb="' + response.thumb +'" data-image="' + response.small+'">Small</button>';
			}
			if (response.medium) {
				html += '<button class="btn btn-default btn-image" data-thumb="' + response.thumb +'" data-image="' + response.medium+'">Medium</button>';
			}
			if (response.large) {
				html += '<button class="btn btn-default btn-image" data-thumb="' + response.thumb +'" data-image="' + response.large+'">Large</button>';
			}
			if (response.image) {
				html += '<button class="btn btn-default btn-image" data-thumb="' + response.thumb +'" data-image="' + response.image+'">Orig</button>';
			}
			html += '</div>';

			// console.log(html);

			$('#image_sizes').html(html);
		}

	});

	// renders the datatables (datatables.net)
	var oTable = $('#datatables').dataTable({
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": site_url + "files/images/datatables",
		"lengthMenu": [[4, 27, 50, 100, 300, -1], [4, 27, 50, 100, 300, "All"]],
		"pagingType": "simple",
		"language": {
			"paginate": {
				"previous": 'Prev',
				"next": 'Next',
			}
		},
		"bAutoWidth": false,
		"aaSorting": [[ 0, "desc" ]],
		"aoColumnDefs": 
		[
			{
				"aTargets": [5],
				"mRender": function (data, type, full) {
					var buttons = '';
					if (full[8]) {
						buttons += '<button class="btn btn-default btn-image" data-thumb="' + full[5] +'" data-image="' + full[8] + '">Small</button> ';
					}
					if (full[7]) {
						buttons += '<button class="btn btn-default btn-image" data-thumb="' + full[5] +'" data-image="' + full[7] + '">Medium</button> ';
					}
					if (full[6]) {
						buttons += '<button class="btn btn-default btn-image" data-thumb="' + full[5] +'" data-image="' + full[6] + '">Large</button> ';
					}
					if (full[4]) {
						buttons += '<button class="btn btn-default btn-image" data-thumb="' + full[5] +'" data-image="' + full[4] + '">Original</button> ';
					}
					return '<div class="col-mini-6 col-sm-4 col-md-4 col-lg-6"><div class="thumbnail"><div class="caption"><h4>Select the image size</h4>' + buttons + '</div><img src="' + site_url + data + '" class="img-responsive" width="100%" data-id="' + full[0] + '" /></div></div>';
				},
			},
			{
				"aTargets": [0,1,2,3,4,6,7,8,9,10,11,12,13],
				"mRender": function (data, type, full) {
					return '<span class="hide">' + data + '</span>';
				},
			},
		],
		"fnDrawCallback": function( oTable ) {
			// hide the table
			$('#datatables').hide();

			// then recreate the table as divs
			var html = '';
			$('tr', this).each(function() {
				$('td', this).each(function() {
					html += $(this).html();
					// console.log(html);
				});
			});

			$('#thumbnails').html(html);
		}
	});

	// disables the enter key
	$('form input').keydown(function(event){
		if(event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});
});

$('#image_sizes, #thumbnails').on("click", ".btn-image", function() {
	// remove the dropzone
	$('#dropzone').hide();

	// insert the image
	var image = $(this).attr('data-image');
	var thumb = $(this).attr('data-thumb');

	$('#' + image_field_id + '_preview').attr('src', site_url + thumb);
	$('#' + image_field_id + '_thumb').val(thumb);
	$('#' + image_field_id).val(image);

	// tinyMCE.execCommand('mceInsertContent', false, '<img class="img-responsive" alt="' + name +'" src="' + src +'"/>');

	// closes the modal
	$('#modal').modal('hide');

	// restores the modal content to loading state
	restore_modal();
});

// $('#thumbnails').on("hover", ".thumbnail", function() {
// 	console.log($(this).attr('data-id'));
// });

$( "#thumbnails" ).on( "mouseenter", ".thumbnail", function( event ) {
	$(this).find('.caption').slideDown(250);
}).on( "mouseleave", ".thumbnail", function( event ) {
	$(this).find('.caption').slideUp(250);
});
</script>