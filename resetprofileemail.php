<?php
include('connector.php');
//<form id="profileemailform" method="post">
//    <input type="hidden" id="werey1" name="email" value="<?php echo $email; ?
//     <input type="hidden" name="user_id" value="<?php echo $user_id; ">
//      <input type="hidden" name="username" value="<?php echo $username; >">
//    <input type="submit"  class="btn btn-lg btn-success" value="Reset my email">
//    </form>
//Define errors
$error1 = "<div class='alert alert-danger'>Core values missing</div>";

//collect data
if(empty($_POST["email"])){
   echo $error1;
    exit;
}else{
    $old_email = $_POST["email"];
}
if(empty($_POST["username"])){
   echo $error1;
    exit;
}else{
    $username = $_POST["username"];
}
if(empty($_POST["user_id"])){
   echo $error1;
    exit;
}else{
    $user_id = $_POST["user_id"];
}


//create and run query to check if match exists
$sql = "SELECT * FROM users WHERE username='$username' AND user_id='$user_id' AND email='$old_email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "<div class='alert alert-danger'>Unable to verify your details. Please contact support</div>";
    exit;
}
$countnn = mysqli_num_rows($result);

if($countnn != 1){
    echo "<div class='alert alert-danger'>ERROR: Unable to find user information in the dB</div>";
    exit;
}else{
    //Match found;
    //insert records into the reset email table. set status to pending. if successful, mail user
    //15 mins expiration equals 900secs
    $time = time() + 900;
    $firstkey = rand(1000000, 10000000);
    $sql = "INSERT INTO resetemail (`user_id`, `username`, `activationkey`, `status`, `time`, `newemail`, `newtime`) VALUES ('$user_id', '$username', '$firstkey', 'pending', '$time', 'null', 'null')";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo "<div class='alert alert-danger'>ERROR: Unable to run insertion query to update db db db</div>";
    exit;
    }else{
        $ghhh = mysqli_affected_rows($link);
        if($ghhh != 1){
            echo "<div class='alert alert-danger'>ERROR: shfhhfhfhf</div>";
    exit;
        }else{
            
    //Mail the user.
     $message = "<h1>Puffers account email reset</h1><br>";
        $message .= "<p>Hi, ".$username.", A request was made to reset your email address;</p><br>";
    
        $message .= "<p>If you didn't make this request yourself, please, <strong>Contact support right away.</srong><br>Otherwise, proceed to change your email by clicking the button below;<br></p>";
        $message .= "<form action='".$webserverbaselink."emailrst.php' method='post' >
        <input type='hidden' name='activationkey' value='".$firstkey."'>
        <input type='hidden' name='username' value='".$username."'>
        <input type='hidden' name='user_id' value='".$user_id."'>
        <input type='submit' value='Reset my email'></form>";
        //message footer
        $time = time();
        $daate = date('Y', $time);
        $message .= "<p style='color:red; width: 100%; background-color: black; text-align: center; margin: 0px 0px; padding: 15px 0px;'>Puffers Arena. Copyright &copy;  2022 - ".$daate." All rights reserved </p>";
        
        $messagebody = "<div style='text-align: center; border: 10px black; border-style: solid; border-radius: 100px '>".$message."</div>";
   $headerss = 'MIME-Version: 1.0' . "\r\n";
$headerss .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headerss .= "From: hashpro212@gmail.com" . "\r\n";

     //check if sent, if yeah, then echo that it's successful and they can proceed to login
    if(mail($old_email, "Reset Puffers email address", $messagebody, $headerss)){
        echo "2";
    }else{
        echo "<div class='alert alert-danger'>ERROR: Failed at finished stage</div>";
    exit;
    }

            
        }
    }    
    
}
//    if old email exists, create a new table called resetemail, insert records into the resetemail table. core requirement being to have username, userid, id, time of action and status, pending/approved
//    mail the newly provided email address with an activation link
       










?>