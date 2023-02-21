<?php
session_start();
include('connector.php');
    //                                                    session_start();
    //                                                    include('connector.php');
    // sample insertion query  INSERT INTO comments (`comment_id`, `user_id`, `username`, `title`, `comment`, `time`) VALUES ('2', '13', 'Test', 'This is a title', 'comment contentsssssss', '122425253')

    //Listen on first visit and check if user has posted any comment and load them. if none has been posted show error and show create comment HTMLButtonElement
    //loadcomments.php

    //get userdetails from session array
    if(!$_SESSION['user_id']){
         exit;
    }else{
        $user_id = $_SESSION['user_id'];

    }
    if(!$_SESSION['username']){
        exit;
    }else{
        $username = $_SESSION['username'];
    }
//delete empty notes
$sql = "DELETE FROM comments WHERE title='' AND comment=''";
$result = mysqli_query($link, $sql);
    //datas gotten, run query to check if details exists or not
    $sql = "SELECT * FROM comments WHERE username ='$username' AND user_id ='$user_id' ORDER BY time DESC";
    $result = mysqli_query($link, $sql);
    if(!$result){
         echo 'unabletorun';
        exit;
    }else{
        $counter = mysqli_num_rows($result);


        if($counter < 1){
            echo 'nonefound';
            exit;

        }else{
            while($fetcher = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            //SET REQUIRED VARIABLES AND PREPARE FOR INSERTION
            $comment_id = $fetcher['comment_id'];
            $title = $fetcher['title'];
            $comment = $fetcher['comment'];
            $time = $fetcher['time'];
            $time = date("F d, Y h:i:s A", $time);
            echo "<div class='commentss' style='margin-bottom: 20px; margin-left: 30px; margin-right: 30px;'>
                                  <input type='hidden' name='comment_id' id='comment_id' value='$comment_id'>
                                   <h3  style='text-overflow: ellipsis; white-space: nowrap; overflow: hidden;'>$title</h3>
                               <h4 style='text-overflow: ellipsis; white-space: nowrap; overflow: hidden;'>$comment</h4>
                               <p style='text-overflow: ellipsis; white-space: nowrap; overflow: hidden;'>$time</p>
                       </div>";
                
              
            }
           


        }
    }
    
?>
