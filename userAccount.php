<?php
require 'include/db_credentials.php';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Main Page</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
    </script>
    <script type="text/javascript" src="js/main.js"></script>

</head>

<body>
    <!-- including the header with the session start -->
    <?php
    include 'header.php';
    ?>
    <div class="main_account">
        <!-- have to link to this after checking session variable user and seeing if they are logged in -->

        <!-- included all teh stuff above to make the doc work -->
        <!-- going to have the same style as main with the same header (reddit does this) -->

        <?php
        // $user = $_SESSION["user"];
        // $user = "this guy";
        //setting up variables
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $test = $_SESSION['user'];

            // 
            //prints out all the session, very useful for testing
            // print_r($_SESSION);
            // 

        ?>
            <!-- checks if the user is logged in, used for testing -->
            <?php
            // if(empty($user)){
            //     echo "thing done";
            // }elseif(empty($test)){
            //     echo "thing not done";
            // }else{
            //     echo "damn dude";
            // }
            // echo $user;
            ?>
            <div class="left_col_account">
                <?php
                $sql = "SELECT * FROM users WHERE username = ?";
                $result = $pdo->prepare($sql);
                $result->execute(array($user));
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    //echo '<img src="data:image/jpeg;base64,' . base64_encode($row['pic']) . '"/>';
                    $user = $row['username'];
                    $fname = $row['firstName'];
                    $lname = $row['lastName'];
                    $email = $row['email'];



                    echo "<div>Username: " . $user . "</div>";
                    echo "<div>First Name: " . $fname . "</div>";
                    echo "<p>Last Name: " . $lname . "</p>";
                    echo "<p>Email: " . $email . "</p>";
                    echo '<p><img src="data:image/jpeg;base64,' . base64_encode($row['pic']) . '" alt="User missing a profile picture"/></p>';
                }
                ?>
                <form action="editAccount.php" method="post">
                    <input type="submit" value="Edit Account">
                </form>
            </div>
            <!-- the column on the right -->
            <div class="right_col_account">
                <!-- the style for the box on the right -->
            <?php
            //getting the posts that the logged in user has using session variable and a query
            $postQry = "SELECT * FROM post WHERE username =? ORDER BY postdate DESC";
            $result0 = $pdo->prepare($postQry);
            $result0->execute(array($user));
            if ($result0->rowCount() != 0) {
                while ($row0 = $result0->fetch()) {
                    //making the post id and body of the posts for the user 
                    echo '<div class="post">';
                    echo '<h3 class="post_title" id="' . $row0['postid'] . '">' . $row0['title'] . '</h3>';
                    $length = strlen($row0['body']);
                    if ($length > 500) {
                        echo '<p class="post_content">' . substr($row0['body'], 0, 500) . '...</p>';
                    } else {
                        echo '<p class="post_content">' . $row0['body'] . '</p>';
                    }
                    // getting the comments count
                    $numComments = 0;
                    $commentQry = "SELECT COUNT(*) FROM comment WHERE postid=" . $row0['postid'];
                    $result1 = $pdo->query($commentQry);
                    while ($row1 = $result1->fetch()) {
                        $numComments = $row1['COUNT(*)'];
                    }
                    // using the comments count for the post info
                    $postdate = date_create($row0['postdate']);
                    echo '<p class="post_information">Comments: ' . $numComments . ', Username: ' . $row0['username'] . ', Posted on: ' . date_format($postdate, 'm/d/Y g:ia') . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<div class="post" id="demo">You have no posts yet! Clicke here to create your first post</div>';
            }
        } else {
            echo "<p>Must be logged in</p>";
            echo "<a href='login.php'>Click here to log in</a>";
        }
        // reseting the PHP Data Object back to null
        $pdo = null;
            ?>

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
    <?php include 'footer.php'; ?>

</body>

</html>