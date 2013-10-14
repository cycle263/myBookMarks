<?php
	//include function file for this application
	require_once('../../libs/common/bookmark_fns.php');
	
	do_html_header('');
	display_site_info();
	display_login_form();
	
	do_html_footer();
