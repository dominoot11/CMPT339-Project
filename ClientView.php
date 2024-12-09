<?php

//shubham verma

// Include the database connection (ensure this file connects to your MySQL database)
include('dbConnection.php');

// SQL query to fetch all client records
$sql = "SELECT * FROM client";
$result = $conn->query($sql);

// Start of HTML output
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client View</title>
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
        <h1>Clients Table</h1>
    </header>
    <section>
        <h2>View Clients</h2>
        <table>
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Zip Code</th>
                    <th>Province</th>
                    <th>Country</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any records returned from the query
                if ($result->num_rows > 0) {
                    // Output each row as a table row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row['ClientID'] . "</td>
                            <td>" . $row['FirstName'] . "</td>
                            <td>" . $row['LastName'] . "</td>
                            <td>" . $row['PhoneNumber'] . "</td>
                            <td>" . $row['Email'] . "</td>
                            <td>" . $row['Address'] . "</td>
                            <td>" . $row['City'] . "</td>
                            <td>" . $row['ZipCode'] . "</td>
                            <td>" . $row['Province'] . "</td>
                            <td>" . $row['Country'] . "</td>
                            <td>" . $row['DateOfBirth'] . "</td>
                            <td>" . $row['Gender'] . "</td>
                        </tr>";
                    }
                } else {
                    // Display a message if no clients are found
                    echo "<tr><td colspan='12'>No clients found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    <a href="ClientEdit.php" style="position: fixed; bottom: 25px; right: 25px;"><button>Client Manager</button></a>
    <a href="index.php" style="position: fixed; bottom: 50px; right: 25px;"><button>Home</button></a>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
