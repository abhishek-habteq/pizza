<?php
include 'functions.php';
$registerSuccess = isset($_GET['registerSuccess']) && $_GET['registerSuccess'] === 'true';
$loginSuccess = isset($_GET['loginSuccess']) && $_GET['loginSuccess'] === 'true';

$username = isset($_GET['username']) ? $_GET['username'] : '';

$navbarItem = ($loginSuccess || $registerSuccess) ? $username . ' (Logout)' : 'Login';

$pizzas = getAllPizzas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>All Pizzas</title>
 
  <style>
    body {
      padding-top: 56px; 
    }
    
    .card {
      height: 100%;
    }
    .card-img-top {
      height: 200px; 
      object-fit: cover;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg- fixed-top">
  <a class="navbar-brand" href="index.php">Pizza</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item">
      <?php
        $successParam = ($loginSuccess) ? 'loginSuccess=true' : 'registerSuccess=true';
        $url = "all.php?$successParam&username=$username"; ?>
        <a class="nav-link" href="<?php echo $url; ?>">All Pizzas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">Cart</a>
      </li>
      <li class="nav-item">
        <?php if ($loginSuccess || $registerSuccess): ?>
          <a class="nav-link" href="index.php?logout=true"> <?php echo $navbarItem; ?></a>
        <?php else: ?>
          <a class="nav-link" href="login.php">Login</a>
        <?php endif; ?>
      </li>
    </ul>
  </div>
</nav>

<div class="container mt-4">
  <h2>All Items</h2>
  <div class="row">
    <?php foreach ($pizzas as $pizza): ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="<?php echo $pizza['image_url']; ?>" class="card-img-top" alt="<?php echo $pizza['name']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $pizza['name']; ?></h5>
            <p class="card-text "><?php echo $pizza['description']; ?></p>
            <p class="card-text">$<?php echo $pizza['price']; ?></p>
            <button class="btn btn-primary">Add to Cart</button>
            <button class="btn btn-success">Buy Now</button>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<footer class="bg- text-dark text-center py-3">
  <p>&copy; 2024 Pizza</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
