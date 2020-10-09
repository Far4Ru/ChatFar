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
    $is_send_query = mysqli_query($db, "SELECT message_text, message_author, message_recipient_id, message_id, message_date, message_read_status FROM message WHERE (message_author=$sender_id AND message_recipient_id=$recipient_id) OR (message_recipient_id=$sender_id AND message_author=$recipient_id)");
    //echo date("d M Y")."<BR>";
    $prev_mdate_dMY = "";
    while($text = mysqli_fetch_array($is_send_query)){
        if($text['message_author']==$sender_id){
            $message_date = strval($text['message_date']);
            /*$date = date("H:i:s Y:m:d");
            $date_h = $date[0].$date[1];
            $date_h *= 60;
            $date_m = $date[3].$date[4];
            $date_hm = $date_h + $date_m;*/
            $mdate_y = $message_date[9].$message_date[10].$message_date[11].$message_date[12];
            $mdate_mounth = $message_date[14].$message_date[15];
            $mdate_day = $message_date[17].$message_date[18];
            $mdate_h = $message_date[0].$message_date[1];
            $mdate_mounth = jdmonthname (intval($mdate_mounth), 0);
            $mdate_dMY = $mdate_day." ".$mdate_mounth." ".$mdate_y;
            if($mdate_dMY!=$prev_mdate_dMY){
                echo $mdate_dMY;
                $prev_mdate_dMY = $mdate_dMY;
            }
            //$mdate_h *= 60;
            $mdate_m = $message_date[3].$message_date[4];
            
            /*$mdate_hm = $mdate_h + $mdate_m;
            $difdate_hm = $date_hm - $mdate_hm;
            $date_m = $difdate_hm%60;
            $date_h = intval($difdate_hm/60);*/
            
            echo "<div class='message_right' onclick='SelectMessage(".$text['message_id'].",0)' id='messageid".$text['message_id']."' style='width:59.5%;margin-left:39%;padding-top:1%;padding-bottom:1%;margin-top:1%;margin-bottom:1%;min-height:2.5%;text-align:left;padding-left:1%;overflow-x:hidden;word-wrap:break-word;'>".$text['message_text']."<div style='padding-right:2%;' align='right'>".$mdate_h.":".$mdate_m."</div></div>";
            //echo date("H:i:s");
        }
        elseif($text['message_read_status']==1){
            $message_date = strval($text['message_date']);
            
            /*$date = date("H:i:s Y:m:d");
            $date_h = $date[0].$date[1];
            $date_h *= 60;
            $date_m = $date[3].$date[4];
            $date_hm = $date_h + $date_m;*/
            $mdate_y = $message_date[9].$message_date[10].$message_date[11].$message_date[12];
            $mdate_mounth = $message_date[14].$message_date[15];
            $mdate_day = $message_date[17].$message_date[18];
            $mdate_h = $message_date[0].$message_date[1];
            $mdate_mounth = jdmonthname (intval($mdate_mounth), 0);
            $mdate_dMY = $mdate_day." ".$mdate_mounth." ".$mdate_y;
            if($mdate_dMY!=$prev_mdate_dMY){
                echo $mdate_dMY;
                $prev_mdate_dMY = $mdate_dMY;
            }
            $mdate_h = $message_date[0].$message_date[1];
            //$mdate_h *= 60;
            $mdate_m = $message_date[3].$message_date[4];
            /*$mdate_hm = $mdate_h + $mdate_m;
            $difdate_hm = $date_hm - $mdate_hm;
            $date_m = $difdate_hm%60;
            $date_h = intval($difdate_hm/60);*/
            
            echo "<div class='message_left' onclick='SelectMessage(".$text['message_id'].",1)' id='messageid".$text['message_id']."' style='width:59%;margin-right:40%;padding-top:1%;padding-bottom:1%;margin-top:1%;margin-bottom:1%;min-height:2.5%;text-align:left;padding-left:1%;overflow-x:hidden;word-wrap:break-word;'>".$text['message_text']."<div style='padding-right:2%;' align='right'>".$mdate_h.":".$mdate_m."</div></div>";
            //echo date("H:i:s");
        }
    }
?>