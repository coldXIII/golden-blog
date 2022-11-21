<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $author_id = $_SESSION['user_id'];
    $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $text = filter_var($_POST['text'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $image = $_FILES['image'];

    $is_featured = $is_featured == 1 ?: 0;


    if (!$title) {
        $_SESSION['add_post'] = 'Please enter the title of the post';
    } elseif (!$text) {
        $_SESSION['add_post'] = 'Please enter post content';
    } elseif (!$category_id) {
        $_SESSION['add_post'] = 'Please select a category';
    } elseif (!$image['name']) {
        $_SESSION['add_post'] = 'Please choose a photo for your avatar';
    } else {
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
                $_SESSION['add_post'] = 'file size is too big. Should be less than 1MB';
            }
        } else {
            $_SESSION['add_post'] = "File should be 'png','jpg' or 'webp' extention";
        }
    }

    if (isset($_SESSION['add_post'])) {
        $_SESSION['add_post-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/add-post.php');
        die();
    } else {
        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }

        $insert_post_query = "INSERT INTO posts (title,text,image,author_id,category_id,is_featured) VALUES('$title','$text','$image_name','$author_id','$category_id','$is_featured')";

        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add_post-success'] = "New post was added succesfully";
            header('location:' . ROOT_URL . 'admin/');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add-post.php');
    die();
}
