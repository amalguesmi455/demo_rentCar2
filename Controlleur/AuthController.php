<?php

require_once './Model/UserModel.php';


class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            // Assuming you have already created an instance of UserModel

            // Call the non-static method on the instance
            $user = UserModel::getUserByEmail($email);
               
            if ( password_verify($password,$user['password']) ) {
                // Set user session and redirect to the dashboard
                setcookie('user',   serialize($user), time() + 3600, '/');
                if ($user["role"]!="admin")
                header('Location: Task.php?action=profile');
                else  header('Location: Task.php?action=admin');
            } else {
                // Invalid login, show an error message
                
                echo '<script>alert("Invalid credentials. Please try again.")</script>';
            }
        } else {
            // Load the login form view
            include './Views/Login.php';
        }
    }


    public function logout()
    {
        setcookie('user', '', time() + 3600, '/');
        header('Location: Task.php?action=login');

    }
}

