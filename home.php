<?php
session_start();

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
}else{
    echo "<script> location.href='login.php' </script>";
}


echo "<h1>Hello, " . $username . ".</h1>";

if(isset($_REQUEST['submit'])){
    session_unset();
    session_destroy();
    echo "<script> location.href='login.php' </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body{
            text-align: center;
        }
        h1{
            font-size: 100px;
            text-transform: capitalize;
        }
        button{
            height: 50px;
            width: 100px;
            background-color: lightskyblue;
            color: white;
            font-size: x-large;
            border-radius: 10px;
            font-family: monospace;
        }
        button:hover{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <p>Have a nice day.</p>
    <form action="">
        <button type="submit" name="submit" value="20">LOGOUT</button>
    </form>
</body>
</html>
