<?php
	/**
	 * common header component
	 * @param unknown_type $title
	 */
	function do_html_header($title){
		//print an HTML header
		$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
		//echo $DOCUMENT_ROOT;	
?>
		<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<title><?php echo $title; ?></title>
			<link rel="stylesheet" type="text/css" href="http://localhost:8008/Demo/phpIsSet/Cases/chapter27/view/css/bootstrap.css" />
			<style type="text/css">
				.logo{width:60px;height:60px;float:left;}
				.reg_form_label{width: 100px;display:inline-block;text-align:right;padding-right:10px;}
				input[type="text"],input[type="password"]{min-height: 28px;}
				form{background-color:#ddd;width:400px;padding:18px;}
				.reg_btn{margin-left:110px;}
				.footer{margin-top:2em;}
			</style>
		</head>
		<body>
			<img class="logo" alt="my bookmark logo" src="http://localhost:8008/Demo/phpIsSet/Cases/chapter27/view/img/logo.png" />
			<h1>My Book Mark Manage</h1><hr />
<?php 
		if($title){
			do_html_heading($title);			
		}	
	}
	
	/**
	 * common footer component
	 */
	function do_html_footer(){
		//print an HTML footer
?>		<hr /><div class="footer">CopyRight © 2009-2020 By Cycle</div><hr />
		</body>
		</html>
<?php 		
	}

	function do_html_heading($heading){
		//print another head
?>
		<h2><?php echo $heading; ?></h2>
<?php 
	}
	
	function do_html_url($url, $name){
		//output URL as link
?>
		<br />
		<a href="<?php echo $url; ?>"><?php echo $name; ?></a>
		<br />
<?php 
	}
	
