<?php /* DEPRECATED - USE MORE GENERIC garment.list.item.php INSTEAD */?>


<?php 

	require_once (common::root_path ("Classes/site.php"));
	
	$current_page = new site ();
	
?>


<grid-row onmouseenter="this.highlight ();" onmouseleave="this.highlight ();" onclick="new dialog_window ({
	eyecandy: 'Loading...',
	action: 'garments',
	option: 'details',
	data: { garment_id: <?=$garment->garment_id?> }
}).show (event);">

	<div class="image-cell"><img src="<?=$this->load_image ("Uploads/Garments/{$garment->image_name}", default_garment_image)?>" /></div>
	
	<div class="rating-cell"><h2 style="text-align: center"><?=$garment->rating?></h2></div>

	<div class="details-cell">
	
		<div><?=$garment->name?></div>
		<div><?=$current_page->garment_description ($garment)?></div>
	
	</div>

</grid-row>