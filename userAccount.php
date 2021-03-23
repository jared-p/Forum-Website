<?php
require 'include/db_credentials.php';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Main Page</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
    </script>
    <script type="text/javascript" src="js/main.js"></script>

</head>
    <body>
        <?php 
        include 'header.php'; 
        ?>
    <div class = "main">
        <!-- have to link to this after checking session variable user and seeing if they are logged in -->

        <!-- included all teh stuff above to make the doc work -->
        <!-- going to have the same style as main with the same header (reddit does this) -->

        <div class = "left_col">
            <?php    
            // $user = $_SESSION["user"];
            $user = "this guy";
            $username = $_SESSION['username'];
            $test = $_GET['user'];
            print_r($_SESSION);
            ?>
            <?php if(empty($user)){
                echo "thing done";
            }elseif(empty($test)){
                echo "thing not done";
            }else{
                echo "damn dude";
            }
            ?>
            <h1 class="left_col_title"><?php echo $user;?></h1>
        </div>
        
        <div class = "right_col">
            <div class = "post">
            <h1 class = "right_col_title">Title of the posts they have made</h1>
            <p class = "post_content">some kind of content</p>
            <p class = "post_information">query info relative to user</p>
            </div>
        </div>

    </div>
        <!-- have user info with email etc -->
        <!-- could have the profile with all the user info on the left box to follow main css look -->

        <!-- display current user logged in -->
        <!-- change login button to logout -->


        <!-- reddit uses a secondary header, maybe integrate that -->
        <!-- tab for posts made by user -->
        <!-- maybe see where they commented -->

    </body>
</html>