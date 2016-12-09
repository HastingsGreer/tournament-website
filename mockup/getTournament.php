<?php
header('Content-Type: application/json');
$id = intval($_GET['id']);
echo $id;
$mysqli = mysqli_connect("classroom.cs.unc.edu", "tgreer", "horsejump5678", "tgreerdb");
$teamtable = mysqli_query($mysqli, "SELECT id, name, poolID, seed FROM team WHERE tournamentID = " . $id );


$teams = array();
while($team = $teamtable->fetch_row()) {
    $teams[] = (object) array("team_name" => $team[1],
                              "team_id" => $team[0],
			      "team_league" => $team[2],
			      "seed" => $team[3]);
    
}
#var_dump($teams);


$leaguetable = mysqli_query($mysqli, "SELECT ID, name, FROM pool WHERE tournamentID = " . $id );

$leagues = array();
while($pool = $leaguetable->fetch_row() {   
    $league = array("league_id" => $pool[0],
                    "league_name" => $pool[1]);
    $lteams = array();
    foreach($teams as $t){
        if($t->team_league == $leagueid){
	    $lteams[] = $t->team_id;
	}
    }
    $league["teams_in_league"] = $lteams;

    $leagues[] = $league;

}

$games = (object) array("leagues" => $leagues,
                        "bracket" => array());

$tournament1 = (object) array(
                              'numteams'=> 16,
                              'numleagues'=> 4,
                              'in_bracket_play' => false,
                              'tournament_style' => 'round_robin',
			      'teams' => $teams,
			      'games' => $games,
			      );




$tournament2 = (object) array('tournament' => 'UNC basketball Intramurals 2016',
                              'tournament_id' => '1235',
                              'tournament_day' => '12-23-16');
echo id;
if($id == 1234){
    echo json_encode($tournament1);
} else {
    if($id == 1235){
        echo json_encode($tournament2);
    } else {
        echo json_encode(null);
    }
}
?>


