<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Process</title>
</head>
<body>
    <form action="<?= base_url('bonita/startProcess') ?>" method="post">
        <label for="processDefinitionId">Process Definition ID:</label>
        <input type="text" id="processDefinitionId" name="processDefinitionId" required>
        <br>
        <label for="cookies">Cookies:</label>
        <textarea id="cookies" name="cookies" required></textarea>
        <br>
        <input type="submit" value="Start Process">
    </form>
    <?php if (session()->has('message')): ?>
        <p><?= session('message') ?></p>
    <?php endif; ?>
</body>
</html>