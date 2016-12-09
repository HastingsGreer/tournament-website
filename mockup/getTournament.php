<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = intval($_GET['id']);
#echo $id;
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


$leaguetable = mysqli_query($mysqli, "SELECT ID, name FROM pool WHERE tournamentID = " . $id );

#echo "SELECT ID, name FROM pool WHERE tournamentID = " . $id;
#echo mysqli_error($mysqli);
#var_dump($leaguetable);
$leagues = array();
#echo "hi2";
while($pool = $leaguetable->fetch_row()) {   
    
    
    $league = (object) array("league_id" => $pool[0],
                    "league_name" => $pool[1]);
    $lteams = array();
    foreach($teams as $t){
        if($t->team_league == $pool[0]){
	    $lteams[] = $t->team_id;
	}
    }
    $league->teams_in_league = $lteams;
    $lgames = array();

    $gametable = mysqli_query($mysqli, "SELECT game.id, game.home_team, game.home_score, game.away_team, game.away_score, game.date, game.time, game.location FROM game, team WHERE game.is_bracket_game=false AND game.home_team = team.id and team.poolID = '". $pool[0] . "'" );
       
    while($game = $gametable->fetch_row()) { 
         $lgames[] = (object) array(
	             "gameID" => $game[0],
		     "team1" => $game[1],
		     "team1Score" => $game[2],
                     "team2" => $game[3],
		     "team2Score" => $game[4],
		     "time" => $game[5] . $game[6],
		     "location" => $game[7]);
                     
    }  
    $league->games = $lgames;
    $leagues[] = $league;

}
#var_dump($leagues);

$lgames = array();

$gametable = mysqli_query($mysqli, "SELECT game.id, game.home_team, game.home_score, game.away_team, game.away_score, game.date, game.time, game.location FROM game, team WHERE game.is_bracket_game=true AND game.home_team = team.id and team.tournamentID = '". $id . "'" );
       
while($game = $gametable->fetch_row()) { 
         $lgames[] = (object) array(
	             "gameID" => $game[0],
		     "team1" => $game[1],
		     "team1Score" => $game[2],
                     "team2" => $game[3],
		     "team2Score" => $game[4],
		     "time" => $game[5] . $game[6],
		     "location" => $game[7]);
                     
    }  
    
    


$games = (object) array("leagues" => $leagues,
                        "bracket" => $lgames);

$tournament1 = (object) array(
                              'numteams'=> 16,
                              'numleagues'=> 4,
                              'in_bracket_play' => false,
                              'tournament_style' => 'round_robin',
			      'teams' => $teams,
			      'games' => $games,
			      );




#echo $id;
echo json_encode($tournament1);
?>

