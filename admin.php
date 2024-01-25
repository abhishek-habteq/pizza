<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Admin Panel</title>
    <style>
        
        body {
            padding-top: 56px; 
        }

        @media (max-width: 576px) {
            body {
                padding-top: 70px; 
            }
        }
    </style>
</head>
<body>


        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="#">Manage</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php
                    
                    $isAddActive = isset($_GET['action']) && $_GET['action'] === 'addPizza';
                    ?>
                    <li class="nav-item">
                <a class="nav-link" href="users.php">User List</a>
            </li>
                    <li class="nav-item <?php echo $isAddActive ? 'active' : ''; ?>">
                        <a class="nav-link" href="admin.php">Add Pizza</a>
                    </li>
                </ul>
            </div>
        </nav>


<div class="container-fluid mt-4 p-3 pl-4">
    <div class="row">
        <div class="col-md-6">
            <?php
           
            include 'functions.php';

            
            if(isset($_GET['action']) && $_GET['action'] == 'editPizza' && isset($_GET['id'])) {
                $pizzaId = $_GET['id'];
                $pizza = getPizzaById($pizzaId);

                if ($pizza) {
                    
                    ?>
                    <h2>Edit Pizza</h2>
                    <form action="process_edit_pizza.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="editPizza">
                        <input type="hidden" name="pizzaId" value="<?php echo $pizza['id']; ?>">

                      
                        <div class="form-group">
                            <label for="pizzaName">Pizza Name:</label>
                            <input type="text" class="form-control" id="pizzaName" name="pizzaName" value="<?php echo $pizza['name']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="pizzaDescription">Description:</label>
                            <textarea class="form-control" id="pizzaDescription" name="pizzaDescription" required><?php echo $pizza['description']; ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="pizzaPrice">Price:</label>
                            <input type="number" step="0.01" class="form-control" id="pizzaPrice" name="pizzaPrice" value="<?php echo $pizza['price']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="pizzaImage">Image:</label>
                            <input type="file" class="form-contr    ol-file" id="pizzaImage" name="pizzaImage" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Pizza</button>
                    </form>
                    <?php
                } else {
                    
                    echo '<div class="alert alert-danger" role="alert">Error: Pizza not found for editing.</div>';
                }
            } else {
                ?>
                <h2>Add Pizza</h2>
                <form action="process_add_pizza.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="addPizza">

                    <div class="form-group">
                        <label for="pizzaName">Pizza Name:</label>
                        <input type="text" class="form-control" id="pizzaName" name="pizzaName" required>
                    </div>

                    <div class="form-group">
                        <label for="pizzaDescription">Description:</label>
                        <textarea class="form-control" id="pizzaDescription" name="pizzaDescription" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="pizzaPrice">Price:</label>
                        <input type="number" step="0.01" class="form-control" id="pizzaPrice" name="pizzaPrice" required>
                    </div>

                    <div class="form-group">
                        <label for="pizzaImage">Image:</label>
                        <input type="file" class="form-control-file" id="pizzaImage" name="pizzaImage" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Pizza</button>
                </form>
                <?php
            }
            ?>
        </div>

        <div class="col-md-6 mt-4 mt-md-0">
    <h2>Current Inventory</h2>
    <div class="row">
        <?php
        $existingPizzas = getAllPizzas();
        foreach ($existingPizzas as $pizza):
            ?>
            
            <div class="col-6 col-sm-6 col-md-4 col-lg-4 mb-4">
                <div class="card">
                    <img src="<?php echo $pizza['image_url']; ?>" class="card-img-top" alt="<?php echo $pizza['name']; ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 1rem; height: 2.5rem; overflow: hidden;"><?php echo $pizza['name']; ?></h5>
                        <p class="card-text" style="font-size: 0.9rem; height: 4rem; overflow: hidden;"><?php echo $pizza['description']; ?></p>
                        <p class="card-text">$<?php echo $pizza['price']; ?></p>
                        
                        <a href="admin.php?action=editPizza&id=<?php echo $pizza['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="process_delete_pizza.php?action=deletePizza&id=<?php echo $pizza['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this pizza?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
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
