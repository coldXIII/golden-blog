<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_POST['category'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$name) {
        $_SESSION['edit_category'] = 'Please enter the new category name';
    } else if (!$description) {
        $_SESSION['edit_category'] = 'Please enter the new description';
    } else {
        $query = "UPDATE categories SET category_name='$name', category_description='$description' WHERE id='$id' LIMIT 1";
        $result = mysqli_query($connection, $query);

        if (mysqli_errno($connection)) {
           $_SESSION['edit_category'] = 'Failed to update category';
        } else { $_SESSION['edit_category-success'] = "Category  $name  updated succesfully";
            header('location:'. ROOT_URL . 'admin/manage-categories.php');
            die();
        }
    }
} else {
    header('location: '. ROOT_URL . 'admin/edit-category.php');
    die();
}