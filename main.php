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
    <?php
    include 'header.php';
    ?>
    <div class="main">
        <div class="left_col">
            <h1 class="left_col_title">Top 3 Topics</h1>
            <?php
            $topQry = "SELECT topicName, count(topicName) from post GROUP BY topicName ORDER BY count(topicName) DESC LIMIT 3";
            $topResult = $pdo->query($topQry);
            while ($topRow = $topResult->fetch()) {
                echo '<div class = "top_topics">';
                echo "<a href='main.php?topic=" . $topRow['topicName'] . "'>" . $topRow['topicName'] . "</a>";
                echo '</div>';
            }
            ?>
            <h1 class="left_col_title">All Topics</h1>
            <?php
            $topQry = "SELECT * from topic ORDER BY topicName ASC";
            $topResult = $pdo->query($topQry);
            while ($topRow = $topResult->fetch()) {
                echo '<div class = "all_topics">';
                echo "<a href='main.php?topic=" . $topRow['topicName'] . "'>" . $topRow['topicName'] . "</a>";
                echo '</div>';
            }
            ?>
        </div>
        <div class="right_col">
            <?php
            $user = "";

            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                $title = "";
                $body = "";
                $topic = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $title = $_POST["title"] ?? "";
                    $body = $_POST["body"] ?? "";
                    $topic = $_POST["topic"] ?? "";
                }
                if ($title != "" && $body != "" && $topic != "") {
                    $sql = "INSERT INTO post (title, body, postdate, topicName, username) VALUES (?, ?, ?, ?, ?)";
                    date_default_timezone_set('America/Los_Angeles');
                    $commentdate = date("Y-m-d H:i:s");
                    $result = $pdo->prepare($sql);
                    $result->execute(array($title, $body, $commentdate, $topic, $user));
                }
            }
            if ($user != "") {
            ?>
                <div id="create_post" class="post">
                    <h3 class="post_title">Create a new post</h3>
                    <form method="post" action="main.php" id="post_form" class="hide">
                        <input type="text" name="title" placeholder="Title" id="post_form_title">
                        <p class="post_content">
                            <label for="body_input">Post content:</label>
                            <br>
                            <textarea name="body" id="post_form_body"></textarea>
                        </p>
                        <select name="topic" id="post_form_topic">
                            <option value="none">Select Topic</option>
                            <?php
                            $topQry = "SELECT DISTINCT topicName from topic ORDER BY topicName ASC";
                            $topResult = $pdo->query($topQry);
                            while ($topRow = $topResult->fetch()) {
                                echo "<option value='" . $topRow['topicName'] . "'>" . $topRow['topicName'] . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        <input type="submit" value="Create Post">
                        <!-- <p class="post_information"># Comments, Author, datetime</p> -->
                    </form>
                </div>
            <?php
            }
            $search_input = "";
            $topic_input = "";
            $postQry = "";
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $search_input = $_GET["search"] ?? "";
                $topic_input = $_GET['topic'] ?? "";
            }
            if ($search_input != "") {
                if ($topic_input != "" && $topic_input != "all") {
                    $postQry = "SELECT * FROM post WHERE title LIKE ? AND topicName = ? ORDER BY postdate DESC";
                    $result0 = $pdo->prepare($postQry);
                    $result0->execute(array('%' . $search_input . '%', $topic_input));
                } else {
                    $postQry = "SELECT * FROM post WHERE title LIKE ? ORDER BY postdate DESC";
                    $result0 = $pdo->prepare($postQry);
                    $result0->execute(array('%' . $search_input . '%'));
                }
            } else {
                if ($topic_input != "" && $topic_input != "all") {
                    $postQry = "SELECT * FROM post WHERE topicName = ? ORDER BY postdate DESC";
                    $result0 = $pdo->prepare($postQry);
                    $result0->execute(array($topic_input));
                } else {
                    $postQry = "SELECT * FROM post ORDER BY postdate DESC";
                    $result0 = $pdo->prepare($postQry);
                    $result0->execute();
                }
            }
            //echo $postQry;
            //$tstrslt = $pdo->query($postQry);
            if ($result0->rowCount() != 0) {
                while ($row0 = $result0->fetch()) {
                    echo '<div class="post">';
                    echo '<h3 class="post_title" id="' . $row0['postid'] . '">' . $row0['title'] . '</h3>';
                    $length = strlen($row0['body']);
                    if ($length > 500) {
                        echo '<p class="post_content">' . substr($row0['body'], 0, 500) . '...</p>';
                    } else {
                        echo '<p class="post_content">' . $row0['body'] . '</p>';
                    }
                    $numComments = 0;
                    $commentQry = "SELECT COUNT(*) FROM comment WHERE postid=" . $row0['postid'];
                    $result1 = $pdo->query($commentQry);
                    while ($row1 = $result1->fetch()) {
                        $numComments = $row1['COUNT(*)'];
                    }
                    $postdate = date_create($row0['postdate']);
                    echo '<p class="post_information">Comments: ' . $numComments . ', Username: ' . $row0['username'] . ', Posted on: ' . date_format($postdate, 'm/d/Y g:ia') . '</p>';
                    echo '</div>';
                }
            } else {
                echo "<br>No Search Results Found";
            }

            $pdo = null;
            //}
            ?>
        </div>

    </div>





</body>
<?php include 'footer.php'; ?>

</html>