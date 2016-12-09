<?php  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$id = trim($_REQUEST['gameid']);
#$home_team = trim($_REQUEST['home_team']);
$home_score = trim($_REQUEST['home_score']);
#$away_team = trim($_REQUEST['away_team']);
$away_score= trim($_REQUEST['away_score']);
$conn = new mysqli("classroom.cs.unc.edu", "tgreer", "horsejump5678", "tgreerdb");

$result = $conn->query("UPDATE game SET home_score=". "'" . $home_score . "', away_score=" . "'" . $away_score . "' WHERE id=" . $id);

$result = $conn->query("SELECT * from game WHERE id=" . $id);
$array_obj = (object) $result->fetch_array();

var_dump($array_obj);
echo $array_obj->is_bracket_game . "\n";
 
$tourneyid = $conn->query("SELECT 
                           team.tournamentID 
			   FROM game, team 
			   WHERE
			   game.home_team = team.id AND
			   game.id = '". $id . "'")->fetch_row()[0];
echo $tourneyid ."\n";			
$home_team_look = [1, 1, 2, 1, 4, 2, 3, 1, 8, 4, 5, 2, 7, 3, 6];
$away_team_look = [2, 4, 3, 8, 5, 7, 6,16, 9,13,12,15,10,14,11];

if($array_obj->is_bracket_game){
    $bracket_pos = intval($array_obj->bracket_position);
    echo $bracket_pos . "was the bracket pos\n";
    if(intval($home_score) >intval( $away_score)){
        $winner = $array_obj->home_team;
    } else {
        $winner = $array_obj->away_team;
    }
    echo $winner . " was the winner \n";
    if($bracket_pos%2 == 1){
        $result = $conn->query("UPDATE game SET home_team=". "'" .
          $winner . "' WHERE tournamentID='" . $tourneyid . "'AND bracket_position = '".
	  intval(($bracket_pos + 1)/2 - 1) . "'"
	  );
    }  else {
        $result = $conn->query("UPDATE game SET away_team=". "'" .
          $winner . "' WHERE tournamentID='" . $tourneyid . "'AND bracket_position = '".
	  intval(($bracket_pos)/2 - 1) . "'"
	  );
    }
    
 }else {
   $result = $conn->query("SELECT 
                           game.id 
			   FROM game, team 
			   WHERE
                           game.home_score IS NULL AND 
			   game.home_team = team.id AND
			   game.is_bracket_game = false AND
			   team.tournamentID = '" . $tourneyid . "'"
   )->fetch_row();
   var_dump($result);
   if(!$result){ #!$result
     echo "a l games decided";
     #make array teamid=>teamscoresum
     $teamtable = $conn->query("SELECT
                                id
				FROM 
				team
				WHERE
				tournamentID = '" . $tourneyid . "'");
     
     $result = $conn->query("UPDATE tournament 
	                         SET is_in_bracket_play = 'true'
				 WHERE id=" . $tourneyid);

     $scores = array();
     while($team = $teamtable->fetch_row()[0]){
         $score = $conn->query("SELECT SUM(game.home_score) 
	                        FROM game
				WHERE game.home_team= '" . $team . "'
				AND game.is_bracket_game = false")->fetch_row()[0]
                + $conn->query("SELECT SUM(game.away_score) 
	                        FROM game
				WHERE game.away_team= '" . $team . "'
				AND game.is_bracket_game = false")->fetch_row()[0];
	 $scores[$team] = $score;
     }
     arsort($scores);
     $seed = 1;
     foreach($scores as $id => $score){
         $result = $conn->query("UPDATE team 
	                         SET seed = '" . $seed . "'
				 WHERE id=" . $id);
	 $seed = $seed + 1;
     }
     $n = count($scores);
     var_dump($scores);
    for($i = intval($n/2) - 1; $i < $n - 1; $i = $i + 1){
     $gameid = $conn->query("SELECT
                             id
                             FROM
                             game
                             WHERE
                             tournamentID = '".$tourneyid."' AND
                             bracket_position = '".$i."'"
                            )->fetch_row()[0]; 
    echo $gameid . "a\n";    
    $result = $conn->query("UPDATE game SET home_team=". "'" .
       array_keys($scores)[$home_team_look[$i]-1] . "' WHERE id=" . $gameid);
    $result = $conn->query("UPDATE game SET away_team=". "'" .
       array_keys($scores)[$away_team_look[$i]-1] . "' WHERE id=" . $gameid);
    }

     
   }  
}
echo "hi";
echo mysqli_error($conn);
?>
