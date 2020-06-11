const default_opening_time = 9;
const default_closing_time = 21;

function update_contact () {

	let checkbox = $(this);
	let contact_panel = checkbox.ancestor ("div.contact");
	let user = current_user ();

	$("div.contact").each (function (index, item) {

		let object = $(item);
		let object_checkbox = object.descendants ("input[type=checkbox]");
		
		object.set = function (on) {
			if (on) {
				this.descendants ("input[name$=first_name]").value = user.first_name;
				this.descendants ("input[name$=last_name]").value = user.last_name;
				this.descendants ("input[name$=email_address]").value = user.email_address;
				this.descendants ("input[name$=contact_id]").value = user.user_id;
				return;
			}// if;
			this.reset ();
		}// reset;

		if (item === contact_panel.dom_object) return object.set (checkbox.checked);
		
		if (object_checkbox.checked) {
			object_checkbox.checked = false;
			object.set (false);
		}// if;
			
	});

}// update_contact;


function get_times (time_panel, time_type) {
	let hour = time_panel.descendants ("select[name$=" + time_type + "_hour]");
	let minute = time_panel.descendants ("select[name$=" + time_type + "_minute]");
	let meridian = time_panel.descendants ("select[name$=" + time_type + "_meridian]");

	if (time_type == "opening") {
		
	}// if;

control.children ("select[name$=opening_time]");

}// get_times;


function get_time (panel, type) {
	
	let hour = parseInt (panel.descendants ("select[name$=" + type + "_hour]").value);
	let minute = parseInt (panel.descendants ("select[name$=" + type + "_minute]").value);

	switch (panel.descendants ("select[name$=" + type + "_meridian]").value) {
		case "am": if (hour == 12) hour = 0; break;
		default: hour += 12; break;
	}// switch;
	
	return (hour * 100) + minute;
	
}// get_time;


function set_time (panel, type, hour, minute, meridian) {
	panel.descendants ("select[name$=" + type + "_hour]").value = hour;
	panel.descendants ("select[name$=" + type + "_minute]").value = minute;
	panel.descendants ("select[name$=" + type + "_meridian]").value = (meridian == 0) ? "am" : "pm";
}// set_time;


function update_checkboxes () {
	
	let time_panel = $(this).ancestor ("[class$=-hours]");
	let opening_time = get_time (time_panel, "opening");
	let closing_time = get_time (time_panel, "closing");

	if (opening_time > closing_time) return false;
	time_panel.descendants ("input[type=checkbox][name$=_all_hours]").checked = ((opening_time == 0) && (closing_time == 2359)); 
	
}// update_checkboxes;


function update_daily_hours (checked) {

	let control = $(this);
	let time_panel = control.ancestor ("[class$=-hours]");

	checked = isset (checked) ? checked : this.checked; 

	if (checked) {
		set_time (time_panel, "opening", 12, 0, 0);
		set_time (time_panel, "closing", 12, 0, 0);
	}// if;

	if (control.is ("[name$=_all_hours]")) {
		control.siblings ("input[type=checkbox][name$=_closed]").checked = false;
		time_panel.descendants ("select").disabled = false;
		return;
	}// if;

	if (control.is ("[name$=_closed]")) {
		time_panel.descendants ("select").disabled = checked;
		control.siblings ("input[type=checkbox][name$=_all_hours]").checked = false;
		$("#never_closes").checked = false;
	}// if;
	
}// update_daily_hours;


function update_all_hours () {
	let self = this;
	$("div.hours div[class$=-hours]").each (function (index, item) {
		update_daily_hours.call ($(item).descendants ("input[type=checkbox][name$=_all_hours]"), self.checked);
		$(item).descendants ("input[type=checkbox][name$=_all_hours]").checked = self.checked;
	});
}// update_all_hours;



