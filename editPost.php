<?php
require 'include/db_credentials.php';
$postid = "";
$title = "";
$body = "";
$topic = "";
$delete = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postid = $_POST['postid'] ?? "";
    $title = $_POST['title'] ?? "";
    $topic = $_POST['topic'] ?? "";
    $body = $_POST['body'] ?? "";
    $delete = $_POST['delete'] ?? "";
}
if ($delete != "") {
    $sql = "DELETE FROM post WHERE postid=?";
    $deleterslt = $pdo->prepare($sql);
    $deleterslt->execute(array($postid));
    echo "<a href='admin.php'>PostId does not exist, click here to return to the admin portal</a>";
} else {
    if ($topic != "" && $body != "" && $title != "") {
        if ($topic == "unchanged") {
            $sql = "UPDATE post set title=?, body=? WHERE postid=?";
            $updaterslt = $pdo->prepare($sql);
            $updaterslt->execute(array(trim($title), trim($body), $postid));
        } else {
            $sql = "UPDATE post set title=?, body=?, topicName=? WHERE postid=?";
            $updaterslt = $pdo->prepare($sql);
            $updaterslt->execute(array(trim($title), trim($body), trim($topic), $postid));
        }
    }
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/admin.css">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript">
            window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
        </script>
        <script type="text/javascript" src="js/edit_comments.js"></script>
        <script type="text/javascript" src="js/edit_post.js"></script>
    </head>

    <body>
        <?php
        include 'header.php';
        if (isset($_SESSION['admin'])) {
            $rslt = $pdo->prepare("SELECT * FROM post WHERE postid=?");
            $rslt->execute(array($postid));
            if ($rslt->rowCount() != 0) {
                while ($rw = $rslt->fetch()) {
                    echo "<div class='post main_wrapper' id='" . $postid . "'>";
                    $title = $rw['title'];
                    $body = $rw['body'];
                    $topicName = $rw['topicName'];
        ?>
                    <form action="editPost.php" method="post" id="post_form">
                        <textarea name="title" id='post_form_title' class="title_editor"><?php echo $title; ?></textarea>
                        <br>
                        <textarea name="body" id='post_form_body' class="body_editor"><?php echo $body; ?></textarea>
                        <br>
                        <select name="topic" id="post_form_topic">
                            <option value="unchanged">Don't Change</option>
                            <?php
                            $result = $pdo->prepare("SELECT * FROM topic");
                            $result->execute();
                            while ($row = $result->fetch()) {
                                echo "<option value='" . $row['topicName'] . "'>" . $row["topicName"] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" value="Update Posting">
                        <input type="hidden" name="postid" value="<?php echo $rw['postid']; ?>">
                    </form>
                    <br>
                    <form action="editPost.php" method="post">
                        <input type="submit" value="Delete Posting">
                        <input type="hidden" name="delete" value="1">
                        <input type="hidden" name="postid" value="<?php echo $rw['postid']; ?>">
                    </form>
    <?php
                    echo "</div>";
                    echo '<div id="comments">';
                    echo '</div>';
                    //add comments which can be edited 
                    /*
                    $sql = "SELECT * FROM comment WHERE postid=?";
                    $result = $pdo->prepare($sql);
                    $result->execute(array($postid));
                    if ($result->rowCount() != 0) {
                        while ($rw = $result->fetch()) {
                        }
                    } else {
                        echo "<p>This post has no comments</p>";
                    }
                    */
                }


                echo "<a href='admin.php'>Click here to return to the admin portal</a>";
            } else {
                echo "<a href='admin.php'>PostId does not exist, click here to return to the admin portal</a>";
            }
        } else {
            echo "<p>You are not logged in, this page requires admin access.</p>";
            if (isset($_SESSION['previousPage'])) {
                $previousPage = $_SESSION['previousPage'];
                echo "<a href='" . $previousPage . "'>Click here to go to the page you came from.</a>";
            } else {
                echo "<a href='adminLogin.php'>Click here to go to the admin login.</a>";
            }
        }
    }
    ?>
    <?php include 'footer.php'; ?>
    </body>

    </html>