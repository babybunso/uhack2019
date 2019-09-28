		<div class="form-group">
			<label for="{{form_name}}"><?php echo lang('{{form_name}}')?>:</label>
			<?php $options = create_dropdown('array', ',{{form_value}}'); ?>
			<?php echo form_dropdown('{{form_name}}', $options, set_value('{{form_name}}', (isset($record->{{form_name}})) ? $record->{{form_name}} : ''), 'id="{{form_name}}" class="form-control"'); ?>
			<div id="error-{{form_name}}"></div>
		</div>

