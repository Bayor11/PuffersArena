<?php
include("connector.php");
//   "<form action='".$webserverbaselink."emailrst2.php' method='post' >
//        <input type='hidden' name='record_id' value='".$record_id."'>
//        <input type='hidden' name='newtime' value='".$newtime."'>
//        <input type='submit' value='Verify my new email address'></form>";
//        //message footer
////    Then finally, design for final change. to check if new time is still valid, 24hrs and also if status is turbo. if condition is satisfied, extract username and user_id. Update users table with new email where userdetails matches and echo success message or error as applicable
if(empty($_POST["record_id"])){
    header("location:index.php");
}else{
    $record_id = $_POST["record_id"];
}
if(empty($_POST["newtime"])){
     header("location:index.php");
}else{
    $currentttime = time();
    $record_time = $_POST["newtime"];
    if($record_time < $currentttime){
             echo "<div style='color: white; margin: auto; width: 80%; background: red; margin-top: 20%; text-align: center;'>Activation link has expired. You had 24hrs before it's expiration</button></div>";
        exit;
    }
  
}
//datas present

//check if submitted email can be found in users table;
$sql = "SELECT * FROM resetemail WHERE id='$record_id' AND newtime='$record_time'";
$result = mysqli_query($link, $sql);
if(!$result){
    header("location:index.php");
    exit;
}
$coutn = mysqli_num_rows($result);
if($coutn != 1){
    header("location:index.php");
    exit;
}else{
    //match found
     $firstfetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username = $firstfetch["username"];
    $user_id = $firstfetch["user_id"];
    //fetch new email too
    $newemail = $firstfetch["newemail"];
    $status = $firstfetch["status"];
    if($status == "finished"){
        echo "<div style='color: white; margin: auto; width: 80%; background: red; margin-top: 20%; text-align: center;'>Activation link has already been used by you.</button></div>";
        exit;
    }elseif($status == "turbo"){
        //run update to reset it to finished
         $sql = "UPDATE resetemail SET status='finished' WHERE user_id='$user_id' AND id='$record_id'";
        $result = mysqli_query($link, $sql);
        if(!$result){
             header("location:index.php");
    exit;
        }
        $quickone = mysqli_affected_rows($link);
    if($quickone != 1){
             header("location:index.php");
    exit;
    }
        //updated, now update email
         $sql = "UPDATE users SET email='$newemail' WHERE user_id='$user_id' AND username='$username'";
        $result = mysqli_query($link, $sql);
        if(!$result){
             header("location:index.php");
    exit;
        }
        $finalcheck = mysqli_affected_rows($link);
    if($finalcheck != 1){
             header("location:index.php");
    exit;
    }
    echo"<div style='color: white; margin: auto; width: 80%; background: green; margin-top: 20%; text-align: center;'>Email reset successful. Click here to continue <a href='".$webserverbaselink."index.php'>PUFFING</a></div>";
    exit;   
    }
       
}
  



?>