<?php
require __DIR__.'/../src/controllers/recipe-controller.php';

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/' === $urlPath) {
    header("location: /home");
} elseif("/home" === $urlPath){
    browseRecipes();
} elseif("/show" === $urlPath){
    checkBrowseRecipeId();
    browseRecipe($_GET["id"]);
} elseif("/add" === $urlPath) {
    displayAndCheckRecipeForm();
}
else {
    header('HTTP/1.1 404 Not Found');
}