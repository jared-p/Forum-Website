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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
    </script>
</head>

<body>
    <?php
    include 'header.php';
    if (!isset($_SESSION['admin'])) {
        // $previousPage = $_SERVER['HTTP_REFERER'];
        // if ($previousPage != "http://localhost/cosc360-team10/adminLogin.php")
        //     $_SESSION['previousPage'] = $previousPage;
    ?>
        <form method="post" action="adminLogin.php">
            <!-- Change to POST -->
            <fieldset id="login_form">
                <legend>Admin Login</legend>
                <input type="text" name="username" placeholder="Admin Username" id=username>
                <br>
                <input type="password" name="password" placeholder="Password" id=password>
                <br>
                <input type="submit" value="Submit" id="submit">
                <input type="reset" value="Reset" id="reset">
            </fieldset>
        </form>
    <?php
        $uname = "";
        $pass = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uname = $_POST["username"] ?? "failed";
            $pass = $_POST['password'] ?? "failed";
        }
        //echo $uname ." ". $pass;
        if ($uname != "" && $uname != "failed" && $pass != "" && $pass != "failed") {
            $qry = $pdo->prepare('SELECT * FROM admin WHERE username=? AND pass=?');
            $qry->execute(array($uname, $pass));
            //echo $result = $qry->fetchAll();
            if ($qry->fetchAll()) {
                $_SESSION['admin'] = $uname;
                // if (isset($_SESSION['previousPage'])) {
                //     $previousPage = $_SESSION['previousPage'];
                //     header("Location: " . $previousPage . "");
                // }
                //header("Location: admin.php");
                echo "<a href='admin.php'>Click here to proceed to admin portal</a>";
            } else {
                echo "<p>Invalid Login</p>";
            }
        }
    } else {
        // echo "<p>You are already logged in</p>";
        // if (isset($_SESSION['previousPage'])) {
        //     $previousPage = $_SESSION['previousPage'];
        //     echo "<p>You will be redirected to your last page in 3 seconds</p>";
        //     header("refresh:3; url=" . $previousPage);
        //     echo "<a href='" . $previousPage . "'>If not click here</a>";
        // }
        //header("Location: admin.php");
        echo "<a href='admin.php'>Click here to proceed to admin portal</a>";
    }
    include 'footer.php';
    ?>

</body>

</html>