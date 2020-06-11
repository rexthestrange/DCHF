<script>

	function checkbox_list_names (parent, values) {
		let result = null;
		if (!is_array (values)) values = [values];
		for (let value of values) {
			if (is_null (result)) result = new Array ();
			result.push (parent.descendants ("input[type=checkbox][value=" + value + "]").label.html ());
		}// for;
		return result;
	}// checkbox_list_names;

</script>


<style>

	dynamic-list.label-list dynamic-list-form {
		display: grid;
		grid-template-columns: [fields] 1fr [button] min-content;
	}/* dynamic-list.label-list dynamic-list-form */
	
	
	dynamic-list.label-list dynamic-list-form div.checkbox-list {
		display: flex;
		flex-direction: row;
	}/* dynamic-list.label-list dynamic-list-form div.checkbox-list */ 
	

	dynamic-list.label-list dynamic-list-form div.checkbox-table {
		display: grid;
		grid-template-columns: repeat(8, min-content); 
	}/* dynamic-list.label-list dynamic-list-form div.checkbox-table */ 
	
	
	dynamic-list.label-list dynamic-list-form div.checkbox-table div.checkbox-cell:nth-child(8) label  {
		margin: 0;
	}/* dynamic-list.label-list dynamic-list-form div.checkbox-table div.checkbox-cell:nth-child(8) label */
	

	dynamic-list.label-list dynamic-list-rows {
		display: grid;
	    grid-template-columns: repeat(3, min-content);
	    grid-column-gap: 1em;
	    justify-content: center;
	    align-items: center;
	}/* dynamic-list.label-list dynamic-list-rows */

</style>


<div class="header-panel">

	<h1>Your labels</h1>
	

	<dynamic-list name="label_list" class="label-list flex-row" button-text="Add" style="display: block">
	
		<dynamic-list-form>

			<div class="one-column-form">
			
				<label for="label_name">Label name</label>
				<input id="label_name" type="text" VALUE="Asstight Jeans" />
			
				<div style="margin: 1em 0">We make</div>
				<div class="checkbox-list">

					<div class="checkbox-table">
					
						<?php foreach ((new garment_data ())->select_garment_types () as $row): ?>
						
							<div class="checkbox-cell">
								<input type="checkbox" id="<?=$this->variable_name ($row->description)?>_label" name="labels" value="<?=$row->garment_type_id?>" />
								<label for="<?=$this->variable_name ($row->description)?>_label"><?=$row->description?></label>
							</div>
							
						<?php endforeach ?>
						
					</div>
					
				</div>
				
			</div>

		</dynamic-list-form>

		<dynamic-list-model oncopy="this.descendants ('div.garment-type-list').html ('(' + checkbox_list_names ($('dynamic-list.label-list dynamic-list-form div.checkbox-table'), json_decode (values.labels)).join (', ') + ')');">
			<div field="label_name"></div>
			<div class="garment-type-list"></div>
			<img src="<?=common::root_url ("Images/close.dot.png")?>" onclick="$(this).parent ().dom_object.remove (); return false;" style="width: 1em; height: auto;" />
		</dynamic-list-model>
		
	</dynamic-list>
	

</div>


