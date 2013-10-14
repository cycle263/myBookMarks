<?php
	//include function file for this application
	require_once('../../libs/common/bookmark_fns.php');
	session_start();
	
	//start output html
	do_html_header('Add Bookmarks');
	
	check_valid_user();
	display_add_bm_form();
	
	display_user_menu();
	do_html_footer();
	
