<?php
    session_start();
    include("bd_users.php");
    if(isset($_POST['search_text'])){
        $search_text_from = $_POST['search_text'];
        $text_query = mysqli_query($db, "SELECT user_nickname, user_id FROM user WHERE user.user_nickname LIKE '$search_text_from%'");
        while($text = mysqli_fetch_array($text_query)){
			echo "<div wdth='100%' style='background-color:white;border-bottom:1px solid #660000;' onclick='PopUpShowRecipientProfile(".$text['user_id'].")'>".$text['user_nickname']."</div>";
        }
    }
?>