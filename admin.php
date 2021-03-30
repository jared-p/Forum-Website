<?php
require 'include/db_credentials.php';
$uname = "";
$disable = "";
$name = "";
$email = "";
$post = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['username'] ?? "";
    $disable = $_POST['disable'] ?? "";
    $name = $_POST['name'] ?? "";
    $email = $_POST['email'] ?? "";
    $post = $_POST['post'] ?? "";
}
if ($uname != "") {
    $updateQry = $pdo->prepare("UPDATE users SET disable=? WHERE username=?");
    $updateQry->execute(array($disable, $uname));
}
if ($name != "" && $email != "" && $post != "") {
    $userQry = "SELECT * FROM users JOIN post ON users.username = post.username where users.username LIKE ? AND users.email LIKE ? AND post.title LIKE ? GROUP BY users.username";
    $result = $pdo->prepare($userQry);
    $result->execute(array('%' . $name . '%', '%' . $email . '%', '%' . $post . '%'));
} elseif ($name != "" && $email != "" && $post == "") {
    $userQry = "SELECT * FROM users JOIN post ON users.username = post.username where users.username LIKE ? AND users.email LIKE ? GROUP BY users.username";
    $result = $pdo->prepare($userQry);
    $result->execute(array('%' . $name . '%', '%' . $email . '%'));
} elseif ($name != "" && $email == "" && $post != "") {
    $userQry = "SELECT * FROM users JOIN post ON users.username = post.username where users.username LIKE ? AND post.title LIKE ? GROUP BY users.username";
    $result = $pdo->prepare($userQry);
    $result->execute(array('%' . $name . '%', '%' . $post . '%'));
} elseif ($name != "" && $email == "" && $post == "") {
    $userQry = "SELECT * FROM users JOIN post ON users.username = post.username where users.username LIKE ? GROUP BY users.username";
    $result = $pdo->prepare($userQry);
    $result->execute(array('%' . $name . '%'));
} elseif ($name == "" && $email != "" && $post != "") {
    $userQry = "SELECT * FROM users JOIN post ON users.username = post.username where users.email LIKE ? AND post.title LIKE ? GROUP BY users.username";
    $result = $pdo->prepare($userQry);
    $result->execute(array('%' . $email . '%', '%' . $post . '%'));
} elseif ($name == "" && $email != "" && $post == "") {
    $userQry = "SELECT * FROM users JOIN post ON users.username = post.username where users.email LIKE ? GROUP BY users.username";
    $result = $pdo->prepare($userQry);
    $result->execute(array('%' . $email . '%'));
} elseif ($name == "" && $email == "" && $post != "") {
    $userQry = "SELECT * FROM users JOIN post ON users.username = post.username where post.title LIKE ? GROUP BY users.username";
    $result = $pdo->prepare($userQry);
    $result->execute(array('%' . $post . '%'));
} elseif ($name == "" && $email == "" && $post == "") {
    $userQry = "SELECT * FROM users JOIN post ON users.username = post.username GROUP BY users.username";
    $result = $pdo->prepare($userQry);
    $result->execute();
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
</head>

<body>
    <?php
    include 'header.php';
    if (isset($_SESSION['admin'])) {
    ?>
        <form action="admin.php" method="post">
            <fieldset>
                <legend>Search For User</legend>
                <label for="name">User Name:</label>
                <input type="text" id="name" name="name">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email">
                <label for="post">Post:</label>
                <input type="text" id="post" name="post">
                <input type="submit" value="Filter">
            </fieldset>
        </form>

        <?php
        //Displays all users with a button that allows you to delete a given user
        echo "<h1>Welcome to the Admin portal</h1>";
        echo "<div id='user_fixed_height'>";
        echo "<div id='user_grid'>";
        echo "<div class='user_heading'>Username</div>";
        echo "<div class='user_heading'>First Name</div>";
        echo "<div class='user_heading'>Last Name</div>";
        echo "<div class='user_heading'>Email Address</div>";
        echo "<div></div>";

        if ($result->rowCount() != 0) {
            while ($row = $result->fetch()) {
                $uname = $row["username"];
                $fname = $row["firstName"];
                $lname = $row["lastName"];
                $email = $row["email"];
                echo "<div class='user_item'>" . $uname . "</div>";
                echo "<div class='user_item'>" . $fname . "</div>";
                echo "<div class='user_item'>" . $lname . "</div>";
                echo "<div class='user_item'>" . $email . "</div>";
                echo "<div class='user_item'>";

                $submit_name = ($row["disable"] == 1) ? "Enable User" : "Disable User";
                $submit_value = ($row["disable"] == 1) ? 0 : 1;
        ?>
                <form action="admin.php" method="post">
                    <input type="submit" value="<?php echo $submit_name; ?>">
                    <input type="hidden" name="username" value="<?php echo $uname; ?>">
                    <input type="hidden" name="disable" value="<?php echo $submit_value; ?>">
                </form>
                <?php
                echo "</div>";
                $postQry = "SELECT * FROM post WHERE username = ?";
                $rslt = $pdo->prepare($postQry);
                $rslt->execute(array($uname));
                if ($rslt->rowCount() != 0) {
                    echo "<div></div>";
                    echo "<div class='post_heading'>Title</div>";
                    echo "<div class='post_heading'>Topic</div>";
                    echo "<div class='post_heading'>Post Date</div>";
                    echo "<div></div>";
                    while ($rw = $rslt->fetch()) {
                        echo "<div></div>";
                        echo "<div class='post_item'>" . $rw['title'] . "</div>";
                        echo "<div class='post_item'>" . $rw['topicName'] . "</div>";
                        $postdate = date_create($rw['postdate']);
                        echo "<div class='post_item'>" . date_format($postdate, 'm/d/Y g:ia') . "</div>";
                        echo "<div>";
                ?>
                        <form action="editPost.php" method="post" class="action">
                            <input type="submit" value="Edit Posting">
                            <input type="hidden" name="postid" value="<?php echo $rw['postid']; ?>">
                        </form>
    <?php
                        echo "</div>";
                    }
                }
            }
        } else {
            echo "<p>No users!</p>";
        }
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p>You are not logged in, this page requires admin access.</p>";
        if (isset($_SESSION['previousPage'])) {
            $previousPage = $_SESSION['previousPage'];
            echo "<a href='" . $previousPage . "'>Click here to go to the page you came from.</a>";
        } else {
            echo "<a href='adminLogin.php'>Click here to go to the admin login.</a>";
        }
    }
    include 'footer.php';
    ?>

</body>

</html>