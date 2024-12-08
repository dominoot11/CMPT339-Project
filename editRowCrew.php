<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $crewID = $_POST['crewID'];
    header("Location: editFormCrew.php?crewID=$crewID");
    exit();
}
?>
