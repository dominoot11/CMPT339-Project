<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $JobID = $_POST['JobID'];
    header("Location: editFormJob.php?JobID=$JobID");
    exit();
}
?>
