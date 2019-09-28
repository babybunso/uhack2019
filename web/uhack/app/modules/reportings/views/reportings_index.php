<section id="roles">
	<div class="container-fluid">
		<div class="card">
			<!-- <div class="card-close">
				<div class="card-buttons">
					<?php if ($this->acl->restrict('reportings.reportings.add', 'return')): ?>
						<a href="<?php echo site_url('reportings/reportings/form/add')?>" data-toggle="modal" data-target="#modal" class="btn btn-sm btn-primary btn-add" id="btn_add"><span class="fa fa-plus"></span> <?php echo lang('button_add')?></a>
					<?php endif; ?>
				</div>
			</div> -->
			<div class="card-header d-flex align-items-center">
				<h3 class="h4"><?php echo $page_heading; ?></h3>
			</div>
			<div class="card-body">				
				<table class="table table-striped table-bordered table-hover dt-responsive" id="datatables">
					<thead>
						<tr>
								<th class="all"><?php echo lang('index_id'); ?></th>
				<th class="none"><?php echo lang('index_name'); ?></th>
				<th class="none"><?php echo lang('index_type'); ?></th>
				<th class="all"><?php echo lang('index_reporter_id'); ?></th>
				<th class="none"><?php echo lang('index_report_type'); ?></th>
				<th class="none"><?php echo lang('index_report'); ?></th>
				<th class="min-desktop"><?php echo lang('index_base_location'); ?></th>
				<th class="min-desktop"><?php echo lang('index_unit_location'); ?></th>
				<th class="min-desktop"><?php echo lang('index_status'); ?></th>
				<th class="min-desktop"><?php echo lang('index_bldg_engr'); ?></th>
				<th class="min-desktop"><?php echo lang('index_bldg_mngr'); ?></th>
				<th class="min-desktop"><?php echo lang('index_opt_mngr'); ?></th>

							<th class="none"><?php echo lang('index_created_on')?></th>
							<th class="none"><?php echo lang('index_created_by')?></th>
							<th class="none"><?php echo lang('index_modified_on')?></th>
							<th class="none"><?php echo lang('index_modified_by')?></th>
							<th class="min-tablet"><?php echo lang('index_action')?></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</section>