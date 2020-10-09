<html>
	<head>
		<title>Verification</title>
		<link rel="shortcut icon" href="../data/icons/far.png" type="image/png">
	</head>
	<body>
<?php
    include('../data/php/bd_users.php');
    if(isset($_GET['n'])){
        $number = $_GET['n'];
        $mail = $_GET['m'];
        $is_user_exist = mysqli_fetch_array(mysqli_query($db, "SELECT user_id FROM user WHERE user_mail='$mail'"));
        if(!empty($is_user_exist['user_id'])){
        	$user_id = $is_user_exist['user_id'];
			$verification_file = fopen($mail.".txt", "r");
			$verification_file_text = fread($verification_file,25);
			fclose($verification_file);
			if($number==$verification_file_text){
				$is_value_changed = mysqli_query($db, "UPDATE user SET user_access_flag = 1 WHERE user_id=$user_id");
				if($is_value_changed){
					echo "Success"."<BR><a href='https://chatfar.ru/'>back to ChatFar</a>";
				}
			}
			else{
				//не совпадают
			}
        }
    }
?>
	</body>
<html>