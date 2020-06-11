<div class="header-panel">

	<h1>About your company</h1>

	<div class="form">
	
		<?=$this->load_control ("Library/Forms/address.php", array ("address" => (debugging ? (Object) default_address : null)))?>
		
		<label for="phone">Phone number</label>
		<div class="row-grid">
			<input type="text" name="phone" value="<?=default_value ("phone")?>" required="true" />
			<label for="website">Website</label>
			<input type="text" name="website" maxlength="255" value="<?=default_value ("website")?>" />		
		</div>
					
	</div>
	
</div>


