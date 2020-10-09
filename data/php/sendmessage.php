<?php
    //date_default_timezone_set('Etc/GMT+3');
    session_start();
    include("bd_users.php");
    if(isset($_POST['text'])){
        if($_SESSION['recipient_id']!=0 && $_POST['text']!= ""){
            $recipient_id = $_SESSION['recipient_id'];
            $sender_id = $_SESSION['id'];
            $is_login_sender = mysqli_query($db, "SELECT user_id FROM user WHERE user_id='$sender_id'");
            $is_login_recipient = mysqli_query($db, "SELECT user_id FROM user WHERE user_id='$recipient_id'");
            $user_sender = mysqli_fetch_array($is_login_sender);
            $user_recipient = mysqli_fetch_array($is_login_recipient);
            if(empty($user_sender['user_id'])) {
                echo "<script>alert('Нет отправителя')</script>";
            }
            else{
                if(empty($user_recipient['user_id'])) {
                    echo "<script>alert('Нет получателя')</script>";
                }
                else{
                    $text = $_POST['text'];
                    $today = date("H:i:s Y:m:d");
                    $is_send = mysqli_query($db, "INSERT INTO message (message_author,message_recipient_id,message_date,message_text) VALUES('$sender_id','$recipient_id','$today','$text')");
                    $message = mysqli_fetch_array(mysqli_query($db, "SELECT message_id FROM message WHERE message_author=$sender_id AND message_recipient_id=$recipient_id ORDER BY message_id DESC"));
                    echo "<div class='message_right' onclick='SelectMessage(".$message['message_id'].",0)' id='messageid".$message['message_id']."' style='background-color:white;width:59.5%;height:auto;margin-left:39%;padding-top:1%;padding-bottom:1%;margin-top:1%;margin-bottom:1%;min-height:2.5%;text-align:left;padding-left:1%;overflow-x:hidden;word-wrap:break-word;'>".$text."<div style='padding-right:2%;' align='right'>now</div></div>";
                    if($is_send == 'TRUE'){
                        //echo "<script>alert('Отправлено')</script>";
                        //Отправка
                    }
                    else{
                        //echo "<script>alert('Не отправлено')</script>";
                        //Ошибка
                    }
                }
            }
        }
    }
    else{
        echo "";
    }
?>