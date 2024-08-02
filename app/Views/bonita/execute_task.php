<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Execute Task</title>
</head>
<body>
    <form action="<?= base_url('bonita/executeTask') ?>" method="post">
        <label for="taskId">Task ID:</label>
        <input type="text" id="taskId" name="taskId" required>
        <br>
        <label for="data">Data (JSON):</label>
        <textarea id="data" name="data" required></textarea>
        <br>
        <label for="cookies">Cookies:</label>
        <textarea id="cookies" name="cookies" required></textarea>
        <br>
        <input type="submit" value="Execute Task">
    </form>
    <?php if (session()->has('message')): ?>
        <p><?= session('message') ?></p>
    <?php endif; ?>
</body>
</html>