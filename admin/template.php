<?php
require_once '../core/function.php';

if (!isset($_SESSION['username'])) {
  header('Location: ../auth/login.php');
  exit;
}

if ($_SESSION['role'] != 'admin') {
  header('Location: ' . base_url());
  exit;
}

require_once '../template/header.php';
?>

<div class="container mt-5 mb-5">
  <div>
    <div class="list-group list-group-flush">
      <a href="<?= base_url() ?>/admin/index.php"
        class="list-group-item waves-effect <?= $active == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
      <a href="<?= base_url() ?>/admin/user.php"
        class="list-group-item list-group-item-action waves-effect <?= $active == 'user' ? 'active' : '' ?>">User</a>
      <a href="<?= base_url() ?>/admin/category.php"
        class="list-group-item list-group-item-action waves-effect <?= $active == 'category' ? 'active' : '' ?>">Category</a>
      <a href="<?= base_url() ?>/admin/product.php"
        class="list-group-item list-group-item-action waves-effect <?= $active == 'product' ? 'active' : '' ?>">Product</a>
      <a href="<?= base_url() ?>/admin/banner.php"
        class="list-group-item list-group-item-action waves-effect <?= $active == 'banner' ? 'active' : '' ?>">Banner</a>
    </div>
  </div>
</div>