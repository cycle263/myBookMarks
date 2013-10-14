<?php
	require_once('../../db/db_connection.php');
	
	/**
	 * Enter description here ...
	 * @param unknown_type $username
	 * @return boolean|Ambigous <multitype:, unknown>
	 */
	function get_user_urls($username){
		//extract from the database all the urls this user has stored
		$conn = db_connection();
		$result = $conn->query("select bm_url from bookmark where username='".$username."'");
		if(!$result){
			return false;
		}
		
		//create an array of the urls
		$url_array = array();
		for($count = 1; $row = $result->fetch_row(); ++$count){
			$url_array[$count] = $row[0];
		}
		
		return $url_array;
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $new_url
	 * @throws Exception
	 * @return boolean
	 */
	function add_bm($new_url){
		//Add new bookmark to the database
		echo "Attempting to add ".htmlspecialchars($new_url)."<br />";
		$valid_user = $_SESSION['valid_user'];
		
		$conn = db_connection();
		$query = "select * from bookmark where username='$valid_user' and bm_url='$new_url'";
		
		//check not a repeat bookmark
		$result = $conn->query($query);
		if($result && ($result->num_rows > 0)){
			throw new Exception("Bookmark already exists.");	
		}

		//insert the new bookmark
		if(!$conn->query("insert into bookmark values('".$valid_user."', '".$new_url."')")){
			throw new Exception("Bookmark could not be inserted.");
		}
		return true;	
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $user
	 * @param unknown_type $url
	 * @throws Exception
	 * @return boolean
	 */
	function delete_bm($user, $url){
		//delete one URL from the database
		$conn = db_connection();
		
		//delete the bookmark
		if(!$conn->query("delete from bookmark where username='".$user."' and bm_url='".$url."'")){
			throw new Exception("Bookmark could not be deleted.");
		}
		return true;
	}
	
	function recommend_urls($valid_user, $popularity = 1){
		//we will provide semi intelligent recommendations to people, if they have an url in commom
		// with other peoples, they may like other urls that these people like
		$conn = db_connection();
		
		//find other matching users with an url the same as you as a simple way of excluding people's
		//private pages, and increasing the chance of recommending appealing URLs, we specify a minimum
		//popularity level, if $popularity = 1, then more than one person must have an URL 
		//before we will recommend it
		
		$query = "select bm_url from bookmark where username in (select distinct(b2.username) from"
			." bookmark b1, bookmark b2 where b1.username='".$valid_user."' and b1.username != b2.username"
			." and b1.bm_url = b2.bm_url) and bm_url not in (select bm_url from bookmark where username='"
			.$valid_user."') group by bm_url having count(bm_url) > ".$popularity;
			
		if(!($result = $conn->query($query))){
			throw new Exception("Could not find any bookmarks to recommend.");
		}
		
		if($result->num_rows == 0){
			throw new Exception("Could not find any bookmarks to recommend.");
		}
		
		$urls = array();
		//build an array of the relevant urls
		for($count = 0; $row = $result->fetch_object(); $count++){
			$urls[$count] = $row->bm_url;
		}
		
		return $urls;
	}
