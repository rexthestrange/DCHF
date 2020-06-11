<!doctype html>


<html>


<head>

	<title>The Dry Cleaning Hall of Fame</title>
	
	
	<script type="text/javascript" src="Scripts/Library/Common/External/jquery.js"></script>
	<script type="text/javascript" src="Scripts/Library/Common/External/jquery-ui.js"></script>
	<script type="text/javascript" src="Scripts/Library/Common/External/jquery.cookie.js"></script>
	<script type="text/javascript" src="Scripts/Library/Common/common.js"></script>
	<script type="text/javascript" src="Scripts/Library/Common/prototypes.js"></script>
	<script type="text/javascript" src="Scripts/Library/Common/extensions.js"></script>
	<script type="text/javascript" src="Scripts/Library/Common/initialize.js"></script>
	
	<script type="text/javascript" src="Scripts/Library/Controls/dialog.window.js"></script>
	<script type="text/javascript" src="Scripts/Library/Controls/fade.list.js"></script>
	<script type="text/javascript" src="Scripts/Library/Controls/fade.panel.js"></script>
	<script type="text/javascript" src="Scripts/Library/Controls/menu.button.js"></script>
	
	<script type="text/javascript" src="Scripts/Local/common.js"></script>
	<script type="text/javascript" src="Scripts/Local/voting.js"></script>
	
	<script type="text/javascript" src="Scripts/Local/Controls/grid.row.js"></script>
	<script type="text/javascript" src="Scripts/Local/Controls/ballot.item.js"></script>
	
	
	<link rel="stylesheet" href="Styles/Library/Controls/dialog.window.css" />
	<link rel="stylesheet" href="Styles/Library/common.css" />
	<link rel="stylesheet" href="Styles/forms.css" />
	
	<link rel="stylesheet" href="Styles/Local/common.css" />
	<link rel="stylesheet" href="Styles/Local/home.css" />
	
	<link rel="stylesheet" href="Styles/Local/Controls/dialog.window.css" />
	
</head>

<script type="text/javascript" src="<?=common::root_url ("Scripts/Library/Controls/progress.bar.js")?>"></script>


<script>


	function load_menu_item (options) {

		let self = $(this);

		$("button.menu-button").removeAttr ("selected");
		if (self.is ("button.menu-button")) self.attr ("selected", "true");
		return load_panel (options);
		
	}// load_menu_item;

	
</script>



<style>

	#load_screen {
		position: absolute;
		width: 100%;
		height: 100%;
		z-index: -1;
		display: flex;
		justify-content: center;
		align-items: center;
	}/* #load_screen */
	
	
	#main_menu_buttons > button:not(:first-child), #main_menu_buttons > menu-button {
		margin-left: 0.5em;
	}/* #main_menu_buttons > button:not(:first-child), #main_menu_buttons > menu-button */


	div.gunbarrel_image {
		width: 2em;
		height: 2em;
		position: relative;
		overflow: hidden;
		border-radius: 50%;
		border: solid 1px var(--panel-border-color);
	}/* div.gunbarrel_image */
	

	div.gunbarrel_image img {
		width: 100%;
		height: auto;
		margin-top: -25%;
	}/* div.gunbarrel_image img */

</style>


<body>

	<div id="load_screen">
		<img src="Images/bubbles.transparent.gif" />
	</div>
	
	<fade-panel id="main_screen">

		<div id="main_panel">
				
			<div class="header">
				
				<div class="main-banner">
					
					<div id="title_panel" onclick="load_menu_item ({ action: 'main', option: 'home' });">
					
						<h1>It lives forever at</h1>
						<img src="Images/dchf.png" style="width: 65%; height: auto;" />
						
					</div>
					
					<div class="flex-column">
					
						<div class="user-home-controls">

							<div class="middle-flex-column">						

								<label>Hello <?=$this->user->screen_name?>!</label>
								
								<div class="subtext">
								
									<?php if ($this->user->logged_out) { ?>
								
										<a onclick="return load_panel ({
											action: 'main',
											option: 'login'
										});">Log in</a> 
										or 
										<a onclick="return load_panel ({
											action: 'main',
											option: 'signup'
										});">click here</a> to create an account. It's free!
		
									<?php } else { ?>
								
										<a onclick="return log_out ();">Log out</a>
								
									<?php }// if; ?>
			
								</div>
								
							</div>
								
							<?php if (!$this->user->guest) : ?>
								<div class="gunbarrel_image">
									<img src="<?=$this->load_image ("Uploads/Members/{$this->user->avatar}", default_avatar_image)?>" class="avatar-icon" />
								</div>
							<?php endif ?>
							
						</div>
					
						<div class="header-sponsor-panel">
						
							<div class="top-banner header-panel">
							
								<h1>Sponsored by</h1>
								
								<div class="contents">
								
									<div>
										The Dry Cleaning Hall of Fame is proudly sponsored
										by Fluffy White Sudsy Detergent. Remember, the best
										detergent is fluffy white and sudsy!<br />
									</div>
									
									<div>
										Your advertisement could go here! <a href="about:blank" onclick="return new dialog_window ({ 
											eyecandy: 'Loading...',
											action: 'sponsors',
											option: 'advertising',
											buttons: [dialog_buttons.close]
										}).show (event);">Click Here</a> to find out how!
									</div>
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
	
	
			<div class="body">
			
				<div id="main_menu_buttons" class="center-button-bar" style="margin-bottom: 1em">
				
					<?php if ($this->user->logged_in): ?>

						<button class="menu-button" onclick="return load_menu_item.call (this, { action: 'garments', option: 'hall_of_fame', data:  { gallery: 'personal' } });">My Hall of Fame</button>
						<button class="menu-button" onclick="return load_menu_item.call (this, { action: 'garments', option: 'edit' });">Add Garment</button>
						
					<?php else: ?>
	
						<button class="menu-button" onclick="return load_menu_item.call (this, { action: 'main', option: 'login' });">Log In</button>
						<button class="menu-button" onclick="return load_menu_item.call (this, { action: 'main', option: 'signup' });">Sign Up (it's free!)</button>
					
					<?php endif ?>
					
					
					<?php if (debugging): ?><button onclick="return run_debug ();">Debug</button><?php endif ?>
					
							
					<?php if (($this->user->user_admin) or ($this->user->system_admin)): ?>
					
						<menu-button text="Administration" speed="200">
					
							<?php if ($this->user->user_admin): ?>
								<button onclick="return load_menu_item.call (this, { action: 'admin', option: 'account' });">Account</button>
							<?php endif ?>
						
							<?php if ($this->user->system_admin): ?>
								<button onclick="return load_menu_item.call (this, { action: 'admin', option: 'laundromats' });">Laundromats</button>
								<button onclick="return load_menu_item.call (this, { action: 'admin', option: 'advertising' });">Advertising</button>
							<?php endif ?>
					
						</menu-button>
					
					<?php endif ?>
					

				</div>
				
				<div class="ajax-panel panel">
				
					<?=$this->home_page ()?>
					
				</div>
				
			</div>
	
		
			<div class="footer">
				We encourage you to donate any usable Hall of Fame garments to the local charity of your<br />
				choice to gain maximum usage rather than filling the landfills with usable textiles.
			</div>
	
			
		</div>

	
	</fade-panel>
	
</body>


</html>

