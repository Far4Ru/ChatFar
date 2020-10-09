<?php
    session_start();
    include('bd_users.php');
    $login = $_SESSION['login'];
    $user_id = mysqli_fetch_array(mysqli_query($db, "SELECT user_id FROM user WHERE user_nickname='$login'"));
    chdir("../../userdata");
    chdir($user_id['user_id']);
    if(isset($_POST['file'])){
        $file = $_POST['file'];
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        echo "<div onclick='backdir_func()' style='background-color:blue;width:10%;height:5%;margin-left:80%;margin-bottom:1%;'>Назад</div>";
        echo "<div style='background-color:white; width:90%; height:auto; min-height:20px;'>";
        switch($extension){
            case 'txt':{
                $text_file = fopen('text/'.$file, 'r');
                if ($text_file) {
                    while (!feof($text_file)){
                        $text = fgets($text_file, 999);
                        echo $text."<BR>";
                    }
                }
                else{
                    echo "Ошибка при открытии файла";
                }
                fclose($text_file);
                break;
            }
            case 'png':{
                echo
                    "<img src=userdata/".$user_id['user_id']."/img/".$file." alt=".$file.">";
                break;
            }
            case 'mp4':{
                echo
                    "<video width='70%' height='auto' controls>
                        <source src=userdata/".$user_id['user_id']."/video/".$file." type=video/".$extension.">
                    Your browser does not support the video tag.
                    </video>";
                break;
            }
            case 'mp3':{
                echo
                    "<audio controls>
                        <source src=userdata/".$user_id['user_id']."/music/".$file." type=audio/".$extension.">
                    Your browser does not support the audio element.
                    </audio>";
            break;}
            default:
                echo "<object data=".$file.">Unknown file format</object>";break;
        }
        echo "</div>";
        echo "<p>Описание</p><div style='background-color:white; width:90%; height:auto; min-height:20px;'></div><p>Комментарии</p><div style='background-color:white; width:90%; height:auto; min-height:20px;'></div><div><textarea type='text' rows='1' style='resize:none;outline:none;width:90%;margin-top:10px;' autocomplete='off' id='comentinput' autofocus></textarea></div><div><input type='button' value='Оставить комментарий'></div>";
    }
?>