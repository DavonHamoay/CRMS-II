<?php
// fetch_towns.php
include('config.php');

// Fetch towns from the database
$sql = "SELECT id, dTown FROM towns ORDER BY dTown";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output each town as an option
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['dTown']) . "</option>";
    }
} else {
    echo "<option value=''>No towns available</option>";
}
?>
