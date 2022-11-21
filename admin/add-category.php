<?php
include 'partials/header.php';

$category = $_SESSION['add_category-data']['category'] ?? null;
$description = $_SESSION['add_category-data']['description'] ?? null;

unset($_SESSION['add_category-data'])
?>

    <body>
        <section class="form__section">
            <div class="container form__section-container">
                <h2>Add Category</h2>
                <?php if(isset($_SESSION['add_category'])):?> 
                 <div class="alert__message error" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:#ba0f30">
                    <p><?= $_SESSION['add_category'];
                     unset($_SESSION['add_category']);
                    ?>
                 </p>
                </div>
                 <?php endif?>
                <div class="alert__message error">
                    <p>This is an error message</p>
                </div>
                <form action="<?= ROOT_URL ?>admin/add-category-logic.php" method="POST">
                    <input type="text" placeholder="Category" name="category" value="<?=$category?>">
                    <textarea placeholder="Category Description" name="description" rows="4" value="<?=$description?>"></textarea>
                    <button type="submit" name="submit">Add Category</button>
                </form>
            </div>
        </section>
    </body>