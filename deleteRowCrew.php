<?php
include 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crewID = $_POST['crewID'];

    $sql = "DELETE FROM crew WHERE crewID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $crewID);

    if ($stmt->execute()) {
        // Redirect to CrewEdit.php after success
        header("Location: CrewEdit.php");
        exit(); // Stop further execution to ensure the redirect works
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
