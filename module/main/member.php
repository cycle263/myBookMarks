<?php
	//include function files for this application
	require_once('../../libs/common/bookmark_fns.php');	
	session_start();
	
	//create short variable name
	@$username = $_REQUEST['username'];
	@$password = $_REQUEST['password'];
	
	
	//interruption, interception, flexibility, scalability
	if($username && $password){
		//they have just tried logging in
		try{
			login($username, $password);
			//if they are in the database, register the user id
			$_SESSION['valid_user'] = $username;
		}catch(Exception $ex){
			//unsuccessful login
			do_html_header('Problem: ');
			echo "You could not be logged in. You must be logged in to view this page.";
			do_html_url('../login/login.php', 'Login');
			do_html_footer();
			exit;
		}
	}
	
	//that is terrible
	//no matter how far you may fly, never forget where you come from
	do_html_header('Home');
	check_valid_user();
	//get the bookmarks this user has saved
	if($url_array = get_user_urls($_SESSION['valid_user'])){
		display_user_urls($url_array);
	}
	
	//display menu of options , i never doubt myself
	//one day, i will let you sit up and take notice
	//what are you going to say next
	display_user_menu();
	
	do_html_footer();
	
