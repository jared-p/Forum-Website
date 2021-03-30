<?php
require 'include/db_credentials.php';
$commentid = "";
$body = "";
$delete = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $commentid = $_POST['commentid'] ?? "";
    $body = $_POST['body'] ?? "";
    $delete = $_POST['delete'] ?? "";
}
if ($delete != "") {
    $sql = "DELETE FROM comment WHERE commentid=?";
    $deleterslt = $pdo->prepare($sql);
    $deleterslt->execute(array($commentid));
    echo "<a href='admin.php'>commentid does not exist, click here to return to the admin portal</a>";
} else {
    if ($body != "") {
        $sql = "UPDATE comment set body=? WHERE commentid=?";
        $updaterslt = $pdo->prepare($sql);
        $updaterslt->execute(array(trim($body), $commentid));
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
    </head>

    <body>
        <?php
        include 'header.php';
        if (isset($_SESSION['admin'])) {
            $rslt = $pdo->prepare("SELECT * FROM comment WHERE commentid=?");
            $rslt->execute(array($commentid));
            if ($rslt->rowCount() != 0) {
                while ($rw = $rslt->fetch()) {
                    echo "<div class='main_wrapper'>";
                    $body = $rw['body'];
        ?>
                    <form action="editComments.php" method="post" id="comment_form">
                        <textarea name="body" class='body_editor' id="comment_form_body"><?php echo $body; ?></textarea>

                        <input type="submit" value="Update Comment">
                        <input type="hidden" name="commentid" value="<?php echo $rw['commentid']; ?>">
                    </form>
                    <br>
                    <form action="editComments.php" method="post">
                        <input type="submit" value="Delete Comment">
                        <input type="hidden" name="delete" value="1">
                        <input type="hidden" name="commentid" value="<?php echo $rw['commentid']; ?>">
                    </form>
                    <br>
    <?php
                }


                echo "<a href='admin.php'>Click here to return to the admin portal</a>";
            } else {
                echo "<a href='admin.php'>commentid does not exist, click here to return to the admin portal</a>";
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
    </div>
    <?php include 'footer.php'; ?>
    </body>

    </html>