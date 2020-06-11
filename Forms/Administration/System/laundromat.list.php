<style>


	div.grid-list {
		display: grid;
		grid-template-columns: repeat(3, [name] min-content);
		white-space: nowrap;
	}/* div.grid-list */
	

	div.grid-list div {
		padding: 0.2em 1em;
	}/* div.grid-list div */


	div.grid-list div.title {
		display: contents;
		font-weight: bold;
	}/* div.grid-list div.title */
	
	
	div.grid-list div.title div {
		background-color: var(--banner-color);
	}/* div.grid-list div.title div */

	div.grid-list div.row {
		display: contents;
	}/* div.grid-list div.row */



	div.grid-list div.title div:first-child {
		border-top-left-radius: var(large-border-radius); 
	}/* div.grid-list div.title div:first-child */


</style>

 

<div class="grid-list">

	<div class="title">
		<div>Name</div>
		<div>Website</div>
		<div>Location</div>
	</div>

	<?php foreach ($laundromats as $laundromat): ?>
	
		<div class="row">
			<div><?=$laundromat->name?></div>
			<div><?=$laundromat->website?></div>
			<div><?=$laundromat->city?>, <?=$laundromat->state?>, <?=$laundromat->country?></div>
		</div>
	
	<?php endforeach ?>
	
</div>