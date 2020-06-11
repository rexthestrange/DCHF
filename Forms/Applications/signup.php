<?php 

	require_once (common::root_path ("Library/Classes/form.php"));
	
?>


<script type="text/javascript" src="<?=common::root_url ("Scripts/Library/Controls/eyecandy.button.js")?>"></script>
<script type="text/javascript" src="<?=common::root_url ("Scripts/Local/Forms/signup.js")?>"></script>

<link rel="stylesheet" href="<?=common::root_url ("Styles/Local/logging.css")?>" />


<?=$this->load_control ("Controls/button.eyecandy.php")?>


<div id="signup_form" class="image-form">

	<input type="hidden" id="user_admin" name="user_admin" value="false" />

	<?=$this->load_control ("Library/Forms/contact.php")?>
		
	<div class="right-button-bar">
	
		<div class="subtext">
			Already a member?
			<a onclick="load_panel ({
				action: 'main',
				option: 'login'
			});">Click here</a> to log in!
		</div>

		<button id="submit_button" is="eyecandy-button" onclick="return submit_signup_form.call (this);">Submit</button>
		
	</div>
		
</div>