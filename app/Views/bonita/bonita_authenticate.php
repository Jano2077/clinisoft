<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonita Authentication</title>
</head>
<body>
    <form action="<?= base_url('bonita/authenticate') ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Authenticate">
    </form>
    <?php if (session()->has('message')): ?>
        <p><?= session('message') ?></p>
    <?php endif; ?>
</body>
</html>