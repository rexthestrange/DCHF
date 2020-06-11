<div class="checkbox-control">

	<input type="checkbox" onclick="new dialog_window ({ 
		eyecandy: 'Loading...',
		contents: 'Reporting inappropriate content (well, not really).',
		data: { garment_id: <?=$garment_id?> },
		buttons: [dialog_buttons.close]
	}).show (event);" />
	
	Report inappropriate content
	
</div>
