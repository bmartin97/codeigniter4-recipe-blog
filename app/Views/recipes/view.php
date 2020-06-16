<h1><?= esc($title); ?></h1>
<div class="recipe-page">
    <a href="/" class="button-link">&larr;Go Back </a>
    <p class="slug">Slug: <?= esc($slug); ?></p>
    <div class="image">
        <img src="/public/upload/<?= $image ?>" />
    </div>
    <h2>Recipe</h2>
    <div class="recipe-body"><?= esc($body); ?></div>
    <a href="/" class="button-link">&larr;Go Back </a>
</div>