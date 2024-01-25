<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>User Management</title>

    <style>
        body {
            padding-top: 56px;
        }

        @media (max-width: 576px) {
            body {
                padding-top: 70px;
            }
        }

        .container {
            margin-top: 20px;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            color: #ffffff;
            font-weight: bold;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #ffffff;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .table th, .table td {
            text-align: center;
        }

        .table thead th {
            background-color: #343a40;
            color: #ffffff;
            border-color: #343a40;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .btn-danger {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand" href="#">User Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="admin.php">Admin Panel</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2 class="mt-4 mb-4">User Management</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Index</th>
                <th>Username</th>
                <th>Password (Hashed)</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $jsonFile = 'users.json';

            if (file_exists($jsonFile)) {
                $users = json_decode(file_get_contents($jsonFile), true);

                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>{$user['index']}</td>";
                    echo "<td>{$user['username']}</td>";
                    echo "<td>" . substr($user['password'], 0, 10) . "...</td>";
                    echo "<td><a href=\"javascript:void(0);\" class=\"btn btn-danger\" onclick=\"deleteUser({$user['index']})\">Delete</a></td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function deleteUser(index) {
        var confirmation = confirm("Are you sure you want to delete this user?");
        if (confirmation) {
            window.location.href = "users.php?delete=" + index;
        }
    }
</script>

</body>
</html>
