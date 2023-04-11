<?php

$active = 'product';
require_once 'template.php';

$product = getAllProduct();

$category = getAllCategory();

if (isset($_POST['add'])) {
  if (addProduct($_POST, $_FILES) > 0) {
    echo "
      <script>
        alert('Product added successfully');
        document.location.href = 'product.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to add product');
        document.location.href = 'product.php';
      </script>
    ";
  }
}

if (isset($_POST['delete'])) {
  if (deleteProduct($_POST['id']) > 0) {
    echo "
      <script>
        alert('product deleted successfully');
        document.location.href = 'product.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to delete product');
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
      <div class="row mt-3">
        <div class="col-3">
          <input type="text" class="form-control" placeholder="name" name="name" required />
        </div>
        <div class="col-3">
          <input type="text" class="form-control" placeholder="description" name="description" required />
        </div>
      </div>
      <div class="row mt-1">
        <div class="col-3">
          <input type="file" class="form-control" name="image" required />
        </div>
        <div class="col-2">
          <select class="form-select" name="category">
            <option value="" selected disabled>Category</option>
            <?php foreach ($category as $item) : ?>
            <option value="<?= $item['id'] ?>"><?= $item['name'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="col-1">
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
          <th scope="col">Image</th>
          <th scope="col">Category</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($product as $i => $item) : ?>
        <tr>
          <th scope="row"><?= $i + 1 ?></th>
          <td><?= $item['name'] ?></td>
          <td><?= $item['description'] ?></td>
          <td><img src="../asset/img/<?= $item['image'] ?>" alt=""
              style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px"></td>
          <td><?= $item['category'] ?></td>
          <td>
            <div class="d-flex gap-1">
              <a href="<?= base_url() ?>/admin/product_edit.php?id=<?= $item['id'] ?>"
                class="btn btn-sm btn-warning">Edit</a>
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $item['id'] ?>">
                <button type="submit" name="delete" class="btn btn-sm btn-danger">Delete</button>
              </form>
            </div>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>

<?php require_once '../template/footer.php' ?>