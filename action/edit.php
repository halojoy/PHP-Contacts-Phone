<?php

if (!LOGGED) {
    header('location:index.php');
    exit();
}
if (!isset($req_get['id'])) {
    header('location:index.php');
    exit();
}

require 'include/header.php';
$id = $req_get['id'];
$db->edit_contact($id);
$view->edit_contact_form($id, $db);
require 'include/footer.php';
