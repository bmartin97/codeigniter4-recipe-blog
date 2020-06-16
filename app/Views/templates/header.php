<!doctype html>
<html>

<head>
    <title><?= esc($title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/global_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <?php if (isset($username)) : ?>
            <div class="username">user: <?= $username ?></div>
        <?php endif; ?>
        <nav>
            <ul>
                <?php if (isset($username)) : ?>
                    <li><a href="/dashboard">Dashboard</a>
                    </li>
                    <li><a href="/dashboard/add-recipe">Add Recipe</a></li>
                    <li><a href="/log-out">Log Out</a></li>
                <?php else : ?>
                    <li><a href="/">Recipes</a></li>
                    <li><a href="/login">Log In</a></li>
                    <li><a href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="layout-container">