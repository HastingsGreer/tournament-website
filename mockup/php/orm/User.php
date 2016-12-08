<?php

class BBUser
{    /*database object*/
    private $email;
    private $password;
    private $userid;


    /* Check for a database object and creates one if needed.
    @param object $db
    @return void
    */
    public static function connect()
    {
        //return new mysqli("classroom.cs.unc.edu", "tgreer", "horsejump5678", "tgreerdb");
        return new mysqli("localhost", "root", "", "tournament");
    }

    public static function create($email, $password)
    {
//        echo($email);
//        echo(" ");
//        echo($password);
        $mysqli = BBUser::connect();
        //$result = $mysqli->query("INSERT INTO users (email,password) VALUE( 'dharrell96@gmail.com', 'asdfghjk')");
        $result = $mysqli->query("INSERT INTO users (email,password) VALUE( " . "'" . $mysqli->real_escape_string($email) . "', " . "'" . $mysqli->real_escape_string($password) . "')");

        if ($result) {
            $userid = $mysqli->insert_id;
            return new BBUser($userid, $email, $password);
        }
        return null;

    }

    private function __construct($userid, $email, $password)
    {
        $this->userid = $userid;
        $this->email = $email;
        $this->password = $password;
    }

    public static function findByID($id)
    {
        $mysqli = BBUser::connect();

        $result = $mysqli->query("SELECT * FROM users WHERE id = " . $id);
        if ($result) {
            if ($result->num_rows == 0) {
                return null;
            }
            $user_info = $result->fetch_array();
            return new BBUser($user_info['id'], $user_info['email'], $user_info['password']);
        }
        return null;

    }

    public static function findByEmail($email)
    {
        $mysqli = BBUser::connect();
        $result = $mysqli->query("SELECT * FROM users WHERE email = " . "'" . $mysqli->real_escape_string($email) . "'");
        if ($result) {
            if ($result->num_rows == 0) {
                echo "NOT FOUND";
                return null;
            }
            $user_info = $result->fetch_array();
            return new BBUser($user_info['id'], $user_info['email'], $user_info['password']);
        }
        return null;

    }


    public static function getAllIDs() {
        $mysqli = BBUser::connect();

        $result = $mysqli->query("select id from users");
        $id_array = array();

        if ($result) {
            while ($next_row = $result->fetch_array()) {
                $id_array[] = intval($next_row['id']);
            }
        }
        return $id_array;
    }
    function get_email()
    {
        return $this->email;
    }

    function set_email($name)
    {
        $this->email = $name;
        return $this->update();
    }

    function get_password()
    {
        return $this->password;
    }

    function set_password($pass)
    {
        $this->password = $pass;
        return $this->update();
    }

    function get_userid()
    {
        return $this->userid;
    }


    private function update(){
        $mysqli = BBUser::connect();
        $result = $mysqli->query("UPDATE users set " .
            "email=" .
            "'" . $mysqli->real_escape_string($this->email) . "', " .
            "password=" .
            "'" . $mysqli->real_escape_string($this->password) . "' WHERE id=" . $this->userid);

        return result;


    }
    public function delete() {
        $mysqli = BBUser::connec();
        $mysqli->query("DELETE FROM users WHERE id=" . $this->userid);
    }

    public function getJSON()
    {
        $json_obj = array('id' => $this->userid,
            'email' => $this->email,
            'password' => $this->password);
        return json_encode($json_obj);
    }


}

?>