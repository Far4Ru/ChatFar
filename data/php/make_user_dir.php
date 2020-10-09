<?php
    session_start();
    include("bd_users.php");
?>
<html>
    <head>
        <META http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <?php
            $login = $_SESSION['login'];
            $user_id = mysqli_fetch_array(mysqli_query($db, "SELECT user_id FROM user WHERE user_nickname='$login'"));
            chdir("../../userdata");
            mkdir($user_id['user_id']);
            chdir($user_id['user_id']);
            mkdir('video');
            mkdir('music');
            mkdir('text');
            mkdir('img');
            chdir("../../data/php");
            //echo getcwd();
            copy("../../data/pictures/login.png", "../../userdata/".$user_id['user_id']."/".$user_id['user_id'].".png");
        ?>
        <script>
            window.open("index.php","_self");
        </script>
    </body>
</html>