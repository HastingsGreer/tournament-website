<?php

require_once('orm/Tournament.php');

$path_components = explode('/', $_SERVER['PATH_INFO']);

// Note that since extra path info starts with '/'
// First element of path_components is always defined and always empty.

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  // GET means either instance look up, index generation, or deletion

  // Following matches instance URL in form
  // /todo.php/<id>

  if ((count($path_components) >= 2) && ($path_components[1] != "")) {

    // Interpret <id> as integer
    $tournament_id = intval($path_components[1]);

    // Look up object via ORM
    $tournament= Tournament::findByID($tournament_id_id);

    if ($tournament == null) {
      // Todo not found.
      header("HTTP/1.0 404 Not Found");
      print("Tournament: " . $tournament_id . " not found.");
      exit();
    }

    // Check to see if deleting
    if (isset($_REQUEST['delete'])) {
      $tournament->delete();
      header("Content-type: application/json");
      print(json_encode(true));
      exit();
    } 

    // Normal lookup.
    // Generate JSON encoding as response
    header("Content-type: application/json");
    print($touranment->getJSON());
    exit();

  }

  // ID not specified, then must be asking for index
  header("Content-type: application/json");
  print(json_encode(Tournament::getAllIDs()));
  exit();

} else if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Either creating or updating

  // Following matches /todo.php/<id> form
  if ((count($path_components) >= 2) &&
      ($path_components[1] != "")) {

    //Interpret <id> as integer and look up via ORM
    $tournament_id = intval($path_components[1]);
    $tournament = Tournament::findByID($tournament_id);

    if ($touranment == null) {
      // Todo not found.
      header("HTTP/1.0 404 Not Found");
      print("Tournament: " . $tournament_id . " not found while attempting update.");
      exit();
    }

    // Validate values
    $new_title = false;
    if (isset($_REQUEST['title'])) {
      $new_title = trim($_REQUEST['title']);
      if ($new_title == "") {
    header("HTTP/1.0 400 Bad Request");
    print("Bad title");
    exit();
      }
    }

    $new_note = false;
    if (isset($_REQUEST['note'])) {
      $new_note = trim($_REQUEST['note']);
    }

    $new_project = false;
    if (isset($_REQUEST['project'])) {
      $new_project = trim($_REQUEST['project']);
    }

    $new_due_date = false;
    $new_date_obj = null;
    if (isset($_REQUEST['due_date'])) {
      $new_due_date = true;
      $date_str = trim($_REQUEST['due_date']);
      if ($date_str != "") {
    $new_date_obj = new DateTime($date_str);
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
      $todo->setTitle($new_title);
    }
    if ($new_note != false) {
      $todo->setNote($new_note);
    }
    if ($new_project != false) {
      $todo->setProject($new_project);
    }
    if ($new_due_date) {
      $todo->setDueDate($new_date_obj);
    }
    if ($new_priority != false) {
      $todo->setPriority($new_priority);
    }
    
    if (!$new_complete) {
      $todo->clearComplete();
    } else {
      $todo->setComplete();
    }

    // Return JSON encoding of updated Todo
    header("Content-type: application/json");
    print($todo->getJSON());
    exit();
  } else {

    // Creating a new Todo item

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


    // Create new Todo via ORM
    $new_todo = Todo::create($title, $note, $project, $due_date, $priority, $complete);

    // Report if failed
    if ($new_todo == null) {
      header("HTTP/1.0 500 Server Error");
      print("Server couldn't create new todo.");
      exit();
    }
    
    //Generate JSON encoding of new Todo
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