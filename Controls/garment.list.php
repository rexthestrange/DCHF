<?php require_once (Common::root_path ("Classes/site.php")); ?>


<div id="<?=$id?>" class="header-panel">

	<h1><?=$title?></h1>
	<div class="garment-list"><?=(new site ())->garment_list ($garments, isset ($list_type) ? $list_type : "public")?></div>
	
</div>

