<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Jack Finamore
 * Date: 2/16/17
 * Time: 11:59 AM
 */
$_currentFile = basename($_SERVER['PHP_SELF']);
//SET TIME ZONE
ini_set('date.timezone', 'American/New_York');
date_default_timezone_set('America/New_York');

//Error Reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Connecting to Database
require_once "_connect.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5o7mj88vhvtv3r2c5v5qo4htc088gcb5l913qx5wlrtjn81y"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css" />
    <title>Jack Finamore Home</title>
</head>
<body>
<header>
    <h1>Jack Finamore's Webpage</h1>
    <nav>
        <ul>
            <li><?php if($_currentFile == "index.php"){ echo "Home";} else{echo "<a href='index.php'>Home</a>";}?></li>
            <li><?php if($_currentFile == "jhfinamore.php"){echo "More About Me";} else{echo "<a href='jhfinamore.php'>More about me page</a>";}?></li>
            <li><?php if($_currentFile == "dogs.php"){echo "My Dogs";} else{echo "<a href='dogs.php'>Dog page</a>"; }?></li>
            <li><?php if($_currentFile == "table.php"){echo "My Favorite Movies";} else{echo "<a href='table.php'>My Favorite Movies page</a>";}?></li>
            <li><?php if($_currentFile == "form.php"){echo "Fan Club Registration";} else{echo "<a href='form.php'>Fan Registration</a>"; }?></li>
            <li><?php if($_currentFile == "exampleform.php"){echo "Example form";} else {echo "<a href='exampleform.php'>Example Form</a>";}?></li>
            <li><?php if($_currentFile == "selectall.php"){echo "Select all";} else {echo "<a href='selectall.php'>Select all</a>";}?></li>
            <li><?php if($_currentFile == "list.php"){echo "Fan Database";} else {echo "<a href='list.php'>Fan Database</a>";}?></li>
            <?php if(isset($_SESSION['ID'])) { echo "<li><a href='logout.php'>Log Out</a></li>";}else{ echo "<li><a href='login.php'>Log In</a></li>";} ?>
        </ul>
    </nav>
</header>
<h2><?php echo $_pageTitle ?></h2>
<aside>
    <?php
        include "_aside.php";
    ?>
</aside>
<div id="main">