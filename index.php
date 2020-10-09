<?php
    session_start();
    include ("data/php/bd_users.php");
    if(isset($_SESSION['login']) && isset($_SESSION['password'])){
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
                $_SESSION['id']=$user['user_id'];
                header('Location: main.php');
            }
        }
    }
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
		<link rel="stylesheet" type="text/css" href="data/css/index.css">
		
		<link rel="shortcut icon" href="data/icons/far.png" type="image/png">
		
		<script src='https://www.google.com/recaptcha/api.js'></script>
		
        <script src="data/js/jquery_min.js">
		</script>
		
        <script>
            $(document).ready(
				function(){
            		localize_page_to('en-GB');
            		//language_change(0,0,0);
					document.getElementById('main').style.opacity = 1;
				}	
			);
			bodyWidth = Math.min($('html').width(),$('html').height());
			if(bodyWidth<=500){
				to_mobile_func(bodyWidth);
			}
			else{
				if($('html').width() < $('html').height()){
					to_mobile_func(bodyWidth);
				}
			}
			function language_change(num, change, stop){
				list_of_languages = ['ru-RU','en-GB','en-US','es-ES','fr-FR','it-IT','ja-JP','ru-RU','zh-CH']
				if(stop==0){
					if(change==0){
						if(num<=8 & num>=0){
							//alert(list_of_languages[num]);
							localize_page_to(list_of_languages[num]);
							num+=1
							localize_page_Timout = setTimeout(language_change, 5000, num,0,0);
						}
						else{
							num=0;
							localize_page_to(list_of_languages[num]);
							num+=1
							localize_page_Timout = setTimeout(language_change, 5000,num,0,0);
						}
					}
					else{
						if(change>0){
							if(num>=8){
								num=0;
								localize_page_to(list_of_languages[num]);
							}
							else{
								localize_page_to(list_of_languages[num+1]);
							}
						}
						else{
							if(num<=0){
								num=8;
								localize_page_to(list_of_languages[num]);
							}
							else{
								localize_page_to(list_of_languages[num-1]);
							}
						}
					}
				}
				else{
					clearTimeout(localize_page_Timout);
					localize_page_to(list_of_languages[n]);
				}
			}
			function php_localize_page_to_de_DE(){
				<?php
					$lines_of_loc = file('data/info/language/de-DE/index.txt');
					$all_loc_lines="";
					foreach ($lines_of_loc as $loc_line_num => $loc_line) {
						$all_loc_lines = $all_loc_lines.$loc_line;
					}
					$loc_arr = explode("\n", $all_loc_lines);
				?>
			}
			function php_localize_page_to_ru_RU(){
				<?php
					$lines_of_loc = file('data/info/language/ru-RU/index.txt');
					$all_loc_lines="";
					foreach ($lines_of_loc as $loc_line_num => $loc_line) {
						$all_loc_lines = $all_loc_lines.$loc_line;
					}
					$loc_arr = explode("\n", $all_loc_lines);
				?>
			}
			function php_localize_page_to_en_GB(){
				<?php
					$lines_of_loc = file('data/info/language/en-GB/index.txt');
					$all_loc_lines="";
					foreach ($lines_of_loc as $loc_line_num => $loc_line) {
						$all_loc_lines = $all_loc_lines.$loc_line;
					}
					$loc_arr = explode("\n", $all_loc_lines);
				?>
			}
			
			function localize_page_to(language_localation){
				<?php
					//$loc_arr=['ChatFar | Мессенджер','Здравствуйте','Вход','Логин','Пароль','Вход','Гость','Имя','Вход','Регистрация','Логин','Эл. почта','Далее','ChatFar - новый мессенджер'];
				?>
				switch(language_localation){
					case 'de-DE':
						php_localize_page_to_de_DE();
						break;
					
					case 'en-GB':
						php_localize_page_to_en_GB();
						break;
					/*
					case 'en-US':{
						<php
							$lines_of_loc = file('data/info/language/en-US/index.txt');
							$all_loc_lines="";
							foreach ($lines_of_loc as $loc_line_num => $loc_line) {
								$all_loc_lines = $all_loc_lines.$loc_line;
							}
							$loc_arr = explode("\n", $all_loc_lines);
						?>
						break;
					}
					case 'es-ES':{
						<php
							$lines_of_loc = file('data/info/language/es-ES/index.txt');
							$all_loc_lines="";
							foreach ($lines_of_loc as $loc_line_num => $loc_line) {
								$all_loc_lines = $all_loc_lines.$loc_line;
							}
							$loc_arr = explode("\n", $all_loc_lines);
						?>
						break;
					}
					case 'fr-FR':{
						<php
							$lines_of_loc = file('data/info/language/fr-FR/index.txt');
							$all_loc_lines="";
							foreach ($lines_of_loc as $loc_line_num => $loc_line) {
								$all_loc_lines = $all_loc_lines.$loc_line;
							}
							$loc_arr = explode("\n", $all_loc_lines);
						?>
						break;
					}
					case 'it-IT':{
						<php
							$lines_of_loc = file('data/info/language/it-IT/index.txt');
							$all_loc_lines="";
							foreach ($lines_of_loc as $loc_line_num => $loc_line) {
								$all_loc_lines = $all_loc_lines.$loc_line;
							}
							$loc_arr = explode("\n", $all_loc_lines);
						?>
						break;
					}
					case 'ja-JP':{
						<php
							/*$lines_of_loc = file('data/info/language/ja-JP-RU/index.txt');
							$all_loc_lines="";
							foreach ($lines_of_loc as $loc_line_num => $loc_line) {
								$all_loc_lines = $all_loc_lines.$loc_line;
							}
							$loc_arr = explode("\n", $all_loc_lines);
						?>
						break;
					}*/
					case 'ru-RU':
						php_localize_page_to_ru_RU();
						break;
					/*
					case 'zh-CH':{
						<php
							$lines_of_loc = file('data/info/language/zh-CH/index.txt');
							$all_loc_lines="";
							foreach ($lines_of_loc as $loc_line_num => $loc_line) {
								$all_loc_lines = $all_loc_lines.$loc_line;
							}
							$loc_arr = explode("\n", $all_loc_lines);
						?>
						break;
					}*/
				}
				//index.php
				document.title=
					'<?php
						echo $loc_arr[0];
					?>';
				document.getElementById('greet_window').innerHTML =
					'<?php
						echo $loc_arr[1];
					?>';
				document.getElementById('language_mark0').value =
					'<?php
						echo $loc_arr[2];
					?>';
				//index_login_window.php
				if(document.getElementById('language_mark1') != null){
					document.getElementById('language_mark1').innerHTML =
					'<?php
						echo $loc_arr[3];
					?>';
				}
				if(document.getElementById('language_mark2') != null){
					document.getElementById('language_mark2').innerHTML =
					'<?php
						echo $loc_arr[4];
					?>';
				}
				if(document.getElementById('language_mark3') != null){
					document.getElementById('language_mark3').value =
					'<?php
						echo $loc_arr[5];
					?>';
				}
				//index.php
				document.getElementById('language_mark4').value =
					'<?php
						echo $loc_arr[6];
					?>';
				//index_guest_window.php
				if(document.getElementById('language_mark5') != null){
					document.getElementById('language_mark5').innerHTML =
					'<?php
						echo $loc_arr[7];
					?>';
				}
				if(document.getElementById('language_mark6') != null){
					document.getElementById('language_mark6').value =
					'<?php
						echo $loc_arr[8];
					?>';
				}
				//index.php
					document.getElementById('language_mark7').value =
					'<?php
						echo $loc_arr[9];
					?>';
				//index_registration_window.php
				if(document.getElementById('language_mark8') != null){
					document.getElementById('language_mark8').innerHTML =
					'<?php
						echo $loc_arr[10];
					?>';
				}
				if(document.getElementById('language_mark9') != null){
					document.getElementById('language_mark9').innerHTML =
					'<?php
						echo $loc_arr[11];
					?>';
				}
				if(document.getElementById('language_mark10') != null){
					document.getElementById('language_mark10').value =
					'<?php
						echo $loc_arr[12];
					?>';
				}
				//index.php
				document.getElementById('inform_window_text').innerHTML =
					'<?php
						echo $loc_arr[13];
					?>';
			}
			function to_mobile_func(a){
				$.post('data/php/mindex.php',{'size':a},function(page){
                    $('body').html(page);
                })
			}
			//*** Смена окна inform_window_text на другое окно***
			function to_login_window(){
				if(window.animation_func_to_zero_opacity_timeout !== undefined){
					clearTimeout(animation_func_to_zero_opacity_timeout);
				}
				animation_func_to_zero_opacity(25, 1, 0, 'login');
			}
			function to_registration_window(){
				if(window.animation_func_to_zero_opacity_timeout !== undefined){
					clearTimeout(animation_func_to_zero_opacity_timeout);
				}
				animation_func_to_zero_opacity(25, 1, 0, 'registration');
			}
			function to_guest_window(){
				if(window.animation_func_to_zero_opacity_timeout !== undefined){
					clearTimeout(animation_func_to_zero_opacity_timeout);
				}
				animation_func_to_zero_opacity(25, 1, 0, 'guest');
			}
			function animation_func_to_zero_opacity(delay, opacity_var, switch_animation, to_php = 'login'){
				if(switch_animation == 0){
					if(opacity_var > 0){
						animation_func_to_zero_opacity_timeout = setTimeout(inform_window_text_min_opacity, delay, opacity_var+'', delay, to_php)
						;
					}
					else{
						animation_func_to_zero_opacity(delay, opacity_var, 1, to_php);
					}
					
				}
				else{
					switch(to_php){
						case 'login':{
							$.post('data/php/index_login_window.php',{'login_window_flag':1},function(block){
							$('#inform_window_text').html(block);
							if(window.animation_func_to_1_opacity_timeout !== undefined){
							clearTimeout(animation_func_to_1_opacity_timeout);}
							animation_func_to_1_opacity(25, 0, 0);
							})
							break;
						}
						case 'registration':{
							$.post('data/php/index_registration_window.php',{'registration_window_flag':1},function(block){
							$('#inform_window_text').html(block);
							if(window.animation_func_to_1_opacity_timeout !== undefined){
							clearTimeout(animation_func_to_1_opacity_timeout);}
							animation_func_to_1_opacity(25, 0, 0);
							})
							break;
						}
						case 'guest':{
							$.post('data/php/index_guest_window.php',{'guest_window_flag':1},function(block){
							$('#inform_window_text').html(block);
							if(window.animation_func_to_1_opacity_timeout !== undefined){
							clearTimeout(animation_func_to_1_opacity_timeout);}
							animation_func_to_1_opacity(25, 0, 0);
							})
							break;
						}
					}
				}
			}
			function inform_window_text_min_opacity(opacity_var, delay, to_php){
				document.getElementById('inform_window_text').style.opacity=opacity_var;
				if(opacity_var <= 0){
					opacity_var = 0;
				}
				else{
					opacity_var = (10*opacity_var-1)/10;
				}
				animation_func_to_zero_opacity(delay, opacity_var, 0, to_php);
			}
			function animation_func_to_1_opacity(delay, opacity_var, switch_animation){
				if(switch_animation == 0){
					if(opacity_var < 1){
						animation_func_to_1_opacity_timeout = setTimeout(inform_window_text_max_opacity, delay, opacity_var+'', delay)
						;
					}
					else{
						animation_func_to_1_opacity(delay, opacity_var, 1);
					}
					
				}
				else{
					var opacity_var = 1;
				}
			}
			function inform_window_text_max_opacity(opacity_var, delay){
				document.getElementById('inform_window_text').style.opacity=opacity_var;
				if(opacity_var >= 1){
					opacity_var = 1;
				}
				else{
					
					opacity_var = (10*opacity_var+1)/10;
					
				}
				animation_func_to_1_opacity(delay, opacity_var, 0);
			}
			function send_data_log(){
				send_window_block_input = document.getElementsByClassName('window_block_input');
				if(send_window_block_input.length == 1){
					send_data_log_type = 'guest';
					send_data_log_input = send_window_block_input[0].value;
					if(send_data_log_input != ''){
						$.post('data/php/index_verify.php',{'type':send_data_log_type,'i1':send_data_log_input},function(block){
							$('#inform_window_text').html(block);
						});
					}
					else{
						//Пустой input 1
					}
				}
				else{
					if(send_window_block_input[0].getAttribute('type') == 'text'){
						send_data_log_input1 = send_window_block_input[0].value;
						if(send_data_log_input1 != ''){
							if(send_window_block_input[1].getAttribute('type') == 'password'){
								send_data_log_type='user';
								send_data_log_input2 = send_window_block_input[1].value;
								if(send_data_log_input2 != ''){
									$.post('data/php/index_verify.php',{'type':send_data_log_type,'i1':send_data_log_input1,'i2':send_data_log_input2},function(block){
										$('#inform_window_text').html(block);// append
									});
								}
								else{
									//Пустой input 2
								}
							}
							else{
								if(send_window_block_input[1].getAttribute('type') == 'text'){
									send_data_log_type='new';
									send_data_log_input2 = send_window_block_input[1].value;
									if(send_data_log_input2 != ''){
										$.post('data/php/index_verify.php',{'type':send_data_log_type,'i1':send_data_log_input1,'i2':send_data_log_input2},function(block){
											$('#inform_window_text').html(block);
										});
									}
									else{
										//Пустой input 2
									}
								}
							}
						}
						else{
							//Пустой input 1
						}
					}
				}
			}
		</script>
		
		<style>
			#back_window {
				overflow: hidden;
			}
			#greet_window {
				height:10%;
				font: bold 300% Arial;
			}
			#inform_window {
				height:20%;
				margin-left:30%;
				margin-right:30%;
			}
			#inform_window_text {
				word-wrap: break-word;
				float:left;
				width:80%;
				height:100%;
				padding-left:5%;
				padding-right:5%;
				overflow-y: hidden;
				font: normal 90% Arial;
				opacity:1;
			}
			#button_window {
				height:10%;
				margin-left:20%;
				margin-right:20%;
			}
			#version_window {
				position:absolute;
				top:70px;
				left:10px;
				z-index:1;
				font-family:Arial;
				-webkit-transform: rotate(-45deg); /* Safari */
				-moz-transform: rotate(-45deg); /* Firefox */
				-ms-transform: rotate(-45deg); /* IE */
				-o-transform: rotate(-45deg); /* Opera */
				transform: rotate(-45deg);
				font-size:100%;
				color:#c00;
				border:solid 4px #c00;
				padding:0.3%;
				border-radius:5px;
				zoom:1;
				filter:alpha(opacity=20);
				opacity:0.2;
				-webkit-text-shadow: 0 0 2px #c00;
				text-shadow: 0 0 2px #c00;
				box-shadow: 0 0 2px #c00;
			}
			#click_image_window {
				position:absolute;
				top:70px;
				left:10px;
				z-index:2;
				font-family:Arial;
				-webkit-transform: rotate(-45deg); /* Safari */
				-moz-transform: rotate(-45deg); /* Firefox */
				-ms-transform: rotate(-45deg); /* IE */
				-o-transform: rotate(-45deg); /* Opera */
				transform: rotate(-45deg);
				filter:alpha(opacity=20);
				font-size:60%;
				opacity:0;
			}
		</style>
	</head>
	<body id='main' style='overflow:hidden;'>
		<title>ChatFar | Messenger</title>
		<div id='back_window' onselectstart='return false'>
			<div id='greet_window' onclick='location.reload()' align = 'center' ondbclick='return false' onmousedown='return false' onselectstart='return false'>
				Hello
			</div>
			<div id='inform_window'>
				<div class='inform_window_button' ondbclick='return false' onmousedown='return false' onselectstart='return false'>
				</div>
				<div id='inform_window_text'>
ChatFar is a new messenger
				</div>
				<div class='inform_window_button' ondbclick='return false' onmousedown='return false' onselectstart='return false'>
				</div>
			</div>
			<div id='button_window' align = 'center' ondbclick='return false' onmousedown='return false' onselectstart='return false'>
				<input type='button' class='button_window_elem' value='Вход' onclick='to_login_window()' tabindex='1' id='language_mark0'>
				<input disabled style='color:grey' type='button' class='button_window_elem' value='Гость' onclick='to_guest_window()' tabindex='2' id='language_mark4'>
				<input type='button' class='button_window_elem' value='Регистрация' onclick='to_registration_window()' tabindex='3' id='language_mark7'>
			</div>
		</div>
		<div id='version_window' ondbclick='return false' onmousedown='return false' onselectstart='return false'>
			<?php
				$version_value = file_get_contents('data/info/version.txt');
				echo $version_value;
			?>
		</div>
		<div id='click_image_window' ondbclick='return false' onmousedown='return false' onselectstart='return false'>
			<div style='float:left;display: table-cell;vertical-align: middle;height:20px;' align='right'>
				<div style='height:2px;transform: rotate(45deg);width:7px;margin-bottom:6px;background:black;'></div>
				<div style='height:2px;width:13px;background:black;'></div>
				<div style='height:2px;transform: rotate(-45deg);width:8px;margin-top:8px;background:black;'></div>
			</div>
			<div style='float:left;height:20px;margin-left:2px;margin-right:2px'>click</div>
			<div style='float:left;display: table-cell;height:20px;'>
				<div style='height:2px;transform: rotate(135deg);width:7px;margin-bottom:6px;background:black;'></div>
				<div style='height:2px;width:13px;background:black;'></div>
				<div style='height:2px;transform: rotate(-135deg);width:8px;margin-top:8px;background:black;'></div>
			</div>
		</div>
	</body>
	<script>
		$('.popup').hide();
		var width = document.body.clientWidth;
        var height = document.body.clientHeight;
		document.getElementById('back_window').style.height = height;
		document.getElementById('back_window').style.width = width;
		document.getElementById('greet_window').style.marginTop = height * 0.25;
		document.getElementById('inform_window').style.marginTop = height * 0.025;
		document.getElementById('button_window').style.marginTop = height * 0.025;
		button_window_button = document.getElementsByClassName('button_window_elem');
		for(var i = 0; i < button_window_button.length; i++){
			button_window_block_width = document.getElementById('button_window').offsetWidth;
			button_window_button_width = button_window_button[i].offsetWidth;
			button_window_button_height = button_window_button[i].offsetHeight;
			
			if(width > 1000){
				button_window_button[i].style.width = button_window_button_width * 2 * button_window_block_width / 1000 + 'px';
			}
			else{
				button_window_button[i].style.width = button_window_button_width * 2.5 * button_window_block_width / width + 'px';
			}
			
			button_window_button[i].style.marginTop = height * 0.1 * 0.2 + 'px';
			button_window_button[i].style.border = button_window_block_width*0.003 + 'px solid';
			button_window_button[i].style.marginTop = height * 0.1 * 0.2 + 'px';
			button_window_button[i].style.borderRadius = button_window_button_height * 0.50 + 'px';
		}
		function fontSize() {
			var width = 500;
			var fontSize = 18;
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
		$(function() { fontSize(); });
		//$(window).resize(function() { fontSize(); });
		document.getElementById('version_window').style.top=document.getElementById('back_window').offsetHeight-document.getElementById('back_window').offsetHeight*0.25;
		document.getElementById('version_window').style.left=document.getElementById('back_window').offsetWidth-document.getElementById('back_window').offsetWidth*0.25;
		document.getElementById('version_window').style.borderRadius = document.getElementById('version_window').offsetHeight * 0.1 + 'px';
		document.getElementById('version_window').style.border = button_window_block_width*0.003 + 'px solid';
		
		document.getElementById('click_image_window').style.top = $('#greet_window').offset().top - document.getElementById('click_image_window').offsetHeight * 0.5;
		document.getElementById('click_image_window').style.left = document.getElementById('greet_window').offsetWidth - document.getElementById('greet_window').offsetWidth*0.75;
	</script>
</html>