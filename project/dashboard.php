<?php
    include('config/DB_config.php');

    // Start Session
    session_start();

    // Redirect if user not logged in
    if(!isset($_SESSION['loggedIn'])) {
        echo "<script>window.location.href='index.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard | ReadWise</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <section><?php require ('layout/header.php'); ?></section>
        <?php
            echo $_SESSION['user_email'];

            if(isset($_SESSION['user'])) {
                echo "<h1>Hi ".($_SESSION['user'] === 'admin' ? 'Admin' : 'User')."</h1>";
            }
        ?>
        <?php
            require ('layout/footer.php');
        ?>
    </body>
</html>