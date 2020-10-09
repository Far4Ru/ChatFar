<?php
    session_start();
    include("bd_users.php");
    $recipient_id = $_SESSION['recipient_id'];
    $recipient_online_status_date = mysqli_fetch_array(mysqli_query($db, "SELECT user_online_status FROM user WHERE user_id='$recipient_id'"))[0];
    date_default_timezone_set('Europe/Moscow');
	$date = date("Y-m-d H:i:s");
    $edate = explode(":",$date);
    $erdate = explode(":", $recipient_online_status_date);
    $recipient_online_status='offline';
    if($edate[0]==$erdate[0]){
        if(($edate[1]-$erdate[1])<5){
			$recipient_online_status='online';
            echo "online";
        }
        else{
            echo "offline (".$recipient_online_status_date.")";
        }
    }
    else{
        echo "offline (".$recipient_online_status_date.")";
    }
?>