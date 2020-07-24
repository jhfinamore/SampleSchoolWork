<?php
/**
 * Created by PhpStorm.
 * User: paulfinamore
 * Date: 4/2/17
 * Time: 12:50 PM
 */
$_currentFile = basename($_SERVER['PHP_SELF']);
$inputdate = time();
$_pageTitle = "Updating Fan page";
$formshow = 1;
$errorfname = $errorlname =  $erroruname = $errorethnicity = $errordob = $erroraddinfo = $erroremail = $errorpassword = $errorschoolyr = $errormsg = "";
require_once "_header.php";
if(isset($_POST['submit'])) {
    //Retain Get
    $_GET['ID'] = $_POST['ID'];
    $formfield['fname'] = trim($_POST['fname']);
    $formfield['mi'] = trim($_POST['mi']);
    $formfield['lname'] = trim($_POST['lname']);
    $formfield['jhf'] = ($_POST['jhf']);
    $formfield['dateOfBirth'] = trim($_POST['dob']);
    $formfield['addinfo'] = trim($_POST['addinfo']);
    $formfield['url'] = trim(strtolower($_POST['url']));
    $formfield['email'] = trim(strtolower($_POST['email']));
    $formfield['password'] = trim($_POST['password']);
    $formfield['school'] = ($_POST['school']);
    $formfield['uname'] = trim(strtolower($_POST['uname']));


    //Checking for data in fields
    if (empty($formfield['fname'])) {$errorfname = "The first name is required.";$errormsg = 1;}
    if (empty($formfield['lname'])) {$errorlname = "The last name is required.";$errormsg = 1;}
    if(empty($formfield['uname'])) {$erroruname = "The username is required.";$errormesg = 1;}
    if(empty($formfield['email'])){$erroremail = "Email is required";$errormesg = 1;}
    if(empty($formfield['password'])) {$errorpassword = "Password is required";$errormsg = 1;}
    if(!isset($formfield['jhf']) || empty($formfield['jhf'])) {$errorethnicity = "Ethnicity is required."; $errormsg = 1;}
    if(empty($formfield['dateOfBirth'])) {$errordob = "Date of birth is required."; $errormsg = 1;}
    if(empty($formfield['addinfo'])) {$erroraddinfo = "Additional information is required."; $errormsg = 1;}
    if(empty($formfield['email'])) {$erroremail = "Email is required."; $errormsg = 1;}
    if(empty($formfield['school'])) {$errorschoolyr = "School year is required."; $errormsg = 1;}

   //checking for duplicate users
    if($formfield['uname'] != $_POST['origuname'])
    {
        try {
            $sqlusers = "SELECT * FROM jhfinamor WHERE uname = :uname";
            $stmtusers = $pdo->prepare($sqlusers);
            $stmtusers->bindValue(':uname', $formfield['uname']);
            $stmtusers->execute();
            $countusers = $stmtusers->rowCount();
            if ($countusers > 0) {
                $erroruname = " The username is already taken.";
                $errormsg = 1;
            }
        } catch (PDOException $e) {
            echo "<p class='error'>ERROR getting users! " . $e->getMessage() . "</p>";
            exit();
        }
    }

    if($formfield['email'] != $_POST['origemail'])
    {
        try {
            $sqlemails = "SELECT * FROM jhfinamor WHERE email = :email";
            $stmtemails = $pdo->prepare($sqlemails);
            $stmtemails->bindValue(':email', $formfield['email']);
            $stmtemails->execute();
            $countemails = $stmtemails->rowCount();
            if ($countemails > 0) {
                $erroremail = " The email is already taken.";
                $errormsg = 1;
            }
        } catch (PDOException $e) {
            echo "<p class='error'>ERROR getting emails! " . $e->getMessage() . "</p>";
            exit();
        }
    }

    //Error checking
    if ($errormsg != 0)
    {
        //print error message
        echo "<p class='error'>THERE ARE ERRORS! Repopulating missing data with original values.</p>";
    }
    else
    {
        try
        {
            //Inserting data into table
            $sql = "UPDATE jhfinamor SET fname = :fname,mi = :mi, lname = :lname, uname = :uname, email = :email, password = :password, ethnicity = :ethnicity, dateofbirth = :dateofbirth, additionalInfo = :additionalinfo, url = :url, schoolyear = :schoolyear, inputdate = :inputdate WHERE ID = :ID";
            $stmt = $pdo->prepare($sql);
            $stmt->bindvalue(':fname', $formfield['fname']);
            $stmt->bindValue(':mi', $formfield['mi']);
            $stmt->bindvalue(':lname', $formfield['lname']);
            $stmt->bindValue(':uname',$formfield['uname']);
            $stmt->bindValue(':email',$formfield['email']);
            $stmt->bindValue(':password',$formfield['password']);
            $stmt->bindValue(':ethnicity', $formfield['jhf']);
            $stmt->bindValue(':dateofbirth', $formfield['dateOfBirth']);
            $stmt->bindValue(':additionalinfo', $formfield['addinfo']);
            $stmt->bindValue(':url',$formfield['url']);
            $stmt->bindValue(':schoolyear',$formfield['school']);
            $stmt->bindValue(':inputdate',$inputdate);
            $stmt->bindvalue(':ID', $_POST['ID']);
            $stmt->execute();

            //print confirmation
            echo "<p class='success'>SUCCESS!  Thank you!</p>";
            $formshow = 0;
        }
        catch (PDOException $e)
        {
            echo "<p class='error'>ERROR updating data into the database! " .$e->getMessage() . "</p>";
            exit();
        }
    }//else error message
}//submit

if($formshow == 1) {
//Collect Data to populate the form
    $sql = "SELECT * FROM jhfinamor WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':ID', $_GET['ID']);
    $stmt->execute();
    $row = $stmt->fetch();
    ?>
    <form id="updateform" method="post" action="change.php" name="updateform">
        <table>
            <tr>
                <th><label for="fname">First Name</label></th>
                <td><input type="text" id="fname" name="fname" size="25"
                           value="<?php if (isset($formfield['fname']) && !empty($formfield['fname'])) {
                               echo $formfield['fname'];
                           } else {
                               echo $row['fname'];
                           } ?>"/><span class="error">* <?php echo $errorfname; ?></span></td>
            </tr>
            <tr>
                <th><label for="mi">Middle Initial</label></th>
                <td><input type="text" id="mi" name="mi"  value="<?php if (isset($formfield['mi']) && !empty($formfield['mi'])) {
                        echo $formfield['mi'];
                    } else {
                        echo $row['mi'];
                    } ?>"/></td>
            </tr>
            <tr>
                <th><label for="lname">Last Name</label></th>
                <td><input type="text" id="lname" name="lname" size="25"
                           value="<?php if (isset($formfield['lname']) && !empty($formfield['lname'])) {
                               echo $formfield['lname'];
                           } else {
                               echo $row['lname'];
                           } ?>"/><span class="error">* <?php echo $errorlname; ?></span></td>
            </tr>
            <tr>
                <th><label for="uname">Username</label></th>
                <td><input type="text" id="uname" name="uname"
                           value="<?php if (isset($formfield['uname']) && !empty($formfield['uname'])) {
                               echo $formfield['uname'];
                           } else {
                               echo $row['uname'];
                           } ?>"/><span class="error">* <?php echo $erroruname; ?></span></td>
            </tr>
            <tr>
                <th><label for="email">Email</label></th>
                <td><input type="email" id="email" name="email" size="20"
                           value="<?php if (isset($formfield['email']) && !empty($formfield['email'])) {
                               echo $formfield['email'];
                           } else {
                               echo $row['email'];
                           } ?>"><span class="error">* <?php echo $erroremail; ?></span></td>
            </tr>
            <tr>
                <th><label for="password">Password</label></th>
                <td><input type="password" id="password" name="password"
                           value="<?php if(isset($formfield['password']) && !empty($formfield['password'])) {
                            echo $formfield['password'];} else {echo $row['password'];}?>" ></td>
            </tr>
            <tr>
                <th><label class="main" for="jhf-cauc">Please choose what ethinicity you are.</label></th>
                <td>
                    <input type="radio" id="jhf-cauc" name="jhf" value="c" <?php if(isset($formfield['jhf']) && $formfield['jhf'] == "c"){echo "checked";}
                    else{ if($row['ethnicity'] == "c"){echo "checked";}}?> />
                    <label for="jhf-cauc">Caucasian</label><br/>
                    <input type="radio" id="jhf-afam" name="jhf" value="a" <?php if(isset($formfield['jhf']) && $formfield['jhf'] == "a"){echo "checked";}
                    else{ if($row['ethnicity'] == "a"){echo "checked";} }?> />
                    <label for="jhf-afam">African American</label><br/>
                    <input type="radio" id="jhf-asian" name="jhf" value="s" <?php if(isset($formfield['jhf']) && $formfield['jhf'] == "s"){echo "checked";}
                    else{ if($row['ethnicity'] == "s"){echo "checked";} }?> />
                    <label for="jhf-asian">Asian</label><br/>
                    <input type="radio" id="jhf-natam" name="jhf" value="n" <?php if(isset($formfield['jhf']) && $formfield['jhf'] == "n"){echo "checked";}
                    else{ if($row['ethnicity'] == "n"){echo "checked";} }?> />
                    <label for="jhf-natam">Native American</label><br/>
                    <span class="error">* <?php if(isset($errorethnicity)) {echo $errorethnicity;} ?></span>
                </td>
            </tr>
            <tr>
                <th><label class="main" for="dob">Please enter your date of birth</label></th>
                <td><input type="text" id="dob" name="dob" size="20" value="<?php if(isset($formfield['dateOfBirth']) && !empty($formfield['dateOfBirth'])) {echo $formfield['dateOfBirth'];}
                else {echo $row['dateofbirth'];}?>">
                    <span class="error">* <?php if(isset($errordob)) {echo $errordob;} ?></span></td>
            </tr>
            <tr>
                <th><label class="main" for="addinfo">Please enter any additional information about yourself</label></th>
                <td><textarea id="addinfo" name="addinfo" ><?php if(isset($formfield['addinfo']) && !empty($formfield['addinfo'])){ echo $formfield['addinfo'];}
                        else{echo $row['additionalInfo'];}?></textarea>
                    <span class="error">* <?php echo $erroraddinfo; ?></span></td>

            </tr>
            <tr>
                <th><label class="main" for="url">URL</label></th>
                <td><input type="url" id="url" name="url" size="20" value="<?php if(isset($formfield['url']) && !empty($formfield['url'])) {echo $formfield['url'];}
                else {echo $row['url'];}?>"/></td>
            </tr>
            <tr>
                <th><label class="main" for="school">Please select your class year</label></th>
                <td>
                    <select id="school" name="school">
                        <option value="" <?php if(isset($formfield['school']) && !empty($formfield['school'])) {if($formfield['school'] == ""){echo "selected";} } ?>>Please choose one</option>
                        <option value="f" <?php if(isset($formfield['school']) && !empty($formfield['school']))  {if($formfield['school'] == "f"){echo "selected";} }else{ if($row['schoolyear'] == "f") echo "selected"; }?>>Freshman</option>
                        <option value="s" <?php if(isset($formfield['school']) && !empty($formfield['school']))  {if($formfield['school'] == "s"){echo "selected";} }else{  if($row['schoolyear'] == "s") echo "selected"; }?>>Sophomore</option>
                        <option value="j" <?php if(isset($formfield['school']) && !empty($formfield['school']))  {if($formfield['school'] == "j"){echo "selected";} } else{ if($row['schoolyear'] == "j") echo "selected"; }?>>Junior</option>
                        <option value="m" <?php if(isset($formfield['school']) && !empty($formfield['school']))  {if($formfield['school'] == "m"){echo "selected";} } else{  if($row['schoolyear'] == "m") echo "selected"; }?>>Senior</option>
                    </select><span class="error">* <?php if(isset($errorschoolyr)) {echo $errorschoolyr;} ?></span>
                </td>
            </tr>
            <tr>
                <th><label for="submit">Submit</label></th>
                <td><input type="hidden" name="ID" id="ID" value="<?php if (isset($row['ID'])) {
                        echo $row['ID'];
                    } ?>"/>
                    <input type="hidden" id="origuname" name="origuname" value="<?php echo $row['uname']; ?>"/>
                    <input type="hidden" id="origemail" name="origemail" value="<?php echo $row['email']; ?>"/>
                    <input type="submit" id="submit" name="submit" value="submit"/></td>
            </tr>
        </table>
    </form>
    <br />
    <br />
    <br />
    <?php
}
require_once "_footer.php";
?>