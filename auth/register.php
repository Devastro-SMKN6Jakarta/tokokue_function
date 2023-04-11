<?php
require_once '../core/function.php';

if (isset($_SESSION['username'])) {
  header("Location: ../");
}

if (isset($_POST['submit'])) {
  if (register($_POST['username'], $_POST['password']) > 0) {
    echo "<script>alert('User baru berhasil ditambahkan!')</script>";
    header("Location: login.php");
  } else {
    echo "<script>alert('User baru gagal ditambahkan!')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <style>
  body {
    height: 100vh;
  }
  </style>
</head>

<body>
  <div class="h-100 d-flex align-items-center justify-content-center">
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Register</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">Buat Akun Baru!</h6>
        <div class="mb-3">
          <form action="" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="username" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
          </form>
        </div>
        <a href="../" class="card-link">Go Home</a>
        <a href="login.php" class="card-link">Already have account!</a>
      </div>
    </div>
  </div>
</body>

</html>