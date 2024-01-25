<?php
session_start();

function saveUserData($userData)
{
    $jsonFile = 'users.json';
    $users = [];

    if (file_exists($jsonFile)) {
        $users = json_decode(file_get_contents($jsonFile), true);
    }

    $index = count($users) + 1;
    $users[] = ['index' => $index, 'username' => $userData['username'], 'password' => $userData['password']];

    file_put_contents($jsonFile, json_encode($users));
}

function getUserData($username)
{
    $jsonFile = 'users.json';

    if (file_exists($jsonFile)) {
        $users = json_decode(file_get_contents($jsonFile), true);

        foreach ($users as $user) {
            if ($user['username'] === $username) {
                return $user;
            }
        }
    }

    return null;
}

function verifyPassword($inputPassword, $hashedPassword)
{
    return password_verify($inputPassword, $hashedPassword);
}

$loginError = $registerError = $loginSuccess = $registerSuccess = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $userData = getUserData($username);

        if ($userData && verifyPassword($password, $userData["password"])) {
            $loginSuccess = true;
            sleep(2);
            header("Location: index.php?loginSuccess=true&username=" . urlencode($username));
            exit();
        } else {
            $loginError = "Invalid username or password. Please try again.";
        }
    } elseif (isset($_POST['register'])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (getUserData($username)) {
            $registerError = "Username already taken. Please choose another.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            saveUserData(['username' => $username, 'password' => $hashedPassword]);

            $registerSuccess = true;
            sleep(2);
            header("Location: index.php?registerSuccess=true&username=" . urlencode($username));
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css'>
    <title>User Authentication</title>

    <style>
        body {
            background: #f5f5f5;
        }

        h5 {
            font-weight: 400;
        }

        .container {
            margin-top: 80px;
            width: 400px;
            height: 700px;
        }

        .tabs .indicator {
            background-color: #e0f2f1;
            height: 60px;
            opacity: 0.3;
        }

        .form-container {
            padding: 40px;
            padding-top: 10px;
        }

        .confirmation-tabs-btn {
            position: absolute;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container white z-depth-2">
    <ul class="tabs teal">
        <li class="tab col s3"><a class="white-text active" href="#login">login</a></li>
        <li class="tab col s3"><a class="white-text" href="#register">register</a></li>
    </ul>
    <div id="login" class="col s12">
        <form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="loginFormAjax">
            <div class="form-container">
                <h3 class="teal-text">Welcome Back!</h3>
                <?php if (!empty($loginError)) echo '<div class="alert alert-danger" role="alert">' . $loginError . '</div>'; ?>
                <?php if ($loginSuccess) echo '<div class="alert alert-success" role="alert">Login successful. Redirecting...</div>'; ?>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="username" type="text" class="validate" name="username" required>
                        <label for="username">Username</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate" name="password" required>
                        <label for="password">Password</label>
                    </div>
                </div>
                <br>
                <center>
                    <button class="btn waves-effect waves-light teal" type="submit" name="login">Login</button>
                </center>
            </div>
        </form>
    </div>
    <div id="register" class="col s12">
        <form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="registerFormAjax">
            <div class="form-container">
                <h3 class="teal-text">Let's get started!</h3>
                <?php if (!empty($registerError)) echo '<div class="alert alert-danger" role="alert">' . $registerError . '</div>'; ?>
                <?php if ($registerSuccess) echo '<div class="alert alert-success" role="alert">Registration successful. Redirecting...</div>'; ?>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="username" type="text" class="validate" name="username" required>
                        <label for="username">Username</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" class="validate" name="password" required>
                        <label for="password">Password</label>
                    </div>
                </div>
                <br>
                <center>
                    <button class="btn waves-effect waves-light teal" type="submit" name="register">Register</button>
                </center>
            </div>
        </form>
    </div>
</div>

<script src='https://code.jquery.com/jquery-2.1.1.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js'></script>

</body>
</html>
