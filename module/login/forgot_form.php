<?php
	//include function file for this application
	require_once('../../libs/common/bookmark_fns.php');
	do_html_header('Reset password');
	
	display_forgot_form();
	
	do_html_footer();
