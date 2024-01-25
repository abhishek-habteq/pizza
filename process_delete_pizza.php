<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $pizzaId = $_GET['id'];

    if (deletePizza($pizzaId)) {
        header("Location: admin.php?success=3");
    } else {
        header("Location: admin.php?error=5"); 
    }
} else {
    
    header("Location: admin.php");
}
?>
