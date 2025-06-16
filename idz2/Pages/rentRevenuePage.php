<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajax']) && $_POST['ajax'] == "true") {
    $selected_date = $_POST['date'] ?? '';

    require '../DB/rentRevenue.php';

    $revenue = getRentRevenue($selected_date);

    echo "<p>Revenue for selected date: $revenue  </p>";
    exit;
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

    <form id="revenueForm">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <button type="submit">Submit</button>
    </form>

    <div id="result"></div>

<script>
document.getElementById('revenueForm').addEventListener('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);
    formData.append('ajax', 'true');

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'rentRevenuePage.php', true); // метод, урл, асинк

    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('result').innerHTML = xhr.responseText;
        } else {
            document.getElementById('result').innerHTML = 'Error loading data';
        }
    };

    xhr.send(formData);
});
</script>

</body>
</html>