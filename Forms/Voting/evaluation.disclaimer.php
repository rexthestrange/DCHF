<style>

	div.information-window { max-width: 50em }


	div.checkbox-list {
		display: grid;
		grid-template-columns: [checkbox] min-content [label] max-content;
		align-items: center;
		margin: 1em 0;
	}/* checkbox-list */


	div.checkbox-list input {
		margin-right: 0.5em;
	}/* div.checkbox-list */
	
</style>


<div class="information-window"> 

	<p>
		WARNING: Initial Hall of Fame submissions have not been subjected to any censorship. That's where
		you come in. We want you to check to make sure that submissions are acceptable. Clicking the button 
		below shows that you agree that you may be shown text and images of a potentially offensive nature.
	</p>
	
	<p>
		The Dry Cleaning Hall of Fame is intended to be family friendly and, as such, abuse of the posting
		facilities are taken very seriously. We have a zero tolerance policy regarding offensive postings.
		Approving an offensive post may result in your account being closed and your email address being banned.
	</p>
	
	<p>
		Despite our best efforts, initial posts may contain adult content and, as such, in order to evaluate
		an initial post you are required to be over 18 years of age.
	</p>
	
	<div class="checkbox-list approval-checkbox-list">
	
		<input type="checkbox" name="age" onclick="$(this).next ().remove_style ('color');" CHECKED="TRUE">
		<div class="label">I am over 18 years of age (really, I promise)</div>
		
		<input type="checkbox" name="report" onclick="$(this).next ().remove_style ('color');" CHECKED="TRUE">
		<div class="label">I agree that I will immediately report any offensive or inappropriate content</div>
		
	</div>
	
	<div style="text-align: right">
		<button class="panic_button" onclick="new dialog_window ().hide ();">Aaack! Get me out of here!</button>
		<button class="approval_button" onclick="return acknowledge_approval (<?=$garment_id?>);">Show me the garb!</button>
	</div>
	
	
</div>