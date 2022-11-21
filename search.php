<?php
require 'partials/header.php';

if (isset($_GET['search']) && isset($_GET['submit'])) {

    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query = "SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY date_time DESC ";
    $posts = mysqli_query($connection, $query);
} else {
    header('location: ' . ROOT_URL . '/blog.php');
}
?>

<section class="posts" style="margin-top:7rem ;">
    <div class="container posts__container">
        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/<?= $post['image'] ?>" alt="">
                </div>
                <div class="post__info">
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

<?php
include 'partials/footer.php'
?>