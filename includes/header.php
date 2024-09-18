<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram-clone</title>
    <!-- <link rel="stylesheet" href=""> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />

    <link rel="stylesheet" href="Assets/css/style.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <!-- FONTAWESOME.COM KI LINK JO ABHI PRO MEIN HI AVAILABLE HAIN ! -->
</head>

<body>
    <!-- NAVIGATION  -->
    <nav class="navbar">
        <div class="nav-wrapper">
            <img class="brand-img" src="Assets/Images/logo.png" />
            <form action="search_post.php" method="post" class="search-form">
                <input type="text" class="search-box" placeholder="search.." name="search_input" />
            </form>
            <div class="nav-items">
                <a href="index.php" style="color: #000;">
                    <i class="icon fas fa-home"></i></a>

                <a href="discover.php" style="color: #000;">
                    <i class="icon fas fa-plus"></i></a>

                <a href="liked_post.php" style="color: #000;">
                    <i class="icon fas fa-heart"></i></a>

                <div class="icon user-profile">
                    <a href="profile.php" style="color: #000;">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>