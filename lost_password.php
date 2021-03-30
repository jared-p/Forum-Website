<?php
require 'include/db_credentials.php';
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
    </script>
</head>

<body>
    <?php
    include 'header.php';

    if (isset($_SESSION['user'])) {
        echo "<a href='main.php'>You are already logged in, click to return to the main page</a>";
    } else {
        $email = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'] ?? "";
        }
        if ($email != "") {
            $qry = "SELECT * FROM users WHERE email=?";
            $rslt = $pdo->prepare($qry);
            $rslt->execute(array($email));
            if ($rslt->rowCount() != 0) {
                while ($row = $rslt->fetch()) {
                    $subj = "Password Reset Request";
                    $pass = generateRandomString();
                    $txt = "Reset Password request, sign in using your new information\nUsername: " . $row['username'] . "\nPassword: " . $pass;
                    $update = "UPDATE users SET pass=? WHERE email=?";
                    $result = $pdo->prepare($update);
                    $result->execute(array($pass, $email));
                }
                mail($email, $subj, $txt);
                echo "Email sent, check your inbox for your new login information";
                echo "<br>";
                echo "<a href='login.php'>Click here to go to the login page</a>";
            } else {
                echo "<p>This email is not associated with an account</p>";

    ?>
                <form action="lost_password.php" method="post">
                    <label for="email">Enter your email below and a new password will be sent to your accounts email</label>
                    <br>
                    <input type="email" id="email" name="email" placeholder="Enter Email Here">
                    <input type="submit" value="Submit">
                </form>

            <?php
            }
        } else {
            ?>
            <form action="lost_password.php" method="post">
                <label for="email">Enter your email below and a new password will be sent to your accounts email</label>
                <br>
                <input type="email" id="email" name="email" placeholder="Enter Email Here">
                <input type="submit" value="Submit">
            </form>
    <?php
        }
    }

    ?>
    <?php include 'footer.php'; ?>
</body>

</html>