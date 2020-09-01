<?php

class Account {


    private $con;
    private $errorArray =array();

    #constructor
    public function __construct($con){
        $this->con = $con;
    }


    #login
    public function login($un,$pw){
    $pw = hash("sha512",$pw);

    $query = $this->con->prepare("SELECT * FROM users WHERE userName=:un AND password=:pw");

    $query->bindValue(":un",$un);
    $query->bindValue(":pw",$pw);

    $query->execute();

    if($query->rowCount()==1){
        return true;
    }
    #push to error array
    array_push($this->errorArray,Constants::$loginFailed);
    return false;

    }



    #check validation register
    public function register($fn,$ln,$un,$pw,$pw2,$em,$em2){
        $this->validateFirstName($fn);
        $this->validateLastName($ln);
        $this->validateUserName($un);
        $this->validateEmail($em,$em2);
        $this->validatePassword($pw,$pw2);
        
        if(empty($this->errorArray)){#if this error array is empty
            return $this->insertUserDetails($fn,$ln,$un,$em,$pw);
        }
        return false;

    }

    #inserting the user data
    private function insertUserDetails($fn,$ln,$un,$em,$pw){
        $pw = hash("sha512",$pw);#hash the password
        $query = $this->con->prepare("INSERT INTO users(firstName,lastName,userName,email,password)
        VALUES (:fn,:ln,:un,:em,:pw)");
        $query->bindValue(":fn",$fn);
        $query->bindValue(":ln",$ln);
        $query->bindValue(":un",$un);
        $query->bindValue(":em",$em);
        $query->bindValue(":pw",$pw);

        return $query->execute();
    }

    #first name validation Private
    private function validateFirstName($fn){
        if(strlen($fn)<2 || strlen($fn)>25){
            array_push($this->errorArray, Constants::$firstNameCharecters);
        }
    }

    #last name validation Private
    private function validateLastName($ln){
        if(strlen($ln)<2 || strlen($ln)>25){
            array_push($this->errorArray, Constants::$lastNameCharecters);
        }
    }

     #user name validation Private
     private function validateUserName($un){
        if(strlen($un)<2 || strlen($un)>25){
            array_push($this->errorArray, Constants::$userNameCharecters);
            return;
        }
        #SQL QUERY
        $query = $this->con->prepare("SELECT * FROM users WHERE userName=:un");
        $query->bindValue(':un', $un); #bind the value to user name
        $query->execute();

        if($query->rowCount() !=0){
            array_push($this->errorArray,Constants::$userNameTaken);
        }

    }

    #email validation Private
    private function validateEmail($em,$em2){
        if($em != $em2){
            array_push($this->errorArray,Constants::$emailDontMatch);
            return;
        }

        if(!filter_var($em,FILTER_VALIDATE_EMAIL)){#filter emali with the FILTER_VALIDATE_EMAIL
            array_push($this->errorArray,Constants::$emailInvalid);
            return;
        }
          #SQL QUERY
          $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
          $query->bindValue(':em', $em); #bind the value to user name
          $query->execute();
  
          if($query->rowCount() !=0){
              array_push($this->errorArray,Constants::$emailTaken);
          }

    }

    #password validation Private
    private function validatePassword($pw,$pw2){
        if($pw != $pw2){
            array_push($this->errorArray,Constants::$passwordsDontMatch);
            return;
        }

        if(strlen($pw)<2 || strlen($pw)>25){
            array_push($this->errorArray, Constants::$passwordLength);
            return;
        }
    }


    #check for errors in form
    public function getError($error){
        if(in_array($error,$this->errorArray)){#if error is in this array
            return "<span class='errorMessage'>$error</span>";
        }
    }
}

?>