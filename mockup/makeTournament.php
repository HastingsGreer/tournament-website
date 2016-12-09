<?php
$json = file_get_contents('php://input'); $obj = json_decode($json);
#echo "\n" . $json . "\n";
$mysqli = mysqli_connect("classroom.cs.unc.edu", "tgreer", "horsejump5678", "tgreerdb");
#echo "d". $obj->tournament_style . "77\n";


mysqli_query($mysqli, "INSERT INTO tournament (end_date, is_in_bracket_play, min_rest_for_team, name, num_pools, num_teams, start_date) VALUES ( '" . $obj->end_date . "',false,'" . $obj->min_rest_time ."','". $obj->name  . "','" . $obj->numleagues. "','" .$obj->numteams . "','" .$obj->start_date."')");
#echo "INSERT INTO tournament (end_date, is_in_bracket_play, min_rest_for_team, name, num_pools, num_teams, start_date) VALUES ( '" . $obj->end_date . "',false,'" . $obj->min_rest_time ."','". $obj->name  . "','" . $obj->numleagues. "','" .$obj->numteams . "','" .$obj->start_date."')";


$tourneyID = mysqli_query($mysqli, "SELECT id FROM tournament WHERE name = '" . $obj->name . "'")->fetch_row()[0];
#echo "dhi\n" . mysqli_error($mysqli)."\n horse";
#echo $tourneyID . "\n";



$leagues = array();
for($i = 0; $i < $obj->numleagues; $i = $i + 1){
    $name = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"[$i];    
    mysqli_query($mysqli, "INSERT INTO pool (name, tournamentID) VALUES ( '" . $name . "','". $tourneyID . "')");
    $leagues[] = mysqli_query($mysqli, "SELECT ID FROM pool WHERE name = '" . $name . "' AND tournamentID = " . $tourneyID)->fetch_row()[0];
    #echo "id: ".$leagues[$i]."\n";

    #echo "dhi\n" . mysqli_error($mysqli)."\n horse";
}

$teams = array();
$i = 1000;
foreach($obj->teams as $name) {
    mysqli_query($mysqli, "INSERT INTO team (name, poolID, seed, tournamentID) VALUES ( '" . $name . "','" . $leagues[$i % $obj->numleagues] . "','".null. "','". $tourneyID . "')");
    #echo $name . "\n";
    $teams[] =  (object) array(
                              "id" => mysqli_query($mysqli, "SELECT id FROM team WHERE name = '" . $name . "' AND tournamentID = " . $tourneyID)->fetch_row()[0],
			      "team_league" => $leagues[$i%$obj->numleagues],
			      "seed" => null);
    
    $i += 1;
}
#var_dump($leagues);
#var_dump($teams);
#echo "generate league games\n";
foreach($leagues as $league) {
    #echo $league . "\n";
    $lteams = array();
    foreach($teams as $t){
        if($t->team_league == $league){
	    $lteams[] = $t->id;
            ##echo $t->id;
	}
    }
    foreach($lteams as $id1) {
       foreach($lteams as $id2){
           if(intval($id1) < intval($id2)){
               #echo $id1 . $id2 . "\n";
                
               mysqli_query($mysqli, "INSERT INTO game (away_team, home_team, is_bracket_game) VALUES ( '" . $id1 . "','". $id2 ."',false)");
           }    
       }
    }
    

}
echo $tourneyID;
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
if($id == 1234){
    #echo json_encode($tournament1);
} else {
    if($id == 1235){
        #echo json_encode($tournament2);
    } else {
        #echo json_encode(null);
    }
}
?>


