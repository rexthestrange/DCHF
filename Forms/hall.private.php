<link rel="stylesheet" href="<?=common::root_url ("Styles/Local/hall.css")?>" />

<h1><?="{$owner->screen_name}'s Hall of Fame"?></h1>

<div id="hall_of_fame">

	<?php if (is_empty ($data)): ?>
	
		<h2>You don't have any items in your Hall of Fame.</h2>
		<h4 class="centered">
			<a href="about:blank" onclick="return load_page.call (this, { action: 'garments', option: 'edit' });">Click Here</a>
			to add your favorite clothes!
		</h4>
	
	<?php else: ?>

		<?php if (isset ($data->private)) : ?>
		
			<div class="hall-panel">
				<?=$this->load_control ("Controls/garment.list.php", (Object) array (
					"id" => "private_garments",
					"title" => "My private treasures",
					"garments" => $data->private,
					"list_type" => "private"
				))?>
			</div>
			
		<?php endif ?>
	
			
		<?php if (isset ($data->submitted)) : ?>
		
			<div class="hall-panel">
				<?=$this->load_control ("Controls/garment.list.php", (Object) array (
					"id" => "submitted_garments",
					"title" => "Submitted for approval",
					"garments" => $data->submitted,
					"list_type" => "submitted"
				))?>
			</div>
			
		<?php endif ?>
			
			
		<?php if (isset ($data->confirmed)) : ?>
		
			<div class="hall-panel">
				<?=$this->load_control ("Controls/garment.list.php", (Object) array (
					"id" => "confirmed_garments",
					"title" => "Open to the public",
					"garments" => $data->confirmed,
					"list_type" => "confirmed"
				))?>
			</div>
			
		<?php endif ?>
			
			
		<?php if (isset ($data->hall)): ?>
		
			<div class="hall-panel">
				<?=$this->load_control ("Controls/garment.list.php", (Object) array (
					"id" => "hall_of_fame",
					"title" => "In the Hall of Fame",
					"garments" => $data->hall,
					"list_type" => "hall"
				))?>
			</div>
			
		<?php endif ?>
		
	
	<?php endif ?>
		
</div>