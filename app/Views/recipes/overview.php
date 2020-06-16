<h2><?= esc($title); ?></h2>

<?php if (!empty($recipes) && is_array($recipes)) : ?>

    <div class="recipe-wrapper">

        <?php foreach ($recipes as $recipe_item) : ?>
            <div class="recipe-item">
                <div class="thumbnail">
                    <img src="/public/upload/<?= $recipe_item['image'] ?>" />
                </div>
                <div class="details">
                    <h3><?= esc($recipe_item['title']); ?></h3>
                    <div class="main">
                        <?= esc($recipe_item['body']); ?>
                    </div>
                    <p><a href="/recipes/<?= esc($recipe_item['slug'], 'url'); ?>">View full recipe &rarr;</a></p>
                </div>

            </div>
        <?php endforeach; ?>

    </div>

<?php else : ?>

    <h3>No Recipes</h3>

    <p>Unable to find any recipes for you.</p>

<?php endif ?>