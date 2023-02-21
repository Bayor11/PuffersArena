<?php
session_start();
include('connector.php');
//collect data from post. At the very least, A title must be entered. if absent, echo error. if saved echo success saved
// data: {id: currentcomment_id, data: datatopost},
if(empty($_POST['id'])){
    echo '<div class="alert alert-danger">Error encountered, unable to save note.</div>';
    
    exit;
}else{
    $comment_id = $_POST['id'];
//    echo 'success';
}
if(empty($_POST['data'])){
    echo '<div class="alert alert-danger">Error encountered, unable to forward note contents to dB</div>';
    exit;
}else{
    $postt = $_POST['data'];
    foreach ($postt as $key => $value) {
    if ($value['name'] == 'comment') {
        $comment = $value['value']; // value of the 'comment' form field
        $comment = mysqli_real_escape_string($link, $comment);
    }
        if ($value['name'] == 'title') {
        $title = $value['value']; // value of the 'title' form field
             $title = mysqli_real_escape_string($link, $title);
    }
}
    if($title == ""){
        echo '<div class="alert alert-danger">Title field cannot be empty</div>';
        exit;
    }
     if($comment == ""){
        echo '<div class="alert alert-danger">Puff some comments in please.....</div>';
        exit;
    }
}
$time = time();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
//all needed datas fetched, prepare to update dB

//UPDATE table_name
//SET column1 = value1, column2 = value2, ...
//WHERE condition;>>>>>>>>>>>>>>`user_id`, `username`, `title`, `comment`, `time`
$sql = "UPDATE comments SET title='$title', comment='$comment', time='$time' WHERE comment_id='$comment_id' AND user_id='$user_id'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Unable to save user inputs. </div>';
}else{
    echo "success";
}

?>