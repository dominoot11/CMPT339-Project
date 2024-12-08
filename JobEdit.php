<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Job Management System</h1>
    </header>

    <!-- Add/Edit Job Section -->
    <section>
        <h2>Add or Edit a Job</h2>
        <form action="addJob.php" method="POST">
                
        <label for="JobID">Job ID:</label>
            <input type="text" id="JobID" name="JobID" required><br>

            <label for="JobStage">Job Stage:</label>
            <input type="text" id="JobStage" name="JobStage" required><br>

            <label for="JobStageDescription">Job Stage Description:</label>
            <input type="text" id="JobStageDescription" name="JobStageDescription" required><br>

            <label for="JobType">Job Type:</label>
            <input type="text" id="JobType" name="JobType" required><br>

            <label for="JobSite">Job Site:</label>
            <input type="text" id="JobSite" name="JobSite" required><br>

            <label for="CrewID">Crew ID:</label>
            <input type="text" id="CrewID" name="CrewID"><br>

            <label for="HoursNeeded">Hours Needed:</label>
            <input type="number" id="HoursNeeded" name="HoursNeeded"><br>

            <label for="StartDate">Start Date:</label>
            <input type="text" id="StartDate" name="StartDate"><br>

            <label for="CompletionDate">Completion Date:</label>
            <input type="text" id="CompletionDate" name="CompletionDate"><br>

            <label for="DueDate">Due Date:</label>
            <input type="text" id="DueDate" name="DueDate"><br>

            <label for="Cost">Cost:</label>
            <input type="number" id="Cost" name="Cost"><br>

            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address"><br>

        <button type="submit">Add Job</button>
        </form>
    </section>

    <!-- View and Manage Jobs Section -->
    <section>
        <h2>Manage Jobs</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Job Stage</th>
                    <th>Job Site Description</th>
                    <th>Job Type</th>
                    <th>Job Site</th>
                    <th>Crew ID</th>
                    <th>Hours Needed</th>
                    <th>Start Date</th>
                    <th>Completion Date</th>
                    <th>Due Date</th>
                    <th>Cost</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to the database
                include 'dbConnection.php';

                $sql = "SELECT * FROM job";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['JobID']}</td>
                                <td>{$row['JobStage']}</td>
                                <td>{$row['JobStageDescription']}</td>
                                <td>{$row['JobType']}</td>
                                <td>{$row['JobSite']}</td>
                                <td>{$row['CrewID']}</td>
                                <td>{$row['HoursNeeded']}</td>
                                <td>{$row['StartDate']}</td>
                                <td>{$row['CompletionDate']}</td>
                                <td>{$row['DueDate']}</td>
                                <td>{$row['Cost']}</td>
                                <td>{$row['Address']}</td>
                                <td>
                                    <form action='deleteRowJob.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='JobID' value='{$row['JobID']}'>
                                        <button type='submit'>Delete</button>
                                    </form>
                                    <form action='editRowJob.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='JobID' value='{$row['JobID']}'>
                                        <button type='submit'>Edit</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='13'>No jobs available.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </section>

    <!-- Navigation Links -->
    <footer>
        <a href="JobView.php" style="position: fixed; top: 25px; right: 25px;"><button>Jobs</button></a>
        <a href="index.html" style="position: fixed; top: 50px; right: 25px;"><button>Home</button></a>
    </footer>
</body>
</html>