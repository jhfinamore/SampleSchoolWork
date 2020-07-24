<?php
/**
 * Created by Jack Finamore
*/
    $inputdate = time();
    $_formshow = 1;
    $_currentFile = basename($_SERVER['PHP_SELF']);
    $_pageTitle= "Jack's Fan Club";
    $errormsg = 0;
    $errorfname = $errorlname =  $erroruname = $errorethnicity = $errordob = $erroraddinfo = $erroremail = $errorpassword = $errorschoolyr = "";

    require_once "_header.php";

    if(isset($_POST['submit']))
    {
        $formfield['fname'] = trim($_POST['firstname']);
        $formfield['middleInitial'] = trim($_POST['middleinitial']);
        $formfield['lname'] = trim($_POST['lastname']);
        if(isset($_POST['jhf']) || !empty($_POST['jhf'])){$formfield['jhf'] = $_POST['jhf'];}
        $formfield['dateOfBirth'] = trim($_POST['dob']);
        $formfield['addinfo'] = trim($_POST['addinfo']);
        $formfield['url'] = trim(strtolower($_POST['url']));
        $formfield['email'] = trim(strtolower($_POST['useremail']));
        $formfield['password'] = trim($_POST['userpassword']);
        $formfield['school'] = ($_POST['school']);
        $formfield['uname'] = trim(strtolower($_POST['uname']));


        if(empty($formfield['fname'])) {$errorfname = "First Name is required."; $errormsg = 1;}
        if(empty($formfield['lname'])) {$errorlname = "Last Name is required."; $errormsg = 1;}
        if(!isset($formfield['jhf']) || empty($formfield['jhf'])) {$errorethnicity = "Ethnicity is required."; $errormsg = 1;}
        if(empty($formfield['dateOfBirth'])) {$errordob = "Date of birth is required."; $errormsg = 1;}
        if(empty($formfield['addinfo'])) {$erroraddinfo = "Additional information is required."; $errormsg = 1;}
        if(empty($formfield['email'])) {$erroremail = "Email is required."; $errormsg = 1;}
        if(empty($formfield['password'])) {$errorpassword = "Password is required."; $errormsg = 1;}
        if(empty($formfield['school'])) {$errorschoolyr = "School year is required."; $errormsg = 1;}
        if(empty($formfield['uname'])){$erroruname = "Username is required."; $errormsg = 1;}

        //Checking for duplicate usernames and emails
        try
        {
            $sqlusers = "SELECT * FROM jhfinamor WHERE uname = :uname";
            $stmtusers = $pdo->prepare($sqlusers);
            $stmtusers->bindValue(':uname', $formfield['uname']);
            $stmtusers->execute();
            $countusers = $stmtusers->rowCount();
            if($countusers > 0)
            {
                $erroruname = "The username is already taken.";
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
            $sqlemails = "SELECT * FROM jhfinamor WHERE email = :email";
            $stmtemails = $pdo->prepare($sqlemails);
            $stmtemails->bindValue(':email', $formfield['email']);
            $stmtemails->execute();
            $countemails = $stmtemails->rowCount();
            if($countemails > 0)
            {
                $erroremail = "The email is already taken.";
                $errormsg = 1;
            }
        }
        catch(PDOException $e)
        {
            echo "<p class='error'>ERROR selecting emails! " .$e->getMessage() . "</p>";
            exit();
        }

        if($errormsg != 0)
        {
            echo "<p class='error'>THERE ARE ERRORS! OH NO!</p>";
        }
        else
        {
            try
            {
                //INSERT DATA INTO THE DATABASE
                $sql = "INSERT INTO jhfinamor (fname, mi, lname, uname, email, password, ethnicity, dateofbirth, additionalinfo, url, schoolyear, inputdate)
                    VALUES (:fname, :mi, :lname, :uname, :email, :password, :ethnicity, :dateofbirth, :addinfo, :url, :school, :inputdate)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindvalue(':fname', $formfield['fname']);
                $stmt->bindvalue(':mi', $formfield['middleInitial']);
                $stmt->bindvalue(':lname', $formfield['lname']);
                $stmt->bindValue(':uname',$formfield['uname']);
                $stmt->bindValue(':email',$formfield['email']);
                $stmt->bindValue(':password',$formfield['password']);
                $stmt->bindValue(':ethnicity', $formfield['jhf']);
                $stmt->bindValue(':dateofbirth',$formfield['dateOfBirth']);
                $stmt->bindValue(':addinfo',$formfield['addinfo']);
                $stmt->bindValue(':url',$formfield['url']);
                $stmt->bindValue(':school',$formfield['school']);
                $stmt->bindvalue(':inputdate', $inputdate);
                $stmt->execute();

                //print confirmation
                echo "<p class='success'>SUCCESS!  Thank you!</p>";
                $_formshow = 0;
            }
            catch (PDOException $e)
            {
                echo "<p class='error'>ERROR inserting into the database table! " .$e->getMessage() . "</p>";
                exit();
            }
        }

    }//submit

    if($_formshow == 1) {
        ?>
        <p>Please enter your information to register to be a member right now!</p>
        <p class="error">* means a field that is required</p>
        <form method="post" action="form.php" name="myform">
            <fieldset>
                <legend>Login for Fan Database Information</legend>
                <table>
                    <tr>
                        <th><label class="main" for="firstname">First Name</label></th>
                        <td><input type="text" id="firstname" name="firstname" size="10" value="<?php if(isset($formfield['fname'])) {echo $formfield['fname'];}?>" />
                            <span class="error">* <?php if(isset($errorfname)) {echo $errorfname;} ?></span></td>
                    </tr>
                    <tr>
                        <th><label class="main" for="middleinitial">Middle Initial</label></th>
                        <td><input type="text" id="middleinitial" name="middleinitial" size="4" maxlength="1" value="<?php if(isset($formfield['middleInitial'])) {echo $formfield['middleInitial'];} ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th><label class="main" for="lastname">Last Name</label></th>
                        <td><input type="text" id="lastname" name="lastname" size="15" value="<?php if(isset($formfield['lname'])) {echo $formfield['lname'];}?>"/>
                            <span class="error">* <?php if(isset($errorlname)) {echo $errorlname;}?> </span></td>
                    </tr>
                    <tr>
                        <th><label class = "main" for="uname">Username</label></th>
                        <td><input type="text" id="uname" name="uname" value="<?php if(isset($formfield['uname'])) {echo  $formfield['uname'];}?>"/>
                        <span class="error">* <?php if(isset($erroruname)) {echo $erroruname;}?></span></td>
                    </tr>
                    <tr>
                        <th><label class="main" for="useremail">Email</label></th>
                        <td><input type="email" id="useremail" name="useremail" size="20" value="<?php if(isset($formfield['email'])) {echo $formfield['email'];} ?>"/>
                            <span class="error">* <?php if(isset($erroremail)) {echo $erroremail;} ?></span></td>
                    </tr>
                    <tr>
                        <th><label class="main" for="userpassword">Password</label></th>
                        <td><input type="password" id="userpassword" name="userpassword" size="20" value="<?php if(isset($formfield['password'])) {echo $formfield['password'];} ?>"/>
                            <span class="error">* <?php if(isset($errorpassword)) {echo $errorpassword;} ?></span></td>
                    </tr>
                </table>
            </fieldset>
            <br />
            <fieldset>
                <legend>Personal Information for user</legend>
                <table>
                    <tr>
                        <th><label class="main" for="jhf-cauc">Please choose what ethinicity you are.</label></th>
                        <td>
                            <input type="radio" id="jhf-cauc" name="jhf" value="c" <?php if(isset($formfield['jhf']) && $formfield['jhf'] == "c"){echo "checked";} ?> />
                            <label for="jhf-cauc">Caucasian</label><br/>
                            <input type="radio" id="jhf-afam" name="jhf" value="a" <?php if(isset($formfield['jhf']) && $formfield['jhf'] == "a"){echo "checked";} ?> />
                            <label for="jhf-afam">African American</label><br/>
                            <input type="radio" id="jhf-asian" name="jhf" value="s" <?php if(isset($formfield['jhf']) && $formfield['jhf'] == "s"){echo "checked";} ?> />
                            <label for="jhf-asian">Asian</label><br/>
                            <input type="radio" id="jhf-natam" name="jhf" value="n" <?php if(isset($formfield['jhf']) && $formfield['jhf'] == "n"){echo "checked";} ?> />
                            <label for="jhf-natam">Native American</label><br/>
                            <span class="error">* <?php if(isset($errorethnicity)) {echo $errorethnicity;} ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label class="main" for="dob">Please enter your date of birth</label></th>
                        <td><input type="text" id="dob" name="dob" size="20" value="<?php if(isset($formfield['dateOfBirth'])) {echo $formfield['dateOfBirth'];}?>"><span class="error">* <?php if(isset($errordob)) {echo $errordob;} ?></span></td>
                    </tr>
                    <tr>
                        <th><label class="main" for="addinfo">Please enter any additional information about yourself</label></th>
                        <td><textarea id="addinfo" name="addinfo" ><?php if(isset($formfield['addinfo'])) echo $formfield['addinfo'];?></textarea><span class="error">* <?php echo $erroraddinfo; ?></span></td>
                    </tr>
                    <tr>
                        <th><label class="main" for="url">URL</label></th>
                        <td><input type="url" id="url" name="url" size="20" value="<?php if(isset($formfield['url'])) {echo $formfield['url'];} ?>"/></td>
                    </tr>
                    <tr>
                        <th><label class="main" for="school">Please select your class year</label></th>
                        <td>
                            <select id="school" name="school">
                                <option value="" <?php if(isset($formfield['school'])) {if($formfield['school'] == ""){echo "selected";} }?>>Please choose one</option>
                                <option value="f" <?php if(isset($formfield['school']))  {if($formfield['school'] == "f"){echo "selected";} }?>>Freshman</option>
                                <option value="s" <?php if(isset($formfield['school']))  {if($formfield['school'] == "s"){echo "selected";} }?>>Sophomore</option>
                                <option value="j" <?php if(isset($formfield['school']))  {if($formfield['school'] == "j"){echo "selected";} }?>>Junior</option>
                                <option value="m" <?php if(isset($formfield['school']))  {if($formfield['school'] == "m"){echo "selected";} }?>>Senior</option>
                            </select><span class="error">* <?php if(isset($errorschoolyr)) {echo $errorschoolyr;} ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th><label class="main" for="submit">Submit</label></th>
                        <td><input type="submit" id="submit" name="submit"/></td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <br />
        <br />
<?php
    }
require_once "_footer.php"
?>