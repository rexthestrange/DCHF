<div class="<?=$id?>-hours">

	<input type="hidden" id="<?=$id?>_id" />
	
	<label><?=propercase ($id)?></label>
	
	<div>

		<select id="<?=$id?>_opening_hour" name="<?=$id?>_opening_hour" onchange="return update_checkboxes.call (this);"><?=$this->hours (9);?></select>
		<select id="<?=$id?>_opening_minute" name="<?=$id?>_opening_minute" onchange="return update_checkboxes.call (this);"><?=$this->minutes ();?></select>
		<select id="<?=$id?>_opening_meridian" name="<?=$id?>_opening_meridian" onchange="return update_checkboxes.call (this);">
			<option value="am" selected="true">AM</option>
			<option value="pm">PM</option>
		</select>
	
	</div>
	<div>
	
		<select id="<?=$id?>_closing_hour" name="<?=$id?>_closing_hour" onchange="return update_checkboxes.call (this);"><?=$this->hours (9);?></select>
		<select id="<?=$id?>_closing_minute" name="<?=$id?>_closing_minute" onchange="return update_checkboxes.call (this);"><?=$this->minutes ();?></select>
		<select id="<?=$id?>_closing_meridian" name="<?=$id?>_closing_meridian" onchange="return update_checkboxes.call (this);">
			<option value="am">AM</option>
			<option value="pm" selected="true">PM</option>
		</select>
		
	</div>

	<div class="checkbox-list">
	
		<input type="checkbox" id="<?=$id?>_closed" name="<?=$id?>_closed" onclick="update_daily_hours.call (this);" />
		<label for="<?=$id?>_closed">Closed</label>
		
		<input type="checkbox" id="<?=$id?>_all_hours" name="<?=$id?>_all_hours" onclick="update_daily_hours.call (this);" />
		<label for="<?=$id?>_all_hours">24 hours</label>
		
	</div>

</div>
