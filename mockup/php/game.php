<?php

require_once('orm/Game.php');

$path_components = explode('/', $_SERVER['PATH_INFO']);

// Note that since extra path info starts with '/'
// First element of path_components is always defined and always empty.

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  // GET means either instance look up, index generation, or deletion

  // Following matches instance URL in form
  // /game.php/<id>

  if ((count($path_components) >= 2) && ($path_components[1] != "")) {

    // Interpret <id> as integer
    $game_id = intval($path_components[1]);

    // Look up object via ORM
    $game= Game::findByID($game_id);

    if ($game == null) {
      // Game not found.
      header("HTTP/1.0 404 Not Found");
      print("Game: " . $game_id . " not found.");
      exit();
    }

    // Check to see if deleting
    if (isset($_REQUEST['delete'])) {
      $game->delete();
      header("Content-type: application/json");
      print(json_encode(true));
      exit();
    } 

    // Normal lookup.
    // Generate JSON encoding as response
    header("Content-type: application/json");
    print($game->getJSON());
    exit();

  }

  // ID not specified, then must be asking for index
  header("Content-type: application/json");
  print(json_encode(Game::getAllIDs()));
  exit();

} else if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Either creating or updating

  // Following matches /game.php/<id> form
  if ((count($path_components) >= 2) &&
      ($path_components[1] != "")) {

    //Interpret <id> as integer and look up via ORM
    $game_id = intval($path_components[1]);
    $game = Game::findByID($game_id);

    if ($game == null) {
      // Game not found.
      header("HTTP/1.0 404 Not Found");
      print("Game: " . $game_id . " not found while attempting update.");
      exit();
    }

    // Validate values
    $new_hometeam = false;
    if (isset($_REQUEST['home_team'])) {
      $new_hometeam = trim($_REQUEST['home_team']);
    }
    $new_homescore = false;
    if (isset($_REQUEST['home_score'])) {
      $new_homescore = trim($_REQUEST['home_score']);
    }
    $new_awayteam = false;
    if (isset($_REQUEST['away_team'])) {
      $new_awayteam = trim($_REQUEST['away_team']);
    }
    $new_awayscore = false;
    if (isset($_REQUEST['away_score'])) {
      $new_awayscore = trim($_REQUEST['away_score']);
    }
    $new_location = false;
    if (isset($_REQUEST['location'])) {
      $new_location = trim($_REQUEST['location']);
    }
    $new_date = false;
    $new_date_obj = null;
    if (isset($_REQUEST['date'])) {
      $new_date = true;
      $date_str = trim($_REQUEST['date']);
      if ($date_str != "") {
        $new_date_obj = new DateTime($date_str);
      }
    }
    $new_time = false;
    $new_time_obj = null;
    if (isset($_REQUEST['time'])) {
      $new_time = true;
      $time_str = trim($_REQUEST['time']);
      if ($time_str != "") {
    $new_time_obj = new DateTime($time_str);
      }
    }

    $new_priority = false;
    if (isset($_REQUEST['priority'])) {
      $new_priority = intval($_REQUEST['priority']);
      if (!($new_priority > 0 && $new_priority <= 10)) {
    header("HTTP/1.0 400 Bad Request");
    print("Priority value out of range.");
    exit();
      }
    }

    if (isset($_REQUEST['complete'])) {
      $new_complete = true;
    } else {
      $new_complete = false;
    }

    // Update via ORM
    if ($new_title) {
      $game->setTitle($new_title);
    }
    if ($new_note != false) {
      $game->setNote($new_note);
    }
    if ($new_project != false) {
      $game->setProject($new_project);
    }
    if ($new_due_date) {
      $game->setDueDate($new_date_obj);
    }
    if ($new_priority != false) {
      $game->setPriority($new_priority);
    }
    
    if (!$new_complete) {
      $game->clearComplete();
    } else {
      $game->setComplete();
    }

    // Return JSON encoding of updated Game
    header("Content-type: application/json");
    print($game->getJSON());
    exit();
  } else {

    // Creating a new Game item

    // Validate values
    if (!isset($_REQUEST['title'])) {
      header("HTTP/1.0 400 Bad Request");
      print("Missing title");
      exit();
    }
    
    $title = trim($_REQUEST['title']);
    if ($title == "") {
      header("HTTP/1.0 400 Bad Request");
      print("Bad title");
      exit();
    }

    $note = "";
    if (isset($_REQUEST['note'])) {
      $note = trim($_REQUEST['note']);
    }

    $project = "";
    if (isset($_REQUEST['project'])) {
      $project = trim($_REQUEST['project']);
    }

    $due_date = null;
    if (isset($_REQUEST['due_date'])) {
      $date_str = trim($_REQUEST['due_date']);
      if ($date_str != "") {
    $due_date = new DateTime($date_str);
      }
    }

    $priority = 1;
    if (isset($_REQUEST['priority'])) {
      $priority = intval($_REQUEST['priority']);
      if (!($priority > 0 && $priority <= 10)) {
    header("HTTP/1.0 400 Bad Request");
    print("Priority value out of range");
    exit();
      }
    }

    if (isset($_REQUEST['complete'])) {
      $complete = true;
    } else {
      $complete = false;
    }


    // Create new Game via ORM
    $new_todo = Game::create($title, $note, $project, $due_date, $priority, $complete);

    // Report if failed
    if ($new_todo == null) {
      header("HTTP/1.0 500 Server Error");
      print("Server couldn't create new game.");
      exit();
    }
    
    //Generate JSON encoding of new Game
    header("Content-type: application/json");
    print($new_todo->getJSON());
    exit();
  }
}

// If here, none of the above applied and URL could
// not be interpreted with respect to RESTful conventions.

header("HTTP/1.0 400 Bad Request");
print("Did not understand URL");

?>