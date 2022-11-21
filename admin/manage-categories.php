<?php
include 'partials/header.php';

$query = "SELECT * FROM categories ORDER BY category_name ASC";
$categories = mysqli_query($connection, $query);
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
            <a href="index.php">
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
              <a href="manage-categories.php" class="active">
                <i class="uil uil-list-ul"></i>
                <span>Manage Categories</span>
              </a>
            </li>
          <?php endif ?>
        </ul>
      </aside>
      <main>
        <h2>Manage Categories</h2>
        <?php if (isset($_SESSION['add_category-success'])) : ?>
          <div class="alert__message error" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
            <p><?= $_SESSION['add_category-success'];
                unset($_SESSION['add_category-success']);
                ?>
            </p>
          </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit_category-success'])) : ?>
          <div class="alert__message" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
            <p><?= $_SESSION['edit_category-success'];
                unset($_SESSION['edit_category-success']);
                ?>
            </p>
          </div>
        <?php endif ?>
        <?php if (isset($_SESSION['delete_category-success'])) : ?>
          <div class="alert__message" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
            <p><?= $_SESSION['delete_category-success'];
                unset($_SESSION['delete_category-success']);
                ?>
            </p>
          </div>
        <?php endif ?>
        <?php if (mysqli_num_rows($categories) > 0) : ?>
          <table>
            <thead>
              <tr>
                <th>Title</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($category = mysqli_fetch_assoc($categories)) : ?>
                <tr>
                  <td><?= $category['category_name'] ?></td>
                  <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>" class=" button btn-edit">Edit</a></a></td>
                  <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>" class=" button btn-delete">Delete</a></td>
                </tr>
              <?php endwhile ?>
            </tbody>
          </table>
        <?php else : ?>
          <div class="alert__message" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:red">
            <p>
              No Categories found...
            </p>
          </div>
        <?php endif ?>
      </main>
    </div>
  </section>
</body>