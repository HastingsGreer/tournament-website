<?php
header('Content-Type: application/json');

$tournamentlist = array();
$tournament1 = (object) array('tournament' => 'UNC Volleyball Intramurals 2019',
                              'tournament_id' => '1234',
                              'tournament_day' => '12-23-19');

$tournament2 = (object) array('tournament' => 'UNC Basketball Intramurals 2016',
                              'tournament_id' => '1235',
                              'tournament_day' => '12-10-16');
$tournamentlist[] = $tournament1;
$tournamentlist[] = $tournament2;

$response = (object) array('tournaments' => $tournamentlist);

echo json_encode($response);
?>


