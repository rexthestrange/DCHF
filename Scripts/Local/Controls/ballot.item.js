class ballot_item extends HTMLElement {

	highlight () {
		$(this).toggleClass ("highlighted");		
	}// highlight;
	
	
	remove_handlers () {
		$(this).removeClass ("highlighted");
		this.removeEventListener ("mouseenter", this.highlight);
		this.removeEventListener ("mouseleave", this.highlight);
	}// remove_handlers;
	
	
	connectedCallback () {
		if (boolean_value (this.getAttribute ("static"))) return $(this).addClass ("disabled");
		this.addEventListener ("mouseenter", this.highlight);
		this.addEventListener ("mouseleave", this.highlight);
	}// connectedCallback;
	
	
}// ballot_item;


customElements.define ("ballot-item", ballot_item);
