<?php
include 'functions.php';

$pizzas = getAllPizzas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Pizza Ordering</title>

  <style>
 
    body {
      padding-top: 56px; 
    }
    .banner {
      background-image: url('banner.png ');
      background-size: cover;
      height: 350px; 
    }
    .card-img-top {
      height: 200px; 
      object-fit: cover;
    }
  


  </style>
</head>
<nav class="navbar navbar-expand-lg  navbar-light bg- fixed-top">
  <a class="navbar-brand " href="index.php">Pizza</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="all.php">All Pizzas</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Login</a>
      </li>
    </ul>
  </div>
</nav>
<div class="container mt-4">

</div>









<footer class="bg- text-dark text-center py-3">
  <p>&copy; 2024 Pizza</p>
</footer>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
