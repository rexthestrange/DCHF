<div class="header-panel">

	<h1>Your company</h1>	

	<div class="one-column-form" style="width: 100%">
	
		<label for="company_name">Name</label>
	 
		<select is="select-textbox" id="company_name" name="company_name" text="Add another brand" onadd="return confirm_account (event);" style="width: 100%" >
		
			<?php if (isset ($brands) and is_array ($brands)) foreach ($brands as $brand): ?>
				<option value="<?=$brand->id?>"><?=$brand->name?></option>
			<?php endforeach ?>
				
		</select>
		
	</div>

</div>



