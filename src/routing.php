<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Marmiwild\App\Controllers\RecipeController;

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($urlPath){
    case "/" :
        header("location: /home");
        break;
    case "/home" :
        $recipeController = new RecipeController();
        echo $recipeController->browse();
        break;
    case "/show" :
        $recipeController = new RecipeController();
        $recipeController->checkBrowseRecipeId();
        echo $recipeController->browseRecipe($_GET["id"]);
        break;
    case "/add" :
        $recipeController = new RecipeController();
        echo $recipeController->addRecipe();
        break;
    case "/delete" :
        $recipeController = new RecipeController();
        $recipeController->checkBrowseRecipeId();
        $recipeController->deleteRecipe($_GET["id"]);
        break;
    case "/edit" :
        $recipeController = new RecipeController();
        $recipeController->checkBrowseRecipeId();
        echo $recipeController->editRecipe();
        break;
    default :
        header('HTTP/1.1 404 Not Found');
}