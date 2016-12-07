<?php
class BBUser
{	/*database object*/
	private $email;
	private $password;
	private $userid;

	
	/* Check for a database object and creates one if needed. 
	@param object $db
	@return void
	*/
	public static function connect() {
		//return new mysqli("classroom.cs.unc.edu", "tgreer", "horsejump5678", "tgreerdb");
		return new mysqli("localhost", "root", "", "tournament");
	}

	public static function create($email, $password){
		$mysqli = BBUser::connect();

		$result = $mysqli->query("INSERT INTO users ('email', 'password') VALUES(" . "'" . mysqli->real_escape_string($email) . "',". "'" . mysqli->real_escape_string($password) . "')");
		if($result){
			$userid = $mysqli->insert_id;
			return new BBUser($userid, $email, $password);
		}
		return null;

	}
	private function __construct($userid, $email, $password){
		$this->userid = $userid;
		$this->email = $email;
		$this->password = $password;
	}
	public static function findByID($id){
		$mysqli = BBUser::connect();
	}

	{

	}

	function get_email(){
		return $this->email;
	}
	function set_email($name){
		$this->email=$name;
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

}
?>