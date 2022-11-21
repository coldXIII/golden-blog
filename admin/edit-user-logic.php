<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['user_role'], FILTER_SANITIZE_NUMBER_INT);

    if (!$username) {
        $_SESSION['edit_user'] = 'Please enter the new username';
    } else {
        $query = "UPDATE users SET username='$username', is_admin='$is_admin' WHERE id='$id' LIMIT 1 ";
        $update_user_result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
           $_SESSION['edit_user'] = 'Failed to update user';
        } else { $_SESSION['edit_user-success'] = "User  $username  updated succesfully";
            header('location:'. ROOT_URL . 'admin/manage-users.php');
            die();
        }
    }
} else {
    header('location: '. ROOT_URL . 'admin/edit-user.php');
    die();
}