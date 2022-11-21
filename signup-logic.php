<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $avatar = $_FILES['avatar'];

    if (!$firstname) {
        $_SESSION['signup'] = 'Please enter your first name';
    } elseif (!$lastname) {
        $_SESSION['signup'] = 'Please enter your last name';
    } elseif (!$username) {
        $_SESSION['signup'] = 'Please enter your username';
    } elseif (!$email) {
        $_SESSION['signup'] = 'Please enter your valid email';
    } elseif (strlen($create_password) < 6 || strlen($confirm_password) < 6) {
        $_SESSION['signup'] = 'Password must be min 6 symbols';
    } elseif (!$avatar['name']) {
        $_SESSION['signup'] = 'Please choose a photo for your avatar';
    } else {
        if ($confirm_password !== $create_password) {
            $_SESSION['signup'] = 'Passwords do not match';
        } else {
            $hashed_password = password_hash($create_password, PASSWORD_DEFAULT);

            $user_check_query = "SELECT * FROM users WHERE username='$username' OR  email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = 'Username or email already exists';
            } else {
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = 'images/' . $avatar_name;

                $allowed_extentions = ['png', 'jpeg', 'jpg', 'webp'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_extentions)) {
                    if ($avatar['size'] < 1000000) {
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['signup'] = 'file size is too big. Should be less than 1MB';
                    }
                } else {
                    $_SESSION['signup'] = "File should be 'png','jpg' or 'webp' extention";
                }
            }
        }
    }

    if (isset($_SESSION['signup'])) {
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        $insert_user_query = "INSERT INTO users (firstname,lastname,username,email,password,avatar,is_admin) VALUES('$firstname','$lastname','$username','$email','$hashed_password','$avatar_name',0)";

        $insert_user_result = mysqli_query($connection,$insert_user_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['signup-success'] = 'Registration Successful, Please Log In';
            header('location: '. ROOT_URL . 'signin.php');
            die();
        }
    }
} else {
    header('location: '. ROOT_URL . 'signup.php');
    die();
}
