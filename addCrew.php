<?php
// Include the database connection file
include 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the POST request
    $crewID = $_POST['crewID'];
    $specialty = $_POST['specialty'];
    $crewSize = $_POST['crewSize'];
    $cost = $_POST['cost'];

    // Prepare the SQL statement to insert data into the 'crew' table
    $sql = "INSERT INTO crew (crewID, specialty, crewSize, cost) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters (string, string, integer, integer)
    $stmt->bind_param("ssii", $crewID, $specialty, $crewSize, $cost);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        // Redirect to CrewEdit.php after success
        header("Location: CrewEdit.php");
        exit(); // Stop further execution to ensure the redirect works
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
