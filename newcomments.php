<?php
//creates a new row in notes table with empty content but returns the id of the created note.
//    if it run into any error echo error
//
session_start();
include("connector.php");
//collect session datas 
if(empty($_SESSION['user_id'])){
    echo "error";
    exit;
}else{
    $user_id = $_SESSION['user_id'];
}
if(empty($_SESSION['username'])){
    echo "error";
    exit;
}else{
    $username = $_SESSION['username'];
}
$time = time();
//Run query
$sql = "INSERT INTO comments (`user_id`, `username`, `title`, `comment`, `time`) VALUES ('$user_id', '$username', '', '', '$time')";
$result = mysqli_query($link, $sql);
echo mysqli_insert_id($link);



?>