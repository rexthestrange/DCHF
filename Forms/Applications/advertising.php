<?php

	const default_address = array (
		"street" => "6795 West 19th Place",
		"additional" => "108",
		"city" => "Lakewood",
		"zip" => 80214
	);
	
	
	const default_secondary_contact = array (
		"first_name" => "Rex",
		"last_name" => "Strange",
		"primary_phone" => "123 456 7890",
		"secondary_phone" => "234 567 8901",
		"email_address" => "rex@rexthestrange.com"
	);


	function default_value ($name) {
		
		if (debugging) switch ($name) {
			
			case "name": return "Asstight Incorporated";
			case "phone": return "720-322-5154";
			case "website": return "http://www.asstightjeans.com";
			
		}// switch;
		
	}// default_value;

?>


<script type="text/javascript" src="<?=common::root_url ("Scripts/Library/Controls/eyecandy.button.js")?>"></script>
<script type="text/javascript" src="<?=common::root_url ("Scripts/Library/Controls/select.textbox.js")?>"></script>



<script>

	function confirm_account (event) {
		new dialog_window ({
			contents: "The basic account only allows for only one brand. Change your account type preferences to add additional brand labels.", 
			buttons: [dialog_buttons.close]
		}).show (event);
		return false;						
	}// confirm_account;

</script>
				
				
<style>

	div.account-types label { margin-left: 1em; font-size: 16pt; }
	div.account-types div.checkbox-cell:not(:first-child) { margin-left: 2em; }

</style>	

	


<?php /* CONSTRUCTION ZONE */ ?>

<script type="text/javascript" src="<?=common::root_url ("Scripts/Local/Forms/laundry.list.js")?>"></script>

	<?php /*
	
		<!-- REPLACE laundry.list.js WITH THIS OR A NEW forms.js OR BOTH IF NECESSARY -->
		
		<script type="text/javascript" src="<?=common::root_url ("Scripts/Local/Forms/brands.js")?>"></script>
		
	*/ ?>

<?php /* END CONSTRUCTION ZONE */ ?>




<link rel="stylesheet" href="<?=common::root_url ("Styles/Local/Forms/laundry.list.css")?>" />


<?=$this->load_control ("Controls/button.eyecandy.php")?>


<div id="laundry_list_form">


	<div class="center-flex-row">
	
		<img class="header-image" src="Images/my.brand.png" />
		
		<div class="form-header">
			<h1>Add your brand</h1>
		</div>
				
	</div>
	
	
	<div class="center-flex-column" style="margin-top: 1em">
	
		<h4>Select your account type</h4>		
	
		<div class="flex-row account-types">

			<div class="checkbox-cell">
				<input type="radio" id="basic_account" name="account_type" value="basic" />
				<label for="basic_account">Basic</label>			
			</div>
			
			<div class="checkbox-cell">
				<input type="radio" id="premium_account" name="account_type" value="premium" checked="true" />
				<label for="premium_account">Premium</label>			
			</div>
	
		</div>
		
	</div>
		
					
	<div class="laundromat header-panel">
	
		<h1>About your company</h1>
	
		<div class="form">
		
			<label for="company_name">Company name</label>
			
			<div class="row-grid">
			
				<input type="text" id="company_name" name="company_name" value="<?=default_value ("name")?>" required="true" />
				<label for="brand_name">Brand</label>
				
				<select is="select-textbox" id="company_name" name="company_name" text="Add another brand" onadd="return confirm_account (event);">
				
					<?php if (isset ($brands) and is_array ($brands)) foreach ($brands as $brand): ?>
						<option value="<?=$brand->id?>"><?=$brand->name?></option>
					<?php endforeach ?>
						
				</select>
				
			</div>
		
			<?=$this->load_control ("Library/Forms/address.php", array ("address" => (debugging ? (Object) default_address : null)))?>
			
			<label for="phone">Phone number</label>
			<div class="row-grid">
				<input type="text" name="phone" value="<?=default_value ("phone")?>" required="true" />
				<label for="website">Website</label>
				<input type="text" name="website" maxlength="255" value="<?=default_value ("website")?>" />		
			</div>
						
		</div>
		
	</div>
	

	<div class="contacts">

		<div class="contact header-panel">
	
			<h1>Primary contact</h1>
	
			<?=$this->load_control ("Library/Forms/contact.php", array (
				"prefix" => "primary",
				"required" => true
			))?>
	
			<div class="checkbox-cell">
				<input type="checkbox" id="primary_logged_user" name="primary_logged_user" onclick="update_contact.call (this);" />
				<label for="primary_logged_user">Same as me.</label>
			</div>
			
		</div>
			
		<div class="contact header-panel">
	
			<h1>Secondary contact</h1>
	
			<?=$this->load_control ("Library/Forms/contact.php", array (
				"prefix" => "secondary", 
				"contact" => (debugging ? (Object) default_secondary_contact : null)
			))?>
	
			<div class="checkbox-cell">
				<input type="checkbox" id="secondary_logged_user" name="secondary_logged_user" onclick="update_contact.call (this);" />
				<label for="secondary_logged_user">Same as me.</label>
			</div>
			
		</div>
		
	</div>
	
	<div class="right-button-bar">
		<button id="submit_button" is="eyecandy-button" onclick="return send_application.call (this, event);" eyecandy="#button_eyecandy">Add my brand!</button>
	</div>
		
</div>

		
