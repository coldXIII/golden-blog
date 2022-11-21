<?php
include 'partials/header.php';

$current_admin_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE NOT id=$current_admin_id";
$users = mysqli_query($connection, $query);
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
            <a href="dashboard.php">
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
              <a href="manage-users.php" class="active">
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
        <h2>Manage Users</h2>

        <?php if (isset($_SESSION['add_user-success'])) : ?>
          <div class="alert__message" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
            <p><?= $_SESSION['add_user-success'];
                unset($_SESSION['add_user-success']);
                ?>
            </p>
          </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit_user-success'])) : ?>
          <div class="alert__message" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
            <p><?= $_SESSION['edit_user-success'];
                unset($_SESSION['edit_user-success']);
                ?>
            </p>
          </div>
        <?php endif ?>
        <?php if (isset($_SESSION['delete_user-success'])) : ?>
          <div class="alert__message" style="background-color:rgba(0,255,0,0.4); padding:0.6rem 2rem; color:green">
            <p><?= $_SESSION['delete_user-success'];
                unset($_SESSION['delete_user-success']);
                ?>
            </p>
          </div>
        <?php endif ?>
        <?php
        if (mysqli_num_rows($users) > 0) : ?>
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Admin</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                <tr>
                  <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                  <td><?= $user['username'] ?></td>
                  <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class=" button btn-edit">Edit</a></a></td>
                  <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class=" button btn-delete">Delete</a></td>
                  <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                </tr>
              <?php endwhile ?>
            </tbody>
          </table>
        <?php else : ?>
          <div class="alert__message" style="background-color:rgba(255,0,0,0.4); padding:0.6rem 2rem; color:red">
            <p>
              No Users found...
            </p>
          </div>
        <?php endif ?>
      </main>
    </div>
  </section>
</body>