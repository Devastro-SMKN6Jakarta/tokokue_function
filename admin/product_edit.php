<?php

$active = 'product';
require_once 'template.php';

$product = getProduct($_GET['id']);

$category = getAllCategory();

if (isset($_POST['save'])) {
  if (editProduct($_POST, $_FILES) > 0) {
    echo "
      <script>
        alert('Product edited successfully');
        document.location.href = 'product.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to edit product');
        document.location.href = 'product.php';
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
    <h5 class="card-title">Manage Product</h5>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $product['id'] ?>">
      <input type="hidden" name="old_image" value="<?= $product['image'] ?>">
      <div class="row mt-3">
        <div class="col-3">
          <input type="text" class="form-control" placeholder="name" name="name" required
            value="<?= $product['name'] ?>" />
        </div>
        <div class="col-3">
          <input type="text" class="form-control" placeholder="description" name="description" required
            value="<?= $product['description'] ?>" />
        </div>
      </div>
      <div class="row mt-1">
        <div class="col-3">
          <input type="file" class="form-control" name="image" />
        </div>
        <div class="col-2">
          <select class="form-select" name="category">
            <option value="" disabled>Category</option>
            <?php foreach ($category as $item) : ?>
            <option value="<?= $item['id'] ?>" <?= $product['category_id'] == $item['id'] ? 'selected' : '' ?>>
              <?= $item['name'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-1">
          <button type="submit" class="btn btn-primary" name="save">Save</button>
        </div>
      </div>
      <div class="row mt-3">
        <img src="../asset/img/<?= $product['image'] ?>" alt=""
          style="width: 200px;object-fit: cover; border-radius: 10%">
      </div>
    </form>
  </div>
</div>

<?php require_once '../template/footer.php' ?>