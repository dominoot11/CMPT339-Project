<?php
include 'dbConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $JobID = $_POST['JobID'];
    $JobStage = $_POST['JobStage'];
    $JobStageDescription = $_POST['JobStageDescription'];
    $JobType = $_POST['JobType'];
    $JobSite = $_POST['JobSite'];
    $CrewID = $_POST['CrewID'];
    $HoursNeeded = $_POST['HoursNeeded'];
    $StartDate = $_POST['StartDate'];
    $CompletionDate = $_POST['CompletionDate'];
    $DueDate = $_POST['DueDate'];
    $Cost = $_POST['Cost'];
    $Address = $_POST['Address'];
    $ClientID = $_POST['ClientID'];

    $sql = "UPDATE job SET JobStage = ?, JobStageDescription = ?, JobType = ?, JobSite = ?, CrewID = ?, 
                            HoursNeeded = ?, StartDate = ?, CompletionDate = ?, DueDate = ?, Cost = ?, Address = ?, ClientID = ? WHERE JobID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssisssiss", $JobID, $JobStage, $JobStageDescription, $JobType, $JobSite, $CrewID, $HoursNeeded, 
                                            $StartDate, $CompletionDate, $DueDate, $Cost, $Address, $ClientID);

    if ($stmt->execute()) {
        // Redirect to JobEdit.php after successful update
        header("Location: JobEdit.php");
        exit(); // Ensure no further code is executed
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
