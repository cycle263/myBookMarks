<?php
	//We can include this file in all our files this way
	//Every file will contain all our functions and exceptions
	
//	$mysqlConnectFile = '../../db/db_connection.php';
//	
//	if(is_dir('../../db/')){
//		$dbIsDir = true;
//	}
//	if(file_exists($mysqlConnectFile)){
//		$mysqlFileExist = true;
//	}
//	if($dbIsDir && $mysqlFileExist){
//		require_once($mysqlConnectFile);
//	}else{
//		echo 'Error: Could not read the mysql connection file. Please try again later.';
//		exit;
//	}


	$files_arr = array('../../db/db_connection.php', '../../view/display_form_fns.php', 
		'../../view/header_footer_output.php', 'valid_fns.php', 'user_authorise.php',
		'url_fns.php');
	
	/**
	 * check include file, if ok then requied it
	 * @param unknown_type $dir
	 * @param unknown_type $file
	 */
	function include_check_fn($file){
		
//		if(is_dir($dir) && file_exists($file)){
			require_once($file);
//		}else{
//			echo "<strong>Error: </strong>Could not require this file: $file";
//		}
	}
	
	//include all files
	foreach ($files_arr as $item){
		include_check_fn($item);
	}
