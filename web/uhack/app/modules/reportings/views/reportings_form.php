<div class="modal-header">
	<h5 class="modal-title" id="modalLabel"><?php echo $page_heading?></h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">

	<div class="form">

		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
		
		<div class="form-group">
			<label for="reporting_name"><?php echo lang('reporting_name')?>:</label>			
			<?php echo form_input(array('id'=>'reporting_name', 'name'=>'reporting_name', 'value'=>set_value('reporting_name', isset($record->reporting_name) ? $record->reporting_name : ''), 'readonly'=>'readonly', 'class'=>'form-control'));?>
			<div id="error-reporting_name"></div>			
		</div>

		<div class="form-group">
			<label for="reporting_type"><?php echo lang('reporting_type')?>:</label>
			<?php $options = create_dropdown('array', ',Condominium,Townhouse'); ?>
			<?php echo form_dropdown('reporting_type', $options, set_value('reporting_type', (isset($record->reporting_type)) ? $record->reporting_type : ''), 'id="reporting_type" class="form-control" readonly="readonly"  disabled="disabled" '); ?>
			<div id="error-reporting_type"></div>
		</div>

		<div class="form-group">
			<label for="reporting_reporter_id"><?php echo lang('reporting_reporter_id')?>:</label>			
			<?php 
			$reporter = "";
			switch ($record->reporting_reporter_id) {
				case '1NFHSMqJtJAMznui2G88uCo4Ak25smCCiZCVNm' :
					$reporter =  'Densetsu Ghem';
				break;
				case '14YzXsRpFFzbqDbiyMNnHpZVhUszVdc3YhD5Pr' :
				$reporter =  "Gaile Sarmiento";
				break;
			} 
			echo form_input(array('id'=>'reporting_reporter_id', 'name'=>'reporting_reporter_id', 'value'=>set_value('reporting_reporter_id', isset($record->reporting_reporter_id) ? $record->reporting_reporter_id : ''), 'class'=>'form-control hide', 'readonly'=>'readonly', 'style'=>'display:none;'));?>
			<span><?php echo $reporter; ?></span>
			<div id="error-reporting_reporter_id"></div>			
		</div>

		<div class="form-group">
			<label for="reporting_report_type"><?php echo lang('reporting_report_type')?>:</label>
			<?php $options = create_dropdown('array', ',common,personal'); ?>
			<?php echo form_dropdown('reporting_report_type', $options, set_value('reporting_report_type', (isset($record->reporting_report_type)) ? $record->reporting_report_type : ''), 'id="reporting_report_type" class="form-control" readonly="readonly"  disabled="disabled"'); ?>
			<div id="error-reporting_report_type"></div>
		</div>

		<div class="form-group">
			<label for="reporting_report"><?php echo lang('reporting_report')?>:</label>			
			<?php echo form_input(array('id'=>'reporting_report', 'name'=>'reporting_report', 'value'=>set_value('reporting_report', isset($record->reporting_report) ? $record->reporting_report : ''), 'class'=>'form-control','readonly'=>'readonly', ));?>
			<div id="error-reporting_report"></div>			
		</div>

		<div class="form-group">
			<label for="reporting_base_location"><?php echo lang('reporting_base_location')?>:</label>			
			<?php echo form_input(array('id'=>'reporting_base_location', 'name'=>'reporting_base_location', 'value'=>set_value('reporting_base_location', isset($record->reporting_base_location) ? $record->reporting_base_location : ''), 'class'=>'form-control', 'readonly'=>'readonly', ));?>
			<div id="error-reporting_base_location"></div>			
		</div>

		<div class="form-group">
			<label for="reporting_unit_location"><?php echo lang('reporting_unit_location')?>:</label>			
			<?php echo form_input(array('id'=>'reporting_unit_location', 'name'=>'reporting_unit_location', 'value'=>set_value('reporting_unit_location', isset($record->reporting_unit_location) ? $record->reporting_unit_location : ''), 'class'=>'form-control', 'readonly'=>'readonly' ));?>
			<div id="error-reporting_unit_location"></div>			
		</div>

		<div class="form-group">
			<label for="reporting_status"><?php echo lang('reporting_status')?>:</label>
			<?php $options = create_dropdown('array', ',Open,Closed'); ?>
			<?php echo form_dropdown('reporting_status', $options, set_value('reporting_status', (isset($record->reporting_status)) ? $record->reporting_status : ''), 'id="reporting_status" class="form-control"'); ?>
			<div id="error-reporting_status"></div>
		</div>

		<?php
		$bldg_engr = "";
		$bldg_mngr = "";
		$oprtn_mngr = "";
		if ($my_group == 2) {
			$bldg_engr = "";
			$bldg_mngr = "disabled='disabled' ";
			$oprtn_mngr = "disabled='disabled' ";
		}

		if ($my_group == 3) {
			$bldg_engr = "disabled='disabled' ";
			$bldg_mngr = "";
			$oprtn_mngr = "disabled='disabled' ";
		}

		if ($my_group == 4) {
			$bldg_engr = "disabled='disabled' ";
			$bldg_mngr =  "disabled='disabled' ";
			$oprtn_mngr = "";
		}

		?>

		<div class="form-group">
			<label for="reporting_bldg_engr"><?php echo lang('reporting_bldg_engr')?>:</label>
			<?php $options = create_dropdown('array', ',Approved,Denied,Pending'); ?>
			<?php echo form_dropdown('reporting_bldg_engr', $options, set_value('reporting_bldg_engr', (isset($record->reporting_bldg_engr)) ? $record->reporting_bldg_engr : ''), 'id="reporting_bldg_engr" class="form-control" ' . $bldg_engr ); ?>
			<div id="error-reporting_bldg_engr"></div>
		</div>
		
		<div class="form-group">
			<label for="reporting_bldg_mngr"><?php echo lang('reporting_bldg_mngr')?>:</label>
			<?php $options = create_dropdown('array', ',Approved,Denied,Pending'); ?>
			<?php echo form_dropdown('reporting_bldg_mngr', $options, set_value('reporting_bldg_mngr', (isset($record->reporting_bldg_mngr)) ? $record->reporting_bldg_mngr : ''), 'id="reporting_bldg_mngr" class="form-control" ' . $bldg_mngr ); ?>
			<div id="error-reporting_bldg_mngr"></div>
		</div>

		<div class="form-group">
			<label for="reporting_opt_mngr"><?php echo lang('reporting_opt_mngr')?>:</label>
			<?php $options = create_dropdown('array', ',Approved,Denied,Pending'); ?>
			<?php echo form_dropdown('reporting_opt_mngr', $options, set_value('reporting_opt_mngr', (isset($record->reporting_opt_mngr)) ? $record->reporting_opt_mngr : ''), 'id="reporting_opt_mngr" class="form-control"  ' . $oprtn_mngr ); ?>
			<div id="error-reporting_opt_mngr"></div>
		</div>



	</div>

</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">
		<i class="fa fa-times"></i> <?php echo lang('button_close')?>
	</button>
	<?php if ($action == 'add'): ?>
		<button id="submit" class="btn btn-success" type="submit" data-loading-text="<?php echo lang('processing')?>">
			<i class="fa fa-save"></i> <?php echo lang('button_add')?>
		</button>
	<?php elseif ($action == 'edit'): ?>
		<button id="submit" class="btn btn-success" type="submit" data-loading-text="<?php echo lang('processing')?>">
			<i class="fa fa-save"></i> <?php echo lang('button_update')?>
		</button>
	<?php else: ?>
		<script>$(".modal-body :input").attr("disabled", true);</script>
	<?php endif; ?>
</div>	