<?php

if (isset($_COOKIE['contact3ex'])) {
    setcookie('contact3ex', $_COOKIE['contact3ex'], time()+14*24*3600);
    define('LOGGED', true);
} else {
    define('LOGGED', false);
}
