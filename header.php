<?php
require 'include/db_credentials.php';
session_start();
$logout = null;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $logout = $_GET["logout"] ?? null;
}
if ($logout == 1 && isset($_SESSION['user'])) {
  $_SESSION['user'] = null;
  header('Location: main.php');
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Navigation</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Syne+Mono&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <link rel="stylesheet" href="css/header.css">
</head>


<body>
  <header>



    <?php
    $user = "";
    if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];
      //echo $user;
    }
    ?>

    <div class="topDivPush">
      <nav>
        <div class="logo">
          <li> <a href="main.php" class="logoheader">
              <h2>My <span>BLOG POST</span> </h2>
            </a> </li>
        </div>
        <ul class="nav_links">
          <li class="center">
            <div class="search">
              <form method="get" action="main.php" class="form">
                <input type="text" name="search post" class="textbox" placeholder=" search posts">
                <select name="topic" id="topic">
                  <?php
                  $topicQry = "SELECT * FROM topic";
                  echo '<option value="all">Choose Topic</option>';
                  $topicResult = $pdo->query($topicQry);
                  while ($topicRow = $topicResult->fetch()) {
                    echo '<option value="' . $topicRow['topicName'] . '">' . $topicRow['topicName'] . '</option>';
                  }
                  ?>
                </select>
                <input type="submit" value="Search" class="btn">
              </form>
            </div>
          </li>
          <?php
          if ($user != "") {
            echo '<li><a href="userAccount.php" class="links">' . $user . '</a></li>';
            echo '<li><a href="main.php?logout=1" class="links">Log out</a></li>';
          ?>
            <li><a href="userAccount.php" class="links">Profile</a>
              <ul>
                <li> <a class="dropdown-item" role="presentation" href="editAccount.php">Edit Profile</a></li>
                <li> <a class="dropdown-item" role="presentation" href="editPosts.php">New Post</a></li>
                <li> <a class="dropdown-item" role="presentation" href="adminLogin.php">Admin</a></li>
                <li> <a class="dropdown-item" role="presentation" href="main.php?logout=1">Log Out</a></li>
              </ul>
            </li>
          <?php
          } else {
            echo '<li><a href="login.php" class="links">Login</a></li>';
            echo '<li><a href="create_account.php" class="links">Sign Up</a></li>';
          ?>
            <li><a href="login.php" class="links">Profile</a>
              <ul>
                <li> <a class="dropdown-item" role="presentation" href="login.php">Edit Profile</a></li>
                <li> <a class="dropdown-item" role="presentation" href="login.php">New Post</a></li>
                <li> <a class="dropdown-item" role="presentation" href="adminLogin.php">Admin</a></li>
                <!-- <li> <a class="dropdown-item" role="presentation" href="main.php?logout=1">Log Out</a></li> -->
              </ul>
            </li>
          <?php
          }
          ?>
          <!-- <li><a href="userAccount.php" class="dropdown-item" role="presentation" href="#">Account</a></li> -->
          <!-- <li> <a class="dropdown-item" role="presentation" href="createComment.php">New Comment</a></li> -->
          <!-- <li> <a class="dropdown-item" role="presentation" href="editComments.php">Edit Comment</a></li> -->


        </ul>

        <div class="sandwich">
          <div class="line1"> </div>
          <div class="line2"> </div>
          <div class="line3"> </div>
        </div>
      </nav>
    </div>
    <script src="js/header.js"></script>
  </header>
  <div class="header2">


  </div>
</body>

</html>