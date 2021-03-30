<?php
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
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
    </script>
    <script type="text/javascript" src="js/edit_comments.js"></script>
</head>

<body>
    <?php
    include 'header.php';
    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user'];
        $commentid = "";
        $body = "";
        $postid = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $commentid = $_POST['commentid'] ?? "";
            $body = $_POST['body'] ?? "";
            $postid = $_POST['postid'] ?? "";
        }
        if ($body != "") {
            if ($commentid != "null") {
                $sql = "INSERT INTO comment (body, postid, username, parentid, commentdate) VALUES (?, ?, ?, ?, ?)";
                $insertrslt = $pdo->prepare($sql);
                date_default_timezone_set('America/Los_Angeles');
                $commentdate = date("Y-m-d H:i:s");
                $insertrslt->execute(array(trim($body), $postid, $username, $commentid, $commentdate));
            } else {
                $sql = "INSERT INTO comment (body, postid, username, parentid, commentdate) VALUES (?, ?, ?, ?, ?)";
                $insertrslt = $pdo->prepare($sql);
                date_default_timezone_set('America/Los_Angeles');
                $commentdate = date("Y-m-d H:i:s");
                $insertrslt->execute(array(trim($body), $postid, $username, null, $commentdate));
            }
            header("Location: posting.php?id=" . $postid);
            echo "<a href='posting.php?id=" . $postid . "'>Comment has been added, click to return to post</a>";
        } else {
    ?>
            <div class="main_wrapper">
                <form action="createComment.php" method="post" id="comment_form">
                    <textarea name="body" cols="30" rows="6" id="comment_form_body"></textarea>
                    <input type="submit" value="Add Comment">
                    <input type="hidden" name="commentid" value="<?php echo $commentid; ?>">
                    <input type="hidden" name="postid" value="<?php echo $postid; ?>">
                </form>
            </div>
    <?php
        }
    } else {
        echo "<p>You are not logged in, this page requires login access.</p>";
        if (isset($_SESSION['previousPage'])) {
            $previousPage = $_SESSION['previousPage'];
            echo "<a href='" . $previousPage . "'>Click here to go to the page you came from.</a>";
        } else {
            echo "<a href='login.php'>Click here to go to the login.</a>";
        }
    }
    include 'footer.php';
    ?>

</body>

</html>