<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Worker Management System</h1>
    </header>

    <!-- Add/Edit Worker Section -->
    <section>
        <h2>Add or Edit a Worker</h2>
        <form action="addWorker.php" method="POST">
            <label for="WorkerID">Worker ID:</label>
            <input type="text" id="WorkerID" name="WorkerID" required><br>

            <label for="FirstName">First Name:</label>
            <input type="text" id="FirstName" name="FirstName" required><br>

            <label for="LastName">Last Name:</label>
            <input type="text" id="LastName" name="LastName" required><br>

            <label for="Specialty">Specialty:</label>
            <input type="text" id="Specialty" name="Specialty" required><br>

            <label for="CrewID">Crew ID:</label>
            <input type="text" id="CrewID" name="CrewID" required><br>

            <button type="submit">Add Worker</button>
        </form>
    </section>

    <!-- View and Manage Workers Section -->
    <section>
        <h2>Manage Workers</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Worker ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Specialty</th>
                    <th>Crew ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to the database
                include 'dbConnection.php';

                $sql = "SELECT * FROM worker";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['workerID']}</td>
                                <td>{$row['firstName']}</td>
                                <td>{$row['lastName']}</td>
                                <td>{$row['specialty']}</td>
                                <td>{$row['crewID']}</td>
                                <td>
                                    <form action='deleteRowWorker.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='workerID' value='{$row['workerID']}'>
                                        <button type='submit'>Delete</button>
                                    </form>
                                    <form action='editRowWorker.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='workerID' value='{$row['workerID']}'>
                                        <button type='submit'>Edit</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No workers available.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </section>

    <!-- Navigation Links -->
    <footer>
        <a href="WorkerView.php" style="position: fixed; bottom: 25px; right: 25px;"><button>Workers</button></a>
        <a href="index.html" style="position: fixed; bottom: 50px; right: 25px;"><button>Home</button></a>
    </footer>
</body>
</html>
