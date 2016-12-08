<?php

class Game
{
	private $id;
	private $home_team;
	private $home_score;
	private $away_team;
	private $away_score;
	private $location;
	private $date;
	private $time;
	private $is_bracket_game;
	private $bracket_position;

	public static function connect(){
		return new mysqli("classroom.cs.unc.edu", "tgreer", "horsejump5678", "tgreerdb");
	}
	public static function create($home_team, $home_score, $away_score, $location, $date, $time, $is_bracket_game, $bracket_positon)
	{
		$mysqli = Game::connect();
		if($date== null){
			$dstr = null;
		}else{
			$dstr = "'" . $date->format('Y-m-d');
		}
		if($time==null){
			$tstr = null;
		}else{
			$tstr=$time->format('H:i');
		}

		if($is_bracket_game){
			$bstr = "1";
		}else{
			$bstr = "0";
		}

		$result = $mysqli->query("INSERT INTO to game values(DEFAULT, " . "'" . $home_team . "', " . "'" . $home_score . "', " . "'" . $away_team . "', " . "'". $away_score ."'," . "'" . $mysqli->real_escape_string($location) "'," . "'" . $dstr . "'," . "'" . $tstr . "', " . "'" . $bstr . "', " . "'" . $bracket_positon . "'" . ")");
		if(result){
			$id = mysqli->insert_id;
			return new Game($id, $home_team, $home_score, $away_score, $location, $date, $time, $is_bracket_game, $bracket_positon);
		}
		return null;


	}

	public static function findByID($id) {
		$mysqli = Game::connect();

		$result = $mysqli->query("select * from game where id = " . $id);
		if ($result) {
			if ($result->num_rows == 0) {
				return null;
			}

			$game_info = $result->fetch_array();

			if ($game_info['date'] != null) {
				$date = new DateTime($todo_info['date']);
			} else {
				$date = null;
			}
			if ($game_info['time'] != null) {
				$time = new DateTime($todo_info['time']);
			} else {
				$time = null;
			}

			if (!$game_info['is_bracket_game']) {
				$is_bracket_game = false;
			} else {
				$is_bracket_game = true;
			}

			return new Game(intval($todo_info['id']),
				intval($todo_info['home_team']),
				intval($todo_info['home_score']),
				intval($todo_info['away_team']),
				intval($todo_info['away_score']),
				$todo_info['location'],
				$date,
				$time,
				$is_bracket_game);

		}
		return null;
	}
	public static function getAllIDs() {
		$mysqli = Game::connect();

		$result = mysqli->query("select id from game");
		$id_array = array();

		if($result) {
			while ($next_row = $result->fetch_array()) {
				$id_array[] = intval($next_row['id']);
			}
		}
		return $id_array;
	}

	private function __construct($id, $home_team, $home_score, $away_score, $location, $date, $time, $is_bracket_game, $bracket_positon){
		$this->id = $id;
		$this->home_team = $home_team;
		$this->home_score = $home_score;
		$this->away_team = $away_team;
		$this->away_score =  $away_score;
		$this->location =  $location;
		$this->date = $date;
		$this->time = $time;
		$this->_is_bracket_game = $is_bracket_game;
		$this->bracket_position = $bracket_positon;
	}

	public function getID(){
		return $this->id;
	}
	public function getHomeTeam(){
		return $this->home_team;
	}
	public function getHomeScore(){
		return $this->home_score;
	}
	public function getAwayTeam(){
		return $this->away_team;
	}
	public function getAwayScore(){
		return $this->away_score;
	}
	public function getLocation(){
		return $this->location;
	}
	public function getDate(){
		return $this->date;
	}
	public function getTime(){
		return $this->time;
	}
	public function isBracketGame(){
		return $this->is_bracket_game;
	}
	public function getBracketPosition(){
		return $this->bracket_position;
	}

	public function setHomeTeam($home_team){
		$this->home_team = $home_team;
	}
	public function setHomeScore($home_score){
		$this->home_score = $home_score;
	}
	public function setAwayTeam($away_team){
		$this->away_team = $away_team;
	}
	public function setAwayScore($away_score){
		$this->away_score = $away_score;
	}
	public function setLocation($location){
		$this->location = $location;
	}
	public function setDate($date){
		$this->date = $date;
	}
	public function setTime($time){
		$this->time = $time;
	}
	public function setisBracketGame($is_bracket_game){
		$this->is_bracket_game = $is_bracket_game;
	}
	public function setBracketPosition($bracket_position){
		$this->bracket_position = $bracket_position;
	}
	public function update(){
		$mysqli = Game::connect();

		if($this->date == null){
			$dstr = "null"
		}else{
			$dstr = "'" . $this->date->format('Y-m-d') . "'";
		}
		if($this->time==null){
			$tstr = null;
		}else{
			$tstr= "'" . $this->time->format('H:i') . "'";
		}

		if($is_bracket_game){
			$bstr = "1";
		}else{
			$bstr = "0";
		}

		$result = $mysqli->query("update game set " . 
			"home_team=" . 
			"'" $this->home_team . "', " . 
			"home_score=" . 
			"'" $this->home_score . "', " . 
			"away_team=" . 
			"'" $this->away_team . "', " .
			"away_score=" . 
			"'" $this->away_score . "', " .
			"location=" . 
			"'" $mysqli->real_escape_string($this->location) . "', " .
			"date=" . 
			 $dstr . ", " . 
			"time=" . 
			$tstr . ", " . 
			"is_bracket_game=" . 
			 $bstr . ", " .
			"bracket_position=" . 
			"'" $this->bracket_position . "' where id=" . $this->id);
		return $result;

	}

	public function delete(){
		$mysqli = Game::connect();
		$mysqli->query("delete from game where id = " . $this->id);
	}

	public function getJSON() {
		if($this->date == null){
			$dstr = "null"
		}else{
			$dstr = "'" . $this->date->format('Y-m-d') . "'";
		}
		if($this->time==null){
			$tstr = null;
		}else{
			$tstr= "'" . $this->time->format('H:i') . "'";
		}
		$json_obj = array('id' => $this->id,
			'home_team' => $this->home_team,
			'home_score' => $this->home_score,
			'away_team' => $this->away_team,
			'away_score' => $this->away_score,
			'location' => $this->location,
			'date' => $this->date,
			'time' => $this->time,
			'is_bracket_game' => $this->is_bracket_game,
			'bracket_position' => $this->bracket_position);
		return json_encode($json_obj);

	}

}