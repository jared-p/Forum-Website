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
    <?php include 'header.php'; ?>
    <!-- <div id="search-bar">
        <form method="get" action="main.php">
            <label for="search"> For Discussion by Title</label>
            <input type="text" placeholder="Search" name="search" id="search">
            <select name="topic" id="topic">
                <?php
                $topicQry = "SELECT * FROM topic";
                echo '<option value="all">Choose Topic</option>';
                $topicResult = $pdo->query($topicQry);
                while($topicRow = $topicResult->fetch()){
                    echo '<option value="'.$topicRow['topicName'].'">'.$topicRow['topicName'].'</option>';
                }
                ?>
            </select>
            <input type="submit" value="submit">
        </form>
    </div> -->
    <div class="main">
        <div class="left_col">
            <h1 class="left_col_title">Top 3 Topics</h1>
            <?php
            $topQry = "SELECT topicName, count(topicName) from post GROUP BY topicName ORDER BY count(topicName) DESC LIMIT 3";
            $topResult = $pdo->query($topQry);
            while($topRow = $topResult->fetch()){
                echo '<div class = "top_topics">';
                echo "<a href='main.php?topic=".$topRow['topicName']."'>".$topRow['topicName']."</a>";
                echo '</div>';
            }
            ?>
            <h1 class="left_col_title">All Topics</h1>
            <?php
            $topQry = "SELECT DISTINCT topicName from post ORDER BY topicName ASC";
            $topResult = $pdo->query($topQry);
            while($topRow = $topResult->fetch()){
                echo '<div class = "all_topics">';
                echo "<a href='main.php?topic=".$topRow['topicName']."'>".$topRow['topicName']."</a>";
                echo '</div>';
            }
            ?>
        </div>
        <div class="right_col">
            <?php
            $search_input = "";
            $topic_input = "";
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                $search_input = $_GET["search"] ?? "";
                $topic_input = $_GET['topic'] ?? "";
            //}
            $postQry = "";

            if ($search_input != ""){
                if( $topic_input != "" && $topic_input != "all"){
                    $postQry = "SELECT * FROM post WHERE title LIKE ? AND topicName = ? ORDER BY postdate DESC";
                    $result0 = $pdo->prepare($postQry);
                    $result0->execute(array('%'.$search_input.'%', $topic_input));
                }else{
                    $postQry = "SELECT * FROM post WHERE title LIKE ? ORDER BY postdate DESC";
                    $result0 = $pdo->prepare($postQry);
                    $result0->execute(array('%'.$search_input.'%'));
                }
            }else{
                if( $topic_input != "" && $topic_input != "all"){
                    $postQry = "SELECT * FROM post WHERE topicName = ? ORDER BY postdate DESC";
                    $result0 = $pdo->prepare($postQry);
                    $result0->execute(array($topic_input));
                }else{
                    $postQry = "SELECT * FROM post ORDER BY postdate DESC";
                    $result0 = $pdo->prepare($postQry);
                    $result0->execute();
                }
            }
            //echo $postQry;
            //$tstrslt = $pdo->query($postQry);
            //if ($tstrslt->fetch()){
            while ($row0 = $result0->fetch()){
                echo '<div class="post">';
                echo '<h3 class="post_title" id="'.$row0['postid'].'">'.$row0['title'].'</h3>';
                $length = strlen($row0['body']);
                if( $length > 500){
                    echo '<p class="post_content">'.substr($row0['body'],0,500).'...</p>';
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
                echo '<p class="post_information">Comments: '.$numComments.', Username: '.$row0['username'].', Posted on: '.date_format($postdate, 'm/d/Y g:ia').'</p>';
                echo '</div>';
            }
            }else{
                echo "<br>No Search Results Found";
            }


            $pdo = null;
        //}
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
