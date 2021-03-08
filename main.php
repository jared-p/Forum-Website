<?php
include 'include/db_credentials.php';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Main Page</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <header>
        <!-- This is the main navigation-->
        I am though Header
    </header>
    <div id="search-bar">
        <form method="get">
            <label for="search">Search For Discussion by Name</label>
            <input type="text" placeholder="Search" name="search" id="search">
            <input type="submit" value="submit">
        </form>
    </div>
    <div class="main">
        <div class="left_col">
            <h1 class="left_col_title">Hot Topics</h1>
            <ul>
                <li>Hot Topic</li>
                <li>Hot Topic</li>
                <li>Hot Topic</li>
                <li>Hot Topic</li>
            </ul>
            <h1 class="left_col_title">Topics</h1>
            <ul>
                <li>Topic</li>
                <li>Topic</li>
                <li>Topic</li>
                <li>Topic</li>
            </ul>
        </div>
        <div class="right_col">
            <?php

                $sql = "SELECT * FROM post";
	        if ($result = sqlsrv_query($con, $sql, array())){
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    echo $row['title'];
                    echo '<h3 class="post_title">'.$row['title'].'</h3>';
                    echo '<p class="post_content">'.$row['content'].'</p>';
                    $username = "Error";
                    $query = "SELECT username from user where username = '".$row['username']."'";
                    $rslt = sqlsrv_query($con, $query, array());
                    while( $row1 = sqlsrv_fetch_array( $rslt, SQLSRV_FETCH_ASSOC)){
                        $username = $row1['username'];
                    }
                    $numcomments = 0;
                    $query = "SELECT count(*) from comment where postid = '".$row['postid']."'";
                    $rslt = sqlsrv_query($con, $query, array());
                    while( $row1 = sqlsrv_fetch_array( $rslt, SQLSRV_FETCH_ASSOC)){
                        $numcomments ++;
                    }
                    echo '<p class="post_information">'.$numComments.', '.$username.', '.$row['postdate'].'</p>';
                }
            }


            ?>
            <div class="post">
                <h3 class="post_title">Forum Title</h3>
                <p class="post_content">These are the words that I speak</p>
                <p class="post_information"># Comments, Author, datetime</p>
            </div>
            <div class="post">
                <h3 class="post_title">Forum Title</h3>
                <p class="post_content">These are the words that I speak</p>
                <p class="post_information"># Comments, Author, datetime</p>
            </div>
            <div class="post">
                <h3 class="post_title">Forum Title</h3>
                <p class="post_content">These are the words that I speak</p>
                <p class="post_information"># Comments, Author, datetime</p>
            </div>
        </div>

    </div>





</body>

</html>