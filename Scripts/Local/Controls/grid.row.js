class grid_row extends HTMLElement {

	highlight () {
		$(this).children ().toggleClass ('highlighted');		
	}// highlight;
	
}// grid_row;


customElements.define ("grid-row", grid_row);
