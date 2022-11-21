<?php
include 'partials/header.php';

$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

$posts_query = "SELECT * FROM posts WHERE is_featured=0  LIMIT 9";
$posts = mysqli_query($connection, $posts_query);
?>


<main>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/<?= $featured['image'] ?>" alt="<?= $featured['title'] ?>" style="height:20rem;">
            </div>
            <div class="post__info">
                <?php
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories WHERE id=$category_id";
                $category_result = mysqli_query($connection, $category_query);
                $category = mysqli_fetch_assoc($category_result);
                ?>
                <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['category_name'] ?></a>
                <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
                <p class="post__body">
                    <?= substr($featured['text'], 0, 250) ?>...
                    <?php
                    $author_id = $featured['author_id'];
                    $author_query = "SELECT * FROM users WHERE id=$author_id";
                    $author_result = mysqli_query($connection, $author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/<?= $author['avatar'] ?>" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>by<?= $author['username'] ?></h5>
                        <small><?= date("M, d, Y", strtotime($featured['date_time'])) ?></small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="posts">
        <div class="container posts__container">
            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                <article class="post" style=" display:flex; flex-direction:column;justify-content:space-between;">
                    <div class="post__thumbnail">
                        <img src="./images/<?= $post['image'] ?>" alt="" style="height:15rem">
                    </div>
                    <div class="post__info" style="flex:1; display:flex; justify-content:space-between; align-items:start;flex-direction:column; ">
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