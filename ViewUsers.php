<?php
    $errorMessages = array();
    $my = new mysqli("mysql.eecs.ku.edu",
                     "j674z324",
                     "Aing4ide",
                     "j674z324");
    if ($my->connect_errno) {
        $errorMessages[] = "Couldn't connect to 2px;";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Users</title>
    <style>
    table {
        border-collapse: collapse;
    }
    td {
        border: 1px dashed black;
    }
    th {
        border: 2px solid black;
    }
    </style>
</head>
<body>
<table>
    <thead>
        <tr>
            <th>Users</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT user_id FROM Users;";
            if ($results = $my->query($query)) {
                while ($result = $results->fetch_assoc()) {
                    echo "<tr><td>{$result["user_id"]}</td></tr>";
                }
                $results->free();
            }
        ?>
    </tbody>
</table>
<a href="AdminHome.html">Back to Admin Home</a>
</body>
</html>