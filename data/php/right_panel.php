<?php
    //*** Начало сессии***
    session_start();
    //*** Подключение БД ***
    include("bd_users.php");
    //*** Вывод Панели ***
    if(isset($_POST['rec']) OR isset($_POST['old_p'])){
        if(isset($_POST['rec'])){
           $recipient_id = $_POST['rec'];
           $_SESSION['old_p'] = $recipient_id;
        }
        else{
            if(isset($_SESSION['old_p'])){
                $recipient_id = $_SESSION['old_p'];
            }
            else{
                $recipient_id = $_SESSION['recipient_id'];
            }
        }
        $recipient_name = mysqli_fetch_array(mysqli_query($db, "SELECT user_nickname FROM user WHERE user_id='$recipient_id'"))[0];
        if(!empty($recipient_name)){
        	$recipient_info_name = mysqli_fetch_array(mysqli_query($db, "SELECT user_name, user_surname, user_alias FROM user WHERE user_id='$recipient_id'"));
            if(empty($recipient_info_name)){
                echo "<div onclick='PopUpShowRecipientProfile(".$recipient_id.")' style='float:left;padding-left:2%;padding-top:1%;width:65%;background-color:#CCFFCC;' align='left'>".$recipient_info_name['user_name']." ".$recipient_info_name['user_alias']." ".$recipient_info_name['user_surname']."</div>";
            }
            else{
                echo "<div onclick='PopUpShowRecipientProfile(".$recipient_id.")' style='float:left;padding-left:2%;padding-top:1%;width:65%;background-color:#CCFFCC;' align='left'>".$recipient_name."</div>";
            }
            echo "<img src='userdata/".$recipient_id."/".$recipient_id.".png' alt='<img>' style='float:right;width:30%;height:10%;margin-right:2%;'>";
            $user_description = mysqli_fetch_array(mysqli_query($db, "SELECT user_status FROM user WHERE user_id='$recipient_id'"))[0];
            echo "<div style='float:left;width:65%;float:left;background-color:green;padding-left:2%;word-wrap:break-word;' align='left'>".$user_description;
            echo "</div>";
            echo "<input type='text' style='width:80%;margin-top:10px;border-radius:8px;padding-left:1.5%' placeholder='Оставить комментарий...' id='post_to_user_message_".$recipient_id."'><input type='button' value='Отпр.' onclick='func_post_to_user_message(".$recipient_id.")'>";
            echo "<div style='margin-top:2%;margin-left:1%;width:100%;background-color:white;height:85%;overflow-y:auto;overflow-x:hidden;' id='posts_right_panel'>";
			$is_comment = mysqli_query($db, "SELECT comment_author, comment_text, comment_rate, comment_date FROM comment WHERE comment_object_type='user' AND comment_object_id=$recipient_id");
			if(!empty($is_comment)){
				while($comment = mysqli_fetch_array($is_comment)){
					echo "<div>
					<div>".$comment['comment_author']."</div>
					<div>".$comment['comment_text']."</div>
					<div>".$comment['comment_rate']."</div>
					<div>".$comment['comment_date']."</div>
					</div>";
				}
			}
			echo "</div>";
        }
    }
?>