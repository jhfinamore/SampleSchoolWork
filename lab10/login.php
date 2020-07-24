<?php
/**
 * Created by PhpStorm.
 * User: paulfinamore
 * Date: 4/8/17
 * Time: 12:55 PM
 */
$_pageTitle = "Login Form";
$showform = 1;
$errormsg = 0;
$erroruname = $errorpwd = "";
$inputdate = time();
require_once "_header.php";

if(isset($_SESSION['ID']))
{
    echo "<p class='error'>You are already logged in.</p>";
    include_once "_footer.php";
    exit();
}
if(isset($_POST['submit'])) {
    $formfield['uname'] = trim($_POST['uname']);
    $formfield['pwd'] = trim($_POST['pwd']);

    //Checking for empty field
    if (empty($formfield['uname'])) {
        $erroruname = "The username is required";
        $errormsg = 1;
    }
    if (empty($formfield['pwd'])) {
        $errorpwd = "The password is required";
        $errormsg = 1;
    }

    if ($errormsg != 0)
    {
        echo "<p class='error'>There are errors!</p>";
    }
    else
        {
        try {
            $user = "SELECT * FROM exampleform WHERE uname = :uname";
            $stmt = $pdo->prepare($user);
            $stmt->bindValue(':uname', $formfield['uname']);
            $stmt->execute();
            $row = $stmt->fetch();
            $countuser = $stmt->rowCount();
            if ($countuser < 1)
            {
                echo "<p class='error'>This user isn't in the database</p>";
            }
            else
                {
                if(password_verify($formfield['pwd'],$row['pwd']))
                {
                    $_SESSION['ID'] = $row['ID'];
                    $_SESSION['fname'] = $row['uname'];
                    $showform = 0;
                    header("Location: confirm.php?state=2");
                }
                else
                {
                    echo "<p class='error'>The username and the password combination you entered isn't correct. Please try again.</p>";
                }
            }
        } catch (PDOException $e) {
            echo "Error fetching users: " . $e->getMessage();
            exit();
        }
    }
}
if($showform = 1)
{
    ?>
    <form method="post" action="login.php" name="loginform">
        <table>
            <tr>
                <th><label for="uname">Username</label></th>
                <td><input type="text" id="uname" name="uname" size="30" value="<?php if(isset($formfield['uname'])) {echo $formfield['uname'];} ?>"/>
                    <span class="error">* <?php if(isset($erroruname)) {echo $erroruname;} ?></span></td>
            </tr>
            <tr>
                <th><label for="pwd">Password</label></th>
                <td><input type="password" id="pwd" name="pwd" /><span class="error">* <?php if(isset($errorpwd)) {echo $errorpwd;} ?></span></td>
            </tr>
            <tr>
                <th><label for="submit">Submit</label></th>
                <th><input type="submit" id="submit" name="submit" value="submit"/></th>
            </tr>
        </table>
    </form>
<?php
}
require_once "_footer.php"
?>