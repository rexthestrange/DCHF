<?php if ($garment->homemade) return; ?>

<div class="brand">
	<div>Made by <?=isset ($garment->brand) ? $garment->brand : "... is this yours?"?></div>
	<div><a href="about:blank" onclick="return load_page.call (this, { option: 'brands' });" target="dchf_brands">Click here</a> to add your brand!</div>		
</div>

