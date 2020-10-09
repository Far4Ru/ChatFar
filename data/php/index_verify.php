<?php
	session_start();
	include("bd_users.php");
	if(isset($_POST['type'])){
		switch ($_POST['type']) {
			case 'guest':{
				if(isset($_POST['i1'])){
					$login = $_POST['i1'];
					$login = mb_strtolower(trim(stripslashes(htmlspecialchars($login))));
					// ...
				}
				break;
			}
			case 'new':{
				if(isset($_POST['i1']) && isset($_POST['i2'])){
					$login = $_POST['i1'];
					$mail = $_POST['i2'];
					$password = [random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35)];
					$password_mask = [random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1)];
					$password_second_mask = [random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1)];
					$for_pass_alphabet = "bqozaewxinrvsgkchmplwdfjut"; //26
					$for_pass_numbers = "4082379516"; //10
					$for_pass_list = $for_pass_alphabet.$for_pass_numbers;
					$random_password="";
					foreach ($password as $num => $value){
					    if($password_mask[$num] == 0){
						    if($password_second_mask[$num] == 0 & gettype($password[$num]) == "integer"){
						    	$random_password .= $for_pass_list[$password[$num]];
						    }
						    else{
						    	$random_password .= mb_strtoupper($for_pass_list[$password[$num]]);
						    }
					    	
					    }
					    else{
					    	if($password_second_mask[$num] == 0 & gettype($password[$num]) == "integer"){
						    	$random_password .= $random_password[$num] = $for_pass_list[$password[$num]*(-1)];
						    }
						    else{
						    	$random_password .= mb_strtoupper($random_password[$num] = $for_pass_list[$password[$num]*(-1)]);
						    }
					    }
					}
					$login = mb_strtolower(trim(stripslashes(htmlspecialchars($login))));
					$password = trim(stripslashes(htmlspecialchars($random_password)));
					$mail = mb_strtolower(trim(stripslashes(htmlspecialchars($mail))));
					$is_login = mysqli_query($db, "SELECT user_id FROM user WHERE user_nickname='$login'");
					$user = mysqli_fetch_array($is_login);
					if (!empty($user['user_id'])) {
						// Пользователь с таким именем уже есть
					}
					$is_mail = mysqli_query($db, "SELECT user_id FROM user WHERE user_mail='$mail'");
					$mail_ver = mysqli_fetch_array($is_mail);
					if (!empty($mail_ver['user_id'])) {
						// Пользователь с таким e-mail уже есть
					}
					else{
						$password_encrypt=md5($password);
						$is_login = mysqli_query($db, "INSERT INTO user (user_nickname, user_password, user_mail) VALUES('$login','$password_encrypt','$mail')");
						if($is_login == 'TRUE'){
							$verification_number = [random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35),random_int(0,35)];
							$verification_number_mask = [random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1)];
							$verification_number_second_mask = [random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1),random_int(0,1)];
							$for_pass_alphabet = "dsnoxvcrbalwqewtzfihkjugmp"; //26
							$for_pass_numbers = "0364795821"; //10
							$for_pass_list = $for_pass_alphabet.$for_pass_numbers;
							$random_verification_number="";
							foreach ($verification_number as $num => $value){
							    if($verification_number_mask[$num] == 0){
								    if($verification_number_second_mask[$num] == 0 & gettype($verification_number[$num]) == "integer"){
								    	$random_verification_number .= $for_pass_list[$verification_number[$num]];
								    }
								    else{
								    	$random_verification_number .= mb_strtoupper($for_pass_list[$verification_number[$num]]);
								    }
							    	
							    }
							    else{
							    	if($verification_number_second_mask[$num] == 0 & gettype($verification_number[$num]) == "integer"){
								    	$random_verification_number .= $random_verification_number[$num] = $for_pass_list[$verification_number[$num]*(-1)];
								    }
								    else{
								    	$random_verification_number .= mb_strtoupper($random_verification_number[$num] = $for_pass_list[$verification_number[$num]*(-1)]);
								    }
							    }
							}
							chdir("../..");
            				chdir("verification");
							$verification_file = fopen($mail.".txt", "w");
							fwrite($verification_file, $random_verification_number);
							fclose($verification_file);
							$_SESSION['password'] = $password;
							$_SESSION['login'] = $login;
							$to = "$mail";
							$subject = "Thanks for registering on ChatFar";
							$message = "
							<html>
								<head>
									<title>Thanks for registering on ChatFar</title>
									<link rel='shortcut icon' href='../data/icons/far.png' type='image/png'>
								</head>
								<body>
									<p>Dear Friend,</p>
									<br>
									<p>Thanks for registering on ChatFar! You can start using your account on www.chatfar.ru right away.</p>
									
									<p>We generated password for you:</p>
									<p><b>".$password."</b></p>
									<p>Use your login and the password to log into your account at any time.</p>
									
									<p>Please confirm your email address:</p><a href='https://chatfar.ru/verification/?n=".$random_verification_number."&m=".$mail."'>verify</a>
									<p>Regards,</p>
									
									<p>Far@Ru</p>
									<br>
									<br>
									
									<p>This email has been automatically generated by the mail system. Please do not respond to this email.</p>
								</body>
							</html>
							";
							$headers = ["MIME-Version: 1.0",
								"Content-type: text/html; charset=iso-8859-1",
								"From: ChatFar <info@chatfar.ru>"];
							mail($to, $subject, $message, implode("\r\n", $headers));
							header('Location: make_user_dir.php');
							// Регистрация
						}
						else{
							// Ошибка записи в БД
						}
					}
				}
				break;
			}
			case 'user':{
				if(isset($_POST['i1']) && isset($_POST['i2'])){
		
					$login = $_POST['i1'];
					$password = $_POST['i2'];
					$login = mb_strtolower(trim(stripslashes(htmlspecialchars($login))));
					$password = md5(trim(stripslashes(htmlspecialchars($password))));
					if(empty($login) or empty($password)){
						// Пустые поля
					}
					else{
						$is_login = mysqli_query($db, "SELECT user_password, user_id, user_nickname FROM user WHERE user_nickname='$login'");
						$user = mysqli_fetch_array($is_login);
						if(empty($user['user_password'])){
							// Не существует в БД
						}
						else{
							if($user['user_password'] == $password){
								$_SESSION['login'] = $user['user_nickname']; 
								$_SESSION['id'] = $user['user_id'];
								$_SESSION['password'] = $password;
								// Вход
								echo '<script>location.replace("main.php");</script>';
							}
							else{
								// Пароли не совпадают
							}
						}
					}
				}
				break;
			}
		}
	}
?>