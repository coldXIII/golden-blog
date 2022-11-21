<?php
include 'partials/header.php';

$query  = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection,$query);
    $post = mysqli_fetch_assoc($result);
} else{
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>

    <body>
        <section class="form__section">
            <div class="container form__section-container">
                <h2>Edit Post</h2>
                <div class="alert__message error">
                    <p>This is an error message</p>
                </div>
                <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
                    <select name="category">
                    <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                        <option value="<?= $category['id']?>"><?= $category['category_name'] ?></option>
                    <?php endwhile ?>
                    </select>
                    <div class="form__control" style="width:25vw; display: flex; justify-content: center;">
                        <label for="is_featured">Featured</label>
                        <input type="checkbox" id="is_featured" style="width: 1rem;" name="is_featured" value="1" checked>
                    </div>
                    <input type="hidden" name="id"  value="<?=$post['id']?>">
                    <input type="hidden" name="previous_image_name"  value="<?=$post['image']?>">
                    <input type="text" placeholder="Post Title" name="title" value="<?=$post['title']?>">
                    <textarea placeholder="Post Content" rows="10" name="text"><?=$post['text']?></textarea>
                    <div class="form__control">
                        <label for="image">Post Image</label>
                        <input type="file" id="image" name="image">
                    </div>
                    <button type="submit" name="submit">Edit Post</button>
                </form>
            </div>
        </section>
    </body>