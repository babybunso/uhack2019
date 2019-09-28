		<div class="form-group">
			<label for="{{form_name}}"><?php echo lang('{{form_name}}')?>:</label>
			<div class="form-check">
				<input class="{{form_name}} form-check-input" name="{{form_name}}" type="radio" value="one" <?php echo set_radio('{{form_name}}', 'one', (isset($record->{{form_name}}) && $record->{{form_name}} == 'one') ? TRUE : FALSE); ?> />
				<label class="form-check-label" for="{{form_name}}">
					Option 1
				</label>
			</div>
			<div class="form-check">
				<input class="{{form_name}} form-check-input" name="{{form_name}}" type="radio" value="two" <?php echo set_radio('{{form_name}}', 'two', (isset($record->{{form_name}}) && $record->{{form_name}} == 'one') ? TRUE : FALSE); ?> />
				<label class="form-check-label" for="{{form_name}}">
					Option 2
				</label>
			</div>
			<div id="error-{{form_name}}"></div>
		</div>

