<?php
// Include the database connection file
include 'dbConnection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the POST request
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


    // Prepare the SQL statement to insert data into the 'job' table
    $sql = "INSERT INTO job (JobID, JobStage, JobStageDescription, JobType, JobSite, CrewID, HoursNeeded, 
                            StartDate, CompletionDate, DueDate, Cost, Address, ClientID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters (string, string, string, string, string, string, int, date, date, date, int, string, string)
    $stmt->bind_param("ssssssdsssdss", $JobID, $JobStage, $JobStageDescription, $JobType, $JobSite, $CrewID, $HoursNeeded, 
                                            $StartDate, $CompletionDate, $DueDate, $Cost, $Address, $ClientID);

    // Execute the statement and check if it was successful
    if ($stmt->execute()) {
        // Redirect to JobEdit.php after success
        header("Location: JobEdit.php");
        exit(); // Stop further execution to ensure the redirect works
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
