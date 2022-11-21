<?php
require 'config/constants.php';

$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['flastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$create_password = $_SESSION['signup-data']['create_password'] ?? null;
$confirm_password = $_SESSION['signup-data']['confirm_password'] ?? null;

unset($_SESSION['signup-data'])
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
                <h2>Sign Up</h2>
                <?php if(isset($_SESSION['signup'])):?> 
                 <div class="alert__message error" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:#ba0f30">
                    <p><?= $_SESSION['signup'];
                     unset($_SESSION['signup']);
                    ?>
                 </p>
                </div>
                 <?php endif?>
                <form action="<?=ROOT_URL?>signup-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="text" name="firstname" value="<?=$firstname?>" placeholder="First name">
                    <input type="text" name="lastname" value="<?=$lastname?>" placeholder="Last name">
                    <input type="text" name="username" value="<?=$username?>" placeholder="Username">
                    <input type="email" name="email" value="<?=$email?>" placeholder="Your Email">
                    <input type="password" name="create_password" value="<?=$create_password?>" placeholder="Your Password">
                    <input type="password" name="confirm_password" value="<?=$confirm_password?>" placeholder="Repeat Your Password">

                    <div class="form__control">
                        <label for="avatar">User Avatar</label>
                        <input type="file" name="avatar" id="avatar">
                    </div>
                    <button type="submit" name="submit">Sign Up</button>
                    <small>Already have an account? <a href="signin.php">Sign In</a></small>
                </form>
            </div>
        </section>
    </body>

</html>