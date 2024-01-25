<?php
include 'db.php';

function getAllPizzas() {
    global $conn;

    $sql = "SELECT * FROM pizzas";
    $result = $conn->query($sql);

    $pizzas = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pizzas[] = $row;
        }
    }

    return $pizzas;
}

function addPizza($name, $description, $price, $imageUrl) {
    global $conn;

    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);
    $price = floatval($price);
    $imageUrl = $conn->real_escape_string($imageUrl);

    $sql = "INSERT INTO pizzas (name, description, price, image_url) VALUES ('$name', '$description', $price, '$imageUrl')";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
       
        error_log("Error adding pizza to database: " . $conn->error);
        return false;
    }
}

function getPizzaById($id) {
    global $conn;

    $id = intval($id);
    $sql = "SELECT * FROM pizzas WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return null; 
    }
}   

function deletePizza($id) {
    global $conn;

    $id = intval($id);
    $sql = "DELETE FROM pizzas WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        return true; 
    } else {
       
        error_log("Error deleting pizza from the database: " . $conn->error);
        return false; 
    }
}


function updatePizza($id, $name, $description, $price) {
    global $conn;

    $id = intval($id);
    $name = $conn->real_escape_string($name);
    $description = $conn->real_escape_string($description);
    $price = floatval($price);

    $sql = "UPDATE pizzas SET name='$name', description='$description', price=$price WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        return true; 
    } else {
       
        error_log("Error updating pizza in the database: " . $conn->error);
        return false; 
    }
}


?>
