<?php
include 'dbConnection.php';

if (isset($_GET['JobID'])) {
    $JobID = $_GET['JobID'];

    $sql = "SELECT * FROM job WHERE JobID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $JobID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<form action='updateRowJob.php' method='POST'>
                
                <input type='hidden' name='JobID' value='{$row['JobID']}'>

                <label for='JobStage'>Job Stage:</label>
                <input type='text' id='JobStage' name='JobStage' value='{$row['JobStage']}' required><br>

                <label for='JobStageDescription'>Job Stage Description:</label>
                <input type='text' id='JobStageDescription' name='JobStageDescription' value='{$row['JobStageDescription']}' required><br>

                <label for='JobType'>Job Type:</label>
                <input type='text' id='JobType' name='JobType' value='{$row['JobType']}' required><br>

                <label for='JobSite'>Job Site:</label>
                <input type='text' id='JobSite' name='JobSite' value='{$row['JobSite']}' required><br>

                <label for='CrewID'>Crew ID:</label>
                <input type='text' id='CrewID' name='CrewID' value='{$row['CrewID']}' required><br>

                <label for='HoursNeeded'>Hours Needed:</label>
                <input type='number' id='HoursNeeded' name='HoursNeeded' value='{$row['HoursNeeded']}' required><br>

                <label for='StartDate'>Start Date:</label>
                <input type='text' id='StartDate' name='StartDate' value='{$row['StartDate']}' required><br>

                <label for='CompletionDate'>Completion Date:</label>
                <input type='text' id='CompletionDate' name='CompletionDate' value='{$row['CompletionDate']}' required><br>

                <label for='DueDate'>Due Date:</label>
                <input type='text' id='DueDate' name='DueDate' value='{$row['DueDate']}' required><br>

                <label for='Cost'>Cost:</label>
                <input type='number' id='Cost' name='Cost' value='{$row['Cost']}' required><br>

                <label for='Address'>Address:</label>
                <input type='text' id='Address' name='Address' value='{$row['Address']}' required><br>

                <button type='submit'>Update</button>
              </form>";
    } else {
        echo "Job not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
