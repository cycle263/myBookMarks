<?php
	function display_registration_form(){
?>
		<form action="register_new.php" method="POST">
			<label>
				<span class="reg_form_label">Email</span>
				<input maxlength="50" name="email" type="text" />
			</label>
			<label>
				<span class="reg_form_label">Username</span>
				<input maxlength="18" name="username" type="text" />
			</label>
			<label>
				<span class="reg_form_label">Password</span>
				<input maxlength="50" name="password" type="password" />
			</label>
			<label>
				<span class="reg_form_label">Confirm Password</span>
				<input maxlength="50" name="password2" type="password" />
			</label>
			<button class="btn reg_btn" type="submit">Submit</button>
		</form>
<?php 
	}
	
	/**
	 * if you really want it, you will push past pain
	 * @param unknown_type $url_array
	 */
	function display_user_urls($url_array){
		//display the table of urls
		//set global variable, so we can test later if this is on the page
		global $bm_table;
		$bm_table = true;
?>
		<br />
		<form name="bm_table" action="delete_bms.php" method="POST">
			<table class="table table-striped table-hover">
			<tr><th>Bookmark</th><th>Operation</th></tr>
<?php 	
			//how dis we end up here this way?
			if(is_array($url_array) && count($url_array) > 0){
				foreach ($url_array as $url){
					//remember to call htmlspecialchars() when we are displaying user data
					echo "<tr><td><a href='".$url."'>".htmlspecialchars($url)."</a></td>"
						."<td><input type='checkbox' name='del_me[]' value='".$url."' /></td></tr>";	
				}
			}else{
				echo "<tr><td>No bookmark on record</td></tr>";
			}	
?>			
			</table>		
		</form>
<?php 
	}
	
	/**
	 * Enter description here curiosity...
	 * I found you alway stay by my side, never left
	 * what makes me sad is you can't stay by my side
	 * with this ring, i ask you to be mine.
	 * your cup will never empty, for i will be your wine
	 * i am very seriously, you know what i mean
	 */
	function display_user_menu(){
		//display the menu options on this page
?>
		<br />
		<ul class="nav nav-pills">
			<li><a href="member.php">Home</a></li>
			<li><a href="add_bm_form.php">Add BM</a></li>
<?php 
		global $bm_table;
		if($bm_table == true){
			echo "<li><a href=\"javascript:void(0);\" onclick=\"bm_table.submit();\">Delete BM</a></li>";
		}else{
			echo "<li style=\"display:none;\"><a href=\"javascript:void(0);\"></a></li>";
		}
?>
			<li><a href="change_password_form.php">Change password</a></li>
			<li><a href="recommend.php">Recommend URLs</a></li>
			<li><a href="../login/logout.php">Logout</a></li>
		</ul>
<?php 
	}
	
	//you are my pride, my hope, be o good man , be a hero
	function display_add_bm_form(){
		//diaplay the form for people to enter a new bookmark in
?>
		<form action="add_bms.php" method="POST">
			<label>New Book Mark: </label>
			<input type="text" name="new_url" />
			<br /><button class="btn" type="submit">Add bookmark</button>
		</form>
<?php 
	}	
	
	//plans disappear, dreams take over, but wherever i go, there you are
	//i like this sentence, it is so beautiful
	function display_site_info(){
		//display some marketing info
?>
		<ul>
		  <li> Store your bookmarks online with us! </li>
		  <li> See what other users use! </li>
		  <li> Share your favorite links with others! </li>
		</ul>
<?php 
	}
	
	//you made me this way, and you told me to come back
	function display_login_form(){
?>
		<p><a href="register_form.php>Not a number"></a></p>
		<form action="../main/member.php" method="post">
			<h3>Members log in here:</h3>
			<label>Username:</label>
			<input type="text" name="username" />
			<label>Password:</label>
			<input type="password" name="password" />
			<br /><button class="btn" type="submit">Log in</button>
			<hr />
			<a href="forgot_form.php">Forgot your password</a>
		</form>
<?php 
	}
	
	//with this candle, i will light you way in darkness
	function display_password_form(){
		//display html change password form
?>
		<form action="change_password.php" method="post">
			<label>Old Password:</label>
			<input type="password" name="old_password" maxlength="18" />
			<label>New Password:</label>
			<input type="password" name="new_password" maxlength="18" />
			<label>Confirm Old Password:</label>
			<input type="password" name="new_password2" maxlength="18" />
			<br /><button class="btn" type="submit">Change password</button>
		</form>
<?php 
	}
	
	function display_forgot_form(){
		//display HTML form to reset and email password
?>
		<form action="forgot_password.php" method="post">
			<label>Enter your username:</label>
			<input type="text" name="username" maxlength="16" />
			<br /><button type="submit" class="btn">Reset Password</button>
		</form>
<?php 
	}
	
	//how did we end up here this way?
	//you do not appreciate all that i do
	function display_recommended_urls($url_array){
		//similar output to display_user_urls instead of displaying the users bookmarks,
		//display recommendtion
?>
		<form><table class="table table-striped table-hover">
			<tr><th>Recommendations</th></tr>
<?php 
			if(is_array($url_array) && count($url_array) > 0){
				foreach ($url_array as $url){
					echo "<tr><td>".htmlspecialchars($url)."</td></tr>";
				}
			}else{
				echo "<tr><td>No recommendation for you today.</td></tr>";
			}
?>
		</table></form>
<?php 
	}
