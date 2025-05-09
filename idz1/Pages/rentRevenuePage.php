<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$selected_date = '';
$revenue = '0';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_date = $_POST['date'];
    
    require '../DB/rentRevenue.php';

    $revenue = getRentRevenue($selected_date);
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

    <h2>Choose the date</h2>

    <form action="rentRevenuePage.php" method="POST">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($selected_date); ?>" required>
        <button type="submit">Submit</button>
    </form>
    
    <?php
    if ($revenue !== null) {
        echo "Revenue: " . htmlspecialchars($revenue);
    }
    ?>
</body>
</html>

