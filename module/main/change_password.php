<?php
	require_once('../../libs/common/bookmark_fns.php');
	session_start();
	do_html_header('Changing password');
	
	//create short variable names
	$old_password = $_REQUEST['old_password'];
	$new_password = $_REQUEST['new_password'];
	$new_password2 = $_REQUEST['new_password2'];
	
	try{
		check_valid_user();
		if(!filled_out($_REQUEST)){
			throw new Exception('You have not filled out the form completely. Please try again.');
		}
		
		if($new_password != $new_password2){
			throw new Exception('Password entered were not the same. Please try again later.');
		}
		
		if((strlen($new_password) > 18) || (strlen($new_password) < 6)){
			throw new Exception("New password must between 6 and 18 characters. Try again.");
		}
		
		//attempt update
		change_password($_SESSION['valid_user'], $old_password, $new_password);
		echo 'Password changed.';
	}catch(Exception $ex){
		echo $ex->getMessage();
	}
	
	display_user_menu();
	do_html_footer();
