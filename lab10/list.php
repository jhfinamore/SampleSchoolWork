<?php
/**
 * Created by PhpStorm.
 * User: paulfinamore
 * Date: 4/2/17
 * Time: 12:43 PM
 */
$_currentFile = basename($_SERVER['PHP_SELF']);
$_pageTitle = "Fan Database";
require_once "_header.php";
try
{
    $sql = "SELECT * FROM jhfinamor";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo "<table>";
    echo "<tr>
              <th>Options</th>
              <th>ID</th>
              <th>Username</th>
              <th>Last Name</th>
              <th>Email</th>
          </tr>";
    foreach ($result as $row)
    {
        echo "<tr>
                  <td><a href='item.php?ID=" . $row['ID'] . "'>VIEW</a> 
                      <a href='change.php?ID=" . $row['ID'] . "'>UPDATE</a> 
                      <a href='remove.php?ID=" . $row['ID'] . "&uname=" . $row['uname'] . "'>DELETE</a></td>
                  <td>" . $row['ID'] . "</td>
                  <td>" . $row['uname'] . "</td>
                  <td>" . $row['lname'] . "</td>
                  <td>". $row['email'] . "</td>
              </tr>";
    }
    echo "</table>";
}//try
catch (PDOException $e)
{
    echo "<p class='error'>ERROR selecting from database table! " .$e->getMessage() . "</p>";
    exit();
}//catch
require_once "_footer.php";
?>