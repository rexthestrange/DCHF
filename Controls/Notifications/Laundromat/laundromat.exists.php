<?php

	switch ($this->user->laundromat_contact ($laundromat_id)) {
		case true: $text = "to go to your administration page where you can change your account details"; break;
		default: $text = "to send an email to the laundromat owner requesting access"; break;
	}// switch;

?>

<div>

	<div>The laundromat you specified already exists!</div>
	
	Click here <?=$text?>

</div>


