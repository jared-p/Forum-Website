<?php
session_start();
require 'include/db_credentials.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript">
        window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
        </script>
    </head>
    <body>
        <?php
        include 'header.php';
        if (isset($_SESSION['admin'])){
            echo "<h1>Welcome to the Admin portal</h1>";
            

        }else{
            echo "<p>You are not logged in, this page requires admin access.</p>";
            if( isset($_SESSION['previousPage'])){
                $previousPage = $_SESSION['previousPage'];
                echo "<a href='".$previousPage."'>Click here to go to the page you came from.</a>";
            }else{
                echo "<a href='adminLogin.php'>Click here to go to the admin login.</a>";
            }
        }
        ?>

    </body>
</html>
