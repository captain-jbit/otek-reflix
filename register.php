<?php
#import
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$firstName='';
$lastName='';
$userName='';
$password='';
$password2='';
$email='';
$email2='';

#set the connection from config.php
$account = new Account($con);




#send form
if(isset($_POST["submitButton"])){

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $userName = FormSanitizer::sanitizeFormUsername($_POST["userName"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);

    #call validation
$success=$account->register($firstName,$lastName,$userName,$password,$password2,$email,$email2);

#if true riderect to index
if($success){
    $_SESSION["userLoggedIn"]=$userName;
    header("Location: index.php");
}

}

#for remebering the user input
function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}



?>


<!DOCTYPE html>
<html>

<head>
    <title>Welcome to REFLIX</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
</head>

<body>
    <div class="sign_in_container">

        <div class="column">

            <div class="header">
                <img src="assets/images/logo.png" title="Logo" alt="logo" />
                <h3>Sign up</h3>
                <span>to continue to reflix</span>

            </div>

            <form method="POST">

                <?php echo $account->getError(Constants::$firstNameCharecters);?>
                <input type="text" placeholder="First Name" name="firstName" value="<?php getInputValue("firstName");?>" required />

                <?php echo $account->getError(Constants::$lastNameCharecters);?>
                <input type="text" placeholder="Last Name" name="lastName" value="<?php getInputValue("lastName");?>" required />

                <?php echo $account->getError(Constants::$userNameCharecters);?>
                <?php echo $account->getError(Constants::$userNameTaken);?>
                <input type="text" placeholder="User Name" name="userName" value="<?php getInputValue("userName");?>" required />

                <?php echo $account->getError(Constants::$emailDontMatch);?>
                <?php echo $account->getError(Constants::$emailInvalid);?>
                <?php echo $account->getError(Constants::$emailTaken);?>
                <input type="email" placeholder="Email" name="email" value="<?php getInputValue("email");?>" required />

                <input type="email" placeholder="Confirm Email" name=" email2" value="<?php getInputValue("email2");?>" required />

                <?php echo $account->getError(Constants::$passwordsDontMatch);?>
                <?php echo $account->getError(Constants::$passwordLength);?>
                <input type="password" placeholder="Password" name="password" required />

                <input type="password" placeholder="Confirm Password " name="password2" required />

                <input type="submit" name="submitButton" value="SUBMIT" />

            </form>

            <a href="login.php" class="sign_in_message">Already have an account? Sing in here</a>

        </div>
    </div>
</body>


</html>