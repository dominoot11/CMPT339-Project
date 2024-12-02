<?php
function fetchAndDisplayTable($tableName, $columns) {
    $host = 'localhost'; // Replace with your host
    $user = 'root'; // Replace with your username
    $password = ''; // Replace with your password
    $dbname = 'TradesFlow'; // Replace with your database name

    try {
        // Create a PDO connection
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $conn = new PDO($dsn, $user, $password);

        // Set error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Generate the SQL query
        $columnList = implode(", ", $columns);
        $sql = "SELECT $columnList FROM $tableName";
        $result = $conn->prepare($sql);

        $stmt->execute();

        // Fetch and display data
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                foreach ($columns as $col) {
                    echo "<td>" . htmlspecialchars($row[$col]) . "</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='" . count($columns) . "'>No data found</td></tr>";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
