		<div class="form-group">
			<div class="form-check">
				<input id="{{form_name}}" name="{{form_name}}" class="form-check-input" type="checkbox" value="1" <?php echo set_checkbox('{{form_name}}', 1, (isset($record->{{form_name}}) && $record->{{form_name}} == 1) ? TRUE : FALSE); ?> /> 
				<label class="form-check-label" for="{{form_name}}">
					<?php echo lang('{{form_name}}')?>
				</label>
				<div id="error-{{form_name}}"></div>
			</div>
		</div>

