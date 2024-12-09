<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Client Schedules</title>
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
        .button-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Client Schedule Table</h1>
    </header>

    <section>
        <!-- Filter Form for ClientID -->
        <form method="POST" action="">
            <label for="clientID">Enter Client ID:</label>
            <input type="text" id="clientID" name="clientID" placeholder="Enter Client ID" value="<?php echo isset($_POST['clientID']) ? htmlspecialchars($_POST['clientID']) : ''; ?>">
            <button type="submit">Filter</button>
        </form>

        <!-- Clear Filter Button -->
        <div class="button-container">
            <form method="POST" action="">
                <button type="submit" name="clear" value="true">Clear Filter</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Job Site</th>
                    <th>Job Stage</th>
                    <th>Current Week</th>
                    <th>Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Client ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection
                include 'dbConnection.php';

                // Default SQL query for fetching all client schedules
                $sql = "SELECT JobID, JobSite, JobStage, CurrentWeek, Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, ClientID 
                        FROM client_schedule";

                // Check if the form is submitted and Client ID is provided
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['clientID']) && !isset($_POST['clear'])) {
                    $clientID = $_POST['clientID'];
                    $sql .= " WHERE ClientID = ?";
                }

                // Prepare the SQL statement
                $stmt = $conn->prepare($sql);

                // If a Client ID was provided, bind the parameter
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['clientID']) && !isset($_POST['clear'])) {
                    $stmt->bind_param("s", $clientID); // 's' for string
                }

                // Execute the query
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['JobID']) . "</td>
                                <td>" . htmlspecialchars($row['JobSite']) . "</td>
                                <td>" . htmlspecialchars($row['JobStage']) . "</td>
                                <td>" . htmlspecialchars($row['CurrentWeek']) . "</td>
                                <td>" . htmlspecialchars($row['Sunday']) . "</td>
                                <td>" . htmlspecialchars($row['Monday']) . "</td>
                                <td>" . htmlspecialchars($row['Tuesday']) . "</td>
                                <td>" . htmlspecialchars($row['Wednesday']) . "</td>
                                <td>" . htmlspecialchars($row['Thursday']) . "</td>
                                <td>" . htmlspecialchars($row['Friday']) . "</td>
                                <td>" . htmlspecialchars($row['Saturday']) . "</td>
                                <td>" . htmlspecialchars($row['ClientID']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No schedule data found for this client.</td></tr>";
                }

                // Close the statement and the connection
                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
    </section>

    <footer>
        <a href="index.html" style="position: fixed; bottom: 25px; right: 25px;"><button>Home</button></a>
    </footer>
</body>
</html>
