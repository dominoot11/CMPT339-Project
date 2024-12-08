<?php
include 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $JobID = $_POST['JobID'];

    $sql = "DELETE FROM job WHERE JobID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $JobID);

    if ($stmt->execute()) {
        // Redirect to JobEdit.php after success
        header("Location: JobEdit.php");
        exit(); // Stop further execution to ensure the redirect works
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
