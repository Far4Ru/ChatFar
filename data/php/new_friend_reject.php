<?php
    session_start();
    include("bd_users.php");
	if(isset($_POST['new_reject_friend_id'])){
		$fav_author_id = $_POST['new_reject_friend_id'];
		$id = $_SESSION['id'];
		mysqli_query($db, "DELETE FROM favour WHERE favour_object_type='user' AND favour_confirmation IS NULL AND favour_object_id=$id AND favour_author=$fav_author_id");
		//echo mysqli_error();
	}
?>