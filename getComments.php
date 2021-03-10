<?php
require 'include/db_credentials.php';
$postid = "not working";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $postid = $_POST['postid'] ?? "broken";
}
//will select all comments from the post and format in JSON for the js to parse
$qry = "SELECT * FROM comment WHERE postid=".$postid;
//echo $qry;
$array = array();
$result = $pdo->query($qry);
while($row = $result->fetch()){
    $comment = array("commentid"=>$row["commentid"],"body"=>$row["body"],"username"=>$row["username"],"parentid"=>$row["parentid"]); 
    array_push($array,$comment);    
}
echo json_encode($array);

//echo "\n".$postid;



?>