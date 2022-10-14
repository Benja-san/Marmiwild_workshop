<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>List of Recipes</title>
    </head>
    <body>
        <h1>List of Recipes</h1>
        <ul>
            <?php foreach ($recipes as $recipe) : ?>
            <li>
                <a href="show?id=<?= $recipe['id'] ?>">
                    <h2><?= $recipe['title'] ?></h2>
                </a>
                <a style="color:red" href="delete?id=<?= $recipe['id'] ?>">X</a>
                <a style="color:yellowgreen" href="edit?id=<?= $recipe['id'] ?>&type=edit">Edit</a>
            </li>
            <?php endforeach ?>
            <li><a href="add?&type=add">Add a recipe</a></li>
        </ul>
    </body>
</html>
