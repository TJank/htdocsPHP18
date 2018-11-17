<?php
require_once('db_connect.php');
// start session
// end session

// test if post or submit
// validate
$errors = [];
if (isset($_POST['submit'])){

    if (!$pilotId) {
        $errors[] = 'Please select a pilot.';
    }

    // TODO:  Add validation errors to the $errors[] array.
    if(!isset($_POST['email'])) {
        $errors[] = 'Please enter an email.';
    }
    if(!isset($_POST['password'])) {
        $errors[] = 'Please enter a password.';
    }
    if(!isset($_POST['confirmPassword'])) {
        $errors[] = 'Please enter a password.';
    }
    if(($_POST['password']) === ($_POST['confirmPassword']) ) {
        $errors[] = 'Password must match confirmation password.';
    }

    if (!count($errors))  {
        // No validation errors occurred.


        // auto generate salt
        $salt = random_bytes(12);

        // TODO: Sanitize the model and registration number fields, just like we did with the pilotId above.
        $model = mysqli_real_escape_string($connection, trim($_POST['model']));
        $registrationNumber = mysqli_real_escape_string($connection, trim($_POST['registrationNumber']));

        // TODO: Write an INSERT SQL statement to add the new aircraft to the database.
        // Ensure that it is assigned to the correct pilot by including the pilotId.
        $sql = "INSERT INTO authentication (pilot_id, registration_number, model) VALUES ('$pilotId', '$registrationNumber', '$model')";

        // TODO: Use mysqli_query to send the SQL query to the MySQL database server.
        $results = mysqli_query($connection, $sql);


        // Redirect to the pilot-detail.php page, for the pilot that we just added the aircraft to.
        header('location: /authentication/login.php');
        die;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentication Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Register</h1>

<!-- TODO: Display validation errors in an unordered list. -->
<?php
if (isset($_POST['submit'])) {
    if (count($errors) > 0) {
        echo "<h2><font color='red'>You have errors!</font></h2><ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
    }
    echo "</ul>";
}

?>

<form method="post">
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input
                type="text"
                class="form-control"
                name="firstName"
                id="firstName"
                value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>"
        >
    </div>

    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input
                type="text"
                name="lastName"
                id="lastName"
                value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>"
        >
    </div>

    <div class="form-group">
        <label for="email">Email Address</label>
        <input
            type="email"
            name="email"
            id="email"
            value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"
        >
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="form-group">
        <label for="email">Confirm Password</label>
        <input type="password" name="confirmPassword" id="confirmPassword">
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>

</body>
</html>

