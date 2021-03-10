<?php
require 'include/db_credentials.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="css/main.css">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        window.jQuery || document.write('<script src=“js/jquery-3.1.1.min.js”><\/script>');
    </script>
    <script type="text/javascript" src="js/posting.js"></script>
  </head>
  <body>
  <?php
  include 'include/header.php';
  //dynamically create the postings putting the postid as the div id and filling with the text
  //name etc, js will do the rest 
  $topic_input = "";
  if($_SERVER["REQUEST_METHOD"] == "GET"){
    $topic_input = $_GET["id"] ?? "none";
  }
  if( $topic_input != "" && $topic_input != "none"){
    $qry = "SELECT * FROM post WHERE postid=".$topic_input;
    $result = $pdo->query($qry);
    while($row = $result->fetch()){
      echo '<div id="'.$row['postid'].'" class="post">';
      echo '<h3 class="post_title">'.$row['title'].'</h3>';
      echo '<p class="post_content">'.$row['body'].'</p>';
      $postdate = date_create($row['postdate']);
      echo '<p class="post_information">Username: '.$row['username'].', Posted on: '.date_format($postdate, 'm/d/Y g:ia').'</p>';
      //echo '</div>';
    }
  }
  echo '<div id="comments">';
  echo '</div>';
  echo '</div>';
  ?>
  </body>
</html>