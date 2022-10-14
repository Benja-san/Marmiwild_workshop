
    <form action="<?= $formName ?>" method="POST">
        <input type="hidden" name="type" value="<?= $formName ?>">
        <?php if(isset($recipeData)) : ?>
            <input type="hidden" name="id" value="<?= $recipeData["id"] ?>">
        <?php endif ?>
        <div>
            <label for="title">Title</label>
            <input value="<?= isset($recipeData["title"]) ? $recipeData["title"] : "" ?>" type="text" id="title" name="title" required placeholder="Title of your recipe">
            <?php if(isset($errors["title"])) : ?>
                <p><?= $errors["title"] ?></p>
            <?php endif ?>
        </div>
        <div>
            <label for="description">Description</label>
            <textarea id="description" name="description" required placeholder="Description of your recipe"><?= isset($recipeData["description"]) ? $recipeData["description"] : "" ?></textarea>
            <?php if(isset($errors["description"])) : ?>
                <p><?= $errors["description"] ?></p>
            <?php endif ?>
        </div>
        <input type="submit" value="<?= $formName ?>">
    </form>