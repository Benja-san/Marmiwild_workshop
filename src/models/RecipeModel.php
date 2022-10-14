<?php

class RecipeModel{
    //Const
    //properties
    private PDO $connection;

    //Magical methods
    public function __construct()
    {
        $this->connection = new \PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
    }

    //methods
    public function getAllRecipes(): array
    {
        $query = 'SELECT id, title FROM recipe';
        $statement = $this->connection->query($query);
        $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $recipes;
    }


    public function getOneRecipe(int $id): array|false
    {
        $query = 'SELECT id, title, description FROM recipe WHERE id=:id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $recipe = $statement->fetch(PDO::FETCH_ASSOC);
        return $recipe;
    }

    public function saveRecipe(array $recipe): void
    {
        $query = 'INSERT INTO recipe (title, description) VALUES (:title, :description)';
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':title', $recipe["title"], PDO::PARAM_STR);
        $statement->bindValue(':description', $recipe["description"], PDO::PARAM_STR);
        $statement->execute();
    }

    public function deleteRecipe(int $id):void
    {
        $query = "DELETE FROM recipe WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function updateRecipe(array $updatedRecipe):void
    {
        $query = "UPDATE recipe SET title = :title, description = :description WHERE id = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindValue(':description', $updatedRecipe["description"], PDO::PARAM_STR);
        $statement->bindValue(':title', $updatedRecipe["title"], PDO::PARAM_STR);
        $statement->bindValue(':id', $updatedRecipe["id"], PDO::PARAM_INT);
        $statement->execute();
    }

}