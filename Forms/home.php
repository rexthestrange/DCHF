<?php 

	require_once (common::root_path ("Classes/site.php"));
	$control = new site ();
	
?>


<style>

	div.home_page {
		display: flex;
		flex-direction: row;
	    margin: 0 auto;	
	}/* div.home_page */


</style>


<div class="home_page">

	<?=$control->load_control ("Controls/featured.garment.php")?>

	<div class="submission_panels">
		<?=$control->load_control ("Controls/recent.submissions.php", array ("control" => $control))?>
		<?=$control->load_control ("Controls/garment.list.php", array (
			"id" => "recent_confirmations",
			"title" => "Recently Confirmed",
			"garments" => (new garment_data ())->select_confirmed_garments (),
			"ballot" => "rating",
			"list_type" => "public"
		))?>
		<?=$control->load_control ("Controls/laundry.list.php", array ("control" => $control))?>
	</div>
	
</div>

