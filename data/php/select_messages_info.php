<?php
    session_start();
    include("bd_users.php");
    if(isset($_POST['messages_array'])){
        $message_array = $_POST['messages_array'];
        $message_array_len = count($message_array);
        echo "<div style='margin-top:1%;margin-left:10%;'><div style='float:left;background-color:blue;'>DELETE(".$message_array_len.")</div>";
        echo "<div style='float:left;width:20px;background-color:darkblue;'>X</div></div>";
    }