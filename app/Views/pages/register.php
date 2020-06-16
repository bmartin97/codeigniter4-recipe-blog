<form action="/register" method="post">
    <h2>Sign Up</h2>
    <label>Username: </label>
    <input type="text" placeholder="Enter Username" name="username" id="username">
    <label>Password: </label>
    <input type="password" placeholder="Enter Password" name="password" id="password">
    <label>Confirm password: </label>
    <input type="password" placeholder="Enter Password" name="conf_password" id="conf_password">
    <button type="submit">Register</button>
    <a href="/login">login</a>
    <?php if (isset($validation)) : ?>
        <div class="error"><?= $validation->listErrors() ?></div>
    <?php endif; ?>
</form>