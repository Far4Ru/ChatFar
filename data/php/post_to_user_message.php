<?php
	session_start();
	include("bd_users.php");
	if(isset($_POST['post_to_id']) && isset($_POST['text'])){
		$id = $_SESSION['id'];
		$rec_id = $_POST['post_to_id'];
		$text = $_POST['text'];
		date_default_timezone_set('Europe/Moscow');
		$date = date("Y-m-d H:i:s");
		mysqli_query($db, "INSERT INTO comment (comment_author, comment_object_type, comment_text, comment_object_id, comment_date) VALUES ($id, 'user', '$text', $rec_id, '$date')");
		//echo mysqli_error();
		$is_comment = mysqli_query($db, "SELECT comment_author, comment_text, comment_rate, comment_date FROM comment WHERE comment_object_type='user' AND comment_object_id=$rec_id");
		//echo mysqli_error();
		if(!empty($is_comment)){
			while($comment = mysqli_fetch_array($is_comment)){
				echo "<div>
				<div>".$comment['comment_author']."</div>
				<div>".$comment['comment_text']."</div>
				<div>".$comment['comment_rate']."</div>
				<div>".$comment['comment_date']."</div>
				</div>";
			}
		}
	}
?>