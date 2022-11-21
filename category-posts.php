<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC LIMIT 9";
    $posts = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>
<body>
    <main style="margin-top:6rem;">
        <section class="posts">
            <div class="category__posts-title container">
                <?php
                $category_query = "SELECT * FROM categories WHERE id=$id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>
                <h1><?= $category['category_name'] ?></h1>
            </div>
            <div class="container posts__container">
                <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                    <article class="post" style=" display:flex; flex-direction:column;justify-content:space-between;">
                        <div class="post__thumbnail">
                            <img src="./images/<?= $post['image'] ?>" alt="<?= $post['title'] ?>" style="height:15rem">
                        </div>
                        <div class="post__info" style="flex:1; display:flex; justify-content:space-between; align-items:start;flex-direction:column;">
                            <?php
                            $category_id = $post['category_id'];
                            $category_query = "SELECT * FROM categories WHERE id=$category_id";
                            $category_result = mysqli_query($connection, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                            ?>
                            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['category_name'] ?></a>
                            <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h2>
                            <p class="post__body"> <?= substr($post['text'], 0, 150) ?>...</p>
                            <div class="post__author">
                                <?php
                                $author_id = $post['author_id'];
                                $author_query = "SELECT * FROM users WHERE id=$author_id";
                                $author_result = mysqli_query($connection, $author_query);
                                $author = mysqli_fetch_assoc($author_result);
                                ?>
                                <div class="post__author-avatar">
                                    <img src="./images/<?= $author['avatar'] ?>" alt="">
                                </div>
                                <div class="post__author-info">
                                    <h5>by<?= $author['username'] ?></h5>
                                    <small><?= date("M, d, Y", strtotime($post['date_time'])) ?></small>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile ?>
            </div>
        </section>
        <section class="category__buttons">
            <div class="container category__buttons-container">
                <?php
                $category_query = "SELECT * FROM categories WHERE NOT id=4";
                $categories = mysqli_query($connection, $category_query);
                ?>
                <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button-block"><?= $category['category_name'] ?></a>
                <?php endwhile ?>
            </div>
        </section>
    </main>
</body>