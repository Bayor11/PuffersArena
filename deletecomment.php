<?php
session_start();
include("connector.php");
//get data from AJAX and session variables

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
if(empty($_POST['ID'])){
    echo "error";
    exit;
}else{
    $comment_id = $_POST['ID'];
}
//Datas fetched, run deletion query
$sql = "DELETE FROM comments WHERE comment_id='$comment_id' AND user_id='$user_id'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "<p>Comment can't be found</p>";
    exit;
}else{
    $affct = mysqli_affected_rows($link);
    if($affct != 1){
        echo "<p>ERROR; Comment can't be found in our database.</p>";
    exit;
    }else{
        echo "success";
    }
}


?>