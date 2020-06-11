<?php

	$readonly = isset ($static) && ($static);
	
	$onclick = $readonly ? null : "onclick=" . quoted ("vote.call (this, {
		garment_id: {$garment_id},
		vote: " . boolean_text ($value) . ",
		eyecandy_panel: $('{$eyecandy_panel}'),
		button_text: '{$button_text}'
	});");
	
	$static = $readonly ? "static='true'" : null;

?>

<ballot-item <?=$onclick?> <?=$static?> value="true">
	<img src="Images/ballot.<?=$value ? "yes" : "no"?>.png" />
	<div><?=isset ($text) ? $text : ($value ? "Yes! I like!" : "Not my style.")?></div>
</ballot-item>
