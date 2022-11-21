<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $category_name = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$category_name) {
        $_SESSION['add_category'] = 'Please name the category';
    } elseif (!$category_description) {
        $_SESSION['add_category'] = 'Please describe the category';
    } 
    if (isset($_SESSION['add_category'])) {
        $_SESSION['add_category-data'] = $_POST;
        header('location:' . ROOT_URL . 'admin/add-category.php');
        die();
    } else {
        $insert_category_query = "INSERT INTO categories (category_name, category_description) VALUES('$category_name','$category_description')";

        $insert_category_result = mysqli_query($connection, $insert_category_query);

        if (!mysqli_errno($connection)) {
            $_SESSION['add_category-success'] = "New category $category_name  added succesfully";
            header('location:'. ROOT_URL . 'admin/manage-categories.php');
            die();
        }
    }
} else {
    header('location: '. ROOT_URL . 'admin/add-user.php');
    die();
}