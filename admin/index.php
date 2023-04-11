<?php

$active = 'dashboard';
require_once 'template.php';

?>

<div class="card">
  <div class="card-header">
    Hi, <?= $_SESSION['username'] ?>
  </div>
  <div class="card-body">
    <h5 class="card-title">Dashboard</h5>
    <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis ipsum magnam enim.</p>
  </div>
</div>

<?php require_once '../template/footer.php' ?>