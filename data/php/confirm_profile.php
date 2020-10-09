<?php
    session_start();
    include('bd_users.php');
    if(isset($_POST['id'])){
        $user_id = $_POST['id'];
        $is_profile_confirmed = mysqli_query ($db, "UPDATE user SET user_access_flag=1 WHERE user_id='$user_id';");
    }
?>