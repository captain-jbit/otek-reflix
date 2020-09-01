<?php

#import
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");


$userName='';
$password='';


#set the connection from config.php
$account = new Account($con);



#send form
if(isset($_POST["submitButton"])){

    $userName = FormSanitizer::sanitizeFormUsername($_POST["userName"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    #call validation
    $success=$account->login($userName,$password);

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
                <h3>Sign In</h3>
                <span>to continue to reflix</span>

            </div>

            <form method="POST">

                <?php echo $account->getError(Constants::$loginFailed);?> 
                <input type="text" placeholder="User Name" name="userName" value="<?php getInputValue("userName");?>" required />

                <input type="password" placeholder="Password" name="password" required />

                <input type="submit" name="submitButton" value="SUBMIT" />

            </form>

            <a href="register.php" class="sign_in_message">Need an account? Sign up here</a>

        </div>
    </div>
</body>


</html>