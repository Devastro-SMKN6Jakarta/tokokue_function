<?php

require_once '../core/function.php';

if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

if (isset($_SESSION['username'])) {
  logout();
}