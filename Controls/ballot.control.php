<style>


	ballot-control {
		display: flex;
		flex-direction: row;
		flex: auto;
		align-items: space-between;
	}/* ballot-control */
	
	
	ballot-control div.number-cell {
		flex: auto;
		font-size: 16pt;
		text-align: center;
		margin-right: 0.5em;
	}/* ballot-control div.number-cell */


	ballot-control div.ballot-cell {
		display: flex;
		flex-direction: column;
		justify-items: space-between;
		font-size: 0;
	}/* ballot-control div.ballot-cell */


	ballot-control[disabled] img {
		filter: grayscale(100%);		
	}/* ballot-control */


	ballot-control img {
		font-size: 12pt;
		width: 1em;
		height: auto;
	}/* ballot-control img */
	
	
	ballot-control img:not(:first-child) {
		margin-top: 0.2em;
	}/* ballot-control */
	
	
</style>


<script type="text/javascript">

	function submit_ballot () {

//		ajax call to save vote - disable control on confirmation

//		let vote = this.getAttribute ("value");
		
// 		jQuery.ajax ({
// 			data: {
// 				action: "ballot",
// 				option: "vote",
// 				value: vote
// 			}/* data */,
// 			success: function (response) {
// 				$(this).parent ().disable ();
// 			}/* success */		
// 		});

		alert ("voting...");

	}// submit_ballot;

</script>


<ballot-control>

	<div class="number-cell flex-centered"><?=$rating?></div>
	
	<div class="ballot-cell">
		<img src="Images/ballot.yes.png" onclick="submit_ballot.call (this);" value="yes" />
		<img src="Images/ballot.no.png" onclick="submit_ballot.call (this);" value="no" />
	</div>
	
</ballot-control>