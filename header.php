<?php
require 'include/db_credentials.php';
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
<nav>
    <div class="logo">
      <li> <a href="main.php" class="logoheader">   <h2>My <span>BLOG POST</span> </h2></a> </li>
</div>
    <ul class="nav_links">
      <li>
        <div class="search">
   <form method="get" action="main.php">
                <input type="text"
                    placeholder=" Search Posts"
                    name="search">
                    <select name="topic" id="topic">
                        <?php
                        $topicQry = "SELECT * FROM topic";
                        echo '<option value="all">Choose Topic</option>';
                        $topicResult = $pdo->query($topicQry);
                        while($topicRow = $topicResult->fetch()){
                            echo '<option value="'.$topicRow['topicName'].'">'.$topicRow['topicName'].'</option>';
                        }
                        ?>
                    </select>
                  <input type="submit" value="submit">
            </form>
        </div>
</li>
      <li><a href="login.php" class="links">Login</a></li>
      <li><a href="#" class="links">About</a></li>
      <li><a href="#"class="links">More</a>
        <ul>
          <li><a class="dropdown-item" role="presentation" href="#">Evenmore</a</li>
          <li><a class="dropdown-item" role="presentation" href="#">More</a></li>
          <li>  <a class="dropdown-item" role="presentation" href="#">About</a></li>
        </ul>
      </li>

    </ul>

    <!-- <div class="search">
            <form action="#">
                <input type="text"
                    placeholder=" Search Posts"
                    name="search">
                <button>
                    <i class="fa fa-search"
                        style="font-size: 18px;">
                    </i>
                </button>
            </form>
        </div> -->


    <div class="sandwich">
      <div class="line1"> </div>
      <div class="line2"> </div>
      <div class="line3"> </div>
    </div>
    </nav>
    <script src="js/header.js" ></script>
  </body>

</html>
