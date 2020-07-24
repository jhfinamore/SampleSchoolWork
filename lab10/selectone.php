<?php
/**
 * Created by PhpStorm.
 * User: jennis
 * Edited: Jack Finamore
 * Date: 2/17/2017
 * Time: 1:44 PM
 */
$_currentFile = basename($_SERVER['PHP_SELF']);
$_pageTitle ="Select All";
require_once "_header.php";
if(!isset($_SESSION['ID']))
{
    echo "<p>This page requires authenication. Please log in.";
    require_once "_footer.php";
    exit();
}
try
{
    $sql = "SELECT * FROM exampleform WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindvalue(':ID', $_GET['ID']);
    $stmt->execute();
    $row = $stmt->fetch();
    echo "<table>
            <tr><th>ID</th><td>" . $row['ID'] . "</td>
            <tr><th>Last Name</th><td>" . $row['lname'] . "</td></tr>
            <tr><th>First Name</th><td>" . $row['fname'] . "</td></tr>
            <tr><th>Username</th><td>" . $row['uname'] . "</td></tr>
            <tr><th>Email</th><td>" . $row['email'] . "</td></tr>

            <tr><th>Input Date</th><td>";
    echo date("F j, Y \a\\t h:i a", $row['inputdate']);
    echo "</td></tr></table>";
}//try
catch (PDOException $e)
{
    echo "<p class='error'>ERROR selecting from database table! " .$e->getMessage() . "</p>";
    exit();
}
    require_once "_footer.php";
?>
