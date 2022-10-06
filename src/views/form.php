<?php
    if($_POST){
        $data = [
            "title" => $_POST["title"],
            "description" => $_POST["description"]
        ];
        $errors = [];
        $recipe = [];
        foreach($data as $key => $value){
            $cleanValue = htmlentities(trim($value));
            if($cleanValue === ""){
                $errors[$key] = "please fill the $key field";
            }
            if($key === "title" && strlen($cleanValue) > 255){
                $errors[$key] = "Title too long";
            }
            if(!$errors[$key]){
                $recipe[$key] = $cleanValue;
            }
        }
        if(!$errors){
            saveRecipe($recipe);
            header("location: /");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmiwild : Add a recipe</title>
</head>
<body>
    <h1>Add a recipe !</h1>
    <form action="add.php" method="POST">
        <div>
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required placeholder="Title of your recipe">
            <?php if($errors["title"]) : ?>
                <p><?= $errors["title"] ?></p>
            <?php endif ?>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" required placeholder="Description of your recipe">
            </textarea>
            <?php if($errors["description"]) : ?>
                <p><?= $errors["description"] ?></p>
            <?php endif ?>
        </div>
        <input type="submit" value="Add">
    </form>
</body>
</html>