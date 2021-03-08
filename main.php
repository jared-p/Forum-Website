<?php
require 'include/db_credentials.php';
include 'include/header.php';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Main Page</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
</head>


<body>
    <div id="search-bar">
        <form method="get" action="main.php">
            <label for="search">Search For Discussion by Name</label>
            <input type="text" placeholder="Search" name="search" id="search">
            <input type="submit" value="submit">
        </form>
    </div>
    <div class="main">
        <div class="left_col">
            <h1 class="left_col_title">Top 3 Topics</h1>
            <?php
            $topQry = "SELECT topicName, count(topicName) from post GROUP BY topicName ORDER BY count(topicName) DESC LIMIT 3";
            $topResult = $pdo->query($topQry);
            while($topRow = $topResult->fetch()){
                echo '<div class = "top_topics">';
                echo $topRow['topicName'];
                echo '</div>';
            }
            ?>    
            <h1 class="left_col_title">All Topics</h1>
            <?php
            $topQry = "SELECT DISTINCT topicName from post ORDER BY topicName ASC";
            $topResult = $pdo->query($topQry);
            while($topRow = $topResult->fetch()){
                echo '<div class = "top_topics">';
                echo $topRow['topicName'];
                echo '</div>';
            }
            ?>
        </div>
        <div class="right_col">
            <?php

            $postQry = "SELECT * FROM post order by postdate desc"; //Can change if want to "order by" (comments, date, length etc)
            $result0 = $pdo->query($postQry);
            while ($row0 = $result0->fetch()){
                echo '<div class="post">';
                echo '<h3 class="post_title">'.$row0['title'].'</h3>';
                $length = strlen($row0['body']);
                if( $length > 100){
                    echo '<p class="post_content">'.substr($row0['body'],0,200).'...</p>';
                }else{
                    echo '<p class="post_content">'.$row0['body'].'</p>';
                }
                $numComments = 0;
                $commentQry = "SELECT COUNT(*) FROM comment WHERE postid=".$row0['postid'];
                $result1 = $pdo->query($commentQry);
                while ($row1 = $result1->fetch()){
                    $numComments = $row1['COUNT(*)'];
                }
                $postdate = date_create($row0['postdate']);
                echo '<p class="post_information">Comments: '.$numComments.', Username: '.$row0['username'].', Posted on: '.date_format($postdate, 'g:ia m/d/Y').'</p>';
                echo '</div>';
            }
            

            $pdo = null;

            ?>
            <div class="post">
                <h3 class="post_title">Forum Title</h3>
                <p class="post_content">These are the words that I speak</p>
                <p class="post_information"># Comments, Author, datetime</p>
            </div>
        </div>

    </div>





</body>

</html>