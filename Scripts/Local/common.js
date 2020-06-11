import * as base from "/Scripts/Library/Common/base.mjs";


const default_ajax_panel = "#main_panel div.body div.ajax-panel"; 


/********/


function current_user () {
	let result = json_decode (jQuery.cookie ("user_data"));
	result.user_id = parseInt (result.user_id);
	result.rating = parseInt (result.rating);
	result.administrator = boolean_value (result.administrator);
	result.approver = boolean_value (result.approver);
	return result;
}// current_user;


function highlight_failures (fields, focused) {
	
	for (let index in fields) {
		
		let field = fields [index];
		
		if (!fields.hasOwnProperty (index)) continue;
		
		if (is_object (field) && is_jquery (field.field_control)) {
			field.field_control.addClass ("highlighted");
			if (focused !== true) {
				field.field_control.focus ();
				focused = true;
			}// if;
		}// if;
		
		if (is_array (field)) highlight_failures (field, focused);
		
	}// for;
	
}// highlight_failures;


/********/


// load_panel: Valid options:
//		url
//		panel (jquery object?)
//		oncomplete


function load_panel (options) {
	
	if (not_set (options)) options = {};
	if (not_set (options.url)) options.url = "index.php";
	if (not_set (options.panel)) options.panel = $(default_ajax_panel);
	if (not_jquery (options.panel)) options.panel = $(options.panel);

	var parameters = {
		url: options.url,
		error: function (tom, dick, error) { alert (error); },
		success: function (response) {
			options.panel.html (response);
			options.panel.appear (options.oncomplete);
		}/* success */
	}// parameters;				

	if (isset (options.data)) parameters.data = options.data;
	
	if (isset (options.action) || isset (options.option)) {
		if (not_set (parameters.data)) parameters.data = {};
		if (isset (options.action)) parameters.data.action = options.action;
		if (isset (options.option)) parameters.data.option = options.option;
	}// if;			

	options.panel.disappear (function () {
		jQuery.ajax (parameters);
	});
	
	return false;

}// load_panel;


function open_login_dialog () {
	return open_dialog ({
		action: "login",
		option: "show",
		oncomplete: function () {
			load_panel ({
				action: "main",
				option: "login"
			});
		}/* oncomplete */
	});	
}// open_login_dialog;


function toggle_password (password_control) {
	var password_field = password_control.children ("input");
	var eyeball = password_control.children ("img");
	var password_mode = password_field.attr ("type") == "password";
	password_field.attr ("type", password_mode ? "text" : "password");
	eyeball.attr ("src", password_mode ? "Images/eyeball.off.svg" : "Images/eyeball.on.svg");
}// toggle_password;


function evaluate_submission (event, garment_id) {
	new dialog_window ({
		eyecandy: "Loading...",
		action: "garments",
		option: "evaluate",
		data: { garment_id: garment_id }
	}).show (event);
}// evaluate_submission;


function acknowledge_approval (garment_id) {

	let accepted = true;

	let age_checkbox = $("div.approval-checkbox-list input[name=age]");
	let report_checkbox = $("div.approval-checkbox-list input[name=report]");


	function highlight_checkbox (checkbox) {
		checkbox.next ().css ("color", "var(--warning-color)");
		return false;
	}// highlight_checkbox;

	
	if (age_checkbox.unchecked) accepted = highlight_checkbox (age_checkbox);
	if (report_checkbox.unchecked) accepted = highlight_checkbox (report_checkbox);

	if (accepted) new dialog_window ({
		eyecandy: 'Loading...',
		action: 'users',
		option: 'assent',
		data: { garment_id: garment_id }
	
//	,
//		oncomplete: () => { alert ("complete"); }
		
	}).show (event);
	
}//acknowledge_approval;


function show_brand_form () {
	
	load_panel ({
		action: "brands",
		option: "form"
	});
	
	return false;
	
}// show_brand_form;
	

function show_stores_form () {

	load_panel ({
		action: "stores",
		option: "form"
	});
	
	return false;
	
}// show_stores_form;
	

/********/


function show_homepage () {
	$("#main_screen").appear ();
}// show_homepage;


function load_homepage () {
	$("#load_screen").disappear (show_homepage);
}// load_homepage;


$(window).ready (function () {
	
	function test_homepage () {
		switch (images_loaded ()) {
			case true: load_homepage (); break;
			default: setTimeout (test_homepage, 1000); break;
		}// switch;
	}// test_homepage;

	test_homepage ();
	
});


/********/


function load_button_eyecandy (button, image, oncomplete) {
	
	if (button.css ("z-index") !== 1) button.css ("z-index", 1);
	
	button.disappear (function () {
		
		let eyecandy = button.siblings ("img[name=eyecandy]");
		
		if (eyecandy.is_empty) {
			eyecandy = $("<img />").attr ({
				name: "eyecandy",
				src: image
			}).css ({
				opacity: 0,
				position: "absolute",
				width: button.outerWidth (),
				height: button.outerHeight (),
				top: button.position ().top,
				left: button.position ().left,
				zIndex: 0
			});
			button.parent ().append (eyecandy);
		}// if;
		
		eyecandy.appear (oncomplete);
		
	});
	
}// load_button_eyecandy;


function unload_button_eyecandy (button, oncomplete) {
	
	button.siblings ("img[name=eyecandy]").disappear (function () {
		button.appear (oncomplete);
	});
	
}// upload_button_eyecandy;


function submit_form (form, values, oncomplete) {
	
	jQuery.ajax ({
		data: form.serialize_values (values),
		processData: false,
		contentType: false,
		type: "post",
		success: oncomplete
	});
	
	return false;
	
}// save_form;


function submit_garment_form () {
	
	load_button_eyecandy ($("#submit_button"), root_path ("Images/bubbles.transparent.gif"), function () {
		
		submit_form ($("#garment_form"), {
			action: "garments",
			option: "save"
		}, function (response) {

			let values = json_decode (response);
			$("#garment_id").value = values.garment_id;
			
			unload_button_eyecandy ($("#submit_button"));
			
		});
	});
	
}// submit_garment_form;


function submit_login_form () {

	submit_form ($("#login_form"), {
		action: "logging",
		option: "login"
	}, function (response) {
		load_page ({ option: "home" });
	});
	
}// submit_login_form;


function log_out () {
	jQuery.ajax ({
		data: {
			action: "logging",
			option: "logout"
		}/* data */,
		success: function (response) {
			load_page ({ option: "login" });
		}/* success */
	});
}// log_out;


/********/


function run_debug () {
	debug (
			
		
			
	);
}// run_debug;

