<?php
require __DIR__ . '/../models/RecipeModel.php';

class RecipeController{
    //properties
    private RecipeModel $model;

    //magical methods
    public function __construct()
    {
        $this->model = new RecipeModel();
    }


    public function browse(): void
    {
        $recipes = $this->model->getAllRecipes();

        require __DIR__ . '/../views/index.php';
    }

    public function checkBrowseRecipeId():void
    {
        $id = isset($_GET["id"]) ? $_GET["id"] : $_POST["id"];
        $cleanId = filter_var($id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
        if (false === $cleanId || null === $cleanId) {
            header("Location: /");
            exit("Wrong input parameter");
        }
    }

    public function browseRecipe(int $cleanId): void
    {
        $recipe = $this->model->getOneRecipe($cleanId);
        // Database result check
        if (!isset($recipe['title']) || !isset($recipe['description'])) {
            header("Location: /");
            exit("Recipe not found");
        }

        // Generate the web page
        require __DIR__ . '/../views/show.php';
    }

    public function checkForm(array $data): array
    {
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
            if(!isset($errors[$key])){
                $recipe[$key] = $cleanValue;
            }
        }

        $checkedData = [
            "errors" => $errors,
            "recipe" => $recipe
        ];
        return $checkedData;
    }

    public function addRecipe(): void
    {
        if($_POST){
            $data = [
                "title" => $_POST["title"],
                "description" => $_POST["description"]
            ];

            $checkedData = $this->checkForm($data);
            
            if(!$checkedData["errors"]){
                $this->model->saveRecipe($checkedData["recipe"]);
                header("location: /");
            }
        }
        // Generate the web page
            require __DIR__ . '/../views/add.php';
    }

    public function editRecipe(): void
    {
        //If I get id in url parameter, I'll retrieve the recipe to edit
        if(isset($_GET["id"])){
            $recipeData = $this->model->getOneRecipe($_GET["id"]);
        }

        //If the user send the form
        if($_POST){

            $data = [
                "title" => $_POST["title"],
                "description" => $_POST["description"]
            ];
            $checkedData = $this->checkForm($data);
            
            if(!$checkedData["errors"]){
                $checkedData["recipe"]["id"] = $_POST["id"];
                $this->model->updateRecipe($checkedData["recipe"]);
                header("location: /");
            }
        }
        // Generate the web page
            require __DIR__ . '/../views/edit.php';
    }

    public function deleteRecipe(int $id):void
    {
        $this->model->deleteRecipe($id);
        header("location: /");
    }
}