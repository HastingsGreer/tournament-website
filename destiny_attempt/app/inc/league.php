<?php
class BBLeague
{	/*database object*/
	private $id;
	private $name;
	private $num_teams;
	private $tournament_id;
	private $sport;
	private $gender;
	private $city;
	private $state;

	

	
	/* Check for a database object and creates one if needed. 
	@param object $db
	@return void
	*/
	public static function connect() {
		//return new mysqli("classroom.cs.unc.edu", "tgreer", "horsejump5678", "tgreerdb");
		return new mysqli("localhost", "root", "", "tournament");
	}

	public static function create($name, $num_teams, $tournament_id, $sport, $gender, $city, $state){
		$mysqli = BBLeague::connect();

		$result = $mysqli->query("INSERT INTO league ('name, 'num_teams', 'tournament_id', 'sport', 'gender', 'city', 'state') VALUES(" . "'" . mysqli->real_escape_string($name) . "',". "'" . mysqli->real_escape_string($num_teams) . "," . "'" . mysqli->real_escape_string($tournament_id) . "'" . mysqli->real_escape_string($sport) . "'" . "," . "'" . mysqli->real_escape_string($gender) . "'" . "," . "'" . mysqli->real_escape_string($city) . "'" . "," . "'" . mysqli->real_escape_string($state) . "'" .")");
		if($result){
			$id = $mysqli->insert_id;
			return new BBLeague($id, $name, $num_teams, $tournament_id, $sport, $gender, $city, $state);
		}
		return null;

	}
	private function __construct($id,$name, $num_teams, $tournament_id, $sport, $gender, $city, $state){
		$this->id = $id;
		$this->name = $name;
		$this->num_teams= $num_teams;
		$this->tournament_id = $tournament_id;
		$this->sport=$sport;
		$this->gender=$gender;
		$this->city=$city;
		$this->state=$state;
	}
	public static function findByID($id){
		$mysqli = BBLeague::connect();
		$result = $mysqli->query("SELECT * FROM league WHERE id = " .$id);
		if($results) {
			if($result->num_rows == 0){
				return null;
			}
			$league_info = $result->fetch_array();
			return new BBUser($league_info['id'], $league_info['name'], $league_info['num_teams'], $league_info['tournament_id'], $league_info['sport'], $league_info['gender'], $league_info['city'], $league_info['state']);
		}
		return null;

	}

	function get_name(){
		return $this->name;
	}
	function set_name($name){
		$this->name=$name;
	}
	function get_num_teams(){
		return $this->num_teams;
	}
	function set_num_teams($num_teams){
		$this->num_teams=$num_teams;
	}
	function get_id(){
		return $this->id;
	}
	function set_id($id){
		$this->id=$id
	}
	function get_tournament_id(){
		return $this->tournament_id;
	}
	function set_tournament_id($tournament_id){
		$this->tournament_id=$tournament_id;
	}
	function get_sport(){
		return $this->sport;
	}
	function set_sport($sport){
		$this->sport=$sport;
	}
	function get_gender(){
		return $this->name;
	}
	function set_gender($gender){
		$this->gender=$gender;
	}
	function get_city(){
		return $this->city;
	}
	function set_city($city){
		$this->city=$city;
	}
	function get_state(){
		return $this->state;
	}
	function set_state($state){
		$this->state=$state;
	}

	


}
?>