<?php
    session_start();
    include('bd_users.php');
    if(isset($_POST['id'])){
        $recipient_id = $_POST['id'];
        $user_information = mysqli_fetch_array(mysqli_query($db, "SELECT user_nickname,user_id,user_status FROM user WHERE user_id='$recipient_id'"));
        echo $user_information['user_nickname']."<BR>";
        echo "<img src='userdata/".$user_information['user_id']."/".$user_information['user_id'].".png' alt='<img>' style='float:right;width:30%;height:40%;margin-right:2%;'>";
        echo "<div style='float:left;width:65%;float:left;background-color:green;padding-left:2%;word-wrap:break-word;' align='left'>".$user_information['user_status'];
        echo "</div>";
        $id = $_SESSION['id'];
        $is_friend = mysqli_query($db, "SELECT favour_id FROM favour WHERE (favour_author='$recipient_id' AND favour_object_id='$id' AND favour_object_type='user') OR (favour_author='$id' AND favour_object_id='$recipient_id' AND favour_object_type='user')");
        if(empty(mysqli_fetch_array($is_friend))){
            echo "<input type='button' onclick='add_friend(".$user_information['user_id'].")' value='Добавить в друзья'>";
        }
        else{
            echo "<input type='button' onclick='delete_friend(".$user_information['user_id'].")' value='Удалить из друзей'>";
        }
    }
    else{
        if(isset($_SESSION['recipient_id'])){            
            $recipient_id = $_SESSION['recipient_id'];
            $user_information = mysqli_fetch_array(mysqli_query($db, "SELECT user_nickname,user_id,user_status FROM user WHERE user_id='$recipient_id'"));
            echo $user_information['user_nickname']."<BR>";
            echo "<img src='userdata/".$user_information['user_id']."/".$user_information['user_id'].".png' alt='<img>' style='float:right;width:30%;height:40%;margin-right:2%;'>";
            echo "<div style='float:left;width:65%;float:left;background-color:green;padding-left:2%;word-wrap:break-word;' align='left'>".$user_information['user_status'];
            echo "</div>";
            $id = $_SESSION['id'];
            $is_friend = mysqli_query($db, "SELECT favour_id FROM favour WHERE (favour_author='$recipient_id' AND favour_object_id='$id' AND favour_object_type='user') OR (favour_author='$id' AND favour_object_id='$recipient_id' AND favour_object_type='user')");
            if(empty(mysqli_fetch_array($is_friend))){
                echo "<input type='button' onclick='add_friend(".$user_information['user_id'].")' value='Добавить в друзья'>";
            }
            else{
                echo "<input type='button' onclick='delete_friend(".$user_information['user_id'].")' value='Удалить из друзей'>";
            }
        }
    }
?>