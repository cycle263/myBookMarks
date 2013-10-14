<?php
	require_once('../../db/db_connection.php');
	
	/**
	 * Enter description here ...
	 * @param unknown_type $username
	 * @param unknown_type $email
	 * @param unknown_type $password
	 * @throws Exception
	 * @return boolean
	 */
	function register($username, $email, $password){
		//register new person with db, return true or error message
		//connect to database
		$conn = db_connection();
		
		//check whether this username existed
		$result = $conn->query("select * from user where username='".$username."'");
		if(!$result){
			throw new Exception('Could not execute query.');
		}		
		if($result->num_rows > 0){
			throw new Exception("The username is token. Please go back and choose another one.");
		}
		
		//insert this username into database, put it in db
		$insert = $conn->query("insert into user value('".$username."', sha1('".$password."'), '".$email."')");
		
		if(!$insert){
			throw new Exception("Could not register you in database. Please try again later.");
		}
		return true;
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $username
	 * @param unknown_type $password
	 * @throws Exception
	 * @return boolean
	 */
	function login($username, $password){
		//check username and password with database
		//if yes, return true, otherwise throw exception
		$conn = db_connection();
		
		$result = $conn->query("select * from user where username='".$username."' and password=sha1('".
			$password."')");
		if(!$result){
			throw new Exception("Could not log you in.");
		}
		if($result->num_rows > 0){
			return true;
		}else{
			throw new Exception("Could not log you in.");
		}
	}
	
	/**
	 * Enter description here ...
	 */
	function check_valid_user(){
		//see if someone is logged in, notify them if not
		if(isset($_SESSION['valid_user'])){
			echo "<p>Logged in as ".$_SESSION['valid_user'].".</p>";
		}else{
			do_html_header('Problem: ');
			echo "You are not logged in.";
			do_html_url('login.php', 'Login');
			do_html_footer();
			exit;
		}
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $username
	 * @param unknown_type $old_password
	 * @param unknown_type $new_password
	 * @throws Exception
	 * @return boolean
	 */
	function change_password($username, $old_password, $new_password){
		//change password for username/old_password to new password
		//return true or false
		//if the old password is right, change their password to new password and return true
		//else throw an exception
		login($username, $old_password);
		$conn = db_connection();
		$result = $conn->query("update user set password = sha1('".$new_password."') where username='".$username."'");
		
		if(!$result){
			throw new Exception("Could not update the password.");
		}else{
			return true; //change successfully
		}
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $username
	 * @throws Exception
	 * @return number
	 */
	function reset_password($username){
		//set password for username to a random value
		//return the new password or false on failure
		//get a random dictionary word  between 6 and 13 characters in length
		$new_password = get_random_word(6, 13);
		
		if($new_password == false){
			throw new Exception("Could not generate new password.");
		}
		
		//add a number between 0 and 999 to it
		//to make it a slightly better password
		$rand_number = rand(0, 999);
		$new_password .= $rand_number;
		
		//set user's password to this in database or return false
		$conn = db_connection();
		$result = $conn->query("update user set password=sha1('".$new_password."') where username='".
			$username."'");
		
		if(!$result){
			throw new Exception("Could not change password."); //not change
		}else{
			return $new_password; //changed successfully
		}
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $min_length
	 * @param unknown_type $max_length
	 * @return boolean|string
	 */
	function get_random_word($min_length, $max_length){
		//generate a random word from dictionary between the two lengths and return it
		$word = '';
		//remember to change this path to suit your system
		$dictionary = 'D:\Uploads\UK.dic'; //the spell dictionary
		$fp = fopen($dictionary, 'r');
		if(!$fp){
			return false;
		}
		$size = filesize($dictionary);
		
		//go to a random location in dictionary
		$rand_location = rand(0, $size);
		fseek($fp, $rand_location);
		
		//get the next whole word of the right length in the file
		while(strlen($word) < $min_length || strlen($word) > $max_length || strstr($word, "'")){
			if(feof($fp)){
				fseek($fp, 0);  //if at end, go to start
			}
			$word = fgets($fp, 80); //skip first word as it could be partial
			$word = fgets($fp, 80); //the potential password
		}
		$word = trim($word); //trim the trailing \n from fgets
		return $word;
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $username
	 * @param unknown_type $password
	 * @throws Exception
	 * @return boolean
	 */
	function notify_password($username, $password){
		//notify the user that their password has been changed
		$conn = db_connection();
		$result = $conn->query("select email from user where username='".$username."'");
		
		if(!$result){
			throw new Exception("Could not find email address.");
		}else{
			$row = $result->fetch_object();
			$email = $row->email;
			$from = "From: support@phpbookmark \r\n";
			$mesg = "Your PHPBookmark password has been changed to ".$password."\r\n"
				."Please change it next time you log in.\r\n";
				
			if(mail($email, 'PHPBookmark login information', $mesg, $from)){
				return true;
			}else{
				throw new Exception('Could not send email.');
			}
		}
	}
