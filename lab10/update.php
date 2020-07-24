<?php
/**
 * Created by PhpStorm.
 * User: jennis
 * Edited: Jack Finamore
 * Date: 3/15/2017
 * Time: 1:44 PM
 */
$_pageTitle = "Registration Form";
$_currentFile = basename($_SERVER['PHP_SELF']);
$showform = 1;
$errormsg = 0;
$errorfname = $errorlname = $erroruname = $erroremail = "";
require_once "_header.php";
if(!isset($_SESSION['ID']))
{
    echo "<p>This page requires authenication. Please log in.";
    require_once "_footer.php";
    exit();
}
?>
<?php
if(isset($_POST['submit'])) {
    //Retain Get
    $_GET['ID'] = $_POST['ID'];
    /* ****************************************************************************
      ALL FIELDS - STORE USER DATA; SANITIZE USER-ENTERED DATA
    ***************************************************************************** */
    $formfield['fname'] = trim($_POST['fname']);
    $formfield['lname'] = trim($_POST['lname']);
    $formfield['uname'] = trim($_POST['uname']);
    $formfield['email'] = trim($_POST['email']);
    //YOU NEED TO ADD UNAME AND EMAIL HERE

    /*  ****************************************************************************
       CHECK FOR EMPTY FIELDS FOR REQUIRED DATA ONLY; RADIO BUTTONS ARE ODD
    **************************************************************************** */
    if (empty($formfield['fname'])) {
        $errorfname = "The first name is required.";
        $errormsg = 1;
    }
    if (empty($formfield['lname'])) {
        $errorlname = "The last name is required.";
        $errormsg = 1;
    }
    if(empty($formfield['uname'])) {
        $erroruname = "The username is required.";
        $errormesg = 1;
    }
    if(empty($formfield['email'])){
        $erroremail = "Email is required";
        $errormesg = 1;
    }

    /**********************************************************************************
    CHECK FOR DUPLICATE ERRORS
     *********************************************************************************/
    if($formfield['uname'] != $_POST['origuname'])
    {
        try {
            $sqlusers = "SELECT * FROM exampleform WHERE uname = :uname";
            $stmtusers = $pdo->prepare($sqlusers);
            $stmtusers->bindValue(':uname', $formfield['uname']);
            $stmtusers->execute();
            $countusers = $stmtusers->rowCount();
            if ($countusers > 0) {
                $erroruname = " The username is already taken.";
                $errormsg = 1;
            }
        } catch (PDOException $e) {
            echo "<p class='error'>ERROR selecting users! " . $e->getMessage() . "</p>";
            exit();
        }
    }

    if($formfield['email'] != $_POST['origemail'])
    {
        try {
            $sqlemails = "SELECT * FROM exampleform WHERE email = :email";
            $stmtemails = $pdo->prepare($sqlemails);
            $stmtemails->bindValue(':email', $formfield['email']);
            $stmtemails->execute();
            $countemails = $stmtemails->rowCount();
            if ($countemails > 0) {
                $erroremail = " The email is already taken.";
                $errormsg = 1;
            }
        } catch (PDOException $e) {
            echo "<p class='error'>ERROR selecting emailss! " . $e->getMessage() . "</p>";
            exit();
        }
    }

    /*  ****************************************************************************
        CONTROL FOR ERRORS.  IF ERRORS, DISPLAY THEM.  IF NOT, CONTINUE WITH FORM PROCESSING.
        **************************************************************************** */
    if ($errormsg != 0)
    {
        //print error message
        echo "<p class='error'>THERE ARE ERRORS! Repopulating missing data with original values.</p>";
    }
    else
    {
        try
        {
            /*  ****************************************************************************
                INSERT DATA INTO THE DATABASE
            **************************************************************************** */
            //YOU NEED TO ADD THE CODE FOR UNAME AND EMAIL
            $sql = "UPDATE exampleform SET fname = :fname, lname = :lname, uname = :uname, email = :email WHERE ID = :ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindvalue(':fname', $formfield['fname']);
            $stmt->bindvalue(':lname', $formfield['lname']);
            $stmt->bindValue(':uname',$formfield['uname']);
            $stmt->bindValue(':email',$formfield['email']);
            $stmt->bindvalue(':ID', $_POST['ID']);
            $stmt->execute();

           //print confirmation
            echo "<p class='success'>SUCCESS!  Thank you!</p>";
            $showform = 0;
        }
        catch (PDOException $e)
        {
            echo "<p class='error'>ERROR updating data into the database! " .$e->getMessage() . "</p>";
            exit();
        }
    }//else error message
}//submit

if($showform == 1)
{
    //Collect Data to populate the form
    $sql = "SELECT * FROM exampleform WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':ID', $_GET['ID']);
    $stmt->execute();
    $row = $stmt->fetch();
?>
<form id="updateform" method="post" action="update.php" name="updateform">
    <table>
        <tr>
            <th><label for="fname">First Name</label></th>
            <td><input type="text" id="fname" name="fname" size="25" value="<?php if(isset($formfield['fname']) && !empty($formfield['fname'])) {echo $formfield['fname'];} else{echo $row['fname'];}?>" /><span class="error">* <?php echo $errorfname; ?></span>
           </td>
        </tr>
        <tr>
            <th><label for="lname">Last Name</label></th>
            <td><input type="text" id="lname" name="lname" size="25" value="<?php if(isset($formfield['lname']) && !empty($formfield['lname'])) {echo $formfield['lname'];} else{echo $row['lname'];}?>"/><span class="error">* <?php echo $errorlname; ?></span></td>
        </tr>
        <tr>
            <th><label for="uname">Username</label></th>
            <td><input type="text" id="uname" name="uname" value="<?php if(isset($formfield['uname']) && !empty($formfield['uname'])) {echo $formfield['uname'];} else{echo $row['uname'];}?>" /><span class="error">* <?php echo $erroruname; ?></span></td>
        </tr>
        <tr>
            <th><label for="email">Email</label></th>
            <td><input type="email" id="email" name="email" size="20" value="<?php if(isset($formfield['email']) && !empty($formfield['email'])) {echo $formfield['email'];} else{echo $row['email'];}?>"><span class="error">* <?php echo $erroremail; ?></span> </td>
        </tr>
        <tr>
            <th><label for="submit">Submit</label></th>
            <td><input type="hidden" name="ID" id="ID" value="<?php if(isset($row['ID'])){echo $row['ID'];}?>"/>
                <input type="hidden" id="origuname" name="origuname" value="<?php echo $row['uname'];?>" />
                <input type="hidden" id="origemail" name="origemail" value="<?php echo $row['email'];?>" />
                <input type="submit" id="submit" name="submit" value="submit"/></td>

        </tr>

    </table>
</form>
    <?php
}//showform
    require_once "_footer.php";
?>
