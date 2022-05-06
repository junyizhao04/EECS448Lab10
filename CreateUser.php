<?php
    $err = null;
    if (array_key_exists("user", $_POST)) {
        if ($_POST["user"] === "") {
            $err = "Username empty";
        }
    } else {
        $err = "Username missing from form";
    }
    $my = new mysqli("mysql.eecs.ku.edu",
                     "j674z324",
                     "Aing4ide",
                     "j674z324");
    if ($my->connect_errno) {
        $err = "Failed to connect to SQL server";
    }
    if ($err === null) {
        $username = $my->escape_string($_POST["user"]);
        $query = "INSERT INTO Users (user_id) VALUES (\"{$username}\");";
        if (!$my->query($query)) {
            $err = "Failed to add user to SQL server - could be username used";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php
            if ($err === null) {
                printf("Created user");
            } else {
                printf("Failed to create user");
            }
        ?>
    </title>
    <style>
        body {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>
        <?php
            if ($err === null) {
                printf("Created user");
            } else {
                printf("Failed to create user");
            }
        ?>
    </h1>
    <?php
        if ($err != null) {
            printf("<strong>The error was: </strong>%s<br/>", $err);
        }
    ?>
</body>
</html>