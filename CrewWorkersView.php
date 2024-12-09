<?php
// Include the database connection
include 'dbConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Crews, Members, and Performance</title>
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
        form {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <header>
        <h1>View Crews, Members, and Performance</h1>
    </header>

    <section>
        <h2>View Crew and Members</h2>
        <table>
            <thead>
                <tr>
                    <th>Crew ID</th>
                    <th>Specialty</th>
                    <th>Crew Size</th>
                    <th>Cost</th>
                    <th>Worker ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all crew members from the database using the crew_members view
                $sql = "SELECT * FROM crew_members";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['CrewID']) . "</td>
                                <td>" . htmlspecialchars($row['CrewSpecialty']) . "</td>
                                <td>" . htmlspecialchars($row['CrewSize']) . "</td>
                                <td>" . htmlspecialchars($row['CrewCost']) . "</td>
                                <td>" . htmlspecialchars($row['WorkerID']) . "</td>
                                <td>" . htmlspecialchars($row['WorkerFirstName']) . "</td>
                                <td>" . htmlspecialchars($row['WorkerLastName']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No crew members found in the database.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>View Crew Performance</h2>
        <table>
            <thead>
                <tr>
                    <th>Crew ID</th>
                    <th>Jobs Handled</th>
                    <th>Total Hours</th>
                    <th>Total Earnings</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch crew performance data from the jobs table
                $sql = "SELECT CrewID, COUNT(JobID) AS JobsHandled, SUM(HoursNeeded) AS TotalHours, SUM(Cost) AS TotalEarnings
                        FROM job
                        GROUP BY CrewID";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['CrewID']) . "</td>
                                <td>" . htmlspecialchars($row['JobsHandled']) . "</td>
                                <td>" . htmlspecialchars($row['TotalHours']) . "</td>
                                <td>" . htmlspecialchars($row['TotalEarnings']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No performance data found for any crew.</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <a href="index.php" style="position: fixed; bottom: 25px; right: 25px;"><button>Home</button></a>
    </footer>
</body>
</html>
