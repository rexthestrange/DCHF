<style>

	dynamic-list.associates-list dynamic-list-form {
		display: grid;
		grid-template-columns: [form] 1fr [button] min-content;
	}/* dynamic-list.associates-list dynamic-list-form */

	
	dynamic-list.associates-list dynamic-list-rows {
		display: grid;
	    grid-template-columns: repeat(3, min-content);
	    grid-column-gap: 1em;
	    justify-content: center;
	    align-items: center;
	}/* dynamic-list.associates-list dynamic-list-rows */


	dynamic-list.associates-list dynamic-list-form div.associate-name-grid {
		display: grid;
		grid-template-columns: [first_name] 1fr [last_name_label] min-content [last_name] 1fr;
	}/* dynamic-list.associates-list dynamic-list-form div.associate-name-grid */ 

</style>


<div class="header-panel">

	<h1>Your associates</h1>
	
	<div>
	
		<p class="form-text">
			Let us know other people you want to give access to. If they already have a user 
			account they will be sent an email asking them to confirm their association with your company.
			If they do not have an account they will be invited to join the Dry Cleaning Hall of Fame and 
			will be associated with your company if they accept.
		</p>
			
		
		<dynamic-list id="associates_list" class="associates-list flex-row" style="display: block" button-text="Add">
		
			<dynamic-list-form>
			
				<div class="one-column-form">
				
					<label for="associate_first_name">First Name</label>
					<div class="associate-name-grid">
						<input id="associate_first_name" type="text" value="Some" />
						<label for="associate_last_name" style="margin-left: 1em">Last Name</label>
						<input id="associate_last_name" type="text" value="Guy" />	
					</div>
	
					<label for="associate_email_address">Email Address</label>
					<input id="associate_email_address" type="text" value="some.guy@rexthestrange.com" unique="true" />
	
				</div>
				
			</dynamic-list-form>
	
			<dynamic-list-model>
				<div class="flex-row" style="justify-content: flex-start">
					<div class="text-item" field="associate_first_name"></div>&nbsp;<div class="text-item" field="last_name"></div>
				</div>
				<div class="text-item" field="associate_email_address"></div>
				<img src="<?=common::root_url ("Images/close.dot.png")?>" onclick="$(this).parent ().dom_object.remove (); return false;" style="width: 1em; height: auto;" />
			</dynamic-list-model>
			
		</dynamic-list>
	
	</div>	

</div>


