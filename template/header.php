<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($active) ? $active :  'Toko Kue Devastro' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="asset/css/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url() ?>">Toko Kue Dev</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link active" aria-current="page" href="<?= base_url() ?>">Home</a>
          <a class="nav-link" href="<?= base_url() ?>/page/product.php">Product</a>
          <a class="nav-link" href="<?= base_url() ?>/page/category.php">Category</a>
          <a class="nav-link" href="<?= base_url() ?>/page/about.php">About</a>
          <a class="nav-link disabled" href="#">|</a>

          <?php if (isset($_SESSION['username'])) : ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['username'] ?>
              </a>
              <ul class="dropdown-menu">
                <?php if ($_SESSION['role'] == 'admin') : ?>
                  <li><a class="dropdown-item" href="<?= base_url() ?>/admin/index.php">Dashboard</a></li>
                <?php else : ?>
                  <li><a class="dropdown-item" href="<?= base_url() ?>/page/like.php">Liked Item</a></li>
                <?php endif ?>
                <li><a class="dropdown-item" href="<?= base_url() ?>/auth/logout.php">Logout</a></li>
              </ul>
            </li>
          <?php else : ?>
            <a class="nav-link" href="<?= base_url() ?>/auth/login.php">Login</a>
            <a class="nav-link" href="<?= base_url() ?>/auth/register.php">Register</a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">