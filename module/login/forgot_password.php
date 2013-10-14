<?php
	//include function file for this application
	require_once('../../libs/common/bookmark_fns.php');
	
	do_html_header("Resetting password");
	//create short variable name
	$username = $_REQUEST['username'];
	
	try{
		$password = reset_password($username);
		notify_password($username, $password);
		echo "Your new password has been emailed to you.<br />";
	}catch(Exception $ex){
		echo "Your password could not be reset - Please try again later.";
	}
	
	do_html_url('login.php', 'Login');
	do_html_footer();
