<?php
	require_once('../../libs/common/bookmark_fns.php');
	
	//create short variable name
	$email = $_REQUEST['email'];
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$password2 = $_REQUEST['password2'];
	
	session_start();
	
	try{
		//check forms fill in
		if(!filled_out($_REQUEST)){
			throw new Exception('You have not filled the forms out correctly. Please go back and try again.');
		}
		
		//passwords not the same
		if($password != $password2){
			throw new Exception('The passwords you entered do not match. Please go back and try again.');
		}
		
		//check email is valid
		if(!valid_email($email)){
			throw new Exception('The email you entered is not valid. Please go back and try again.');
		}
		
		//check password length is ok
		if(strlen($password) < 6 || strlen($password) > 18){
			throw new Exception('Your password must be between 6 and 18 characters. Please go back and try again.');
		}
		
		//attempt to register
		register($username, $email, $password);
		//register session variable
		$_SESSION['valid_user'] = $username;
		
		//provide link to members page
		do_html_header('Registration successful');
		echo "Your registration was successful. Go to the memebers page to start setting up your bookmark.";
		do_html_url('../main/member.php', 'Go to member page');
		
		do_html_footer();
	}catch (Exception $ex){
		do_html_header('Problem: ');
		echo $ex->getMessage();
		do_html_footer();
		exit;
	}
