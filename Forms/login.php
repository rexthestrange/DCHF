<script type="text/javascript" src="<?=common::root_url ("Scripts/Forms/login.js")?>"></script>


<link rel="stylesheet" href="<?=common::root_url ("Styles/Local/logging.css")?>" />


<div id="login_control" class="flex-column">

	<div id="login_form">
	
		<div class="one-column-form">
		
			<label for="username">Email</label>
			<input type="text" id="username" name="username" VALUE="roger.main@rexthestrange.com" />
			
			<label for="password">Password</label>
			<div class="password-cell">
				<input type="password" id="password" name="password" VALUE='stranger' />
				<img src="Images/eyeball.on.svg" class="password-eyeball" onclick="toggle_password ($(this).parent ());" />
			</div>
			
		</div>
		
		<button onclick="return submit_login_form ();">Login</button>
		
	</div>
	
	<div class="subtext">
		New to the Dry Cleaning Hall of Fame?<br />
		<a onclick="load_panel ({
			action: 'main',
			option: 'signup'
		});">Click here</a> to create an account. It's free!
	</div>
	
</div>