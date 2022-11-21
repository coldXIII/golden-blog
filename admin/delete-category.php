<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $category = mysqli_fetch_assoc($result);

    $update_category_query = "UPDATE posts SET category_id=4 WHERE category_id=$id";
    $update_category_result = mysqli_query($connection, $update_category_query);

    $delete_category_query = "DELETE FROM categories WHERE id=$id LIMIT 1";
    $delete_category_result = mysqli_query($connection, $delete_category_query);
    if (mysqli_errno($connection)) {
        $_SESSION['delete_category'] = "Failed to delete category";
    } else {
        $_SESSION['delete_category-success'] = "Category {$category['category_name']} was deleted successfully";
        header('location:' . ROOT_URL . 'admin/manage-categories.php');
        die();
    }
}