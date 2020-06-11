<?php

	const default_address = array (
		"street" => "344 Blah St",
		"city" => "Skidsville",
		"zip" => 23456
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
			
			case "name": return "Larry's Laundry";
			case "phone": return "720-322-5154";
			case "website": return "http://www.larryslaundry.com";
			
		}// switch;
		
	}// default_value;

?>


<script type="text/javascript" src="<?=common::root_url ("Scripts/Library/Controls/eyecandy.button.js")?>"></script>
<script type="text/javascript" src="<?=common::root_url ("Scripts/Local/Forms/laundry.list.js")?>"></script>

<link rel="stylesheet" href="<?=common::root_url ("Styles/Local/Forms/laundry.list.css")?>" />


<?=$this->load_control ("Controls/button.eyecandy.php")?>


<div id="laundry_list_form">


	<input type="hidden" name="action" value="laundromat" />
	<input type="hidden" name="option" value="save" />
	 

	<div class="row-table" style="justify-content: center">
	
		<img class="header-image" src="Images/washing.machine.png" />
		
		<div class="form-header">
			<h1>Add your laundromat</h1>
			<h2>to the Laundry List</h2>
		</div>
		
	</div>
	

	<div class="laundromat header-panel">
	
		<h1>About your laundromat</h1>
	
		<div class="form">
		
			<label for="name">Laundromat name</label>
			<input type="text" id="name" name="name" value="<?=default_value ("name")?>" required="Laundromat Name" />
	
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
	
	<div class="header-panel">
	
		<h1>Hours</h1>
		
		<div class="hours">
		
			<div class="header">
				<div></div>
				<div class="title">Opening Times</div> 
				<div class="title">Closing Times</div>
				<div></div> 
			</div>
			
			<?php $this->load_hours (); ?>
		
			<div class="checkbox-list options">
				<input type="checkbox" id="never_closes" name="never_closes" onclick="update_all_hours.call (this);" />
				<label for="never_closes">Never closes</label>
			</div>
							
		</div>

	</div>
	
	
	<div class="header-panel">
	
		<h1>Services</h1>

		<div class="centering-panel">
			<div class="checkbox-list">
				<input type="checkbox" id="accepts_credit_cards" name="accepts_credit_cards" CHECKED />
				<label for="accepts_credit_cards">Accepts credit cards</label>
			</div>
		</div>
	
	</div>


	<div class="right-button-bar">
		<button id="submit_button" is="eyecandy-button" onclick="return send_application.call (this, event);" eyecandy="#button_eyecandy">Add my laundromat!</button>
	</div>
		
</div>

		
