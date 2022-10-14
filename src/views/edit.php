<?php
$formName="edit";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marmiwild : Edit your <?= isset($recipeData["title"]) ? $recipeData["title"] : ""  ?> recipe</title>
</head>
<body>
    <h1>Edit your <?= isset($recipeData["title"]) ? $recipeData["title"] : ""  ?> recipe!</h1>
    <?php require "form.php"; ?>
</body>
</html>