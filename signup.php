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
    if(mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['email'] == $_REQUEST['email']) {
                return true;
            }
        }
    }
    else{
        return false;
    }
}

    

if (isset($_POST['submit'])) {


    if (($_REQUEST['email'] == "") || ($_REQUEST['password'] == "") || ($_REQUEST['name'] == "")) {
        echo "All fields are required";
    } elseif ($_REQUEST['password'] != $_REQUEST['confirm_password']) {
        echo "Password should match";
    } else {
        $password = password_hash($_REQUEST['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO form (email, password, name) VALUES (?, ?, ?);";

        $email = $_REQUEST['email'];
        $pass = $password;
        $name = $_REQUEST['name'];

        if (check($conn)) {
            echo "user already exists";
        } else {

            $sus = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($sus ,"sss", $email, $pass, $name);
            if (mysqli_stmt_execute($sus)) {
                echo "Successfully SignedUp";
            }else{
                echo "something went wrong";
            }
        }
    }
    
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="username">
                <label class="label" for="name">Name</label>
                <input class="input" type="text" name="name" id="name" placeholder="Name">
            </div>
            <div class="emailid">
                <label class="label" for="email">Email</label>
                <input class="input" type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="pass">
                <label class="label" for="password">Password</label>
                <input class="input" type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="con_pass">
                <label class="label" for="name">Confirm Password</label>
                <input class="input" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password">
            </div>
            <input class="submit" name="submit" type="submit" value="Sign Up">
        </form>
    </div>
    <div class="login">
        Already have an account?<a href="./login.php">Login</a>
    </div>
</body>
</html>