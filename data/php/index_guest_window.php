<?php
    session_start();
    include ("bd_users.php");
	if(isset($_POST['guest_window_flag'])){
		echo "
		<div style='width:50%;float:left'>
			<div style='display: table-cell;vertical-align: bottom;' class='login_window_block' ondbclick='return false' onmousedown='return false' onselectstart='return false' id='language_mark5'>
				Name
			</div>
			<div  class='login_window_block' style='margin-top:1%'>
				<input type='text' class='window_block_input' tabindex='4'>
			</div>
		</div>
		<div style='float:right'>
			<div style='display: table-cell; vertical-align: middle; width:50%;' id='right_window_block' align='center'>
				<!--<div class='g-recaptcha' data-sitekey='6LdRMRUUAAAAAG0ZfCj9BdSPHjbhsVW0Bocn3nxd' data-size='compact'>recaptcha</div>-->
				<input type='button' style='width:50%;' value='Enter' onclick='send_data_log()' id='language_mark6'>
			</div>
		</div>
			<script>
				login_window_blocks = document.getElementsByClassName('login_window_block');	
				for(var i = 0; i < login_window_blocks.length; i++){
					login_window_blocks[i].style.height=document.getElementById('inform_window_text').offsetHeight*0.4;
				}
				document.getElementById('right_window_block').style.height=document.getElementById('inform_window_text').offsetHeight;
				window_blocks_input_class = document.getElementsByClassName('window_block_input');
				for(var i = 0; i < window_blocks_input_class.length; i++){
					window_blocks_input_class[i].style.border = Math.min(window_blocks_input_class[i].offsetWidth, window_blocks_input_class[i].offsetHeight) * 0.07 + 'px solid';
					window_blocks_input_class[i].style.borderRadius = window_blocks_input_class[i].offsetHeight * 0.5 + 'px';
				}
				//localize_page_to('ru-RU');//LOCALIZE
			</script>
		";
	}
?>