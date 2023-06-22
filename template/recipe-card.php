<div class="recipe-card main-box flex-box">
    <div class="recipe-card__title flex-box">
        <form action="../view/profile.php" method="get">
            <input type="submit" name="author" value="<?php echo $author ?>" class="button button--underline-hover">
        </form>
        <p>/</p>
        <form action="../view/recipe.php" method="get">
            <textarea name="recipeId" class="none"><?php echo $id ?></textarea>
            <input type="submit" name="title" value="<?php echo $title ?>" class="button button--underline-hover">
        </form>
    </div>
    <div class="recipe-card__description">
        <?php echo $description ?>
    </div>
    <div class="recipe-card__stats flex-box">
        <img src="../img/heart.ico" alt="" height=32 width=32>
        <p><?php echo $likeNumber ?></p>
    </div>
</div>