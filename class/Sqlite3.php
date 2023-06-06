<?php

class MySQLite3 extends SQLite3
{
    // Initialize the extended class
    function __construct()
    {
        parent::__construct('data/sqlite.db');
        $this->enableExceptions(TRUE);
    }

    // SELECT single value
    function single($sql)
    {
        $res = $this->querySingle($sql);
        if ($res === false)
            exit($this->lastErrorMsg());
         return $res;
    }

    // SELECT one row returned as object
    function onerow($sql)
    {
        $row = $this->querySingle($sql, true);
        if ($row === false)
            exit($this->lastErrorMsg());
        if ($row)
            $row = (object)$row;
        return $row;
    }

    // SELECT number of rows returned as objects
    function rows($sql)
    {
        $res = $this->query($sql);
        if ($res === false)
            exit($this->lastErrorMsg());
        $arr =  array();
        while($row = $res->fetchArray(SQLITE3_ASSOC))
            $arr[] = (object)$row;
        $res->finalize();
        return $arr;
    }

    // UPDATE, DELETE, CREATE, DROP
    function execute($sql)
    {
        $res = $this->exec($sql);
        if ($res === false)
            exit($this->lastErrorMsg());
        return $this->changes();
    }

    function get_contacts()
    {
        $sql = "SELECT * FROM contacts ORDER BY fname";
        return $this->rows($sql);
    }

    function add_contact()
    {
        $req_post = $_POST;
        if (!isset($req_post['submit']))
            return;
        extract($req_post);

        $sql = "INSERT INTO contacts (fname, lname, phone, city) VALUES (?, ?, ?, ?)";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(1, $fname);
        $stmt->bindParam(2, $lname);
        $stmt->bindParam(3, $phone);
        $stmt->bindParam(4, $city);
        $stmt->execute();

        echo 'Success!';
    }

    function edit_contact($id)
    {
        $req_post = $_POST;
        if (!isset($req_post['submit']))
            return;
        extract($req_post);

        if ($submit == 'Edit') {
            $sql = "UPDATE contacts 
                    SET fname=?, lname=?, phone=?, city=?
                    WHERE id = $id";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $fname);
            $stmt->bindParam(2, $lname);
            $stmt->bindParam(3, $phone);
            $stmt->bindParam(4, $city);
            $stmt->execute();
            header('location:index.php');
            exit();
        }

        if ($submit == 'Delete') {
            $sql = "DELETE FROM contacts WHERE id = $id";
            $this->execute($sql);
            header('location:index.php');
            exit();
        }
    }

    function login()
    {
        $req_post = $_POST;
        if (!isset($req_post['submit']))
            return;
        extract($req_post);
        $sql = "SELECT * FROM users WHERE id=1";
        $row = $this->onerow($sql);
        if (!$row) {
            $hash = password_hash($upass, PASSWORD_BCRYPT);
            $sql = "INSERT INTO users (uname, upass) VALUES (?, '$hash')";
            $stmt = $this->prepare($sql);
            $stmt->bindParam(1, $uname);
            $stmt->execute();
            $sql = "SELECT * FROM users WHERE id=1";
            $row = $this->onerow($sql);
        }
        if ($uname == $row->uname && password_verify($upass, $row->upass)) {
            setcookie('contact3ex', $uname, time()+14*24*3600);
            header('location:index.php');
            exit();
        } else {
            return 'Not a valid login';
        }
    }

}

error_reporting(32767);
ini_set('display_errors', '1');
return new MySQLite3;

?>
