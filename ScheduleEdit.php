<!-- Markus Blessing -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Schedule</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Schedule Management</h1>
    </header>
    <section>
        <h2>Add or Edit Schedule</h2>
        <form>
            <label for="jobID">Job ID:</label>
            <input type="text" id="jobID" name="jobID" required><br>
            <label for="currentWeek">Current Week:</label>
            <input type="date" id="currentWeek" name="currentWeek" required><br>
            <label for="sunday">Sunday:</label>
            <input type="text" id="sunday" name="sunday"><br>
            <label for="monday">Monday:</label>
            <input type="text" id="monday" name="monday"><br>
            <label for="tuesday">Tuesday:</label>
            <input type="text" id="tuesday" name="tuesday"><br>
            <label for="wednesday">Wednesday:</label>
            <input type="text" id="wednesday" name="wednesday"><br>
            <label for="thursday">Thursday:</label>
            <input type="text" id="thursday" name="thursday"><br>
            <label for="friday">Friday:</label>
            <input type="text" id="friday" name="friday"><br>
            <label for="saturday">Saturday:</label>
            <input type="text" id="saturday" name="saturday"><br>
            <button type="submit">Add Schedule</button>
        </form>
    </section>
        <a href="ScheduleView.html" style="position: fixed; bottom: 25px; right: 25px;"><button>Schedule</button></a>
        <a href="index.html" style="position: fixed; bottom: 50px; right: 25px;"><button>Home</button>
</body>
</html>
