<?php

$db = require 'class/Sqlite3.php';
$sql = "SELECT count(*) FROM sqlite_master";
if (!$db->single($sql))
    $db->execute(file_get_contents('data/sqlite_dump.sql'));
exit('Setup is done alright.<br>
You can now remove the setup.php file.');
