<form action="/dashboard/edit/<?= $recipe['slug'] ?>" method=" post" enctype='multipart/form-data'>
    <h2>Edit Recipe</h2>
    <a href="/dashboard">Go Back</a>
    <?php if (isset($message)) : ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>
    <label>Title: </label>
    <input type="text" placeholder="Title" name="title" value=<?= $recipe['title'] ?>>
    <label>Slug: </label>
    <input type="text" placeholder="Slug" name="slug" value=<?= $recipe['slug'] ?>>
    <label>Body: </label>
    <textarea placeholder="Body" name="body"><?= $recipe['title'] ?></textarea>
    <label>Image: </label>
    <img src="/public/upload/<?= $recipe['image'] ?>" />
    <input type="file" name="recipe_image">

    <button type="submit" value="Upload">Update Recipe</button>
    <?php if (isset($validation)) : ?>
        <div class="error"><?= $validation->listErrors() ?></div>
    <?php endif; ?>
</form>