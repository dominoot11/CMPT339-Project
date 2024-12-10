<!-- Markus Blessing -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job View</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse; /* Avoid double borders */
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black; /* Add a border to each cell */
            /*padding: 10px; /* Add padding for better readability */
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
        <h1>Simple Jobs Table</h1>
    </header>
    <section>
        <h2>View Simple Jobs</h2>
        <table>
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Job Stage</th>
                    <th>Start Date</th>
                    <th>Completion Date</th>
                    <th>Due Date</th>
                    <th>Cost</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection
                include 'dbConnection.php';

                // Call the stored procedure to get active jobs
                $sql = SELECT JobID, Address, StartDate, CompletionDate, DueDate, Cost FROM simple_jobs WHERE JobStage NOT IN ('J', 'K');
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['JobID']) . "</td>
                                <td>" . htmlspecialchars($row['Address']) . "</td>
                                <td>" . htmlspecialchars($row['StartDate']) . "</td>
                                <td>" . htmlspecialchars($row['CompletionDate']) . "</td>
                                <td>" . htmlspecialchars($row['DueDate']) . "</td>
                                <td>" . htmlspecialchars($row['Cost']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No active jobs found in the database.</td></tr>";
                }

                // Close the result set and database connection
                $result->close();
                $conn->close();
                ?>            
            </tbody>
        </table>
    </section>
    <a href="index.html" style="position: fixed; bottom: 25px; right: 25px;"><button>Home</button>
</body>
</html>
