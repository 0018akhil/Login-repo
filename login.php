<?php

$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_base = "test";

try {
    $conn = mysqli_connect($db_server, $db_username, $db_password, $db_base);
    // echo "Connected";
} catch (Exception $e) {
    echo "error in database";
}

function check($conn)
{
    $sel = "SELECT * FROM form;";
    $result = mysqli_query($conn, $sel);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['email'] == $_REQUEST['email']) {
                return true;
            }
        }
    } else {
        return false;
    }
}

function pass($conn)
{
    $sel = "SELECT * FROM form;";
    $result = mysqli_query($conn, $sel);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($_REQUEST['password'], $row['password'])) {
                return true;
            }
        }
    } else {
        return false;
    }
}

if (isset($_POST['submit'])) {


    if (($_REQUEST['email'] == "") || ($_REQUEST['password'] == "")) {
        echo "All fields are required";
    } else {
        if (check($conn)) {

            if (pass($conn)) {
                $stmt = "SELECT name FROM form WHERE email ='" . $_REQUEST['email']. "';";
                $res = mysqli_query($conn, $stmt);
                $out = mysqli_fetch_assoc($res);
                session_start();
                $_SESSION['username'] = $out['name'];
                header("Location:home.php");
            } else {
                echo "Password is wrong";
            }
        } else {
            echo "No such user";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylesign.css">
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="emailid">
                <label class="label" for="email">Email</label>
                <input class="input" type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="pass">
                <label class="label" for="password">Password</label>
                <input class="input" type="password" name="password" id="password" placeholder="Password">
            </div>
            <input class="submit" name="submit" type="submit" value="LogIn">
        </form>
    </div>
    <div class="login">
        Don't have an account<a href="./signup.php">SignUp</a>
    </div>
</body>

</html>