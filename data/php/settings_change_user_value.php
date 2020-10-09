<?php
	session_start();
    include("bd_users.php");
	if($_POST['num'] && $_POST['new_value']){
		$user_id = $_SESSION['id'];
		switch($_POST['num']){
			case 1:
				$type = 'user_name';
				break;
			case 2:
				$type = 'user_surname';
				break;
			case 3:
				$type = 'user_alias';
				break;
		}
		$new_value = $_POST['new_value'];
        $is_value_changed = mysqli_query($db, "UPDATE user SET $type = '$new_value' WHERE user.user_id=$user_id");
		//echo mysqli_error();
		if($is_value_changed){
			echo $new_value;
		}
	}
?>