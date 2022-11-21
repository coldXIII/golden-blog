<?php
require 'config/database.php';

if (isset($_SESSION['user_id'])){
    $id = filter_var($_SESSION['user_id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM  users WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $avatar = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
    <script src="<?= ROOT_URL ?>js/main.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Golden Blog</title>
</head>

<nav>
    <div class="container nav__container">
        <a href="<?= ROOT_URL ?>" class="nav__logo"><span style="color:#d0af51 ;">Golden</span> Blog</a>
        <ul class="nav__items">
            <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
            <?php if (isset($_SESSION['user_id'])) : ?>
                <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'images/' . $avatar['avatar'] ?>" alt="">
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Dashboard</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Log Out</a></li>
                    </ul>
                </li>
            <?php else : ?>
                <li><a href="<?= ROOT_URL ?>signin.php">Log In</a></li>
            <?php endif ?>

        </ul>
        <button id="open-nav__btn"><i class="uil uil-bars"></i></button>
        <button id="close-nav__btn"><i class="uil uil-times"></i></button>
    </div>
</nav>