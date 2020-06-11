<?php 

	require_once (common::root_path ("Classes/Forms/garments.php"));
	require_once (common::root_path ("Classes/Enumerations/garment.types.php"));
	
?>


<style>

	#garment_form div.description-panel {
		margin-left: 1em;
	}/* #garment_form div.main-panel */


</style>


<div id="garment_form" class="image-form">

	<div class="flex-row">
	

		<?=$garment_form->image_upload (array (
			"image" => default_garment_image,
			"name" => "garment_image",
			"multiple" => true,
			"class" => "garment-image"
		)); ?>
		
		
		<div class="description-panel">
		
			<div class="one-column-form">
			
				<input type="hidden" id="garment_id" name="garment_id" />
		
				<label for="garment_type">Type of Garment</label>
				<select id="garment_type" name="type">
					<option>Select one</option>
					<?=$garment_form->garment_type_list?>
				</select>
				

				<label for="garment_name">Does your garment have a name?</label>				
				<input type="text" id="garment_name" name="name" VALUE="Macquarie University Sweatshirt" />
				
				
				<label for="garment_age">Age of garment</label>
				
				<div>
					<input type="numeric" id="garment_age" name="age" />
					or year purchased
					<input type="numeric" id="garment_year" name="year" VALUE="1990" />
					<input type="checkbox" id="circa" name="circa" CHECKED="TRUE" />Circa
				</div>
				
				
				<label>Brand</label>
				<select id="garment_brand" name="brand">
					<option class="title">Select one</option>
					<option>
						<img src="Images/glyph.gif" />
						Your brand could be here! <a href="about:blank" onclick="return new dialog_window ({
							eyecandy: 'Loading...',
							action: 'sponsors',
							option: 'advertise',
							buttons: [dialog_buttons.close]
						).show (event);">Click Here</a> to find out how.
					</option>
				</select>
				
			</div>
			
			<div class="flex-column" style="margin-top: 1em">
				
				<label for="garment_description">Why does this deserve a place in the Hall of Fame?</label>
				<textarea id="garment_description" name="description">Purchased during Rex's college days and worn by almost every girl he's dated.</textarea>
				
			</div>
			
			<div class="right-button-bar">
				<button id="submit_button" onclick="return submit_garment_form ();">Submit</button>
			</div>
		
		</div>
		
	</div>
	
</div>