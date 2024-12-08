<!-- Markus Blessing -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Crews</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse; /* Avoid double borders */
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black; /* Add a border to each cell */
            text-align: left; /* Align content to the left */
        }
        th {
            background-color: #f2f2f2; /* Header background color */
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternate row colors */
        }
    </style>
</head>
<body>
    <header>
        <h1>View Crews</h1>
    </header>
    <section>
        <h2>Crew Table</h2>
        <table>
            <thead>
                <tr>
                    <th>Crew ID</th>
                    <th>Specialty</th>
                    <th>Crew Size</th>
                    <th>Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection
                include 'dbConnection.php';

                // Fetch all crews from the database
                $sql = "SELECT crewID, specialty, crewSize, cost FROM crew";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['crewID']) . "</td>
                                <td>" . htmlspecialchars($row['specialty']) . "</td>
                                <td>" . htmlspecialchars($row['crewSize']) . "</td>
                                <td>" . htmlspecialchars($row['cost']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No crews found in the database.</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </section>
    <footer>
        <a href="CrewEdit.php" style="position: fixed; bottom: 25px; right: 25px;"><button>Crew Manager</button></a>
        <a href="index.html" style="position: fixed; bottom: 50px; right: 25px;"><button>Home</button></a>
    </footer>
</body>
</html>
