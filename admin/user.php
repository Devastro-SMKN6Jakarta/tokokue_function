<?php

$active = 'user';
require_once 'template.php';

$users = getAllUser();

if (isset($_POST['delete'])) {
  if (deleteUser($_POST['id']) > 0) {
    echo "
      <script>
        alert('User deleted successfully');
        document.location.href = 'user.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to delete user');
        document.location.href = 'user.php';
      </script>
    ";
  }
}

if (isset($_POST['change_role'])) {
  if (changeRole($_POST['id'], $_POST['role']) > 0) {
    echo "
      <script>
        alert('Role changed successfully');
        document.location.href = 'user.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to change role');
        document.location.href = 'user.php';
      </script>
    ";
  }
}

if (isset($_POST['add'])) {
  if (register($_POST['username'], $_POST['password']) > 0) {
    echo "
      <script>
        alert('User added successfully');
        document.location.href = 'user.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to add user');
        document.location.href = 'user.php';
      </script>
    ";
  }
}

?>

<div class="card">
  <div class="card-header">
    Hi, <?= $_SESSION['username'] ?>
  </div>
  <div class="card-body">
    <h5 class="card-title">Manage User</h5>
    <form action="" method="post">
      <div class="row mt-3">
        <div class="col-3">
          <input type="text" class="form-control" placeholder="username" name="username" required />
        </div>
        <div class="col-3">
          <input type="text" class="form-control" placeholder="password" name="password" required />
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-primary" name="add">Add</button>
        </div>
      </div>
    </form>
    <table class="table mt-3">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Username</th>
          <th scope="col">Role</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $i => $user) : ?>
          <tr>
            <th scope="row"><?= $i + 1 ?></th>
            <td><?= $user['username'] ?></td>
            <td><span class="badge <?= $user['role'] == 'admin' ? 'bg-primary' : 'bg-warning' ?>"><?= $user['role'] ?></span>
            </td>
            <td>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                <button type="submit" name="change_role" class="btn btn-sm btn-warning">Change Role</button>
                <button type="submit" name="delete" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once '../template/footer.php' ?>