<?php
require_once 'core/function.php';
require_once 'template/header.php';

$banner = getAllBanner();
?>

<div id="bannerCaro" class="carousel slide">
  <div class="carousel-indicators">
    <?php foreach ($banner as $i => $item) : ?>
    <button type="button" data-bs-target="#bannerCaro" data-bs-slide-to="<?= $i ?>" aria-current="true"
      aria-label="Slide <?= $i + 1 ?>" <?= $i == 0 ? 'class="active"' : '' ?>></button>
    <?php endforeach ?>
  </div>
  <div class="carousel-inner">
    <?php foreach ($banner as $i => $item) : ?>
    <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
      <img src="asset/img/<?= $item['image'] ?>" class="d-block w-100" alt="<?= $item['title'] ?>"
        style="height: 600px; object-fit:cover">
      <div class="carousel-caption d-none d-md-block">
        <h5><?= $item['title'] ?></h5>
        <p><?= $item['caption'] ?></p>
      </div>
    </div>
    <?php endforeach ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCaro" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCaro" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<?php require_once 'template/footer.php' ?>