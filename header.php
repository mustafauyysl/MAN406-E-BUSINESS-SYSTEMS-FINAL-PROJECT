<?php
ob_start();
session_start();
include "./settings/connection.php";
$query = $db->prepare("SELECT * FROM users where user_email=:user_email");
$query->execute(array(
    'user_email' => $_SESSION['user_email']
));
$isUser = $query->rowCount();
$getUser = $query->fetch(PDO::FETCH_ASSOC);
$isExistUser = $isUser == 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Götür - Groceries in Minutes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4c3398">
        <div class="container">
            <a class="navbar-brand" href="#" style="color: #ffd300; font-weight: 700;">götür</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <?php
                    if ($isExistUser) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">
                                <i class="fas fa-user"></i> Login
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">
                                <i class="fas fa-user-plus mr-1"></i> Register</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-shopping-cart mr-1"></i> Cart
                                <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="logout.php">
                                <i class="fas fa-sign-out-alt mr-1"></i> Çıkış Yap
                                <span class="sr-only">(current)</span></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>