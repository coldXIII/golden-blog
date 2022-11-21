<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $post = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result)==1){
        $image_name = $post['image'];
        $image_path = '../images/' . $image_name;
        if($image_path){
            unlink($image_path);
        }
    }
    $delete_post_query = "DELETE FROM posts WHERE id=$id";
    $delete_post_result = mysqli_query($connection,$delete_post_query);
    if(mysqli_errno($connection)){
        $_SESSION['delete_posts'] = "Failed to delete post";
    } else{
        $_SESSION['delete_posts-success'] = "Post was deleted successfully";
        header('location:'. ROOT_URL . 'admin/');
        die();
    }

}