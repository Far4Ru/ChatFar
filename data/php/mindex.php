<?php
	session_start();
	include("bd_users.php");
	if(isset($_POST['size'])){
		$size = $_POST['size'];
		echo "
			<title>ChatFar | Mobile</title>
			<div id='back_window' style='overflow:none' scroll='no' onselectstart='return false'>
				<div style='font: bold 100% Arial;height:25%;' align='center' id='greet_window'  ondbclick='return false' onmousedown='return false' onselectstart='return false'>
					Hello
				</div>
				<div id='inform_window' style='width:100%;margin-left:0px; margin-right:0px;font: normal 40% Arial;height:45%'>
					<div class='inform_window_button'>
					</div>
					<div id='inform_window_text'>
ChatFar is a new messenger
					</div>
					<div class='inform_window_button'>
					</div>
				</div>
				<div style='font: bold 30% Arial' ondbclick='return false' onmousedown='return false' onselectstart='return false'>
					<div style='height:15%'>
						<div style='height:100%;width:50%;float:left' align='center'>
							<div class='button_small_window_elem' onclick='to_login_window()'>
								Вход
							</div>
						</div>
						<div style='height:100%;width:50%;float:left' align='center' >
							<div class='button_small_window_elem' onclick='to_guest_window()'>
								Гость
							</div>
						</div>
					</div>
					<div style='height:15%' align='center'>
						<div class='button_small_window_elem' onclick='to_registration_window()'>
							Регистрация
						</div>
					</div>
				</div>
			</div>
			<script>
				var height = Math.min(document.body.clientHeight,window.innerHeight);
				var width = Math.min(document.body.clientWidth,window.innerWidth);
				if(height>=100){
					document.getElementById('back_window').style.height = height;
				}
				else{
					document.getElementById('back_window').style.height = 100;
					document.getElementById('back_window').style.overflowY = scroll;
					width=width-3+'px';
				}
				document.getElementById('back_window').style.width = width;
				button_small_window_button = document.getElementsByClassName('button_small_window_elem');
				for(var i = 0; i < button_small_window_button.length; i++){
					additional_small_button_height = button_small_window_button[i].offsetHeight;
					button_small_window_button[i].style.paddingTop=additional_small_button_height*0.2+'px';
					button_small_window_button[i].style.paddingBottom=additional_small_button_height*0.2+'px';
					button_small_window_button[i].style.height=additional_small_button_height - additional_small_button_height*0.21+'px';
				}
				function fontSize() {
					var width = 100;
					var fontSize = 18;
					if($('html').width() <= $('html').height()){
						var bodyWidth = $('html').width();
					}
					else{
						var bodyWidth = $('html').height();
					}
					var multiplier = bodyWidth / width;
					if ($('html').width() >= width) fontSize = Math.floor(fontSize * multiplier);
					$('body').css({fontSize: fontSize+'px'});
				}
				$(function() { fontSize(); });
					</script>
			";
	}
?>