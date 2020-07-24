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
    $sql = "SELECT * FROM exampleform";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo "<table>";
    echo "<tr>
              <th>Options</th>
              <th>ID</th>
              <th>Last Name</th>
              <th>First name</th>
              <th>Username</th>
          </tr>";
    foreach ($result as $row)
    {
        echo "<tr>
                  <td><a href='selectone.php?ID=" . $row['ID'] . "'>VIEW</a> |
                      <a href='update.php?ID=" . $row['ID'] . "'>UPDATE</a> |
                      <a href='delete.php?ID=" . $row['ID'] . "&uname=" . $row['uname'] . "'>DELETE</a></td>
                  <td>" . $row['ID'] . "</td>
                  <td>" . $row['lname'] . "</td>
                  <td>" . $row['fname'] . "</td>
                  <td>". $row['uname'] . "</td>
              </tr>";
    }
    echo "</table>";
}//try
catch (PDOException $e)
{
    echo "<p class='error'>ERROR selecting from database table! " .$e->getMessage() . "</p>";
    exit();
}
    require_once "_footer.php";
?>
