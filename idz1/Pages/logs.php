<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../Logger/logQueries.php';

$logs = getAllLogs();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_logs'])) {
    clearLogs();
    header("Location: " . $_SERVER['PHP_SELF']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs list</title>
</head>
<body>

    <h2>History</h2>

    <form method="POST">
        <button type="submit" name="clear_logs">Clear</button>
    </form>
    <br>

    <?php if (!empty($logs)): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Params</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($log['id']); ?></td>
                        <td><?php echo htmlspecialchars($log['query_name']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($log['params'])); ?></td>
                        <td><?php echo htmlspecialchars($log['executed_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Логів поки немає.</p>
    <?php endif; ?>

</body>
</html>