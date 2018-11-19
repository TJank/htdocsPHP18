<?php
require_once('db_connect.php');
// start session
// end session

// test if post or submit
// validate
$errors = [];
if (isset($_POST['submit'])){

    if(!isset($_POST['firstName'])) {
        $errors[] = 'Please enter a first name.';
    }
    if(!isset($_POST['lastName'])) {
        $errors[] = 'Please enter last name.';
    }
    if(!isset($_POST['email'])) {
        $errors[] = 'Please enter an email.';
    }
    if(!isset($_POST['password'])) {
        $errors[] = 'Please enter a password.';
    }
    if(!isset($_POST['confirmPassword'])) {
        $errors[] = 'Please enter a password.';
    }
    if(!(($_POST['password']) == ($_POST['confirmPassword']))) {
        $errors[] = 'Password must match confirmation password.';
    }

    if (!count($errors))  {
        // No validation errors occurred.


        // auto generate salt
        $salt = random_bytes(12);
        // sanitize input
        $firstName = mysqli_real_escape_string($connection, trim($_POST['firstName']));
        $lastName = mysqli_real_escape_string($connection, trim($_POST['lastName']));
        $email = mysqli_real_escape_string($connection, trim($_POST['email']));
        $password = mysqli_real_escape_string($connection, trim($_POST['password']));

        // create sql statement
        $sql = "INSERT INTO users (user_id, first_name, last_name, email, password, salt) 
                VALUES ('$firstName', '$lastName', '$email', '$password' , '$salt')";

        // insert to authentication table
        $results = mysqli_query($connection, $sql);
        var_dump($results);
        // if success -> redirect
        if($results) {
            header('location: /authentication/login.php');
            die;
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentication Registration Page</title>
</head>
<body>
<h1>Register</h1>
<?php
// show errors:
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
        <input type="password" name="password" id="password"
               value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
    </div>

    <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" id="confirmPassword"
               value="<?php if (isset($_POST['confirmPassword'])) echo $_POST['confirmPassword']; ?>">
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>

</body>
</html>

