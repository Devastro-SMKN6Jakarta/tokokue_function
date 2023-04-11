<?php
require_once '../core/function.php';
require_once '../template/header.php';

$product = getAllProduct();
?>

<div class="row mt-5">
  <?php foreach ($product as $p) : ?>
    <div class="col-4">
      <div class="card">
        <img src="../asset/img/<?= $p['image'] ?>" class="card-img-top" alt="<?= $p['name'] ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $p['name'] ?></h5>
          <p class="card-text"><?= $p['description'] ?></p>
          <a href="detail.php?id=<?= $p['id'] ?>" class="btn btn-primary">Detail</a>
          <a href="liked.php?id=<?= $p['id'] ?>" class="btn btn-danger">Like</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php require_once '../template/footer.php' ?>