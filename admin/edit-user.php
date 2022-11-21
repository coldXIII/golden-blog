<?php
include 'partials/header.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $user = mysqli_fetch_assoc($result);
} else{
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>

    <body>
        <section class="form__section" style="display:flex ; justify-content:center; align-items:center ;min-height:80vh;">
            <div class="container form__section-container">
                <h2>Edit User</h2>
                <?php if(isset($_SESSION['edit_user'])):?> 
                 <div class="alert__message error" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:#ba0f30">
                    <p><?= $_SESSION['edit_user'];
                     unset($_SESSION['edit_user']);
                    ?>
                 </p>
                </div>
                 <?php endif?>
                <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" enctype="multipart/form-data" method="POST">
                    <select name="user_role">
                        <option value="0">Author</option>
                        <option value="1">Admin</option>
                    </select>
                    <input type="hidden" name="id"  value="<?=$user['id']?>">
                    <input type="text" name="username" placeholder="Username" value="<?=$user['username']?>">
                    <button type="submit" name="submit">Edit User</button>
                </form>
            </div>
        </section>
    </body>