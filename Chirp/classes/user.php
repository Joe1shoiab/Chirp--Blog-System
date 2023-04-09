<?php

class User {
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function register($username, $email, $password)
    {
        // Data Validation
        $errors = array();
        if(empty($username))
        {
            $errors[] =  "Please enter a username.";
        }
        if(empty($email))
        {
            $errors[] =  "Please enter an email.";
        }
        if(empty($password))
        {
            $errors[] =  "Please enter a password.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }
        

        // Checking if the username or the email already exists (in use).
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user WHERE username = :username OR email = :email");
        $stmt->execute(array(':username' => $username, ':email' => $email));
        $count = $stmt->fetchColumn();


        if ($count > 0)
        {
            $errors[] = "Username or email address already in use.";
        }



        // If there is no errors, insert the user into the database
        if (empty($errors))
        {
              
            $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

            
            $stmt = $this->pdo->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, :password)");
            
            $stmt->execute(array(':username' => $username, ':email' => $email, ':password' => $hashedpassword));

            return true;

        } 
        else
        {
            return $errors;
        }

    }

    public function login ($email, $password)
    {
        
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE  email = :email");
            
        $stmt->execute(array( ':email' => $email));  

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password']))
        {
            // The username and password are correct so login and start a session for user
            $_SESSION['user_id']=$user['userID'];
            $_SESSION['username']=$user['username'];
            $_SESSION['email']=$user['email'];

            header('Location: home.php');
            return true;
        }
        else
         {
            // The username or password is incorrect
            return "The email or password is incorrect";
        }
    }

}


/*
    filter_var($email, FILTER_VALIDATE_EMAIL) >>>> returns 1 if the email is vaild and 0 if it's not


    $stmt = $this->pdo->prepare("");
    $stmt->execute(array(':username' => $username, ....));
    $count = $stmt->fetchColumn();

    $hashedpasword = password_hash($password, PASSWORD_DEFAULT);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
*/