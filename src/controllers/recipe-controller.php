<?php
require __DIR__ . '/../models/recipe-model.php';

function browseRecipes(): void
{
    $recipes = getAllRecipes();

    require __DIR__ . '/../views/index.php';
}

function checkBrowseRecipeId()
{
    $cleanId = filter_var($_GET["id"], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
    if (false === $cleanId || null === $cleanId) {
        header("Location: /");
        exit("Wrong input parameter");
    }
}

function browseRecipe(int $cleanId): void
{
    $recipe = getOneRecipe($cleanId);
    // Database result check
    if (!isset($recipe['title']) || !isset($recipe['description'])) {
        header("Location: /");
        exit("Recipe not found");
    }

    // Generate the web page
    require __DIR__ . '/../views/show.php';
}

function displayAndCheckRecipeForm(): void
{
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
    // Generate the web page
    require __DIR__ . '/../views/form.php';
}