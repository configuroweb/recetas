<?php
include('../conn/conn.php');

if (isset($_GET['recipe'])) {
    $recipeID = $_GET['recipe'];

    // Retrieve the book image filename
    $stmt = $conn->prepare("SELECT `recipe_image` FROM `tbl_recipe` WHERE `tbl_recipe_id` = ?");
    $stmt->execute([$recipeID]);
    $row = $stmt->fetch();

    $recipeImage = $row['recipe_image'];

    // Delete the book from the database
    $stmt = $conn->prepare("DELETE FROM `tbl_recipe` WHERE `tbl_recipe_id` = ?");
    $stmt->execute([$recipeID]);

    // Delete the associated image file
    if (!empty($recipeImage)) {
        $imagePath = "../uploads/" . $recipeImage;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Redirect to the page where you want to display the updated book list
    echo "<script>
    alert('Deleted Successfully'); 
    window.location.href = 'http://localhost/recetas/index.php#food';
    </script>";
    exit();
}
