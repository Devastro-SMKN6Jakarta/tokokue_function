<?php

$active = 'category';
require_once 'template.php';

$category = getCategory($_GET['id']);

if (isset($_POST['save'])) {
  if (updateCategory($_POST['id'], $_POST['name'], $_POST['description']) > 0) {
    echo "
      <script>
        alert('Category updated successfully');
        document.location.href = 'category.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to update category');
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
    <h5 class="card-title">Edit Category</h5>
    <form action="" method="post">
      <input type="hidden" name="id" value="<?= $category['id'] ?>">
      <div class="row mt-3">
        <div class="col-3">
          <input type="text" class="form-control" placeholder="name" name="name" required
            value="<?= $category['name'] ?>" />
        </div>
        <div class="col-3">
          <input type="text" class="form-control" placeholder="description" name="description" required
            value="<?= $category['description'] ?>" />
        </div>
        <div class="col-3">
          <button type="submit" class="btn btn-primary" name="save">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php require_once '../template/footer.php' ?>