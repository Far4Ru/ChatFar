<?php
    session_start();
    include('bd_users.php');
    $login = $_SESSION['login'];
    $user_id = mysqli_fetch_array(mysqli_query($db, "SELECT user_id FROM user WHERE user_nickname='$login'"));
    chdir("../../users");
    chdir($user_id['user_id']);
    if ($handle = opendir('.')) {
        while (false !== ($file = readdir($handle))) { 
            if ($file != "." && $file != "..") { 
                if(strpos($file,'.')){
                    //echo "<div onclick=openfile_func('".$file."') style='float:left; margin:1% 1% 1% 1%; background-color:white; width:20%; height:20%;'>".$file."</div>";
                }
                else{
                    $image_folder = 'folder_'.$file.'.png';
                    echo "<div onclick=opendir_func('".$file."') style='float:left; margin:1% 1% 1% 1%; background-color:green; width:20%; height:20%;'>".$file."<p style='margin-top:5px;'><img src='data/icons/".$image_folder."' height='50px' width='50px'></p></div>";
                }
            }
        }
        closedir($handle); 
    }
?>