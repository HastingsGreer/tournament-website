<?php

require_once('orm/User.php');

$path_components = explode('/', $_SERVER['PATH_INFO']);
//First element is always defined and always empty
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //either /user.php/<id>
    //or /user.php/email/<email>
    //or /user.php/email/
    if((count($path_components) >=2) && ($path_components[1] != "")){
        //Determine which case
        $part_2 = $path_components[1];
        if($part_2=="email"){
            if(count($path_components)==3 && $path_components[2] != ""){//Must match /user/email/email

                $user_email = $path_components[2];
                //Look up by email.
                $user = BBUser::findByEmail($user_email);

                if($user == null){
                    // Email not found.
                    header("HTTP/1.0 404 Not Found");
                    print("Email: " . $user_email . " not found.");
                    exit();

                }
                // Check to see if deleting
                if (isset($_REQUEST['delete'])) {
                    $user->delete();
                    header("Content-type: application/json");
                    print(json_encode(true));
                    exit();
                }

                // Normal lookup.
                // Generate JSON encoding as response
                header("Content-type: application/json");
                print($user->getJSON());
                exit();
            }else{//Must match /user/email/
                // ID not specified, then must be asking for index
                header("Content-type: application/json");
                print(json_encode(BBUser::getAllIDs()));
                exit();

            }
    }elseif($part_2 != ""){ //If it isnt an email, its an id.
            $user_id = intval($path_components[1]);

            $user = BBUser::findByID($user_id);

            if($user == null){
                // Email not found.
                header("HTTP/1.0 404 Not Found");
                print("User: " . $user_id . " not found.");
                exit();

            }
            // Check to see if deleting
            if (isset($_REQUEST['delete'])) {
                $user->delete();
                header("Content-type: application/json");
                print(json_encode(true));
                exit();
            }

            // Normal lookup.
            // Generate JSON encoding as response
            header("Content-type: application/json");
            print($user->getJSON());
            exit();
        }
    }else{
        // ID not specified, then must be asking for index
        header("Content-type: application/json");
        print(json_encode(BBUser::getAllIDs()));
        exit();
    }
}else if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Either creating or updating

    // Following matches /user.php/<id> form
    if ((count($path_components) >= 2) &&
        ($path_components[1] != "")) {

        //Interpret <id> as integer and look up via ORM
        $user_id = intval($path_components[1]);
        $user = BBUser::findByID($user_id);

        if ($user == null) {
            // User not found.
            header("HTTP/1.0 404 Not Found");
            print("User id: " . $user_id . " not found while attempting update.");
            exit();
        }

        // Validate values
        $new_email = false;
        if (isset($_REQUEST['email'])) {
            $new_email = trim($_REQUEST['email']);
            if ($new_email == "") {
                header("HTTP/1.0 400 Bad Request");
                print("Bad email");
                exit();
            }
        }

        $new_password = false;
        if (isset($_REQUEST['password'])) {
            $new_password = trim($_REQUEST['password']);
            if ($new_password == "") {
                header("HTTP/1.0 400 Bad Request");
                print("Bad password");
                exit();
            }
        }

        // Update via ORM
        if ($new_email) {
            $user->set_email($new_email);
        }
        if ($new_password != false) {
            $user->set_password($new_password);
        }

        // Return JSON encoding of updated Todo
        header("Content-type: application/json");
        print($user->getJSON());
        exit();
    } else {

        // Creating a new Todo item

        // Validate values
        if (!isset($_REQUEST['email'])) {
            header("HTTP/1.0 400 Bad Request");
            print("Missing email");
            exit();
        }

        $email = trim($_REQUEST['email']);;
        if ($email == "") {
            header("HTTP/1.0 400 Bad Request");
            print("Bad email");
            exit();
        }
        if (!isset($_REQUEST['password'])) {
            header("HTTP/1.0 400 Bad Request");
            print("Missing password");
            exit();
        }

        $password = trim($_REQUEST['password']);

        if ($password == "") {
            header("HTTP/1.0 400 Bad Request");
            print("Bad password");
            exit();
        }

        // Create new User via ORM
        $new_user = BBUser::create($email, $password);
        //print($new_user);

        // Report if failed
        if ($new_user == null) {
            header("HTTP/1.0 500 Server Error");
            print("Server couldn't create new user.");
            exit();
        }

        //Generate JSON encoding of new User
        header("Content-type: application/json");
        print($new_user->getJSON());
        exit();
    }

}
// If here, none of the above applied and URL could
// not be interpreted with respect to RESTful conventions.

header("HTTP/1.0 400 Bad Request");
print("Did not understand URL");

?>