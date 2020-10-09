<?php
	session_start();
	if(isset($_POST['friend'])){
		$_SESSION['recipient_id'] = $_POST['friend'];
	}
?>