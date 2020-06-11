<?php 

	$garment_submitted = boolean_value ($garment->submitted);
	$garment_confirmed = boolean_value ($garment->confirmed);
	
	$voted = not_null ($garment->vote);
	$vote = boolean_value ($garment->vote);
	
	$my_garment = ($garment->user_id == $this->user->id);
	
?>

<style>


	#garment_details div.rating {
		display: flex;
		flex-direction: row;
		align-items: space-between;
	}/* #garment_details div.rating */
	
	
	#garment_details div.rating {
		display: flex;
		flex-direction: row;
		justify-content: space-between;
		margin-top: 1em;		 
	}/* #garment_details div.rating */


	#garment_details div.rating-cell {
	    font-size: 72pt;
	}/* #garment_details div.rating-cell */
	
	
	#garment_details div.options-cell {
	    display: flex;
	    flex-direction: row;
	    align-items: center;
	    justify-content: center;
	}/* #garment_details div.options-cell */	
	

	#garment_details div.flex-row {
		margin-top: 1em;
	}/* #garment_details div.flex-row */

	
</style>


<div id="garment_details" class="flex-column">

	<img src="Images/vote.eyecandy.gif" class="eyecandy template  absolute-right-aligned" style="display: none" />
			
	<h3><?=(isset ($garment->name) ? $garment->name : "It has no name.")?></h3>
		
		
	<?=$this->load_control ("Controls/Garments/details.php", array ("garment" => $garment))?>
			
			
	<div class="flex-row">

		<?php if ($garment_confirmed) : ?>
		
			<div class="rating-cell" garment_id="<?=$garment->garment_id?>"><?=$garment->rating?></div>
			
		<?php endif ?>
		
		
		<?php if ($garment_submitted and !$garment_confirmed and $my_garment): ?>
			
			<progress-bar type="loops" length="<?=$garment->confirmation_threshold?>" value="<?=$garment->confirmation_level?>" />
					
		<?php endif ?>
		
		
		<?php if ($this->user->guest or $my_garment): ?>
		
			<button onclick='new dialog_window ().close ();'>Peachy</button>
			
		<?php endif ?>
		
		
		<?php if (!$my_garment and !$this->user->guest and $garment_confirmed): ?>
		
			<div class="confirmation-panel flex-column">
		
				<?php if ($voted): ?>
				
					<div class="options-cell">
				
						<?=$this->load_control ("Controls/Ballots/item.php", array (
							"garment_id" => $garment->garment_id,
							"value" => $vote,
							"static" => true
						))?>
						
					</div>
		
					<button class="close-button" onclick='new dialog_window ().close ();'><?=$vote ? "Peachy" : "Bummer"?></button>
					
				<?php else: ?>
	
					<div class="options-cell">
				
						<?=$this->load_control ("Controls/Ballots/panel.php", array (
							"garment" => $garment,
							"eyecandy_panel" => "div.confirmation-panel",
							"button_text" => "Faboo!"
						))?>
						
					</div>
		
					<button class="close-button" onclick='new dialog_window ().close ();'>Later</button>
						
				<?php endif ?>
	
			</div>
			
		<?php endif ?>
		
		
		<?php if (!$my_garment and !$this->user->guest and $garment_submitted and !$garment_confirmed): ?>
		
			<div class="header" style="margin-right: 1em">Is this suitable for the Hall of Fame?</div>
			
			<div class="confirmation-panel flex-column">
	
				<?php if ($voted): ?>
				
					<?=$this->load_control ("Controls/Ballots/item.php", array (
						"garment_id" => $garment->garment_id,
						"value" => $vote,
						"text" => $vote ? "Yes" : "No",
						"static" => true
					))?>
				
					<button class="close-button" onclick='new dialog_window ().close ();'><?=$vote ? "Peachy" : "Oh dear"?></button>
				
				<?php else: ?>
				
					<?=$this->load_control ("Controls/Ballots/panel.php", array (
						"garment" => $garment,
						"yes" => "Yes",
						"no" => "No",
						"show_checkbox" => false,
						"eyecandy_panel" => "div.confirmation-panel",
						"button_text" => (Object) array (
							"yes" => "Peachy",
							"no" => "Oh dear"
						)/* button_text */
					))?>
					
					<button class="close-button" onclick='new dialog_window ().close ();'>Pass</button>
				
				<?php endif ?>
				
			</div>

		<?php endif ?>
		
		
	</div>
		
</div>

