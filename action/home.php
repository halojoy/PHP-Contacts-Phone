<?php

require 'include/header.php';
$rows = $db->get_contacts();
$view->view_contacts($rows);
require 'include/footer.php';
