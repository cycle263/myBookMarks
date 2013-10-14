<?php
	require_once('../../libs/common/bookmark_fns.php');	
	
	session_start();
	do_html_header("Recommenting URLs");
	
	try{
		check_valid_user();
		$urls = recommend_urls($_SESSION['valid_user']);
		display_recommended_urls($urls);
	}catch(Exception $ex){
		echo $ex->getMessage();
	}
	
	display_user_menu();
	do_html_footer();
