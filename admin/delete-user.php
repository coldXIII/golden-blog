<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }

    $image_query = "SELECT image FROM posts WHERE author_id=$id";
    $image_result = mysqli_query($connection, $image_query);
    if (mysqli_num_rows($image_result) > 0) {
        while ($image = mysqli_fetch_assoc($image_result)) {
            $image_path  = '../images' . $image['image'];
            if ($image_path) {
                unlink($image_path);
            }
        }
    }





    $delete_user_query = "DELETE FROM users WHERE id=$id";
    $delete_user_result = mysqli_query($connection, $delete_user_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete_user'] = "Failed to delete user";
    } else {
        $_SESSION['delete_user-success'] = "User {$user['username']} was deleted successfully";
        header('location:' . ROOT_URL . 'admin/manage-users.php');
        die();
    }
}
