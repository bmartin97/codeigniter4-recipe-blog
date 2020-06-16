<form action="/login" method="post">
    <h2>Sign in</h2>
    <?php if (isset($message)) : ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>
    <label>Username: </label>
    <input type="text" placeholder="Enter Username" name="username" required>
    <label>Password: </label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <button type="submit">Login</button>
    <?php if (isset($validation)) : ?>
        <div class="error"><?= $validation->listErrors() ?></div>
    <?php endif; ?>
</form>