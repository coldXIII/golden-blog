<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $prev_image = filter_var($_POST['previous_image_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $text = filter_var($_POST['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $category = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $image = $_FILES['image'];

    $is_featured = $is_featured == 1 ?: 0;

    if (!$title) {
        $_SESSION['edit_post'] = 'Please enter the new title';
    } else if (!$text) {
        $_SESSION['edit_post'] = 'Please enter the new description';
    } else {
        if ($image['name']) {
            $prev_image_path = '../images/' . $prev_image;
            if ($prev_image_path) {
                unlink($prev_image_path);
            }
            $time = time();
            $image_name = $time . $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_destination_path = '../images/' . $image_name;
            $allowed_extentions = ['png', 'jpeg', 'jpg', 'webp'];
            $extention = explode('.', $image_name);
            $extention = end($extention);
            if (in_array($extention, $allowed_extentions)) {
                if ($image['size'] < 2000000) {
                    move_uploaded_file($image_tmp_name, $image_destination_path);
                } else {
                    $_SESSION['edit_post'] = 'file size is too big. Should be less than 2MB';
                }
            } else {
                $_SESSION['edit_post'] = "File should be 'png','jpg' or 'webp' extention";
            }
        }
        $image_to_insert = $image_name ?? $prev_image;

        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        $query =  "UPDATE posts SET title='$title',text='$text',image='$image_to_insert',category_id='$category',is_featured='$is_featured' WHERE id='$id' LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
            $_SESSION['edit_post'] = 'Failed to update post';
        } else {
            $_SESSION['edit_post-success'] = "Post  updated succesfully";
            header('location:' . ROOT_URL . 'admin/');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/edit-post.php');
    die();
}
