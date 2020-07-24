<?php
/**
 * Created by PhpStorm.
 * User: paulfinamore
 * Date: 3/24/17
 * Time: 10:08 AM
 */
$_pageTitle = "Delete Form";
$showform = 1;
require_once "_header.php";
if(!isset($_SESSION['ID']))
{
    echo "<p>This page requires authenication. Please log in.";
    require_once "_footer.php";
    exit();
}
if(isset($_POST['delete']))
{
    try
    {
        $sql = "DELETE from exampleform WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ID', $_POST['ID']);
        $stmt->execute();

        //print confirmation
        echo "<p class='success'>Success connecting to data! Thank you!</p>";
        $showform = 0;

    }
    catch(PDOException $e)
    {
        echo "<p class='error'>ERROR deleting data! " . $e->getMessage() . "</p>";
        exit();
    }
}//if submit

if($showform == 1)
{

?>
<p>Confirm deletion of ID no. <?php echo $_GET['ID'];?> [User <?php echo $_GET['uname'];?>]</p>
<form id="deleteform" method="post" action="delete.php" name="deleteform">
    <input type="hidden" id="ID" name="ID" value="<?php echo $_GET['ID'];?>" />
    <input type="submit" id="delete" name="delete" value="YES" />
    <input type="button" id="nodelete" name="nodelete" value="NO" onClick="window.location='selectall.php'" />

</form>

<?php
}//if showform
    require_once "_footer.php";
?>
