<?php
    function checkField($fieldName, $fieldNamePretty)
    {
        $err = null;
        if (array_key_exists($fieldName, $_POST)) {
            if ($_POST[$fieldName] === "") {
                $err = "{$fieldNamePretty} empty";
            }
        } else {
            $err = "{$fieldNamePretty} missing from form";
        }
        return $err;
    }
    //Prints a suitable title string given the error message list
    function printTitle($errors) 
    {
        if (count($errors) == 0) {
            printf("Created post");
        } else {
            printf("Failed to create post");
        }
    }
    //Prints the error list, if it exists
    function printErrors($errors) 
    {
        if (count($errors) > 0) {
            echo "<h3>Errors</h3>";
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>{$error}</li>";
            }
            echo "</ul>";
        }
    }
    $errorMessages = array();
    $fields = array(
        "user" => "Username",
        "post" => "Post"
    );
    //Validate fields
    foreach ($fields as $fieldName => $fieldNamePretty) {
        $err = checkField($fieldName, $fieldNamePretty);
        if ($err != null) {
            $errorMessages[] = $err;
        }
    }
    $my = new mysqli("mysql.eecs.ku.edu",
                     "j674z324",
                     "Aing4ide",
                     "j674z324");
    if ($my->connect_errno) {
        $errorMessages[] = "Failed to connect to database";
    }
    if (count($errorMessages) == 0) {
        $username = $my->escape_string($_POST["user"]);
        $post = $my->escape_string($_POST["post"]);
        $query = "INSERT INTO Posts (content, author_id) VALUES (\"{$post}\", \"{$username}\");";
        if (!$my->query($query) || $my->affected_rows == 0) {
            $errorMessages[] = "Failed to add post to database - could be user invalid";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php printTitle(); ?>
    </title>
</head>
<body>
    <h1><?php printTitle($errorMessages); ?></h1>
        <?php printErrors($errorMessages); ?>
</body>
</html>