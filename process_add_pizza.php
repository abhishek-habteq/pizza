<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizzaName = $_POST["pizzaName"];
    $pizzaDescription = $_POST["pizzaDescription"];
    $pizzaPrice = $_POST["pizzaPrice"];

    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["pizzaImage"]["name"]);

    if (move_uploaded_file($_FILES["pizzaImage"]["tmp_name"], $targetFile)) {
        
        if (addPizza($pizzaName, $pizzaDescription, $pizzaPrice, $imageUrl)) {
            header("Location: admin.php?success=1");
        } else {
            header("Location: admin.php?error=2"); 
        }
    } else {
       
        header("Location: admin.php?error=1&message=Image upload failed. Check if the directory 'uploads' exists and has the correct permissions.");
    }
} else {
    
    header("Location: admin.php");
}
?>
