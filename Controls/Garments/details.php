<style>

	garment-details {
		display: flex;
		flex-direction: row;
	}/* garment-details */
	
	
	garment-details img {
		max-width: 23em;
	    max-height: 13em;	
		border: var(--image-outline);
		border-radius: var(--tiny-border-radius);
	}/* garment-details img */


	garment-details h2 {
		margin-bottom: 0.5em;
	}/* garment-details h2 */


	garment-details div.details {
		margin-left: 1em;
		white-space: nowrap;
	}/* garment-details div.details */


	garment-details div.details > div:not(:first-child) {
		margin-top: 1em;
	}/* garment-details div.details > div:not(:first-child) */


	garment-details div.description {
		margin-top: 1em;
	}/* garment-details div.description */
	
</style>


<garment-details>

	<div class="garment-image"><img src="<?=$this->load_image ("Uploads/Garments/{$garment->image_name}", default_garment_image)?>" /></div>

	<div class="details">
				
		<div>
			<div>Age: <?=$garment->age . space . (($garment->age < 2) ? "year old or less" : "years old")?> <?php if ($garment->circa) write ("(approx)"); ?></div>
			<div>Origin: <?=$garment->origin?></div>
		</div>
		
		<?php if (!$garment->homemade): ?>
			<div><?=$this->load_control ("Controls/Garments/brand.php", array ("garment" => $garment))?></div>
			<div><?=$this->load_control ("Controls/Garments/stores.php", array ("garment" => $garment))?></div>
		<?php endif ?>
		
		<div class="description"><?=$garment->description?></div>
		
	</div>
	
</garment-details>
	

