
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puffers Email Reset Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/css.css" rel="stylesheet">
      <link href='https://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
  </head>
  <body>
<div id="wrap">
<!--Navigation Bar-->
           <nav role="navigation" class="navbar navbar-inverse navbar-fixed-top">
                  <div class="container_fluid">
<!--                  Nav header/ Brand name/ logo-->
                   <div class="navbar-header">
                       <a href="index.php" class="navbar-brand">Puffers Arena</a>
                       <button type="button" class="navbar-toggle" data-target="#igbo" data-toggle="collapse">
                           <span class="sr-only">Navigation button</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                   </div>
<!--                   Collapsible stuffs-->
                   <div id="igbo" class="navbar-collapse collapse">
    <!--        login and logout buttons-->
                        <form action="" class="navbar-form navbar-right" style="margin-right: 2px">
                            <input type="button" class="btn btn-sm btn-info" value="Puff-in" name="login" data-target="#puffinmodal" data-toggle="modal">
                        </form>
                        <form action="Post" class="navbar-form navbar-right" >
                            <input type="button" class="btn btn-sm btn-info" value="Puff-up" name="signup" data-target="#puffupmodal" data-toggle="modal">
                        </form>
<!--                  Menu navigation items                     -->
                       <ul class="nav navbar-nav navbar-right">
                          <li class="active"><a href="#">Home</a></li>
                           <li><a href="#dudee" data-toggle="modal">Drop Comments</a></li>
                           <li ><a href="about.php">About</a></li>
                       </ul>

        <!--                       Nav search form-->
                  <form action="post" class="navbar-form navbar-right" role="search">
                     <div class="input-group">
                        <span class="input-group-btn">
                             <button class="btn-sm btn-info btn" type="submit">Search</button>
                         </span>
                         <label for="puffsearch" class="sr-only">Puffers Navigation search box</label>
                         <input type="text" id="puffsearch" class="form-control" placeholder="Looking for something?">
                         <span class="glyphicon glyphicon-search form-control-feedback "></span>
                     </div>

                  </form>

                   </div>
                </div>
           </nav>
<!--           Innercontent-->
         <div id="innercontent">
                 <div class="introtext">
                           <h1 style="text-align: center">Email reset page</h1>
                           
                           
                           
                            <!--// //////////////////////////PHP CODE GOES HERE//////////////////////////-->
                            <?php
include("connector.php");
//<form action='http://localhost/puffersarena/emailrst.php' method='post' >
//        <input type='hidden' name='activationkey' value='".$firstkey."'>
//        <input type='hidden' name='username' value='".$username."'>
//        <input type='submit' value='Reset my email'></form>";
//check if supplied datas are caught
                     $exiit = null;
if(empty($_POST["activationkey"])){
    $exiit = "true";
}else{
    $actkey = $_POST["activationkey"];
}
if(empty($_POST["username"])){
    $exiit = "true";
}else{
    $username = $_POST["username"];
}
if(empty($_POST["user_id"])){
    $exiit = "true";
}else{
    $user_id = $_POST["user_id"];
}
if($exiit == "true"){
    echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>An error was ran into. Please make sure to click the button within the email sent to you. Thanks.</div>";
        exit;
}
//fetch instance from the resetemail dB.
$sql = "SELECT * FROM resetemail WHERE user_id='$user_id' AND activationkey='$actkey' AND username='$username'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Unable to run verification query. Please try again later</div>";
        exit;
}
$coutn = mysqli_num_rows($result);
if($coutn == 0){
    echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>An error was ran into. Refresh the page. Do contact support if the error persist</div>";
        exit;
}elseif($coutn > 1){
    echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>FATAL ERROR: Please restart password reset process or contact support</div>";
        exit;
}else{
    //equal to 1. Proceed
    //Check if instance is still valid. within 15mins
    $firstfetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($firstfetch["time"] < time()){
        echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Session has expired, you had only 15mins to reset after initiation.</div>";
        exit;
    }
    //time still valid
    //check if code hasn't been used before
    if($firstfetch["status"] == "used"){
        echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Activation code has already been used by you</div>";
        exit;
    }
    if($firstfetch["status"] == "pending"){
        //valid, now update field and set it to used
        //Fetch record id.
      
        $record_id = $firstfetch["id"];
        $sql = "UPDATE resetemail SET status='used' WHERE id='$record_id'";
        $result = mysqli_query($link, $sql);
        if(!$result){
            echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Unable to update instance record fff</div>";
        exit;
        }else{
            //it ran
            //check affected rows
            $secondcheck = mysqli_affected_rows($link);
            if($secondcheck != 1){
                echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Unable to update instance record balablu</div>";
        exit;
            }else{
                //update successful
                //now echo form
                echo "<form id='wahallaformm' style='color: black; margin: auto; width: 60%;' method='post'>
                <h3 style='color: white; text-align: center; margin-top: 10px;'>Hi ".$username.", let's reset your email ASAP</h3><br>
                    <div id='wahallaformmerror'></div>
                    <input type='hidden' name='record_id'value='".$record_id."'>
                <input type='email' name='email' placeholder='Enter new email address' style='display: block; width: 100%;'>
                <input type='email' name='email2' placeholder='Confirm new email address' style='display: block; width: 100%;'>
                <input type='submit' class='btn btn-lg btn-success' name='submit' value='Update my email address' style='text-align: center; margin-top: 10px;'>
                </form>";
            }
        }
        
        
    }else{
//status is something else
         echo "<div class='alert alert-danger' style='font-weight: bold; width: 70%; overflow-wrap: break-word; text-align: center; margin: auto;'>Error 2222222, contact support</div>";
        exit;
    }
}



?>



                        
                 </div>
                
        </div>
<!-- Puffup Jumbotron       -->
        <form  method="post" id="puffupform">
            <div class="modal" id="puffupmodal" role="dialog" aria-labelledby="PuffupModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button class="close" data-dismiss="modal">&times;</button>
                           <h1 style="font-weight=bold; text-align: center;">Puffing-up form</h1>
                           <h4 id="puffupmodallabel" style="font-weight=bold; text-align: center;">Hey dude! It's great you finally decided to start puffing. <br> Let's sign you up real quick;</h4>
                       </div>
                       <div class="modal-body">
<!--                         error messages from php-->
                         <div id="signuperrormessages"></div>
                          <div class="form-group">
                              <label for="username" class="sr-only">Enter your Username</label>
                               <input class="form-control" type="text" name="username" maxlength="30" id="username" placeholder="Puff your desired username in here">
                          </div>
                          <div class="form-group">
                              <label for="email" class="sr-only">Enter your Email address</label>
                               <input class="form-control" type="email" name="email" maxlength="50" id="email" placeholder="Puff in your email address shaparly">
                          </div>
                          <div class="form-group">
                              <label for="password" class="sr-only">Enter your Password</label>
                               <input class="form-control" type="password" name="password" maxlength="30" id="password" placeholder="Password please...">
                          </div>
                           <div class="form-group">
                              <label for="password2" class="sr-only">Enter your Password again</label>
                               <input class="form-control" type="password" name="password2" maxlength="30" id="password2" placeholder="Enter that password again.">
                          </div>
                       </div>
                       <div class="modal-footer" style="text-align: center;">
                           <input type="submit" name="signup" value="Create my account" class="btn btn-info">
                           <p>Already a Puffer? No worries, Puff-in <button type="button" class="btn" data-target="#puffinmodal" data-toggle="modal" data-dismiss="modal" style="color:blue;">here</button></p>
                       </div>
                   </div>
               </div>
                
            </div>
        </form>
<!-- Puffin Jumbotron       -->
        <form  method="post" id="puffinform">
            <div class="modal" id="puffinmodal" role="dialog" aria-labelledby="PuffinModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button class="close" data-dismiss="modal">&times;</button>
                           <h1 style="font-weight=bold; text-align: center;">Puffing-in page</h1>
                           <h4 id="puffinmodallabel" style="font-weight=bold; text-align: center;">Welcome back comrade. Let's get going</h4>
                       </div>
                       <div class="modal-body">
<!--                         error messages from php-->
                         <div class="signinerrormessages"></div>
                          <div class="form-group">
                              <label for="username" class="sr-only">Enter your Username</label>
                               <input class="form-control" type="text" name="username" maxlength="30" id="username" placeholder="Puffer username">
                          </div>
                          
                          <div class="form-group">
                              <label for="password" class="sr-only">Enter your Password</label>
                               <input class="form-control" type="password" name="password" maxlength="30" id="password" placeholder="Password please...">
                          </div>
                          <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="rememberme" id="rememberme">
                                    Remember me
                                </label>
                                <input type="submit" name="signin" value="Puff into my account" class="btn pull-right btn-info">
                          </div>
                          
                       </div>
                       <div class="modal-footer" style="text-align: center;">
                           
                           <p>Forgotten password? No worries, reset it <button type="button" class="btn" data-target="#forgottenpasswordmodal" data-dismiss="modal" data-toggle="modal" style="color:blue;">here</button></p> 
                           <p>New to the arena? become a Puffer <button type="button" class="btn" data-target="#puffupmodal" data-dismiss="modal" data-toggle="modal" style="color: #5bc0de;">here</button></p>
                       </div>
                   </div>
               </div>
                
            </div>
        </form>
<!-- Password reset Jumbotron       -->
        <form  method="post" id="forgottenpasswordform">
            <div class="modal" id="forgottenpasswordmodal" role="dialog" aria-labelledby="forgottenpasswordModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button class="close" data-dismiss="modal">&times;</button>
                           <h1 style="font-weight=bold; text-align: center;">Password reset page</h1>
                           <h4 id="forgottenpasswordmodallabel" style="font-weight=bold; text-align: center;">Yeah, shit happens... <br> Enter your email address here and let's get you back on ASAP</h4>
                       </div>
                       <div class="modal-body">
<!--                         error messages from php-->
                         <div class="forgottenpassworderrormessages"></div>
                            <div class="form-group">
                              <label for="email" class="sr-only">Enter your Email address</label>
                               <input class="form-control" type="email" name="email" maxlength="50" id="email" placeholder="No dulling...">
                              </div>
                       </div>
                       <div class="modal-footer" style="text-align: center;">
                           <input type="submit" name="signin" value="Reset my password" class="btn btn-info">
                           <button type="button" class="btn" data-target="#puffinmodal" data-dismiss="modal" data-toggle="modal" style="color:blue;">Return to Puff-in page</button>
                       </div>
                   </div>
                </div>
            </div>
        </form>
<!-- Dude sign up first Jumbotron features redirection to sign-up/sign-in buttons      -->
        <form  method="post" id="dude">
            <div class="modal" id="dudee" role="dialog" aria-labelledby="dudeModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button class="close" data-dismiss="modal">&times;</button>
                           <h1 style="font-weight=bold; text-align: center;">Woah!!</h1>
                       </div>
                       <div class="modal-body">
                           <h4 id="forgottenpasswordmodallabel" style="font-weight=bold; text-align: center;">Calm down... Gotta be a Puffer to be able to drop comments here.</h4>  
                       </div>
                       <div class="modal-footer" style="text-align: center;">
                               <button type="button" class="btn btn-info" data-target="#puffupmodal" data-dismiss="modal" data-toggle="modal" style="color:blue;">Puff-up now</button>
                               <button type="button" class="btn btn-success" data-target="#puffinmodal" data-dismiss="modal" data-toggle="modal" style="color:blue;">Access your Puffers' profile</button>
                        </div>
                   </div>
                </div>
            </div>
        </form>
</div>
<!--        Footer          -->
       <div class="footer " style="width: 100%;" >
           <div class="container-fluid nopadding">
                <div class="topfooter">
                    <div class="footer-grp col-xs-6">
                       <h3 style="color: white;">Some vawulence</h3>
                        <ul>
                            <li><a href="#">wahalla wahalla</a></li>
                            <li><a href="#">wahalla wahalla</a></li>
                            <li><a href="#">wahalla wahalla</a></li>
                            <li><a href="#">wahalla wahalla</a></li>
                            
                        </ul>
                    </div>
                    <div class="footer-grp col-xs-6">
                       <h3 style="color: white;">More vawulence</h3>
                        <ul>
                            <li><a href="#">wahalla wahalla</a></li>
                            <li><a href="#">wahalla wahalla</a></li>
                            <li><a href="#">wahalla wahalla</a></li>
                            <li><a href="#">wahalla wahalla</a></li>
                        </ul>
                    </div>
                    <span style="color: white; text-align: center; margin: auto; display: block; width: 100%;">Why would you click on any wahalla? <br> Abi you wan collect? ELL-OH-ELL</span>
               </div>
               <p style="color:red; width: 100%; background-color: black; text-align: center; margin: 0px 0px; padding: 15px 0px;">Puffers Arena. Copyright &copy;  2022 - <?php $daate = date('Y'); echo $daate ?>. All rights reserved </p>
               
               
           </div>
       </div>

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- This is a slim version which doesn't support AJAX-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
<!--   This version is said to support AJAX-->
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
     <script src="index.js"></script>
     <script>
      //write a script below this page to listen to when the created form gets submitted. id wahallaformm. pulls an AJAX call to another file called emailrstresetter.php
//check for validation of supplied data and match
//if satisfied, update users table with new email
//    echo 3 for success. show success message or show error message. 
$('#wahallaformm').submit(function(event){
     event.preventDefault();
    //Define data to be sent accross in a variable
    var datatopost = $(this).serializeArray();
     $.ajax({
        //WHERE DATAS ARE TO BE SENT TO
        url: 'emailrstresetter.php',
        //COS FORM WAS SUBMITTED USING THE POST METHOD
        type: "POST",
        //What to send...
        data: datatopost,
        //IF THE CALL IS SUCCESSFULL OR NOT, DO...
        success: function(data){
            if(data == '3'){
                 $("#wahallaformmerror").html('<div class="alert alert-success">Email reset successful. For the change to take effect, go verify the newly provided email address by checking your mailbox and clicking on the activation button in the mail received. Thanks.</div>');
            }else{
                 $("#wahallaformmerror").html("<div class='alert alert-danger'>"+ data +"</div>");
            }        
        },
        error: function(){
            $("#wahallaformmerror").html('<div class="alert alert-danger">UNABLE TO SEND AJAX CALL</div>');
        }
    }) 
    
    
})
      
      
      
      </script>
</body>
</html>