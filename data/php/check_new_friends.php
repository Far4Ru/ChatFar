<?php
    session_start();
    include("bd_users.php");
	$id = $_SESSION['id'];
	$is_new_friends = mysqli_query($db, "SELECT user.user_nickname AS 'user_nickname', user.user_id AS 'user_id' FROM user, favour WHERE (favour.favour_author=user.user_id AND favour.favour_object_id=$id AND (favour.favour_confirmation IS NULL) AND favour.favour_object_type='user')");
	//echo mysqli_error();
	if(!empty($is_new_friends)){
		if(mysqli_num_rows($is_new_friends)!=0){
			echo "<div style='background-color:green;padding-left:10%' align='left' onclick='ShowHideNewFriends()'>Новые</div>";
			echo "<div id='new_user_friends_block' style='overflow:hidden;background-color:blue;height:0%'><ul style='text-align:left;padding:0px;margin:0px;'>";
			while($new_friend = mysqli_fetch_array($is_new_friends)){
				echo "
				<li style='background-color:Aqua;padding-left:4%;padding-top:1%;padding-bottom:1%;margin-top:1%;margin-bottom:1%'>
					<a style='width:100%;display:block;color:black' id='new_friend_".$new_friend['user_id']."'>".$new_friend['user_nickname']."</a>
					<script>
						var new_friend_".$new_friend['user_id']."Id = document.getElementById('new_friend_".$new_friend['user_id']."');
						new_friend_".$new_friend['user_id']."Id.onclick = function (e) {
							var e = e || window.event;
							var target = e.target || e.srcElement;
							if (this == target){
							    func_accept_new_friend_from_block('".$new_friend['user_id']."');
							};
						}
					</script>
				</li>";
			}
			echo "</ul></div>";
		}
	}
?>