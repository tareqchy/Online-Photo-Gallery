<?php 
// Start Session
session_start();

// Loading DB Information
require_once("config/db.php");

// If The user is not logged in redirect to login page
if(!isset($_SESSION['user_id']))
    header("Location: login.php");

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Online Photo Gallery</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <ul class="nav nav-tabs menu_inner">
                <li><a href="index.php">Albums</a></li>
                <li><a href="new-album.php">Add New Album</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        
        </div>    
    </div>