<?php

if (LOGGED) {
    header('location:index.php');
    exit();
}

$db->login();
require 'include/header.php';
$view->login_form();
require 'include/footer.php';
