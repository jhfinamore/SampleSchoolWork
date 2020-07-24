<?php
/**
 * Created by PhpStorm.
 * User: paulfinamore
 * Date: 4/8/17
 * Time: 1:23 PM
 */

session_start();
session_unset();
session_destroy();
header("Location: confirm.php?state=1");
exit();

?>