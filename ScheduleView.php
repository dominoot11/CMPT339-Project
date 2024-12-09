<?php
// Include the database connection (make sure you have a separate connection file or connection settings here)
include('dbConnection.php');

// SQL query to fetch schedule data from the 'schedule' table
$sql = "SELECT * FROM schedule";
$result = $conn->query($sql);

// Start of HTML output
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedules</title>
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
        <h1>Schedule Table</h1>
    </header>
    <section>
        <table>
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Current Week</th>
                    <th>Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any records returned from the query
                if ($result->num_rows > 0) {
                    // Output each row as a table row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['JobID'] . "</td>
                            <td>" . $row['CurrentWeek'] . "</td>
                            <td>" . $row['Sunday'] . "</td>
                            <td>" . $row['Monday'] . "</td>
                            <td>" . $row['Tuesday'] . "</td>
                            <td>" . $row['Wednesday'] . "</td>
                            <td>" . $row['Thursday'] . "</td>
                            <td>" . $row['Friday'] . "</td>
                            <td>" . $row['Saturday'] . "</td>
                        </tr>";
                    }
                } else {
                    // Display a message if no schedules are found
                    echo "<tr><td colspan='9'>No schedules found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    <a href="ScheduleEdit.php" style="position: fixed; bottom: 25px; right: 25px;"><button>Schedule Manager</button></a>
    <a href="index.php" style="position: fixed; bottom: 50px; right: 25px;"><button>Home</button></a>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
