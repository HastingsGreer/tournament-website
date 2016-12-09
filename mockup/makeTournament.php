<?php
$json = file_get_contents('php://input'); $obj = json_decode($json);

echo "d". $obj->tournament_style . "77\n";

$id = intval(1234);
$teams = array();
$teamnames = ['Broncos', 'Bulls', 'Wingnuts', 'Gamecocks', 'Ampersands', 'xss', 'tar heels', 'snoot boopers', 'fly balls', 'team chaos', 'cow tippers', 'crazy 8s', 'ballers', 'robots', 'cat-people', 'brainsuckers'];
$i = 1000;
foreach($teamnames as $name) {
    $teams[] = (object) array("team_name" => $name,
                              "team_id" => $i,
			      "team_league" => $i%4,
			      "seed" => null);
    $i += 1;
}
$leagues = array();
foreach([0, 1, 2, 3] as $leagueid) {
    $league = array("league_id" => $leagueid);
    $lteams = array();
    foreach($teams as $t){
        if($t->team_league == $leagueid){
	    $lteams[] = $t->team_id;
	}
    }
    $league["teams_in_league"] = $lteams;
    foreach($lteams as $id1) {
    }
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


