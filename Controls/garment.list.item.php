<style>


	grid-row { border: solid 1px red }

	grid-row div.rating-cell {
		font-weight: bold;
		font-size: 18pt;
	}

</style>


<grid-row onmouseenter="this.highlight ();" onmouseleave="this.highlight ();" onclick="new dialog_window ({
	eyecandy: 'Loading...',
	action: 'garments',
	option: 'details',
	data: { garment_id: <?=$garment->garment_id?> }
}).show (event);">

	<div class="image-cell"><img src="<?=$this->load_image ("Uploads/Garments/{$garment->image_name}", default_garment_image)?>" /></div>
	
	<div class="details-cell">
		<div><?=$garment->name?></div>
		<div><?=$common->garment_description ($garment)?></div>
	</div>
	
	<?php if ($garment->confirmed) : ?>

		<div class="rating-cell" garment_id="<?=$garment->garment_id?>"><?=$garment->rating?></div>
		
	<?php elseif ($type == "submitted")  : ?>

		<div class="confirmation-cell">	
			<progress-bar type="loops" length="<?=$garment->confirmation_threshold?>" value="<?=$garment->confirmation_level?>" />
		</div>	
		
	<?php endif ?>	

</grid-row>