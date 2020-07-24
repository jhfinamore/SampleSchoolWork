<?php
/**
 * Created by PhpStorm.
 * User: paulfinamore
 * Date: 4/2/17
 * Time: 12:50 PM
 */
$_currentFile = basename($_SERVER['PHP_SELF']);
$_pageTitle = "Leaving Page";
$formshow = 1;
require_once "_header.php";

if(isset($_POST['delete']))
{
    try
    {
        $sql = "DELETE from jhfinamor WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ID', $_POST['ID']);
        $stmt->execute();

        //print confirmation
        echo "<p class='success'>Sorry to see you go! Thank you for being a fan!</p>";
        $formshow = 0;

    }
    catch(PDOException $e)
    {
        echo "<p class='error'>Error deleting data your fan data! Looks like you have to stick around " . $e->getMessage() . "</p>";
        exit();
    }
}//if submit

if($formshow == 1)
{
?>
<p>Confirm deletion of ID no. <?php echo $_GET['ID'];?> [User <?php echo $_GET['uname'];?>]</p>
<form id="removalform" method="post" action="remove.php" name="removalform">
    <input type="hidden" id="ID" name="ID" value="<?php echo $_GET['ID'];?>" />
    <input type="submit" id="delete" name="delete" value="YES" />
    <input type="button" id="nodelete" name="nodelete" value="NO" onClick="window.location='list.php'" />
</form>
<?php
}
require_once "_footer.php";
?>