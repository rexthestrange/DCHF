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
<script type="text/javascript" src="<?=common::root_url ("Scripts/Library/Controls/dynamic.list.js")?>"></script>

<script type="text/javascript" src="<?=common::root_url ("Scripts/Local/forms.js")?>"></script>


<link rel="stylesheet" href="<?=common::root_url ("Styles/Local/forms.css")?>" />


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


	dynamic-list dynamic-list-form > *:not(:first-child) {
		margin-left: 0.5em;
	}/* dynamic-list dynamic-list-form > *:not(:first-child) */
	
	dynamic-list dynamic-list-form > label:not(:first-child) {
		margin-left: 1em;
	}/* dynamic-list dynamic-list-form > label:not(:first-child) */

</style>


<?=$this->load_control ("Controls/button.eyecandy.php")?>


<div id="brand_form" class="application-form">


	<input type="hidden" name="action" value="brands" />
	<input type="hidden" name="option" value="save" />
	
	<input type="hidden" name="user_admin" value="true" />
	 

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
	
	
	<?php if ($this->user->guest): ?>
	
		<div class="header-panel">
			
			<h1>About you</h1>
			<?=$this->load_control ("Library/Forms/contact.php", array ("id" => "user"))?>
			
		</div>
	
	<?php endif ?>
	
	
	<?=$this->load_control ("Forms/Applications/Sections/company.name.php")?>
	<?=$this->load_control ("Forms/Applications/Sections/company.details.php", array ("visible", false))?>
	<?=$this->load_control ("Forms/Applications/Sections/associates.php")?>
	<?=$this->load_control ("Forms/Applications/Sections/labels.php")?>

	<div class="right-button-bar">
		<button id="submit_button" is="eyecandy-button" onclick="return send_application.call (this, event, $('#brand_form'));" eyecandy="#button_eyecandy">Add my brand!</button>
	</div>
		
</div>

		
