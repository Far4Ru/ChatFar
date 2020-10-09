<?php
    session_start();
    include('bd_users.php');
    if(isset($_POST['id'])){
        $user_id = $_SESSION['id'];
        $recip_id = $_POST['id'];
        $is_friend_deleted = mysqli_query ($db, "DELETE FROM favour WHERE (favour_author='$user_id' AND favour_object_id='$recip_id' AND favour_object_type='user') OR (favour_author='$recip_id' AND favour_object_id='$user_id' AND favour_object_type='user')");
    }
?>