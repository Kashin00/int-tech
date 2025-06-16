<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $selected_date = $_GET['date'] ?? '';
    $callback = $_GET['callback'] ?? null;

    if (!$callback) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing callback']);
        exit;
    }

    require '../DB/availableCars.php';
    $cars = getAvailableCars($selected_date);

    header('Content-Type: application/javascript');
    echo $callback . '(' . json_encode($cars) . ');';
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

    <h2>Choose a date</h2>

    <form id="carForm">
        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>
        <button type="submit">Submit</button>
    </form>

    <div id="carResult"></div>

    <script>
    document.getElementById('carForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const date = document.getElementById('date').value;
        const callbackName = 'displayCars';

        const script = document.createElement('script');
        script.id = 'jsonpScript';
        script.src = `availableCarsPage.php?ajax=true&date=${encodeURIComponent(date)}&callback=${callbackName}`;
        document.body.appendChild(script);
    });

    function displayCars(cars) {
        if (!Array.isArray(cars)) {
            document.getElementById('carResult').innerHTML = '<p>No cars available or error loading data.</p>';
            return;
        }

        let tableHtml = '<table border="1"><tr><th>ID</th><th>Name</th><th>Release Date</th><th>Race</th><th>Vendor</th><th>Price</th></tr>';

        cars.forEach(car => {
            tableHtml += `<tr>
                <td>${car.ID_Cars}</td>
                <td>${car.Name}</td>
                <td>${car.Release_date}</td>
                <td>${car.Race}</td>
                <td>${car.FID_Vendors}</td>
                <td>${car.Price}</td>
            </tr>`;
        });

        tableHtml += '</table>';
        document.getElementById('carResult').innerHTML = tableHtml;
    }
    </script>

</body>
</html>
