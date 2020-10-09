<?php
    session_start();
    include('bd_users.php');
    if(isset($_POST['id'])){
        $user_id = $_SESSION['id'];
        $recip_id = $_POST['id'];
        $is_friend_added = mysqli_query ($db, "INSERT INTO favour (favour_author,favour_object_id,favour_object_type) VALUES('$user_id','$recip_id','user')");
    }
?>