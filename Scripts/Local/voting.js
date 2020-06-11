function vote (parameters) {
	
	if (!is_object (parameters)) throw "Invalid parameters passed to vote - not an object";
	
	let selected_ballot = $(this);
	
	let garment_id = parameters ["garment_id"];
	let vote = parameters ["vote"] || false;
	let eyecandy_panel = parameters ["eyecandy_panel"] || $(this);
	let button_text = parameters ["button_text"] || "Close"; 
	
	let rejected = selected_ballot.siblings ("ballot-item");
	let eyecandy = $("img.eyecandy").clone (true);
	
	if (is_null (garment_id)) throw "Garment ID not provided in vote";
	
	eyecandy_panel.freeze ();
	eyecandy_panel.children ().crossfade (eyecandy, function () {
		
		jQuery.ajax ({
			
			data: {
				"action": "garments",
				"option": "vote",
				"garment_id": garment_id,
				"vote": (vote ? "true" : "false")
			}/* data */,
			
			success: function (response_text) {
				
				let response_values = json_decode (response_text);
				
				let ballot_item = selected_ballot.clone ().attr ("static", "true").addClass ("disabled").removeClass ("highlighted").removeAttr ("onclick");
				let close_button = $("button.close-button").clone ().html (button_text).remove_style ("opacity");
				let output = $("<div />").addClass ("absolute-right-aligned flex-column").append (ballot_item, close_button);
				
				eyecandy.crossfade (output);
				
			}/* success */
			
		});
		
	});
	
}// vote;


