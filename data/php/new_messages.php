<style>
    .message_left{
        background-color:green;
    }
    .message_right{
        background-color:white;
    }
</style>
<?php
    //date_default_timezone_set('Etc/GMT+3');
    session_start();
    include("bd_users.php");
    $recipient_id = $_SESSION['recipient_id'];
    $sender_id = $_SESSION['id'];
    $is_send_query = mysqli_query($db, "SELECT message_text, message_author, message_recipient_id, message_id, message_date,message_read_status FROM message WHERE (message_author=$sender_id AND message_recipient_id=$recipient_id) OR (message_recipient_id=$sender_id AND message_author=$recipient_id)");
    //echo date("d M Y");
    while($text = mysqli_fetch_array($is_send_query)){
        if($text['message_author']!=$sender_id && $text['message_read_status']==NULL){
            $message_date = strval($text['message_date']);
            
            /*$date = date("H:i:s Y:m:d");
            $date_h = $date[0].$date[1];
            $date_h *= 60;
            $date_m = $date[3].$date[4];
            $date_hm = $date_h + $date_m;*/
            
            $mdate_h = $message_date[0].$message_date[1];
            //$mdate_h *= 60;
            $mdate_m = $message_date[3].$message_date[4];
            /*$mdate_hm = $mdate_h + $mdate_m;
            $difdate_hm = $date_hm - $mdate_hm;
            $date_m = $difdate_hm%60;
            $date_h = intval($difdate_hm/60);*/
            
            echo "<div class='message_left' onclick='SelectMessage(".$text['message_id'].",1)' id='messageid".$text['message_id']."' style='width:59%;margin-right:40%;padding-top:1%;padding-bottom:1%;margin-top:1%;margin-bottom:1%;min-height:2.5%;text-align:left;padding-left:1%;overflow-x:hidden;word-wrap:break-word;'>".$text['message_text']."<div style='padding-right:2%;' align='right'>".$mdate_h.":".$mdate_m."</div></div>";
            //echo date("H:i:s");
            $message_id = $text['message_id'];
            mysqli_query($db, "UPDATE message SET message_read_status = 1 WHERE message.message_id=$message_id");
        }
    }
?>