<?php

$active = 'banner';
require_once 'template.php';

$banner = getAllBanner();

$category = getAllCategory();

if (isset($_POST['add'])) {
  if (addBanner($_POST, $_FILES) > 0) {
    echo "
      <script>
        alert('Banner added successfully');
        document.location.href = 'banner.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to add banner');
        document.location.href = 'banner.php';
      </script>
    ";
  }
}

if (isset($_POST['delete'])) {
  if (deleteBanner($_POST['id']) > 0) {
    echo "
      <script>
        alert('banner deleted successfully');
        document.location.href = 'banner.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Failed to delete banner');
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
      <div class="row mt-3">
        <div class="col-3">
          <input type="text" class="form-control" placeholder="title" name="title" required />
        </div>
        <div class="col-3">
          <input type="text" class="form-control" placeholder="caption" name="caption" required />
        </div>
      </div>
      <div class="row mt-1">
        <div class="col-3">
          <input type="file" class="form-control" name="image" required />
        </div>
        <div class="col-3">
          <input type="text" class="form-control" placeholder="link to" name="link" />
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
          <th scope="col">Image</th>
          <th scope="col">Title</th>
          <th scope="col">Caption</th>
          <th scope="col">Link To</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($banner as $i => $item) : ?>
        <tr>
          <th scope="row"><?= $i + 1 ?></th>
          <td><img src="../asset/img/<?= $item['image'] ?>" alt=""
              style="height: 100px; object-fit: cover; border-radius: 10px"></td>
          <td><?= $item['title'] ?></td>
          <td><?= $item['caption'] ?></td>
          <td><a href="<?= $item['link'] ?>" target="_blank"><?= $item['link'] ?></a> </td>
          <td>
            <div class="d-flex gap-1">
              <a href="<?= base_url() ?>/admin/banner_edit.php?id=<?= $item['id'] ?>"
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