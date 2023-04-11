<?php
require_once '../core/function.php';
require_once '../template/header.php';

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}

$like = getUserLike();

?>

<div class="container">
  <div class="row mt-5">
    <div class="col-12">
      <h1>My Liked</h1>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($like as $item) : ?>
          <tr>
            <th scope="row"><?= $i; ?></th>
            <td><?= $item['name']; ?></td>
            <td>
              <a href="liked.php?id=<?= $item['id']; ?>" class="btn btn-danger">Unlike</a>
            </td>
          </tr>
          <?php $i++; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>


  <?php require_once '../template/footer.php' ?>