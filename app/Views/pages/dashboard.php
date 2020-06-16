<h1>Dashboard</h1>

<div class="recipe-wrapper">
    <a href="/dashboard/add-recipe" class="button-link">Add Recipe</a>
    <table>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($recipes as $recipe) : ?>
            <tr>
                <td class="title"><?= $recipe['title'] ?></td>
                <td class="slug"><?= $recipe['slug'] ?></td>
                <td>
                    <a href="/recipes/<?= $recipe['slug'] ?>" class="open-link">🔹 Open recipe</a>
                    <a href="/dashboard/edit/<?= $recipe['slug'] ?>">🔧Edit</a>
                    <a href="dashboard/delete/<?= $recipe['slug'] ?>" class="delete-link">❌Delete</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </table>
</div>