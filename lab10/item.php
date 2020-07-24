<?php
/**
 * Created by PhpStorm.
 * User: paulfinamore
 * Date: 4/2/17
 * Time: 12:50 PM
 */
$_currentFile = basename($_SERVER['PHP_SELF']);
$_pageTitle = "#1 Fan page";
require_once "_header.php";
try
{
    $sql = "SELECT * FROM jhfinamor WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindvalue(':ID', $_GET['ID']);
    $stmt->execute();
    $row = $stmt->fetch();
    echo "<table>
            <tr><th>ID</th><td>" . $row['ID'] . "</td>
            <tr><th>First Name</th><td>" . $row['fname'] . "</td></tr>
            <tr><th>Middle Initial</th><td>" . $row['mi'] . "</td></tr>
            <tr><th>Last Name</th><td>" . $row['lname'] . "</td></tr>
            <tr><th>Username</th><td>" . $row['uname'] . "</td></tr>
            <tr><th>Email</th><td>" . $row['email'] . "</td></tr>
            <tr><th>Password</th><td>Password is hidden for security reasons</td></tr>
            <tr><th>Ethnicity</th><td>". ethnicityChooser($row['ethnicity']) . "</td></tr>
            <tr><th>Date of Birth</th><td>". $row['dateofbirth'] . "</td></tr>
            <tr><th>Additional Info</th><td>". $row['additionalInfo'] . "</td></tr>
            <tr><th>URL</th><td>". $row['url'] . "</td></tr>
            <tr><th>School Year</th><td>". yearChooser($row['schoolyear']) . "</td></tr>
            <tr><th>Input Date</th><td>";
    echo date("F j, Y \a\\t h:i a", $row['inputdate']);
    echo "</td></tr></table>";
    echo "<br /> <br />";
}//try
catch (PDOException $e)
{
    echo "<p class='error'>ERROR selecting from database table! " .$e->getMessage() . "</p>";
    exit();
}
require_once "_footer.php";

function ethnicityChooser($c)
{
    if($c == 'c')
    {
        return "Caucasian";
    }
    else if($c == 'a')
    {
        return "African American";
    }
    else if($c == 's')
    {
        return "Asian";
    }
    else if($c == 'n')
    {
        return "Native American";
    }
    else
    {
        return "No ethnicity in database";
    }
}

function yearChooser($year)
{
    if($year == "f")
    {
        return "Freshman";
    }
    else if($year == "s")
    {
        return "Sophomore";
    }
    else if($year == "j")
    {
        return "Junior";
    }
    else if($year == "m")
    {
        return "Senior";
    }
    else
    {
        return "No school year in database";
    }
}