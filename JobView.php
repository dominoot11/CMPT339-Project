<!-- Markus Blessing -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job View</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse; /* Avoid double borders */
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black; /* Add a border to each cell */
            /*padding: 10px; /* Add padding for better readability */
            text-align: left; /* Align content to the left */
        }
        th {
            background-color: #f2f2f2; /* Header background color */
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternate row colors */
        }
    </style>
</head>
<body>
    <header>
        <h1>Jobs Table</h1>
    </header>
    <section>
        <h2>View Jobs</h2>
        <table>
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Job Stage</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Site</th>
                    <th>Crew ID</th>
                    <th>Hours</th>
                    <th>Start Date</th>
                    <th>Completion Date</th>
                    <th>Due Date</th>
                    <th>Cost</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <!-- info for jobs will go here -->
            </tbody>
        </table>
    </section>
    <a href="JobEdit.php" style="position: fixed; bottom: 25px; right: 25px;"><button>Job Manager</button></a>
    <a href="index.html" style="position: fixed; bottom: 50px; right: 25px;"><button>Home</button>
</body>
</html>
