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
  $user = "";
  if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  }
  if ($user != "") {
    echo '<script type="text/javascript" src="js/user_posting.js"></script>';
  } else {
    echo '<script type="text/javascript" src="js/posting.js"></script>';
  }

  //dynamically create the postings putting the postid as the div id and filling with the text
  //name etc, js will do the rest
  $postid = "";
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $postid = $_GET["id"] ?? "none";
  }
  if ($postid != "" && $postid != "none") {
    $postQry = "SELECT * FROM post WHERE postid=?";
    $result = $pdo->prepare($postQry);
    $result->execute(array($postid));
    if ($result->rowCount() != 0) {
      while ($row = $result->fetch()) {
        echo '<div id="' . $row['postid'] . '" class="post">';
        echo '<h3 class="post_title">' . $row['title'] . '</h3>';
        echo '<p class="post_content">' . $row['body'] . '</p>';
        $postdate = date_create($row['postdate']);
        echo '<p class="post_information">Username: ' . $row['username'] . ', Posted on: ' . date_format($postdate, 'm/d/Y g:ia') . '</p>';
        //echo '</div>';
        echo '<div id="comments">';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo "<p>No postings match this id</p>";
    }
  } else {
    echo "<p>Invalid post request</p>";
    echo "<a href='main.php'>Click to return to postings</a>";
  }
  include 'footer.php';
  ?>
</body>

</html>