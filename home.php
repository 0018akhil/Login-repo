<?php
session_start();
$username = $_SESSION['username'];
echo "<h1>Hello, " . $username . ".</h1>";
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
    </style>
</head>
<body>
    <p>Have a nice day.</p>
</body>
</html>