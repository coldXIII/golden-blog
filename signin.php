<?php
require 'config/constants.php';
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;

unset($_SESSION['signin-data'])
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= ROOT_URL?>css/style.css">
        <title>Document</title>
    </head>

    <body>
        <section class="form__section">
            <div class="container form__section-container">
                <h2>Sign In</h2>
                <?php if(isset($_SESSION['signup-success'])):?> 
                 <div class="alert__message error" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
                    <p><?= $_SESSION['signup-success'];
                     unset($_SESSION['signup-success']);
                    ?>
                 </p>
                </div>
                <?php elseif(isset($_SESSION['signin'])):?> 
                 <div class="alert__message error" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:#ba0f30">
                    <p><?= $_SESSION['signin'];
                     unset($_SESSION['signin']);
                    ?>
                 </p>
                </div>
                 <?php endif?>
                <form action="<?=ROOT_URL?>signin-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="username_email" placeholder="Your Username or Email"value="<?=$username_email?>">
                    <input type="password" name="password" placeholder="Your Password" value="<?=$password?>">
                    <button type="submit" name="submit">Sign In</button>
                    <small>Don`t have an account? <a href="signup.php">Sign Up</a></small>
                </form>
            </div>
        </section>
    </body>

</html>