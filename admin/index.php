<?php
include 'partials/header.php';

$current_user_id = $_SESSION['user_id'];
$query = "SELECT id, title, category_id FROM posts  WHERE author_id=$current_user_id ORDER  BY date_time DESC";
$posts = mysqli_query($connection, $query);
?>

<body>
    <section class="dashboard">
        <div class="container dashboard-container">
            <aside>
                <ul>
                    <li title="Add Post">
                        <a href="add-post.php">
                            <i class="uil uil-pen"></i>
                            <span>Add Post</span>
                        </a>
                    </li>
                    <li title="Manage Posts">
                        <a href="dashboard.php" class="active">
                            <i class="uil uil-postcard"></i>
                            <span>Manage Posts</span>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['user_is_admin'])) : ?>
                        <li title="Add User">
                            <a href="add-user.php">
                                <i class="uil uil-user"></i>
                                <span>Add User</span>
                            </a>
                        </li>
                        <li title="Manage Users">
                            <a href="manage-users.php">
                                <i class="uil uil-users-alt"></i>
                                <span>Manage Users</span>
                            </a>
                        </li>
                        <li title="Add Category">
                            <a href="add-category.php">
                                <i class="uil uil-edit"></i>
                                <span>Add Category</span>
                            </a>
                        </li>
                        <li title="Manage Categories">
                            <a href="manage-categories.php">
                                <i class="uil uil-list-ul"></i>
                                <span>Manage Categories</span>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </aside>
            <main>
                <h2>Manage Posts</h2>
                <?php if (isset($_SESSION['add_post-success'])) : ?>
                    <div class="alert__message" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
                        <p><?= $_SESSION['add_post-success'];
                            unset($_SESSION['add_post-success']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>
                <?php if (isset($_SESSION['edit_post-success'])) : ?>
                    <div class="alert__message" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
                        <p><?= $_SESSION['edit_post-success'];
                            unset($_SESSION['edit_post-success']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>
                <?php if (isset($_SESSION['delete_post-success'])) : ?>
                    <div class="alert__message" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
                        <p><?= $_SESSION['delete_post-success'];
                            unset($_SESSION['delete_post-success']);
                            ?>
                        </p>
                    </div>
                <?php endif ?>

                <?php if (mysqli_num_rows($posts) > 0) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($post = mysqli_fetch_assoc($posts)) : ?>

                                <?php
                                $category_id = $post['category_id'];
                                $category_query = "SELECT category_name FROM categories WHERE id=$category_id ";
                                $category_result = mysqli_query($connection, $category_query);
                                $category = mysqli_fetch_assoc($category_result);
                                ?>
                                <tr>
                                    <td><?= $post['title'] ?></td>
                                    <td><?= $category['category_name'] ?></td>
                                    <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class=" button btn-edit">Edit</></a></td>
                                    <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class=" button btn-delete">Delete</a></td>

                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="alert__message" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:red">
                        <p>
                           There are no posts here yet...
                        </p>
                    </div>
                <?php endif ?>
            </main>
        </div>
    </section>
</body>