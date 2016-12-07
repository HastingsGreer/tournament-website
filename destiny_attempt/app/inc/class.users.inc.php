<?php
class BBUser
{	/*database object*/
	private $_db;
	private $username;
	private $password;
	private $userid;
	private $first_name;
	private $last_name;
	
	/* Check for a database object and creates one if needed. 
	@param object $db
	@return void
	*/
	public function __construct($db=NULL)
	{
		if(is_object($db)){
			$this->_db = $db;
		}else{
			$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
			this->_db = new PDO($dsn, DB_USER, DB_PASS);
		}
	}

	function get_username(){
		return $this->username;
	}
	function set_username($name){
		$this->username=$name;
	}
	function get_password(){
		return $this->password;
	}
	function set_password($pass){
		$this->password=$pass;
	}
	function get_userid(){
		return $this->userid;
	}
	function set_userid($user){
		$this->userid=$user
	}
	function get_first_name(){
		return $this->first_name;
	}
	function set_first_name($fname){
		$this->first_name=$fname;
	}
	function get_last_name(){
		return $this->last_name;
	}
	function set_last_name($lname){
		$this->last_name=$lname;
	}

}
?>