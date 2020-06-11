<?php 

	require_once (common::root_path ("Models/garments.php"));

	$garment = ((Object) (new garment_data ())->select_featured_garment ());

?>
	

<style>

	#featured_garment div.subpanel {
		padding: 2em;
	}/* #featured_garment div.subpanel */

	
	#featured_garment div.rating-cell {
		font-size: 72pt;
	}/* #featured_garment div.rating-cell */
	
</style>


<div id="featured_garment">

	<div class="subpanel">
	
		<div class="row-table">
	
			<div class="flex-column">
	
				<h1 class="title">Featured Garment:</h1>
			
				<h2><?=$garment->name?></h2>
				
			</div>
			
			<div class="rating-cell" garment_id="<?=$garment->garment_id?>"><?=$garment->rating?></div>
			
		</div>

		<?=$this->load_control ("Controls/Garments/details.php", array ("garment" => $garment))?>			
	
	</div>

</div>