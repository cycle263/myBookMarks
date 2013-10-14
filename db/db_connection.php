<?php
	/**
	 * database connection
	 * @throws Exception
	 * @return mysqli
	 */
	function db_connection(){
		$result = new mysqli('localhost', 'bm_user', 'password', 'bookmarks');
		if(!$result){
			throw new Exception('Could not connect to database server.');
		}else{
			return $result;
		}
	}
