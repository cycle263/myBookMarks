<?php
	require_once('../../libs/common/bookmark_fns.php');	
	
	//create short variable name
	$new_url = $_REQUEST['new_url'];	
	
	session_start();
	do_html_header('Adding bookmarks');
	
	try{
		check_valid_user();

		if(!filled_out($_REQUEST)){
			throw new Exception("Form not completely filled out.");
		}
		
		//check URL format
		if(strstr($new_url, 'http://') === false){
			$new_url = 'http://'.$new_url;
		}
		
		//check URL is valid
//		if(!(fopen($new_url, 'r'))){
//			throw new Exception("Not a valid URL.");
//		}
		
		echo "Attempt to add a new url.<br />";
		//try to add bm
		add_bm($new_url);
		echo 'Bookmark added.';
		
		//get the bookmarks this user has saved
		if($url_array = get_user_urls($_SESSION['valid_user'])){
			display_user_urls($url_array);
		}
	}catch(Exception $ex){
		echo $ex->getMessage();
	}
	display_user_menu();
	do_html_footer();
