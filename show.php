<?php

// Input GET parameter validation (integer >0)
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
if (false === $id || null === $id) {
    header("Location: /");
    exit("Wrong input parameter");
}

//Retrieve my recipe
require __DIR__.'/src/models/recipe-model.php';
$recipe = getOneRecipe($id);

// Database result check
if (!isset($recipe['title']) || !isset($recipe['description'])) {
    header("Location: /");
    exit("Recipe not found");
}


// Generate the web page
require __DIR__ . '/src/views/show.php';
