<?php
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pizzaId = $_POST["pizzaId"];
    $pizzaName = $_POST["pizzaName"];
    $pizzaDescription = $_POST["pizzaDescription"];
    $pizzaPrice = $_POST["pizzaPrice"];

   
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["pizzaImage"]["name"]);
    move_uploaded_file($_FILES["pizzaImage"]["tmp_name"], $targetFile);
    $imageUrl = $targetFile;

    
    if (updatePizza($pizzaId, $pizzaName, $pizzaDescription, $pizzaPrice)) {
        header("Location: admin.php?success=2"); 
    } else {
        header("Location: admin.php?error=4"); 
    }
} else {
   
    header("Location: admin.php");
}
?>
