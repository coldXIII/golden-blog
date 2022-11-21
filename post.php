<?php
include 'partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . '/');
    die();
}
?>

<body>
    <main>
        <section class="single__post">
            <div class=" single__post-container">
                <h2 class="post__title"><?= $post['title'] ?></h2>
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
                <div class="post__thumbnail">
                    <img src="./images/<?= $post['image'] ?>" alt="">
                </div>
                <p class="post__body"><?= $post['text'] ?></p>
            </div>
        </section>
    </main>
</body>