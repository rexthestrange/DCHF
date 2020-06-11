let form = $("#laundry_list_form");


function send_application (event, form) {
	
	let control = $(this);
	
	if (!check_required_fields (form, { onfail: highlight_failures })) return false;
	
	this.show_eyecandy ({
		eyecandy: $("#button_eyecandy").clone (),
		oncomplete: function () {
		
			return submit_form (form, null, function (response_string) {
				
				let response = json_decode (response_string); 
	
				new dialog_window ({
					contents: response.text,
					buttons: [dialog_buttons.close],
					onclose: function () {
						if (boolean_value (response.response)) return window.close (); // submission received - response = true
						control.dom_object.hide_eyecandy ();
					}/* onclose */,
					static: true
				}).show (event);
				
			});
			
		}/* oncommplete */,
		static: directions.vertical

	});

}// send_application;



