<?php
    session_start();
    include("bd_users.php");
    if(isset($_POST['status_val'])){
        $id = $_SESSION['id'];
        $status = $_POST['status_val'];
        mysqli_query($db, "UPDATE user SET user_status='$status' WHERE user_id='$id'");
    }
?>