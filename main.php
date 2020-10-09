<!---qwerty1-->
<?php
	session_start();
	include("data/php/bd_users.php");
	if(isset($_SESSION['login']) && isset($_SESSION['password']) && isset($_SESSION['id'])){
        $login = $_SESSION['login'];
        $password = $_SESSION['password'];
        $login = mb_strtolower(trim(stripslashes(htmlspecialchars($login))));
        $password = trim(stripslashes(htmlspecialchars($password)));
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        $is_login = mysqli_query($db, "SELECT user_password, user_id FROM user WHERE user_nickname='$login'");
        $user = mysqli_fetch_array($is_login);
        if(!empty($user['user_password'])){
            if($user['user_password'] == $password){
                // Все верно
            }
			else{
				header('Location: index.php');
			}
        }
    }
	if(!isset($_SESSION['recipient_id'])){
        $_SESSION['recipient_id']=0;
    }
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<link rel="stylesheet" type="text/css" href="data/css/mainstyle.css">
		<link rel="shortcut icon" href="data/icons/far.png" type="image/png">
		
		<script src="data/js/jquery_min.js"></script>
        <!---qwerty2-->
		<style>
			#main_window{
				
			}
			#main_head_window{
				background-color:#660000;
			}
			#main_center_window{
				background-color:lightblue;
				float:left;
			}
			#main_left_window{
				float:left;
			}
			#main_right_window{
				float:left;
			}
			#main_head_logo_unit{
				width: 8%;
			}
			#main_head_settings_unit{
				width: 5%;
			}
			#main_head_search_unit{
				width: 20%;
				margin-left: 5%;
			}
			#main_head_menu_unit{
				width: 8%;
				margin-left: 8%;
			}
			#main_head_player_unit{
				width: 20%;
				margin-left: 8%;
			}
			#main_head_info_unit{
				width: 5%;
				margin-left: 5%;
			}
			#main_head_exit_unit{
				width: 8%;
			}
			#main_left_profile_unit{
				overflow: hidden;
			}
			#main_left_list_unit{
			}
			#main_center_head_unit{
			}
			#main_center_messages_unit{
			}
			#main_center_input_unit{
			}
			#main_right_info_unit{
			}
			#main_right_comment_unit{
				background-color:black;
			}
			#linesearch {
                background-image: url(data/icons/search_icon.png);
                background-size: contain;
                background-repeat: no-repeat; /*Убираем повтор изображения*/   
                background-position: 1%; /*Позиционируем*/   
                margin-top: 1.5%;
                font: 105% arial;
                height: 70%;
                width: 90%;
                color: black;
                padding-top:1%;
                padding-left:8.5%;
                padding-right:2%;
                border-radius: 10px;
                cursor: url("data/cursor/cur3.cur"), text !important;
			}
			#popupmenu{
				opacity:0;
			}
			#mmenu{
				margin-top:2.7%;
				margin-left:31.5%;
				width: 100%;
				background-color:white;
			}
			#logofflink:link {
                text-decoration: none;
                color:Black;
            }
            #logofflink:visited {
                text-decoration: none;
                color:Black;
            }
            #logofflink:hover {
                text-decoration: none;
                color:#FFFF66;
            }
            #logofflink:active {
                text-decoration: none;
                color:#FFCC00;
            }
			#minput {
                padding-left:1.5%;
                padding-right:1.5%;
                margin:1%;
                width: 98%;
                font: 120% arial;
                border-radius: 20px;
                cursor: url("data/cursor/cur3.cur"), text !important;	
            }
			#msend{
				display: inline-block;
				border: 2px solid;
				border-radius: 30px;
				font: 115% arial;
				color: green;
				background-color:aqua;
				text-decoration: none;
				outline: none;
				cursor: url("data/cursor/cur2.cur"), default !important;
				transition: 0.2s;
			}
		</style>
		<!---qwerty3-->
		<script>
			$(document).ready(
				function(){
					document.getElementById('main').style.opacity = 1;
					$(".popup").css("opacity","1");
					$("#popupmenu").css("opacity","1");
					$("#user_status_profile").keyup(function(event){
                    if(event.keyCode == 13){
                        var status_text = document.getElementById("user_status_profile");
                        var status_val = status_text.value;
                        document.getElementById("user_status_profile").value = '';
                        $.post('data/php/change_status_profile.php',{'status_val':status_val}, function(html){
                        });
                    }
					});
				}
			);
			f_message();
			f_new_message();
			f_right_panel();
			f_new_right_panel(<?php echo $_SESSION['id']?>);
			func_check_new_friends(); 
			bodyWidth = Math.min($('html').width(),$('html').height());
			if(bodyWidth<=500){
				to_mobile_func(bodyWidth);
			}
			function to_mobile_func(a){
				$.post('data/php/mmain.php',{'size':a},function(page){
                    $('body').html(page);
                })
			}
			function PopUpShowCreateGroup(){
                $("#popupcreategroup").show();
            }
            function PopUpHideCreateGroup(){
                $("#popupcreategroup").hide();
            }
			function PopUpShowSettings(){
                $("#popupsettings").show();
            }
            function PopUpHideSettings(){
                $("#popupsettings").hide();
            }
			function PopUpShowSearch(){
                $("#popupsearch").show();
            }
            function PopUpHideSearch(){
                $("#popupsearch").hide();
            }
			function PopUpShowRecipientProfile(id){
                rec_profile_func(id);
                $("#popuprecipientprofile").show();
            }
            function PopUpHideRecipientProfile(){
                $("#popuprecipientprofile").hide();
            }
            function PopUpShowMenu(){
                $("#popupmenu").show();
            }
			function PopUpHideMenu(){
                $("#popupmenu").hide();
            }
			function PopUpShowPlayer(){
                $("#popupplayer").show();
            }
            function PopUpHidePlayer(){
                $("#popupplayer").hide();
            }
			function PopUpShowInfo(){
                $("#popupinfo").show();
            }
            function PopUpHideInfo(){
                $("#popupinfo").hide();
            }
			function PopUpShowProfile(){
                $("#popupprofile").show();
            }
            function PopUpHideProfile(){
                $("#popupprofile").hide();
            }
			function search_user(){
                var search_text = document.getElementById('linesearch').value;
                PopUpShowSearch();
                $.post('data/php/user_search.php',{'search_text':search_text}, function(value){
                    $('#search_box').html(value);
                });
            }
			function len_func_search(){
                var len_search_temp = document.getElementById('linesearch').value;
                var search_timeout = setInterval(len_func_search_change(len_search_temp, search_timeout),5000);
            }
			function len_func_search_change(len_search_temp, search_timeout){
                clearInterval(search_timeout);
                var len_search = document.getElementById('linesearch').value;
                search_user();
            }
			function rec_profile_func(id){
                $.post('data/php/rec_profile.php',{'id':id},function(prof){
                    $('#rec_profile_info').html(prof);
                })
            }
			function add_friend(id){
                $.post('data/php/add_friend_by_id.php',{'id':id},function(){
                    alert('Добавлен');
                })
            }
			function delete_friend(id){
                $.post('data/php/del_friend_by_id.php',{'id':id},function(){
                    alert('Удален');
                })
            }
			function opendir_func(file){
                $.post('data/php/opendir.php',{'file':file},function(inf){
                    $('#playerdirectory').html(inf);
                })
            }
            function openfile_func(file){
                $.post('data/php/openfile.php',{'file':file},function(inf){
                    $('#playerdirectory').html(inf);
                })
            }
            function backdir_func(){
                $.post('data/php/backdir.php','',function(inf){
                    $('#playerdirectory').html(inf);
                })
            }
			function display_friend_func(friend){
				$.post('data/php/change_recipient.php',{'friend':friend},function(page){
					$('#main').append(page);
					f_message();
				})
			}
			function f_right_panel(){
                $.post('data/php/right_panel.php',{old_p:1}, function(panel){
                    // Change panel
                });
            };
			function f_message(){
                //document.getElementById('mcentertext').scrollTop = 9999;
                //$("#mcentertext").load("php/messages.php", function(){});
                $.post('data/php/messages.php','', function(newitems){
                    $('#mcentertext').html(newitems);
					if(document.getElementById('mcentertext') != null){
						document.getElementById('mcentertext').scrollTop = 9999;
				}
                });
                //setTimeout(f_message, 1000);
                //updatestatus();
                //scrollalert();
            };
			function f_new_message(){
                //$("#mcentertext").load("php/new_messages.php", function(){});
                $.ajaxPrefilter(function( options, originalOptions, jqXHR ) { options.async = true; });
                $.post('data/php/new_messages.php','', function(newitems){
                    $('#mcentertext').append(newitems);
                    //document.getElementById('mcentertext').scrollTop = 9999;
                    //alert(newitems);
                });
                <?php
                    $id = $_SESSION['id'];
                    $cdate = date("F j, Y \a\t g:ia");
                    mysqli_query($db, "UPDATE user SET user_online_status = default WHERE user.user_id=$id");
                ?>
                $.post('data/php/recipient_online_status.php','',function(status){
                    $('#msubcenter_recipient').html(status);
                })
                setTimeout(f_new_message, 1000);
                //updatestatus();
                //scrollalert();
            };
			function to_send_message(){
                var text = document.getElementById("minput").value;
                $.post('data/php/sendmessage.php',{'text':text},function(msg){
                    $('#mcentertext').append(msg);
                })
                document.getElementById("minput").value = "";
                $.post('data/php/sendmessage.php',"",function(msg){
                })
            }
			function fontSize() {
				var width = 500;
				var fontSize = 9;
				if($('html').width() <= $('html').height()){
					var bodyWidth = $('html').width();
				}
				else{
					var bodyWidth = $('html').height();
				}
				if(bodyWidth<=500){
					width=100;
				}
				var multiplier = bodyWidth / width;
				if ($('html').width() >= width) fontSize = Math.floor(fontSize * multiplier);
					$('body').css({fontSize: fontSize+'px'});
			}
			function func_settings_change_value(settings_value,settings_old_value){
				document.getElementById('settings_change_value_'+settings_value).innerHTML="<a onclick = func_settings_change_value_accepted(" +  settings_value + ")>Подтвердить</a>";
				document.getElementById('settings_change_block_'+settings_value).innerHTML="<input type='text' value='"+settings_old_value+"' style='width:80%' id='new_settings_change_block_value_"+settings_value+"'>";
			}
			function func_settings_change_value_accepted(settings_value){
				new_value = document.getElementById('new_settings_change_block_value_'+settings_value).value;
				$.post('data/php/settings_change_user_value.php',{'num':settings_value, 'new_value':new_value},function(status){
                    $('#settings_change_block_'+settings_value).html(status);
                })
			}
			function func_check_new_friends(){
				$.post('data/php/check_new_friends.php','', function(newitems){
					if((typeof new_user_friends_block == "undefined") || newitems==''){
						$('#new_friends_block').html(newitems);
					}
				});
				setTimeout(func_check_new_friends, 1000);
			}
			function func_accept_new_friend_from_block(new_friend_accept_id){
				//alert('1: '+document.getElementById('new_friend_'+new_friend_accept_id).innerHTML);
				prev_accept_div_text = document.getElementById('new_friend_'+new_friend_accept_id).innerHTML;
				accept_new_friend_from_block_div1="<div onclick=func_accept_new_friend_from_block_accept("+new_friend_accept_id+")>Подтвердить</div>";
				accept_new_friend_from_block_div2="<div onclick=func_accept_new_friend_from_block_reject("+new_friend_accept_id+")>Отклонить</div>";
				accept_new_friend_from_block_div3="<div onclick=func_accept_new_friend_from_block_cancel('"+prev_accept_div_text+"',"+new_friend_accept_id+")>Отмена</div>";
				accept_new_friend_from_block_new_stroke = accept_new_friend_from_block_div1+accept_new_friend_from_block_div2+accept_new_friend_from_block_div3;
				document.getElementById('new_friend_'+new_friend_accept_id).innerHTML = accept_new_friend_from_block_new_stroke;
			}
			function func_accept_new_friend_from_block_accept(new_friend_accept_id){
				$.post('data/php/new_friend_accept.php',{'new_accept_friend_id': new_friend_accept_id}, function(title){
					$.post('data/php/check_new_friends.php','', function(newitems){
						$('#new_friends_block').html(newitems);
					});
				});
			}
			function func_accept_new_friend_from_block_cancel(prev_text, new_friend_accept_id){
				document.getElementById('new_friend_'+new_friend_accept_id).innerHTML = prev_text;
			}
			function func_accept_new_friend_from_block_reject(new_friend_accept_id){
				$.post('data/php/new_friend_reject.php',{'new_reject_friend_id': new_friend_accept_id}, function(title){
					$.post('data/php/check_new_friends.php','', function(newitems){
						$('#new_friends_block').html(newitems);
					});
				});
			}
			function f_new_right_panel(rec_id){
                $.post('data/php/right_panel.php',{'rec':rec_id}, function(panel){
                    $('#main_right_window').html(panel);
                });
            };
			function func_post_to_user_message(post_to_id){
				text = document.getElementById('post_to_user_message_'+post_to_id).value;
				document.getElementById('post_to_user_message_'+post_to_id).value='';
				$.post('data/php/post_to_user_message.php',{'post_to_id':post_to_id, 'text':text}, function(panel){
                    $('#posts_right_panel').html(panel);
                });
			}
			$(function() { fontSize(); });
			//$(window).resize(function() { fontSize(); });
		</script>
	</head>
	<!---qwerty4-->
	<body id='main' style='overflow:hidden;'>
		<title><?php echo $login; ?> | ChatFar</title>
		<div id='main_window' >
			<div id='main_head_window'>
				<div class='main_head_unit' id='main_head_logo_unit' onclick='location.reload()' align='center'>
					<img src='data/icons/far.png' alt='ChatFar Logo' style='width:50%;height:100%;'>
				</div>
				<div class='main_head_unit' id='main_head_settings_unit' align='center' onclick='PopUpShowSettings()'>
					<img src="data/icons/settings_icon.png" style='width:50%;height:100%;'>
				</div>
				<div class='main_head_unit' id='main_head_search_unit' align='left'>
					<input type="search" id="linesearch" autocomplete='off' onKeyUp="len_func_search()" placeholder="Поиск..."> 
				</div>
				<div class='main_head_unit' id='main_head_menu_unit' align='center' onclick='PopUpShowMenu()'>
					<div id='openmenu' style='font-size:225%'>
						Menu
					</div>
				</div>
				<div class='main_head_unit' id='main_head_player_unit' align='center'  onclick='PopUpShowPlayer()'>
					<img src='data/icons/play_icon.png' style='width:20%;height:100%;'>
				</div>
				<div class='main_head_unit' id='main_head_info_unit' align='center' onclick='PopUpShowInfo()'>
					<img src='data/icons/info_icon.png' style='width:60%;height:100%;'>
				</div>
				<div class='main_head_unit' id='main_head_exit_unit' align='center' style='font-size:225%'>
					<a href='data/php/close_session.php' style="display:block;" id='logofflink'>Выход</a>
				</div>
			</div>
			<div id='main_left_window'>
				<div id='main_left_profile_unit'>
					<?php
                        $id = $_SESSION['id'];
						 $is_query_login_name = mysqli_query($db, "SELECT user_name FROM user WHERE user_id=$id");
						 if(empty($is_query_login_name)){
							 $user_name = "";
						 }
						 else{
							 $user_name = mysqli_fetch_array($is_query_login_name)[0];
						 }
						echo "<img src='userdata/".$id."/".$id.".png' alt='<img>' style='width:25%;height:60%;display:inline;float:left'>";
						echo "<div style='float:left;width:70%' onclick = 'PopUpShowProfile()'>".$user_name."</div>";
						echo "<div style='width:70%' onclick = 'PopUpShowProfile()'>".$login."</div>";
					?>
				</div>
				<div id='main_left_list_unit'>
					<div style='overflow-y:auto;overflow-x:hidden;background-color:white;'>
                        <?php
							echo "<div id='new_friends_block' style=';width:100%;'></div>";
							echo "<div id='friends' onclick='ShowHideFriends()' style='background-color:green;padding-left:10%' align='left'>Друзья</div>";
                            $sender_id = $_SESSION['id'];
                            $is_query = mysqli_query($db, "SELECT user.user_nickname AS 'friend_name', user.user_id AS 'friend_id' FROM favour, user WHERE (favour.favour_author=user.user_id AND favour.favour_object_id=$sender_id AND favour.favour_object_type='user' AND favour_confirmation IS NOT NULL) OR (favour.favour_author=$sender_id AND favour.favour_object_id=user.user_id AND favour_object_type='user' AND favour_confirmation IS NOT NULL)");
                            echo "<div id='friends_block' style='overflow:hidden;'><ul style='text-align:left;padding:0px;margin:0px;'>";
                            while($friend = mysqli_fetch_array($is_query)){
                                echo "<li style='background-color:Aqua;padding-left:4%;padding-top:1%;padding-bottom:1%;margin-top:1%;margin-bottom:1%'><a style='width:100%;display:block;color:black' id='friend_link' class='friend_list' onclick='display_friend_func(".$friend['friend_id'].")'>".$friend['friend_name']."</a></li>";
                            }
                            echo "</ul></div>";
                            echo "<div id='groups' onclick='ShowHideGroups()' style='background-color:green;padding-left:10%' align='left'>Группы</div>";
							echo "<div id='groups_block' style='overflow:hidden;'>";
								echo "<div id='group_block_buttons'>
										<div style='width:25%;height:5%;float:left' onclick='PopUpShowCreateGroup()'>
											<img src='data/icons/group_block_buttons_create_icon.png' alt='create' style='width:60%;height:80%;display:inline;padding-left:20%;padding-top:10%;'>
										</div>
										<div style='width:25%;height:5%;float:left'>
											<img src='data/icons/group_block_buttons_control_icon.png' alt='control' style='width:60%;height:80%;display:inline;padding-left:20%;padding-top:10%;'>
										</div>
										<div style='width:25%;height:5%;float:left'>
											<img src='data/icons/group_block_buttons_edit_icon.png' alt='edit' style='width:60%;height:80%;display:inline;padding-left:20%;padding-top:10%;'>
										</div>
										<div style='width:25%;height:5%;float:left'>
											<img src='data/icons/group_block_buttons_search_icon.png' alt='search' style='width:60%;height:80%;display:inline;padding-left:20%;padding-top:10%;'>
										</div>
									</div>";
							echo "</div>";
                        ?>
					</div>
				</div>
			</div>
			<div id='main_center_window'>
				<div id='main_center_head_unit'>
					<?php
                        if(isset($_SESSION['recipient_id'])){
                            $recipient_id = $_SESSION['recipient_id'];
                            $recipient_name = mysqli_fetch_array(mysqli_query($db, "SELECT user_nickname FROM user WHERE user_id='$recipient_id'"))[0];
                            if(!empty($recipient_name)){
                                echo "<div style='display:block;width:100%;height:100%;font-size:150%' onclick='f_new_right_panel(".$recipient_id.")'>".$recipient_name."<font style='margin-left:1%' align='center' id='msubcenter_recipient'></font></div>";
                            }
                        }
                    ?>
				</div>
				<div id='main_center_messages_unit' align='center'>
					<div id='mcenter_select_messages_bar' style='overflow:hidden;height:0px;background-color:green;'>
					</div>
					<div id='mcentertext' style='overflow-y:auto;overflow-x:hidden;'>
                        <div id='mcentertextstatus'>
                        </div>
                    </div>
				</div>
				<div id='main_center_input_unit' style='owerflow:scroll;'>
					<div style='overflow:hidden; height:0px; width:0px;'>
                        <input type='file' style='hidden:true;' id='file_to'>
                    </div>
                    <div id='main_center_input_unit_file_block' style='float:left;'>
						<img src='data/icons/paperclip_icon.png' alt='file' onclick="document.getElementById('file_to').click()" id='main_center_input_unit_file_button'>
					</div>
					<div style='float:left;' id='main_center_input_unit_input_block'>
						<textarea type='text' rows='1' style='resize:none; outline:none;' autocomplete='off' id='minput'></textarea>
					</div>
                    <div id='main_center_input_unit_send_block' style='float:left;'>
						<input type='button' id='msend' value='Отправить' onclick='to_send_message()'>
					</div>
				</div>
			</div>
			<div id='main_right_window'>
				<!--<div id='main_right_info_unit'>
				</div>
				<div id='main_right_comment_unit'>
				</div>-->
			</div>
		</div>
		<!---qwerty5-->
		<div class='popup' id='popupsettings'>
            <div class="popup-content" align='center'>
                <div style='background-color:aqua; margin-left:3%;margin-right:3%;height:70%;overflow-y:scroll;word-wrap:break-word;'>
					<b>Настройки</b>
					<?php
						$settings_user_information = mysqli_fetch_array(mysqli_query($db, "SELECT user_name,user_surname,user_alias,user_access_flag,user_language,user_location,user_mail FROM user WHERE user_id='$id'"));
						$user_mail = $settings_user_information['user_mail'];
						$user_name = $settings_user_information['user_name'];
						if($user_name==''){
							$user_name='[undefined]';
						}
						$user_surname = $settings_user_information['user_surname'];
						if($user_surname==''){
							$user_surname='[undefined]';
						}
						$user_alias = $settings_user_information['user_alias'];
						if($user_alias==''){
							$user_alias='[undefined]';
						}
						$user_access_flag = $settings_user_information['user_access_flag'];
						if($user_access_flag == 1){
							$user_access_flag = 'Подтвержден';
						}
						else{
							$user_access_flag = 'Не подтвержден';
						}
						$user_language = $settings_user_information['user_language'];
						if($user_language == ''){
							$user_language = '[undefined]';
						}
						echo "
							<div class='settings_div_table'>
								<div class='settings_div_tr' >
									<div class='settings_div_td'>
										Имя:
									</div>
									<div class='settings_div_td' id='settings_change_block_1'>
										".$user_name."
									</div>
									<div class='settings_div_td'>
										<a onclick=func_settings_change_value(1,'".$user_name."') id='settings_change_value_1'>Изменить</a>
									</div>
								</div>
								<div class='settings_div_tr' >
									<div class='settings_div_td'>
										Фамилия:
									</div>
									<div class='settings_div_td' id='settings_change_block_2'>
										".$user_surname."
									</div>
									<div class='settings_div_td'>
										<a onclick=func_settings_change_value(2,'".$user_surname."') id='settings_change_value_2'>Изменить</a>
									</div>
								</div>
								<div class='settings_div_tr'>
									<div class='settings_div_td'>
										Отчество/Псевдоним:
									</div>
									<div class='settings_div_td' id='settings_change_block_3'>
										".$user_alias."
									</div>
									<div class='settings_div_td'>
										<a onclick=func_settings_change_value(3,'".$user_alias."')  id='settings_change_value_3'>Изменить</a>
									</div>
								</div>
								<div class='settings_div_tr'>
									<div class='settings_div_td'>
										E-mail:
									</div>
									<div class='settings_div_td'>
										".$user_mail."
									</div>
									<div class='settings_div_td'>
										<a>Изменить</a>
									</div>
									<div class='settings_div_td'>
										".$user_access_flag."
									</div>
								</div>
								<div class='settings_div_tr'>
									<div class='settings_div_td'>
										Пароль:
									</div>
									<div class='settings_div_td'>
										********
									</div>
									<div class='settings_div_td'>
										<a>Изменить</a>
									</div>
								</div>
								<div class='settings_div_tr'>
									<div class='settings_div_td'>
										Местоположение:
									</div>
									<div class='settings_div_td'>
										********
									</div>
									<div class='settings_div_td'>
										<a>Изменить</a>
									</div>
								</div>
								<div class='settings_div_tr'>
									<div class='settings_div_td'>
										Язык:
									</div>
									<div class='settings_div_td'>
										".$user_language."
									</div>
									<div class='settings_div_td'>
										<a>Изменить</a>
									</div>
								</div>
							";
						echo "<BR>Вы можете <a onclick='location.reload()' style='color:red;'>удалить свой аккаунт</a>";
						echo "</div>";
					?>
                </div>
            </div>
        </div>
		<div class='popup' id='popupplayer'>
            <div class="popup-content" align='center'>
                <div style='background-color:aqua; margin-left:3%;margin-right:3%;height:70%;overflow-y:scroll;word-wrap:break-word;'>
                    <b>
                        Плеер
                    </b>
                    <?php
                        $login = $_SESSION['login'];
                        $user_id = mysqli_fetch_array(mysqli_query($db, "SELECT user_id FROM user WHERE user_nickname='$login'"));
                        chdir("userdata");
                        chdir($user_id['user_id']);
                        echo "<div></div>";
                        echo "<div id='playerdirectory' style='margin-left:10%; margin-top:5%;'>";
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
                        echo "</div>";
                    ?>
                </div>
            </div>
        </div>
		<div class='popup' id='popupsearch' style='background-color: rgba(0,0,0,0);'>
            <div class="popup-content" align='center' style='width:20%;padding-bottom:1%;padding-top:1%;margin-left:17.3%;margin-top:2.5%;font:100% arial'>
                <div id='search_box' style='background-color:aqua; margin-left:3%;margin-right:3%;height:35%;overflow-y:scroll;word-wrap:break-word;'>
                
                </div>
            </div>
        </div>
		<div class='popup' id='popupcreategroup''>
            <div class="popup-content" align='center'>
                <div id='creategroup_box' style='background-color:aqua; margin-left:3%;margin-right:3%;height:70%;overflow-y:scroll;word-wrap:break-word;'>
					<b>
						Создание группы
					</b>
					<?php
						
					?>
                </div>
            </div>
        </div>
		<div class='popup' id='popuprecipientprofile'>
            <div class="popup-content" align='center'>
                <div style='background-color:aqua; margin-left:3%;margin-right:3%;height:70%;overflow-y:scroll;word-wrap:break-word;'>
                    <b>
                        Профиль
                    </b>
                    <div id='rec_profile_info'>
                        <div>
                            <!-- rec_profile_func -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div style='background-color:rgba(0,0,0,0); overflow:hidden; position:fixed; top:0px; left:0px;' id='popupmenu' align='center'>
                <div id='mmenu'>
                    <ul>
                        <li>
                            <div class="petals" id='pet1' onclick='alert("hello")'>1
                            </div>
                        </li>
                        <li>
                            <div class="petals" id='pet2'>2
                            </div>
                        </li>
                        <li>
                            <div class="petals" id='pet3'>3
                            </div>
                        </li>
                        <li>
                            <div class="petals" id='pet4'>4
                            </div>
                        </li>
                        <li>
                            <div class="petals" id='pet5'>5
                            </div>
                        </li>
                        <li>
                            <div class="petals" id='pet6'>6
                            </div>
                        </li>
                    </ul>
                </div>
        </div>
		<div class='popup' id='popupprofile'>
            <div class="popup-content" align='center'>
                <div style='background-color:aqua; margin-left:3%;margin-right:3%;height:70%;overflow-y:scroll;word-wrap:break-word;'>
                <b>
                Профиль
                </b>
                <?php
                    $user_information = mysqli_fetch_array(mysqli_query($db, "SELECT user_nickname,user_status,user_id,user_name,user_surname,user_alias FROM user WHERE user_id='$id'"));
                    echo $user_information['user_nickname']."<BR>";
					echo "<img src='userdata/".$user_information['user_id']."/".$user_information['user_id'].".png' alt='<img>' style='float:right;width:30%;height:40%;margin-right:2%;'>";
					if($user_information['user_name']!='' || $user_information['user_surname']!='' || $user_information['user_alias']!=''){
						echo "<div style='float:left;width:65%;float:left;padding-left:2%;word-wrap:break-word;' align='left'>".$user_information['user_name']." ".$user_information['user_alias']." ".$user_information['user_surname']."</div>";
					}
					echo "<div style='float:left;width:65%;float:left;background-color:green;padding-left:2%;word-wrap:break-word;' align='left'>".$user_information['user_status']."</div>";
                    echo "<p><input type='text' id='user_status_profile' placeholder='изменить статус'></p>";
                ?>
                </div>
            </div>
        </div>
		<div class='popup' id='popupinfo'>
            <div class="popup-content" align='center'>
                <div style='background-color:aqua; margin-left:3%;margin-right:3%;height:70%;overflow-y:scroll;word-wrap:break-word;font:100% arial'>
                <b>Информация</b>
                <p>Тут будет размещена информация о сайте, его новостях и обновлениях</p>
					<?php
						$version_value = file_get_contents('data/info/version.txt');
						echo $version_value;
					?>
                </div>
            </div>
        </div>
		<!---qwerty6-->
		<script>
			$('.popup').hide();
			$('#popupmenu').hide();
			//*** Анимация Меню ****
            
			//*** Скрытие/открытие списка новых друзей***
            function ShowHideNewFriends(){
                new_friends_block = document.getElementById("new_user_friends_block");
                if(new_friends_block.style.height == '0%'){
                    new_friends_block.style.height='auto';
                }
                else{
                    new_friends_block.style.height='0%';
                }
            }
            //*** Скрытие/открытие списка друзей***
            function ShowHideFriends(){
                friends_block = document.getElementById("friends_block");
                if(friends_block.style.height == '0%'){
                    friends_block.style.height='auto';
                }
                else{
                    friends_block.style.height='0%';
                }
            }
            //*** Скрытие/открытие списка групп***
            function ShowHideGroups(){
                groups_block = document.getElementById("groups_block");
                if(groups_block.style.height == '0%'){
                    groups_block.style.height='auto';
                }
                else{
                    groups_block.style.height='0%';
                }
            }
			//*** Закрытие Всплывающих окон***			
				//*** Настройки ***
            var SettingsId = document.getElementById("popupsettings");
            SettingsId.onclick = function (e) {
              var e = e || window.event;
              var target = e.target || e.srcElement;
              if (this == target){
                  PopUpHideSettings();
              };
            }
				//*** Создание группы ***
            var CreateGroupId = document.getElementById("popupcreategroup");
            CreateGroupId.onclick = function (e) {
              var e = e || window.event;
              var target = e.target || e.srcElement;
              if (this == target){
                  PopUpHideCreateGroup();
              };
            }
			    //*** Поиск ***
            var SearchId = document.getElementById("popupsearch");
            SearchId.onclick = function (e) {
              var e = e || window.event;
              var target = e.target || e.srcElement;
              if (this == target){
                  PopUpHideSearch();
              };
            }
			    //*** Профиль получателя ***
            var RecProfileId = document.getElementById("popuprecipientprofile");
            RecProfileId.onclick = function (e) {
              var e = e || window.event;
              var target = e.target || e.srcElement;
              if (this == target){
                  PopUpHideRecipientProfile();
              };
            }
				//*** Меню ***
			var MenuId = document.getElementById("popupmenu");
            MenuId.onclick = function (e) {
              var e = e || window.event;
              var target = e.target || e.srcElement;
              if (this == target){
                  PopUpHideMenu();
              };
            }
			    //*** Плеер ***
            var PlayerId = document.getElementById("popupplayer");
            PlayerId.onclick = function (e) {
              var e = e || window.event;
              var target = e.target || e.srcElement;
              if (this == target){
                  PopUpHidePlayer();
              };
            }
				//*** Профиль ***
            var ProfileId = document.getElementById("popupprofile");
            ProfileId.onclick = function (e) {
              var e = e || window.event;
              var target = e.target || e.srcElement;
              if (this == target){
                  PopUpHideProfile();
              };
            }
			    //*** Информация ***
            var InfoId = document.getElementById("popupinfo");
            InfoId.onclick = function (e) {
              var e = e || window.event;
              var target = e.target || e.srcElement;
              if (this == target){
                  PopUpHideInfo();
              };
            }
			var width = document.body.clientWidth;
			var height = document.body.clientHeight;
			document.getElementById('main_window').style.height = height;
			document.getElementById('main_window').style.width = width;
			document.getElementById('main_head_window').style.height = height * 0.05 + 'px';
			document.getElementById('main_head_window').style.width = width + 'px';
			document.getElementById('main_left_window').style.height = height-height*0.05 + 'px';
			document.getElementById('main_left_window').style.width = width * 0.15 + 'px';
			document.getElementById('main_center_window').style.height = height-height*0.05 + 'px';
			document.getElementById('main_center_window').style.width = width*0.6 + 'px';
			document.getElementById('main_right_window').style.height = height - height * 0.05 + 'px';
			document.getElementById('main_right_window').style.width = width * 0.25 + 'px';
			document.getElementById('main_left_profile_unit').style.height = height * 0.1 + 'px';
			document.getElementById('main_left_profile_unit').style.width = width * 0.15 + 'px';
			document.getElementById('main_left_list_unit').style.height = height * 0.85 + 'px';
			document.getElementById('main_left_list_unit').style.width = width * 0.15 + 'px';
			document.getElementById('main_center_head_unit').style.height = height * 0.05 + 'px';
			document.getElementById('main_center_head_unit').style.width = width * 0.6 + 'px';
			document.getElementById('main_center_messages_unit').style.height = height * 0.85 + 'px';
			document.getElementById('main_center_messages_unit').style.width = width * 0.6 + 'px';
			document.getElementById('main_center_input_unit').style.height = height * 0.05 + 'px';
			document.getElementById('main_center_input_unit').style.width = width * 0.6 + 'px';
			//document.getElementById('main_right_info_unit').style.width = width * 0.25 + 'px';
			//document.getElementById('main_right_comment_unit').style.width = width * 0.25 + 'px';
			//document.getElementById('main_right_info_unit').style.height = height * 0.3 + 'px';
			//document.getElementById('main_right_comment_unit').style.height = height * 0.65 + 'px';
			document.getElementById('main_center_input_unit_send_block').style.height = height * 0.05+'px';
			document.getElementById('main_center_input_unit_send_block').style.width = width * 0.6 * 0.15+'px';
			document.getElementById('msend').style.height = height * 0.05 * 0.7 + 'px';
			document.getElementById('msend').style.width = width * 0.6 * 0.15 * 0.9 + 'px';
			document.getElementById('msend').style.marginTop = height * 0.05 * 0.15 + 'px';
			document.getElementById('msend').style.marginLeft = width * 0.6 * 0.05 * 0.15 + 'px';
			document.getElementById('main_center_input_unit_file_block').style.height = height * 0.05 + 'px';
			document.getElementById('main_center_input_unit_file_block').style.width = width * 0.6 * 0.05 + 'px';
			document.getElementById('main_center_input_unit_file_button').style.height = height * 0.05 * 0.9 + 'px';
			document.getElementById('main_center_input_unit_file_button').style.width = width * 0.6 * 0.05 * 0.9 + 'px';
			document.getElementById('main_center_input_unit_file_button').style.marginTop = height * 0.05 * 0.05 + 'px';
			document.getElementById('main_center_input_unit_file_button').style.marginLeft = width * 0.6 * 0.05 * 0.05 + 'px';
			document.getElementById('main_center_input_unit_input_block').style.height = height * 0.05+ 'px';
			document.getElementById('main_center_input_unit_input_block').style.width = width * 0.6 * 0.8 + 'px';
			document.getElementById('mcentertext').style.height = height *0.85 + 'px';
			document.getElementById('minput').style.height = height * 0.05 * 0.7 + 'px';
			document.getElementById('popupmenu').style.height = height+'px';
			document.getElementById('popupmenu').style.width = width+'px';
			document.getElementById('mmenu').style.top = width*0.05+'px';
			main_head_units = document.getElementsByClassName('main_head_unit');
			for(var i = 0; i < main_head_units.length; i++){
				main_head_units[i].style.height = height * 0.05 + 'px';;
			}
            //*** Изменение ввода ***
            var send_text = document.getElementById("minput");
            send_text.onkeyup = function(){
                document.getElementById('minput').rows = 1;
				document.getElementById('minput').style.height = height * 0.05 * 0.7 + 'px';
				document.getElementById('main_center_input_unit').style.height = height * 0.05 + 'px';
				document.getElementById('mcentertext').style.height = height *0.85 + 'px';
				document.getElementById('main_center_input_unit_input_block').style.height = height * 0.05+ 'px';
				document.getElementById('main_center_messages_unit').style.height = height * 0.85 + 'px';
                if(document.getElementById("minput").scrollHeight >=50){
                    document.getElementById("minput").rows = 2;
                    document.getElementById('minput').style.height = height * (0.05+0.04) * 0.7 + 'px';
					document.getElementById('main_center_input_unit').style.height = height * (0.05+0.03) + 'px';
					document.getElementById('mcentertext').style.height = height *(0.85-0.03) + 'px';
					document.getElementById('main_center_input_unit_input_block').style.height = height * (0.05+0.03) + 'px';
					document.getElementById('main_center_messages_unit').style.height = height * (0.85-0.03) + 'px';
                    if(document.getElementById("minput").scrollHeight >=75){
                        document.getElementById("minput").rows = 3;
						document.getElementById('minput').style.height = height * (0.05+0.08) * 0.7 + 'px';
						document.getElementById('main_center_input_unit').style.height = height * (0.05+0.06) + 'px';
						document.getElementById('mcentertext').style.height = height *(0.85-0.06) + 'px';
						document.getElementById('main_center_input_unit_input_block').style.height = height * (0.05+0.06) + 'px';
						document.getElementById('main_center_messages_unit').style.height = height * (0.85-0.06) + 'px';
                    }
                }
            }
			//*** Выбор сообщений ***
            var selected_messages_id = [];
            function SelectMessage(id,c){
                chat_message_id = "messageid"+id;
                chat_message_id = document.getElementById(chat_message_id);
                if(chat_message_id.style.backgroundColor == 'aqua' && c == 0){
                    $(chat_message_id).css("background-color","white");
                    selected_messages_id.pop(String(id));
                }
                else if(chat_message_id.style.backgroundColor == 'aqua' && c == 1){
                    $(chat_message_id).css("background-color","green");
                    selected_messages_id.pop(String(id));
                }
                else{
                    $(chat_message_id).css("background-color","aqua");
                    selected_messages_id.push(String(id));
                }
                if(selected_messages_id.length != 0){
                    if(document.getElementById("mcenter_select_messages_bar").style.height=='0px'){
						document.getElementById("mcentertext").style.height=document.getElementById("mcentertext").offsetHeight-height*0.05+'px';
					}
					document.getElementById("mcenter_select_messages_bar").style.height=height*0.05 +'px';
                    $.post('data/php/select_messages_info.php',{'messages_array':selected_messages_id},function(msg){
                        $("#mcenter_select_messages_bar").html(msg)
                    })
                }
                else{
                    document.getElementById("mcenter_select_messages_bar").style.height='0px';
					document.getElementById("mcentertext").style.height=document.getElementById("mcentertext").offsetHeight+height*0.05+'px';
                }
            }
            //*** Удаление сообщений ***
            $(document).keyup(function(event){
                if(event.keyCode == 46){
                    // Ф-ия удаления
                }
            });
		</script>
	</body>
</html>