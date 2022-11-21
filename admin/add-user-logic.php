<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $is_admin = filter_var($_POST['user_role'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];

    if (!$firstname) {
        $_SESSION['add_user'] = 'Please enter your first name';
    } elseif (!$lastname) {
        $_SESSION['add_user'] = 'Please enter your last name';
    } elseif (!$username) {
        $_SESSION['add_user'] = 'Please enter your username';
    } elseif (!$email) {
        $_SESSION['add_user'] = 'Please enter your valid email';
    } elseif (strlen($create_password) < 6 || strlen($confirm_password) < 6) {
        $_SESSION['add_user'] = 'Password must be min 6 symbols';
    } elseif (!$avatar['name']) {
        $_SESSION['add_user'] = 'Please choose a photo for your avatar';
    } else {
        if ($confirm_password !== $create_password) {
            $_SESSION['add_user'] = 'Passwords do not match';
        } else {
            $hashed_password = password_hash($create_password, PASSWORD_DEFAULT);

            $user_check_query = "SELECT * FROM users WHERE username='$username' OR  email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add_user'] = 'Username or email already exists';
            } else {
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_destination_path = '../images/' . $avatar_name;

                $allowed_extentions = ['png', 'jpeg', 'jpg', 'webp'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_extentions)) {
                    if ($avatar['size'] < 1000000) {
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION['add_user'] = 'file size is too big. Should be less than 1MB';
                    }
                } else {
                    $_SESSION['add_user'] = "File should be 'png','jpg' or 'webp' extention";
                }
            }
        }
    }
    if (isset($_SESSION['add_user'])) {
        $_SESSION['add_user-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {
        $insert_user_query = "INSERT INTO users (firstname,lastname,username,email,password,avatar,is_admin) VALUES('$firstname','$lastname','$username','$email','$hashed_password','$avatar_name',$is_admin)";

        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add_user-success'] = "New user $firstname $lastname added succesfully";
            header('location:'. ROOT_URL . 'admin/manage-users.php');
            die();
        }
    }
} else {
    header('location: '. ROOT_URL . 'admin/add-user.php');
    die();
}
