<?php

/**
 * Created by PhpStorm.
 * User: Destiny
 * Date: 12/8/2016
 * Time: 12:04 AM
 */
class Tournament
{
    private $id;
    private $name;
    private $league_id;
    private $num_teams;
    private $start_date;
    private $end_date;


    public static function connect()
    {
        return new mysqli("classroom.cs.unc.edu", "tgreer", "horsejump5678", "tgreerdb");
        //return new mysqli("localhost", "root", "", "tournament");
    }

    public static function create($name, $league_id, $num_teams, $start_date, $end_date)
    {
        $mysqli = Tournament::connect();
        if($start_date == null){
            $sdstr = "null";
        }else{
            $sdstr = "'" . $start_date->format('Y-m-d') . "'";
        }
        if($end_date == null){
            $edstr = "null";
        }else{
            $edstr = "'" . $end_date->format('Y-m-d') . "'";
        }

        $result = $mysqli->query("INSERT INTO tournament(name,league_id,num_teams,start_date,end_date) VALUE( " . "'" . $mysqli->real_escape_string($name) . "', "
            . "'" . $league_id . "', " . "'" . $num_teams . "', " . "'" . $sdstr . "', "
            . "'" . $edstr . "') ");

        if ($result) {
            $id = $mysqli->insert_id;
            return new Tournament($id, $name, $league_id, $num_teams, $start_date, $end_date);
        }
        return null;
    }

    private function __construct($id, $name, $league_id, $num_teams, $start_date, $end_date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->league_id = $league_id;
        $this->num_teams = $num_teams;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public static function findByID($id)
    {
        $mysqli = Tournament::connect();
        $result = $mysqli->query("SELECT * FROM tournament WHERE id=" . $id);
        if ($result) {
            if ($result->num_rows == 0) {
                return null;
            }

            $tournament_info = $result->fetch_array();
            if($tournament_info['start_date'] != null){
                $start_date = new DateTime($tournament_info['start_date']);
            }else{
                $start_date = null;
            }

            if($tournament_info['end_date'] != null){
                $end_date = new DateTime($tournament_info['end_date']);
            }else{
                $end_date = null;
            }

            return new Tournament($tournament_info['id'], $tournament_info['name'], $tournament_info['league_id'], $tournament_info['num_teams'], $tournament_info['start_date'], $tournament_info['end_date']);
        }
        return null;
    }

    public static function getAllIDs()
    {
        $mysqli = Tournament::connect();

        $result = $mysqli->query("select id from tournament");
        $id_array = array();

        if ($result) {
            while ($next_row = $result->fetch_array()) {
                $id_array[] = intval($next_row['id']);
            }
        }
        return $id_array;
    }

    public function getID()
    {
        return $this->id;
    }


    public function getName()
    {
        return $this->name;
    }

    public function getLeagueID()
    {
        return $this->league_id;
    }

    public function getNumTeams()
    {
        return $this->num_teams;
    }


    public function getStartDate()
    {
        return $this->start_date;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this->update();
    }

    public function setLeagueID($league_id)
    {
        $this->league_id = $league_id;
        return $this->update();
    }

    public function setNumTeams($num_teams)
    {
        $this->num_teams = $num_teams;
        return $this->update();
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
        return $this->update();
    }

    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
        return $this->update();
    }

    private function update(){
        $mysqli = Tournament::connect();
        if($this->start_date==null){
            $sdstr= "null";
        }else{
            $sdstr="'" . $this->start_date->format('Y-m-d') . "'";
        }
        if($this->end_date==null){
            $edstr= "null";
        }else{
            $edstr="'" . $this->end_date->format('Y-m-d') . "'";
        }

        $result = $mysqli->query("UPDATE tournament set " .
            "name=" .
            "'" . $mysqli->real_escape_string($this->name) . "', " .
            "league_id=" .
            "'" . $this->league_id . "', " .
            "num_teams=" .
            "'" . $this->num_teams . "', " .
            "start_date=" .
            "'" . $sdstr . "', " .
            "end_date=" .
            "'" . $edstr . "' WHERE id=" . $this->id);

        return $result;


    }
    public function delete() {
        $mysqli = Tournament::connect();
        $mysqli->query("DELETE FROM tournament WHERE id=" . $this->id);
    }

    public function getJSON()
    {
        $json_obj = array('id' => $this->userid,
            'name' => $this->name,
            'num_teams' => $this->num_teams,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date);
        return json_encode($json_obj);
    }


}