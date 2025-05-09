<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$cars = [];
$selected_date = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_date = $_POST['date'];
    
    require '../DB/availableCars.php';

    $cars = getAvailableCars($selected_date);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select rent date</title>
</head>
<body>

    <h2>Choose a date</h2>

    <form action="availableCarsPage.php" method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($selected_date); ?>" required>
        <button type="submit">Submit</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <?php if (is_array($cars) && !empty($cars)): ?>
            <h3>Availalbe cars for selected date:</h3>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Release date</th>
                    <th>Race</th>
                    <th>Vendor</th>
                    <th>Price</th>
                </tr>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($car['ID_Cars']); ?></td>
                        <td><?php echo htmlspecialchars($car['Name']); ?></td>
                        <td><?php echo htmlspecialchars($car['Release_date']); ?></td>
                        <td><?php echo htmlspecialchars($car['Race']); ?></td>
                        <td><?php echo htmlspecialchars($car['FID_Vendors']); ?></td>
                        <td><?php echo htmlspecialchars($car['Price']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No cars available.</p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>
