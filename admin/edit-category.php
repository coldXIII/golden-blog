<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
    }
} else {
    header('location: ' . ROOT_URL . 'admin/manage-categories.php');
    die();
}
?>

<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Edit Category</h2>
            <?php if (isset($_SESSION['edit_category'])) : ?>
                <div class="alert__message error" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:#ba0f30">
                    <p><?= $_SESSION['edit_category'];
                        unset($_SESSION['edit_category']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="POST">
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                <input type="text" placeholder="Category" name="category" value="<?= $category['category_name'] ?>">
                <textarea placeholder="Description" name="description" rows="4"><?= $category['category_description'] ?></textarea>
                <button type="submit" name="submit">Edit Category</button>
            </form>
        </div>
    </section>
</body>