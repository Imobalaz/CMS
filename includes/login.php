<?php 
include "db.php";
include "../admin/functions.php";

if(isset($_POST['login'])) {
    if(isset($_SESSION)) {
        session_destroy();
    }
    session_start();
    $login_username = $_POST['username'];
    $login_password = $_POST['password'];

    $login_username = mysqli_real_escape_string($connection, $login_username);
    $login_password = mysqli_real_escape_string($connection, $login_password);

    if(!$login_username) {
        $login_info = "Input your username";
        $_SESSION['info'] = $login_info;
        header("Location: ../");
    } elseif (!$login_password) {
        $login_info = "Type your password";
        $_SESSION['info'] = $login_info;
        header("Location: ../");
    } else {
        $login_query = "SELECT * FROM users WHERE username = '$login_username'";
        $login_result = mysqli_query($connection, $login_query);
    
        confirm($login_result);
    
        while($user_data = mysqli_fetch_assoc($login_result)) {
            $user_id = $user_data['user_id'];
            $username = $user_data['username'];
            $user_firstname = $user_data['user_firstname'];
            $user_lastname = $user_data['user_lastname'];
            $user_password = $user_data['user_password'];
            $user_role = $user_data['user_role'];
            $user_email = $user_data['user_email'];
            $user_image = $user_data['user_image'];

        }

        if(!isset($username)) {
            $username = '';
        }

        if(strtolower($login_username) !== strtolower($username)) {
            $login_info = "Incorrect username";
            $_SESSION['info'] = $login_info;
            header("Location: ../");
        } elseif ($login_password !== $user_password) {
            $login_info = "Incorrect password";
            $_SESSION['info'] = $login_info;
            header("Location: ../");
        } else {
            $_SESSION['id'] = $user_id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user_role;
            $_SESSION['lastname'] = $user_lastname;
            $_SESSION['firstname'] = $user_firstname;
            $_SESSION['email'] = $user_email;
            $_SESSION['image'] = $user_image;
            $_SESSION['status'] = 'logged_in';

            if ($user_role === 'Admin') {
                header("Location: ../admin");
            } else {
                header("Location: ../");
            }
        }
            
        
    }


}