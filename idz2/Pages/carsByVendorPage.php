<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../DB/carsForVendor.php';
$vendors = getVendors();
$cars = [];
$selected_vendor = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajax']) && $_POST['ajax'] === 'true') {
    $selected_vendor = $_POST['vendor_id'];
    $cars = getAvailableCars($selected_vendor);

    header('Content-Type: application/json');
    echo json_encode($cars);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars by Vendor</title>
</head>
<body>

    <h2>Choose preferred vendor</h2>

    <form id="vendorForm" action="carsByVendorPage.php" method="POST">
        <label for="vendor">Vendor:</label>
        <select name="vendor_id" id="vendor" required>
            <option value="">---</option>
            <?php foreach ($vendors as $vendor): ?>
                <option value="<?= htmlspecialchars($vendor['ID_Vendors']) ?>">
                    <?= htmlspecialchars($vendor['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Submit</button>
    </form>

    <div id="vendorResult"></div>

    <script>
    document.getElementById('vendorForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('ajax', 'true');

        fetch('carsByVendorPage.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            let html = '';
            if (Array.isArray(data) && data.length > 0) {
                html = '<table border="1"><tr><th>ID</th><th>Name</th><th>Release Date</th><th>Race</th><th>Vendor</th><th>Price</th></tr>';
                data.forEach(car => {
                    html += `<tr>
                        <td>${car.ID_Cars}</td>
                        <td>${car.Name}</td>
                        <td>${car.Release_date}</td>
                        <td>${car.Race}</td>
                        <td>${car.FID_Vendors}</td>
                        <td>${car.Price}</td>
                    </tr>`;
                });
                html += '</table>';
            } else {
                html = '<p>No cars available.</p>';
            }
            document.getElementById('vendorResult').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('vendorResult').innerHTML = 'Error: ' + error;
        });
    });
    </script>

</body>
</html>