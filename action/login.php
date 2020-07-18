<?php

if (LOGGED) {
    header('location:index.php');
    exit();
}

$error = $db->login();
require 'include/header.php';
$view->login_form($error);
require 'include/footer.php';
