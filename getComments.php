<?php
require 'include/db_credentials.php';
$postid = "not working";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $postid = $_POST['postid'] ?? "broken";
}
//will select all comments from the post and format in JSON for the js to parse
$qry = "SELECT * FROM comment WHERE postid=?";
//echo $qry;
$result = $pdo->prepare($qry);
$result->execute(array($postid));
$array = array();
while($row = $result->fetch()){
    $date = date_create($row["commentdate"]);
    $datetime = date_format($date, 'm/d/Y g:ia');
    $comment = array("commentid"=>$row["commentid"],"body"=>$row["body"],"username"=>$row["username"],"parentid"=>$row["parentid"], "commentdate"=>$datetime); 
    array_push($array,$comment);    
}
echo json_encode($array);

//echo "\n".$postid;



?>