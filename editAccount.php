<?php
require 'include/db_credentials.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
    </script>
</head>

<body>
    <?php
    include 'header.php';
    if (isset($_SESSION['user'])) {
        $session_uname = $_SESSION['user'];
        $uname = "";
        $fname = "";
        $lname = "";
        $email = "";
        $pass = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uname = $_POST["uname"] ?? "";
            $lname = $_POST["lname"] ?? "";
            $fname = $_POST["fname"] ?? "";
            $email = $_POST["email"] ?? "";
            $pass = $_POST["pass"] ?? "";
        }
        //echo $uname . ", " . $fname . ", " . $lname . ", " . $email . ", " . $pass;
        if ($uname != "") {
            if (strlen($uname) > 0 && strlen($uname) <= 15) {
                $sql = "SELECT * FROM users WHERE username=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($uname));
                if ($rslt->rowCount() == 0) {
                    $sql = "UPDATE users SET username=? WHERE username=?";
                    $rslt = $pdo->prepare($sql);
                    $rslt->execute(array($uname, $session_uname));
                    $_SESSION["user"] = $uname;
                }
            }
        }
        if ($fname != "") {
            if (strlen($fname) > 0 && strlen($fname) <= 20) {
                $sql = "UPDATE users SET firstName=? WHERE username=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($fname, $session_uname));
            }
        }
        if ($lname != "") {
            if (strlen($lname) > 0 && strlen($lname) <= 20) {
                $sql = "UPDATE users SET lastName=? WHERE username=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($lname, $session_uname));
            }
        }
        if ($email != "") {
            if (strlen($email) > 0 && strlen($email) <= 320 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT * FROM users WHERE email=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($email));
                if ($rslt->rowCount() == 0) {
                    $sql = "UPDATE users SET email=? WHERE username=?";
                    $rslt = $pdo->prepare($sql);
                    $rslt->execute(array($email, $session_uname));
                }
            }
        }
        if ($pass != "") {
            if (strlen($pass) > 0 && strlen($pass) <= 30) {
                $sql = "UPDATE users SET pass=? WHERE username=?";
                $rslt = $pdo->prepare($sql);
                $rslt->execute(array($pass, $session_uname));
            }
        }
        $sql = "SELECT * FROM users WHERE username=?";
        $rslt = $pdo->prepare($sql);
        $rslt->execute(array($session_uname));
        while ($row = $rslt->fetch()) {
            $uname = $row['username'];
            $fname = $row['firstName'];
            $lname = $row['lastName'];
            $email = $row['email'];
            $pass = $row['pass'];
        }
    ?>
        <form action="editAccount.php" method="post" class="main_wrapper_editAccount">
            <label for="uname">Username: </label>
            <textarea name="uname" id="uname" cols="30" rows="1"><?php echo $uname; ?></textarea>
            <br>
            <label for="fname">First Name: </label>
            <textarea name="fname" id="fname" cols="30" rows="1"><?php echo $fname; ?></textarea>
            <br>
            <label for="lname">Last Name: </label>
            <textarea name="lname" id="lname" cols="30" rows="1"><?php echo $lname; ?></textarea>
            <br>
            <label for="email">Email: </label>
            <textarea name="email" id="email" cols="30" rows="1"><?php echo $email; ?></textarea>
            <br>
            <label for="pass">Password: </label>
            <textarea name="pass" id="pass" cols="30" rows="1"><?php echo $pass; ?></textarea>
            <input type="submit" value="Update Account">
        </form>
    <?php
    } else {
        echo "<a href='login.php'>Must be logged in to edit account, click here to login</a>";
    }
    include 'footer.php';
    ?>
</body>

</html>