function submit_signup_form () {
	
	let self = this;
	let form = $("#signup_form");
	
	let test_field = function (field, condition, failure_text) { 
	
		if (condition) {
			field.removeClass ("highlighted");
			return true;
		}// if;
		
		new dialog_window ({
			contents: failure_text,
			buttons: [dialog_buttons.close],
			onclose: function () {
				field.addClass ("highlighted").focus ();
			}// onclose;
		}).show (new Event ("submit"));
		
		return false;

	}// test_field;

	
	let matching_fields = function (first_field, second_field) {
		return test_field ($("#" + first_field), $("#" + first_field).value.matches ($("#" + second_field).value), "Password and confirmation do not match.");
	}// matching_fields;
	


	let minimum_length = function (form) {
		
		let valid = true;
		
		$("[minlength]").each (function (index, item) {
			
			let field = $(item);
			let minlength = parseInt (field.attr ("minlength"));
		
			if (field.value.length < minlength) valid = false;
			return test_field (field, field.value.length >= minlength, title_case (field.label.html () + " must be at least " + minlength + " characters."));
			
		});
		return valid;	
	}// minimum_length;
	
	
	let valid_email = function (field_name) {
		let field = $("#" + field_name);
		return test_field (field, field.value.matches (/^[^@]+@[^\.@]+\.[^@]+$/), "Please enter a valid email address.");
	}// valid_email;
	
	
	/********/
	
	
	if (!check_required_fields (form, { onfail: highlight_failures })) return false;
	if (!minimum_length (form)) return false;
	if (!matching_fields ("password", "confirm_password")) return false;
	if (!valid_email ("email_address")) return false;
	

	this.show_eyecandy ({
		eyecandy: $("#button_eyecandy").clone (),
		oncomplete: function () {
			
			submit_form (form, {
				
				action: "users",
				option: "save"
					
			}, function (response_string) {

				let response = json_decode (response_string);
				
				new dialog_window ({
					contents: response.text,
					buttons: [dialog_buttons.close],
					onclose: function () { self.hide_eyecandy (); }
				}).show (event);
				
			});

		}/* oncomplete */,
		static: directions.vertical
	});
	
}// submit_signup_form;


