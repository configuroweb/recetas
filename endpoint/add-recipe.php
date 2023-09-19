<?php 
include('../conn/conn.php');

$recipeName = $_POST['recipe_name'];
$recipeCategory = $_POST['tbl_category_id'];
$recipeIngredients = $_POST['recipe_ingredients'];
$recipeProcedure = $_POST['recipe_procedure'];

// recipe image
$recipeImageName = $_FILES['recipe_image']['name'];
$recipeImageTmpName = $_FILES['recipe_image']['tmp_name'];

$target_dir = "../uploads/";
$target_file = $target_dir . basename($recipeImageName);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// check if the image is valid
if (isset($_POST['submit'])) {
    $check = getimagesize($recipeImageTmpName);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}

// Check file size
if ($_FILES["recipe_image"]["size"] > 500000) {
    $uploadOk = 0;
}

// Allow only certain image formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    $uploadOk = 0;
} 


// insert of the $uploadOk is 1
if ($uploadOk == 0) {
    echo "<script>
    alert('There\'s a problem with your image, try another image'); 
    window.location.href = 'http://localhost/recetas/index.php#food';
    </script>";
} else {
    if (move_uploaded_file($recipeImageTmpName, $target_file)) {
        $recipeImage = $recipeImageName;

        $stmt = $conn->prepare("INSERT INTO `tbl_recipe` (`tbl_recipe_id`, `tbl_category_id`, `recipe_image`, `recipe_name`, `recipe_ingredients`, `recipe_procedure`) VALUES (NULL, :recipeCategory, :recipeImage, :recipeName, :recipeIngredients, :recipeProcedure)");
        $stmt->bindParam(':recipeCategory', $recipeCategory);
        $stmt->bindParam(':recipeImage', $recipeImage);
        $stmt->bindParam(':recipeName', $recipeName);
        $stmt->bindParam(':recipeIngredients', $recipeIngredients);
        $stmt->bindParam(':recipeProcedure', $recipeProcedure);

        $stmt->execute();

        echo "<script>
        alert('Sucessfully Added'); 
        window.location.href = 'http://localhost/recetas/index.php#food';
        </script>";

    } else {
        echo "<script>
        alert('Failed'); 
        window.location.href = 'http://localhost/recetas/index.php#food';
        </script>";
    }
}
