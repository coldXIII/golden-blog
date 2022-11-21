<?php
include 'partials/header.php';

$query  = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

$title = $_SESSION['add_post-data']['title'] ?? null;
$description = $_SESSION['add_post-data']['description'] ?? null;

unset($_SESSION['add_post-data'])
?>

<body>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Add Post</h2>
            <?php if (isset($_SESSION['add_post'])) : ?>
                <div class="alert__message error" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:#ba0f30">
                    <p><?= $_SESSION['add_post'];
                        unset($_SESSION['add_post']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
                <select name="category">
                    <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                        <option value="<?= $category['id']?>"><?= $category['category_name'] ?></option>
                    <?php endwhile ?>
                </select>
                <?php if (isset($_SESSION['user_is_admin'])) : ?>
                    <div class="form__control" style="width:25vw; display: flex; justify-content: center;">
                        <label for="isfeatured">Featured</label>
                        <input type="checkbox" id="isfeatured" style="width: 1rem;" name="is_featured" checked>
                    </div>
                <?php endif ?>
                <input type="text" placeholder="Post Title" name="title" value="<?=$title?>">
                <textarea placeholder="Post Content" rows="10" name="text" value="<?=$description?>"></textarea>
                <div class="form__control">
                    <label for="image">Post Image</label>
                    <input type="file" id="image" name="image">
                </div>
                <button type="submit" name="submit">Add Post</button>
            </form>
        </div>
    </section>
</body>