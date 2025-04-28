<?php
require_once "config.php";

$sql_query = "SELECT t.id, t.dTown, 
                     SUM(r.dOwned) AS dog_count, 
                     SUM(r.dVacc) AS vaccinated_count
              FROM towns t
              LEFT JOIN tblreg r ON r.dTownID = t.id
              GROUP BY t.id, t.dTown";

if ($result = $conn->query($sql_query)) {
    while ($row = $result->fetch_assoc()) {
        $townId = $row['id'];
        $townName = htmlspecialchars($row['dTown']);
        $dogCount = $row['dog_count'];
        $vaccinatedCount = $row['vaccinated_count'];
        $vaccinationRate = ($dogCount > 0) ? round(($vaccinatedCount / $dogCount) * 100, 2) : 0;

        echo "<tr>
                <td>{$townName}</td>
                <td>{$dogCount}</td>
                <td>{$vaccinatedCount}</td>
                <td>{$vaccinationRate}%</td>
                <td><a href='edit_town.php?id={$townId}' class='btn btn-warning btn-sm'>Edit</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No records found</td></tr>";
}
?>
