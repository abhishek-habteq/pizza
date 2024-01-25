<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Pizza Haven Admin</title>
    
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

<?php

session_set_cookie_params(5); // Set session timeout to 5 seconds for testing

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === "admin" && $password === "admin") {
        session_start();
        $_SESSION["admin_logged_in"] = true;

        echo '<div class="container mt-5"><div class="alert alert-success" role="alert">Login successful! Redirecting...</div></div>';
        echo '<script>setTimeout(function(){ window.location.href = "admin.php"; }, 1000);</script>';
        exit();
    } else {
        $loginError = true;
    }
}

if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"] === true) {
    include 'functions.php';

    // Rest of the admin page code goes here...

} else {
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center mb-4">Admin Login</h2>
                <?php
                if (isset($loginError) && $loginError) {
                    echo '<div class="alert alert-danger" role="alert">Invalid username or password.</div>';
                }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>

    <?php
}
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
