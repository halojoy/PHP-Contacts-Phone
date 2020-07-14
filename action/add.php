<?php

if (!LOGGED) {
    header('location:index.php');
    exit();
}

require 'include/header.php';
$db->add_contact();
$view->add_contact_form();
require 'include/footer.php';
