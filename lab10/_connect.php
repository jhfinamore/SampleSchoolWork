<?php
/**
 * Created by PhpStorm.
 * User: paulfinamore
 * Date: 3/21/17
 * Time: 11:44 AM
 */
$_currentFile = basename($_SERVER['PHP_SELF']);
$dsn = 'mysql:host=localhost;dbname=csci303sp17';
$user = 'csci303sp17';
$pwd = 'csci303sp17!';
try{
    $pdo = new PDO($dsn, $user, $pwd);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
   echo "Error connecting to database!" . $e->getMessage();
   exit();
}
?>