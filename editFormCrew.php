<?php
include 'dbConnection.php';

if (isset($_GET['crewID'])) {
    $crewID = $_GET['crewID'];

    $sql = "SELECT * FROM crew WHERE crewID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $crewID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo "<form action='updateRowCrew.php' method='POST'>
                <input type='hidden' name='crewID' value='{$row['crewID']}'>
                <label for='specialty'>Specialty:</label>
                <input type='text' id='specialty' name='specialty' value='{$row['specialty']}' required><br>
                <label for='crewSize'>Crew Size:</label>
                <input type='number' id='crewSize' name='crewSize' value='{$row['crewSize']}' required><br>
                <label for='cost'>Cost:</label>
                <input type='number' id='cost' name='cost' value='{$row['cost']}' required><br>
                <button type='submit'>Update</button>
              </form>";
    } else {
        echo "Crew not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
