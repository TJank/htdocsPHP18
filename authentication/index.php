<?php
// test cookie / session id

// do a sql retrieval of the name based on session id
require_once('db_connect.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentication Index Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>You are now on the Information Superhighway</h2>
    <?php if($loggedIn) : ?>
        <?= "Hello, " . $name; ?>
        <a href="/authentication/login.php">Logout</a>
    <?php else : ?>
        <a href="/authentication/login.php">Login</a>
        <a href="/authentication/register.php">Register</a>
    <?php endif; ?>
</body>
</html>