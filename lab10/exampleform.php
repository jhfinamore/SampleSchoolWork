<?php
/**
 * Created by PhpStorm.
 * User: jennis
 * Date: 3/15/2017
 * Time: 1:44 PM
 */
$_pageTitle = "Registration Form";
$_currentFile = basename($_SERVER['PHP_SELF']);
$showform = 1;
$errormsg = 0;
$errorfname = $errorlname = $erroruname = $erroremail = $errorpwd = $errorpwdc = $errorpwdmatch = "";
$inputdate = time();
require_once "_header.php";
?>
<?php
if(isset($_POST['submit'])) {
    /* ****************************************************************************
      ALL FIELDS - STORE USER DATA; SANITIZE USER-ENTERED DATA
    ***************************************************************************** */
    $formfield['fname'] = trim($_POST['fname']);
    $formfield['lname'] = trim($_POST['lname']);
    $formfield['uname'] = trim(strtolower($_POST['uname']));
    $formfield['email'] = trim($_POST['email']);
    $formfield['pwd'] = trim($_POST['pwd']);
    $formfield['pwdc'] = trim($_POST['pwdc']);
    $formfield['bio'] = trim($_POST['bio']);

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
    if(empty($formfield['pwd']))
    {
        $errorpwd = "The password is required";
        $errormsg = 1;
    }
    if(empty($formfield['pwdc']))
    {
        $errorpwdc = "The confirmation password is required";
        $errormsg = 1;
    }
    if(empty($formfield['bio']))
    {
        $errorbio = "The biography is required";
        $errormsg = 1;
    }

    //Checking to see if the two password are the same
    if($formfield['pwd'] != $formfield['pwdc'])
    {
        $errorpwdmatch = "The passwords do not match";
        $errormsg = 1;
    }
    /**********************************************************************************
                        CHECK FOR DUPLICATE ERRORS
     *********************************************************************************/

    try
    {
        $sqlusers = "SELECT * FROM exampleform WHERE uname = :uname";
        $stmtusers = $pdo->prepare($sqlusers);
        $stmtusers->bindValue(':uname', $formfield['uname']);
        $stmtusers->execute();
        $countusers = $stmtusers->rowCount();
        if($countusers > 0)
        {
            $erroruname = " The username is already taken.";
            $errormsg = 1;
        }
    }
    catch(PDOException $e)
    {
        echo "<p class='error'>ERROR selecting users! " .$e->getMessage() . "</p>";
        exit();
    }

    try
    {
        $sqlemails = "SELECT * FROM exampleform WHERE email = :email";
        $stmtemails = $pdo->prepare($sqlemails);
        $stmtemails->bindValue(':email', $formfield['email']);
        $stmtemails->execute();
        $countemails = $stmtemails->rowCount();
        if($countemails > 0)
        {
            $erroremail = " The email is already taken.";
            $errormsg = 1;
        }
    }
    catch(PDOException $e)
    {
        echo "<p class='error'>ERROR selecting emails! " .$e->getMessage() . "</p>";
        exit();
    }

    /*  ****************************************************************************
        CONTROL FOR ERRORS.  IF ERRORS, DISPLAY THEM.  IF NOT, CONTINUE WITH FORM PROCESSING.
        **************************************************************************** */
    if ($errormsg != 0)
    {
        //print error message
        echo "<p class='error'>THERE ARE ERRORS!</p>";
    }
    else
    {
        try
        {
            /*  ****************************************************************************
                INSERT DATA INTO THE DATABASE
            **************************************************************************** */
            //YOU NEED TO ADD THE CODE FOR UNAME AND EMAIL
            $sql = "INSERT INTO exampleform (fname, lname, uname, email, pwd, bio, inputdate)
                    VALUES (:fname, :lname, :uname, :email, :pwd, :bio, :inputdate)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindvalue(':fname', $formfield['fname']);
            $stmt->bindvalue(':lname', $formfield['lname']);
            $stmt->bindValue(':uname',$formfield['uname']);
            $stmt->bindValue(':email',$formfield['email']);
            $stmt->bindValue(':pwd', password_hash($formfield['pwd'], PASSWORD_BCRYPT));
            $stmt->bindValue(':bio',$formfield['bio']);
            $stmt->bindvalue(':inputdate', $inputdate);
            $stmt->execute();

           //print confirmation
            echo "<p class='success'>SUCCESS!  Thank you!</p>";
            $showform = 0;
        }
        catch (PDOException $e)
        {
            echo "<p class='error'>ERROR inserting into the database table! " .$e->getMessage() . "</p>";
            exit();
        }
    }//else error message
}//submit

if($showform == 1)
{
?>
<form method="post" action="exampleform.php" name="myform">
    <table>
        <tr>
            <th><label for="fname">First Name</label></th>
            <td><input type="text" id="fname" name="fname" size="25" value="<?php if(isset($formfield['fname'])) {echo $formfield['fname'];}?>" /><span class="error">* <?php if(isset($errorfname)){echo $errorfname;} ?></span></td>
        </tr>
        <tr>
            <th><label for="lname">Last Name</label></th>
            <td><input type="text" id="lname" name="lname" size="25" value="<?php if(isset($formfield['lname'])) {echo $formfield['lname'];}?>"/><span class="error">* <?php if(isset($errorlname)){echo $errorlname;} ?></span></td>
        </tr>
        <tr>
            <th><label for="uname">Username</label></th>
            <td><input type="text" id="uname" name="uname" value="<?php if(isset($formfield['uname'])) {echo $formfield['uname'];}?>" /><span class="error">* <?php if(isset($erroruname)) {echo $erroruname;} ?></span></td>
        </tr>
        <tr>
            <th><label for="email">Email</label></th>
            <td><input type="email" id="email" name="email" size="20" value="<?php if(isset($formfield['email'])) {echo $formfield['email'];}?>"><span class="error">* <?php if(isset($erroremail)) {echo $erroremail;} ?></span> </td>
        </tr>
        <tr>
            <th><label for="pwd">Password</label></th>
            <td><input type="password" id="pwd" name="pwd"/><span class="error">* <?php if(isset($errorpwd)){echo $errorpwd;} ?><br /><?php if(isset($errorpwdmatch)) {echo $errorpwdmatch;} ?></span></td>
        </tr>
        <tr>
            <th><label for="pwdc">Confirmation Password</label></th>
            <td><input type="password" id="pwdc" name="pwdc"/><span class="error">* <?php if(isset($errorpwdc)){echo $errorpwdc;} ?></span></td>
        </tr>
        <tr>
            <th><label for="bio">Biography</label></th>
            <td><textarea id="bio" name="bio"><?php if(isset($formfield['bio'])){echo $formfield['bio'];}?></textarea><span class="error">* <?php if(isset($errorbio)){ echo $errorbio;} ?></span></td>
        </tr>
        <tr>
            <th><label for="submit">Submit</label></th>
            <td><input type="submit" id="submit" name="submit" value="submit"/></td>
        </tr>

    </table>
</form>
    <?php
}//showform
    require_once "_footer.php";
?>
