<?php
include 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crewID = $_POST['crewID'];
    $specialty = $_POST['specialty'];
    $crewSize = $_POST['crewSize'];
    $cost = $_POST['cost'];

    $sql = "UPDATE crew SET specialty = ?, crewSize = ?, cost = ? WHERE crewID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdis", $specialty, $crewSize, $cost, $crewID);

    if ($stmt->execute()) {
        // Redirect to CrewEdit.php after successful update
        header("Location: CrewEdit.php");
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
