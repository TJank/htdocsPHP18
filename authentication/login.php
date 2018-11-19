<?php
require_once('db_connect.php');

$errors = [];
if (isset($_POST['submit'])) {

    if(!isset($_POST['email'])) {
        $errors[] = 'Please enter an email.';
    }

    if (!count($errors)) {
        // do sql query by email and password + salt??
        // ask for password
        $flag = false;
        $sql = "SELECT (email, password_salt, salt) FROM authentication WHERE ";
        $results = mysqli_query($connection, $sql);
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


    <button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>

</body>
</html>
