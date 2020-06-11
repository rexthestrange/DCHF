<?php 

	require_once (common::root_path ("Classes/Forms/garments.php"));
	require_once (common::root_path ("Classes/Enumerations/garment.types.php"));

	function button_text ($option, $fieldname) {
		if (isset ($option)) {
			if (is_string ($option)) return $option;
			if (is_object ($option) and isset ($option->$fieldname)) return $option->$fieldname;
		}// if;
		return "Close";
	}// button_text;
	
	$yes_text = button_text ($button_text, "yes");
	$no_text = button_text ($button_text, "no");
	
	$show_checkbox = (isset ($show_checkbox) ? $show_checkbox !== false : true);
	
?>

<div class="ballot-cell">
			
	<div class="ballot-panel">

		<?=$this->load_control ("Controls/Ballots/item.php", array (
			"garment_id" => $garment->garment_id,
			"text" => isset ($yes) ? $yes : null,
			"value" => true,
			"eyecandy_panel" => $eyecandy_panel,
			"button_text" => $yes_text
		))?>
		
		<?=$this->load_control ("Controls/Ballots/item.php", array (
			"garment_id" => $garment->garment_id,
			"text" => isset ($no) ? $no : null,
			"value" => false,
			"eyecandy_panel" => $eyecandy_panel,
			"button_text" => $no_text
		))?>
			
	</div>
		
	<?php if ($show_checkbox): ?>
			
		<div style="align-self: center; margin-top: 1em">
			<?=$this->load_control ("Controls/inappropriate.content.php", array ("garment_id" => $garment->garment_id))?>
		</div>
	
	<?php endif ?>
	
</div>

