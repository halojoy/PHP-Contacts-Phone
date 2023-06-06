<?php

if ($req_get = $_GET) {
    if (isset($req_get['action'])) {
        if (is_file('action/'.$req_get['action'].'.php')) {
            require 'action/'.$req_get['action'].'.php';
        }
    }
}
require 'action/home.php';
