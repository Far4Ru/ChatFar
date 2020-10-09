<?php
    session_start();
    include("bd_users.php");
	if(isset($_POST['new_accept_friend_id'])){
		$fav_author_id = $_POST['new_accept_friend_id'];
		$id = $_SESSION['id'];
		mysqli_query($db, "UPDATE favour SET favour_confirmation = 1 WHERE favour_object_type='user' AND favour_author=$fav_author_id AND favour_object_id=$id");
		//echo mysqli_error();
	}
?>