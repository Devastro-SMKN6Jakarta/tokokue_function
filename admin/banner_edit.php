<?php

$active = 'banner';
require_once 'template.php';

$banner = getBanner($_GET['id']);

if (isset($_POST['save'])) {
  if (editBanner($_POST, $_FILES) > 0) {
    echo "
      <script>
        alert('Banner edit successfully');
        document.location.href = 'banner.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to edit banner');
        document.location.href = 'banner.php';
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
    <h5 class="card-title">Manage Banner</h5>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $banner['id'] ?>">
      <input type="hidden" name="old_image" value="<?= $banner['image'] ?>">
      <div class="row mt-3">
        <div class="col-3">
          <input type="text" class="form-control" placeholder="title" name="title" required value="<?= $banner['title'] ?>" />
        </div>
        <div class="col-3">
          <input type="text" class="form-control" placeholder="caption" name="caption" required value="<?= $banner['title'] ?>" />
        </div>
      </div>
      <div class="row mt-1">
        <div class="col-3">
          <input type="file" class="form-control" name="image" />
        </div>
        <div class="col-3">
          <input type="text" class="form-control" placeholder="link to" name="link" value="<?= $banner['link'] ?>" />
        </div>
        <div class="col-1">
          <button type="submit" class="btn btn-primary" name="save">Save</button>
        </div>
      </div>
      <div class="row mt-3">
        <img src="../asset/img/<?= $banner['image'] ?>" alt="" style="width: 200px;object-fit: cover; border-radius: 10%">
      </div>
    </form>
  </div>
</div>

<?php require_once '../template/footer.php' ?>