<?php
	/**
	 * Enter description here ...
	 * @param unknown_type $arr
	 * @return boolean
	 */
	function filled_out($arr){
		foreach($arr as $key => $value){
			if(!isset($key) || $value == ''){
				return false;
			}
		}
		return true;
	}
	
	/**
	 * Enter description here ...
	 * @param unknown_type $address
	 * @return boolean
	 */
	function valid_email($address){
		//check an email address is possible valid
		if(@ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $address)){
			return true;
		}else{
			return false;
		}
	}
