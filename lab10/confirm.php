<?php
/**
 * Created by PhpStorm.
 * User: paulfinamore
 * Date: 4/8/17
 * Time: 1:24 PM
 */
session_start();
$_pageTitle = "Confirmation";
require_once "_header.php";

if($_GET['state']==1)
{
    echo "<p>Logout confirmed. Please <a href='login.php'>Log in</a> again to view restricted content.</p>";
}
if($_GET['state']==2)
{
    echo "<p>Welcome back, " . $_SESSION['fname'] . "!</p>";
}
else
{
   echo "<p>Please continue by choosing an item from the menu.</p>";
}
require_once "_footer.php";
?>