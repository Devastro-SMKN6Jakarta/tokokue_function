<?php

$active = 'category';
require_once 'template.php';

$category = getAllCategory();

if (isset($_POST['delete'])) {
  if (deleteCategory($_POST['id']) > 0) {
    echo "
      <script>
        alert('Category deleted successfully');
        document.location.href = 'category.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to delete category');
        document.location.href = 'category.php';
      </script>
    ";
  }
}

if (isset($_POST['add'])) {
  if (addCategory($_POST['name'], $_POST['description']) > 0) {
    echo "
      <script>
        alert('Category added successfully');
        document.location.href = 'category.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to add category');
        document.location.href = 'category.php';
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
    <h5 class="card-title">Manage Category</h5>
    <form action="" method="post">
      <div class="row mt-3">
        <div class="col-3">
          <input type="text" class="form-control" placeholder="name" name="name" required />
        </div>
        <div class="col-3">
          <input type="text" class="form-control" placeholder="description" name="description" required />
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
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($category as $i => $item) : ?>
        <tr>
          <th scope="row"><?= $i + 1 ?></th>
          <td><?= $item['name'] ?></td>
          <td><?= $item['description'] ?></td>
          <td class="d-flex gap-1">
            <a href="<?= base_url() ?>/admin/category_edit.php?id=<?= $item['id'] ?>"
              class="btn btn-sm btn-warning">Edit</a>
            <form action="" method="post">
              <input type="hidden" name="id" value="<?= $item['id'] ?>">
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