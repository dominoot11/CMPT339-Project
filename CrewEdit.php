<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crew Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Crew Management System</h1>
    </header>

    <!-- Add Crew Section -->
    <section>
        <h2>Add a New Crew</h2>
        <form action="addCrew.php" method="POST">
            <label for="crewID">Crew ID:</label>
            <input type="text" id="crewID" name="crewID" required><br>

            <label for="specialty">Specialty:</label>
            <input type="text" id="specialty" name="specialty" required><br>

            <label for="crewSize">Crew Size:</label>
            <input type="number" id="crewSize" name="crewSize" required><br>

            <label for="cost">Cost:</label>
            <input type="number" id="cost" name="cost" required><br>

            <button type="submit">Add Crew</button>
        </form>
    </section>

    <!-- View and Manage Crew Section -->
    <section>
        <h2>Manage Crew</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Crew ID</th>
                    <th>Specialty</th>
                    <th>Crew Size</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connect to the database
                include 'dbConnection.php';

                $sql = "SELECT * FROM crew";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['crewID']}</td>
                                <td>{$row['specialty']}</td>
                                <td>{$row['crewSize']}</td>
                                <td>{$row['cost']}</td>
                                <td>
                                    <form action='deleteRowCrew.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='crewID' value='{$row['crewID']}'>
                                        <button type='submit'>Delete</button>
                                    </form>
                                    <form action='editRowCrew.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='crewID' value='{$row['crewID']}'>
                                        <button type='submit'>Edit</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No crews available.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </section>

    <!-- Navigation Links -->
    <footer>
    <a href="CrewView.php" style="position: fixed; bottom: 25px; right: 25px;"><button>Crews</button>
    <a href="index.html" style="position: fixed; bottom: 50px; right: 25px;"><button>Home</button>
    </footer>
</body>
</html>



<!-- Markus Blessing 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Crew</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Add Crew</h1>
    </header>
    <section>
        <h2>Add a Crew</h2>
        <form>
            <label for="crewID">Crew ID:</label>
            <input type="text" id="crewID" name="crewID" required><br>
            <label for="specialty">Specialty:</label>
            <input type="text" id="specialty" name="specialty" required><br>
            <label for="crewSize">Crew Size:</label>
            <input type="number" id="crewSize" name="crewSize" required><br>
            <label for="cost">Cost:</label>
            <input type="number" id="cost" name="cost" required><br>
            <button type="submit">Add Crew</button>
        </form>
    </section>
    <a href="CrewView.html" style="position: fixed; bottom: 25px; right: 25px;"><button>Crews</button></a>
        <a href="index.html" style="position: fixed; bottom: 50px; right: 25px;"><button>Home</button>
</body>
</html>
-->

<!-- Markus Blessing 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Crews</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            /* padding: 5px 10px; */
            cursor: pointer;
        }
        .edit, .delete {
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Manage Crews</h1>
    </header>

    <section>
        <h2>Add a Crew</h2>
        <form id="crewForm">
            <label for="crewID">Crew ID:</label>
            <input type="text" id="crewID" name="crewID" required><br>
            <label for="specialty">Specialty:</label>
            <input type="text" id="specialty" name="specialty" required><br>
            <label for="crewSize">Crew Size:</label>
            <input type="number" id="crewSize" name="crewSize" required><br>
            <label for="cost">Cost:</label>
            <input type="number" id="cost" name="cost" required><br>
            <button type="submit">Add Crew</button>
        </form>
    </section>

    <section>
        <h2>Crew List</h2>
        <table id="crewTable">
            <thead>
                <tr>
                    <th>Crew ID</th>
                    <th>Specialty</th>
                    <th>Crew Size</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                 Dynamic Rows Will Be Added Here 
            </tbody>
        </table>
    </section>

    <script>
        // Form and table elements
        const crewForm = document.getElementById('crewForm');
        const crewTable = document.getElementById('crewTable').querySelector('tbody');

        // Handle form submission to add a new crew
        crewForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission refresh

            // Get form values
            const crewID = document.getElementById('crewID').value;
            const specialty = document.getElementById('specialty').value;
            const crewSize = document.getElementById('crewSize').value;
            const cost = document.getElementById('cost').value;

            // Add a new row to the table
            const row = crewTable.insertRow();
            row.innerHTML = `
                <td>${crewID}</td>
                <td>${specialty}</td>
                <td>${crewSize}</td>
                <td>${cost}</td>
                <td>
                    <button class="edit" onclick="editCrew(this)">Edit</button>
                    <button class="delete" onclick="deleteCrew(this)">Delete</button>
                </td>
            `;

            // Clear form fields
            crewForm.reset();
        });

        // Function to delete a crew
        function deleteCrew(button) {
            const row = button.parentElement.parentElement; // Get the row of the clicked button
            row.remove(); // Remove the row
        }

        // Function to edit a crew
        function editCrew(button) {
            const row = button.parentElement.parentElement; // Get the row of the clicked button
            const cells = row.querySelectorAll('td');

            // Populate form fields with current row data
            document.getElementById('crewID').value = cells[0].textContent;
            document.getElementById('specialty').value = cells[1].textContent;
            document.getElementById('crewSize').value = cells[2].textContent;
            document.getElementById('cost').value = cells[3].textContent;

            // Remove the row to replace it with updated data upon form submission
            row.remove();
        }
    </script>
        <a href="CrewView.html" style="position: fixed; bottom: 25px; right: 25px;"><button>Crews</button></a>
        <a href="index.html" style="position: fixed; bottom: 50px; right: 25px;"><button>Home</button></a>
</body>
</html>
-->