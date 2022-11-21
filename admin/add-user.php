<?php
include 'partials/header.php';

$firstname = $_SESSION['add_user-data']['firstname'] ?? null;
$lastname = $_SESSION['add_user-data']['lastname'] ?? null;
$username = $_SESSION['add_user-data']['username'] ?? null;
$email = $_SESSION['add_user-data']['email'] ?? null;
$create_password = $_SESSION['add_user-data']['create_password'] ?? null;
$confirm_password = $_SESSION['add_user-data']['confirm_password'] ?? null;

unset($_SESSION['add_user-data'])
?>

    <body>
        <section class="form__section">
            <div class="container form__section-container">
                <h2>Add User</h2>
                <?php if(isset($_SESSION['add_user'])):?> 
                 <div class="alert__message error" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:#ba0f30">
                    <p><?= $_SESSION['add_user'];
                     unset($_SESSION['add_user']);
                    ?>
                 </p>
                </div>
                 <?php endif?>
                <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
                    <select name="user_role">
                        <option value="0">Author</option>
                        <option value="1">Admin</option>
                    </select>
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
                    <button type="submit" name="submit">Add User</button>
                </form>
            </div>
        </section>
    </body>