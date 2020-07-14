<!DOCTYPE html>
<html>
<head>
    <title>Contact Phone</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="container">
    <div id="navbar">
<?php
        echo '<a href="index.php">Home</a>';
        if (LOGGED) {
            echo '<a href="?action=add">Add Contact</a>';
            echo '<a href="?action=logout">Logout</a>';
        } else {
            echo '<a href="?action=login">Login</a>';
        }
?>
    </div>
    <div id="content">
