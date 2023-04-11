<?php
require_once 'connection.php';
session_start();

function base_url()
{
  global $url;
  return $url;
}

function register($username, $password)
{
  global $conn;

  $checkUsername = $conn->prepare("SELECT * FROM user WHERE username = :username");
  $checkUsername->bindParam(':username', $username);
  $checkUsername->execute();
  $result = $checkUsername->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    echo "<script>alert('Username sudah terdaftar!')</script>";
    return false;
  }

  $password = password_hash($password, PASSWORD_DEFAULT);
  $role = "user";

  $sql = "INSERT INTO user (username, password, role) VALUES (:username, :password, :role)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':role', $role);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function login($username, $password)
{
  global $conn;

  $sql = "SELECT * FROM user WHERE username = :username";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':username', $username);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    if (password_verify($password, $result['password'])) {
      $_SESSION['id'] = $result['id'];
      $_SESSION['username'] = $result['username'];
      $_SESSION['role'] = $result['role'];
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function logout()
{
  session_destroy();
  header("Location: ../");
  exit;
}

function getAllUser()
{
  global $conn;

  $sql = "SELECT * FROM user";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}

function changeRole($id)
{
  global $conn;

  $sql = "SELECT * FROM user WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result['role'] == 'user') {
    $role = 'admin';
  } else {
    $role = 'user';
  }

  $sql = "UPDATE user SET role = :role WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':role', $role);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $_SESSION['role'] = $role;
    return true;
  } else {
    return false;
  }
}

function deleteUser($id)
{
  global $conn;

  $sql = "DELETE FROM user WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function getAllCategory()
{
  global $conn;

  $sql = "SELECT * FROM category";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}

function getCategory($id)
{
  global $conn;

  $sql = "SELECT * FROM category WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  return $result;
}

function addCategory($name, $desc)
{
  global $conn;

  $sql = "INSERT INTO category (name, description) VALUES (:name, :description)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':description', $desc);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function updateCategory($id, $name, $desc)
{
  global $conn;

  $sql = "UPDATE category SET name = :name, description = :description WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':description', $desc);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function deleteCategory($id)
{
  global $conn;

  $sql = "DELETE FROM category WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function getAllProduct()
{
  global $conn;

  $sql = "SELECT category.name AS category, product.* FROM product JOIN category ON product.category_id = category.id ORDER BY id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}

function getProduct($id)
{
  global $conn;

  $sql = "SELECT * FROM product WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  return $result;
}

function addProduct($product, $file)
{
  global $conn;

  $image = $file['image']['name'];
  $tmp = $file['image']['tmp_name'];
  $image = date('dmYHis') . '-' . $image;
  $path = "../asset/img/" . $image;
  move_uploaded_file($tmp, $path);

  $sql = "INSERT INTO product (name, description, category_id, image) VALUES (:name, :description, :category_id, :image)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':name', $product['name']);
  $stmt->bindParam(':description', $product['description']);
  $stmt->bindParam(':category_id', $product['category']);
  $stmt->bindParam(':image', $image);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function editProduct($post, $file)
{
  global $conn;

  $image = $post['old_image'];

  if ($file['image']['error'] == 0) {
    unlink('../asset/img/' . $image);

    $image = $file['image']['name'];
    $tmp = $file['image']['tmp_name'];
    $image = date('dmYHis') . '-' . $image;
    $path = "../asset/img/" . $image;
    move_uploaded_file($tmp, $path);
  }

  $sql = "UPDATE product SET name = :name, description = :description, image = :image, category_id = :category_id WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':name', $post['name']);
  $stmt->bindParam(':description', $post['description']);
  $stmt->bindParam(':image', $image);
  $stmt->bindParam(':category_id', $post['category']);
  $stmt->bindParam(':id', $post['id']);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function deleteProduct($id)
{
  global $conn;

  $sql = "SELECT * FROM product WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  $image = $result['image'];

  unlink('../asset/img/' . $image);

  $sql = "DELETE FROM product WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    false;
  }
}

function getAllBanner()
{
  global $conn;

  $sql = "SELECT * FROM banner";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}

function getBanner($id)
{
  global $conn;

  $sql = "SELECT * FROM banner WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  return $result;
}

function addBanner($post, $file)
{
  global $conn;

  $image = $file['image']['name'];
  $tmp = $file['image']['tmp_name'];
  $image = 'banner-' . date('dmYHis') . '-' . $image;
  $path = "../asset/img/" . $image;
  move_uploaded_file($tmp, $path);

  $sql = "INSERT INTO banner (title, caption, image, link) VALUES (:title, :caption, :image, :link)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':title', $post['title']);
  $stmt->bindParam(':caption', $post['caption']);
  $stmt->bindParam(':image', $image);
  $stmt->bindParam(':link', $post['link']);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function editBanner($post, $file)
{
  global $conn;

  $image = $post['old_image'];

  if ($file['image']['error'] == 0) {
    unlink('../asset/img/' . $image);

    $image = $file['image']['name'];
    $tmp = $file['image']['tmp_name'];
    $image = 'banner-' . date('dmYHis') . '-' . $image;
    $path = "../asset/img/" . $image;
    move_uploaded_file($tmp, $path);
  }

  $sql = "UPDATE banner SET title = :title, caption = :caption, image = :image, link = :link WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':title', $post['title']);
  $stmt->bindParam(':caption', $post['caption']);
  $stmt->bindParam(':image', $image);
  $stmt->bindParam(':link', $post['link']);
  $stmt->bindParam(':id', $post['id']);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    return false;
  }
}

function deleteBanner($id)
{
  global $conn;

  $sql = "SELECT * FROM banner WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  $image = $result['image'];

  unlink('../asset/img/' . $image);

  $sql = "DELETE FROM banner WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    return true;
  } else {
    false;
  }
}

function liked($id)
{
  $user = $_SESSION['id'];
  global $conn;

  $sql = "SELECT * FROM like_item WHERE user_id = :user_id AND product_id = :product_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_id', $user);
  $stmt->bindParam(':product_id', $id);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    $sql = "DELETE FROM like_item WHERE user_id = :user_id AND product_id = :product_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user);
    $stmt->bindParam(':product_id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  } else {
    $sql = "INSERT INTO like_item (user_id, product_id) VALUES (:user_id, :product_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user);
    $stmt->bindParam(':product_id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}

function getUserLike()
{
  $user = $_SESSION['id'];
  global $conn;

  $sql = "SELECT * FROM like_item JOIN product ON like_item.product_id = product.id  WHERE user_id = :user_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_id', $user);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $result;
}
