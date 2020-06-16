<form action="/dashboard/add-recipe" method="post" enctype='multipart/form-data'>
    <h2>Add Recipe</h2>
    <a href="/dashboard">Go Back</a>
    <?php if (isset($message)) : ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>
    <label>Title: </label>
    <input type="text" placeholder="Title" name="title">
    <label>Slug: </label>
    <input type="text" placeholder="Slug" name="slug">
    <label>Body: </label>
    <textarea placeholder="Body" name="body"></textarea>
    <label>Image: </label>
    <input type="file" name="recipe_image">

    <button type="submit" value="Upload">Add Recipe</button>
    <?php if (isset($validation)) : ?>
        <div class="error"><?= $validation->listErrors() ?></div>
    <?php endif; ?>
</form>