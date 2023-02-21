
<?php
session_start();
include('connector.php');
include('outtoinwatcher.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puffers Password Reset</title>
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
                           <h1 style="text-align: center">Let's puff you back on track</h1>
                            <!--// //////////////////////////PHP CODE GOES HERE//////////////////////////-->

                                            <?php
                                            //This code will be nested in an html environment similar to that of activation.php to show errors on current page
                                            //include connector
                                            include('connector.php');

                                            //define possible errors(datamissing, expiredlink)
                                            $datamissing = "<p>Password reset can't be processed. Please use the reset button in mail sent to you.</p>";
                                            $expiredlink = "<p>This password request link has expired. request for a new one on Password reset page by supplying your email address in the provided field. Thanks</p>";
                                            function nnn($a){
                                                $b = "<div class='alert alert-danger'>".$a."</div>";
                                                echo $b;
                                            }
                                            function yyy($a){
                                                $b = "<div class='alert alert-success'>".$a."</div>";
                                                echo $b;
                                            }
                                            //check if needed datas (record_id and keycode) are present
                                            //if not, echo error
                                            //if yes
                                            //collect them
                                            if(empty($_GET['record_id'])){
                                               nnn($datamissing);
                                                exit;
                                            }else{
                                                $record_id = $_GET['record_id'];
                                            }
                                            if(empty($_GET['keycode'])){
                                                nnn($datamissing);
                                                exit;
                                            }else{
                                                $keycode = $_GET['keycode'];
                                            }
                                            //run a query through forgotpassword table to select the field corresponding to the data with an added check that status must be "pending"
                                            //run count, if equals 1, 
                                            //fetch array
                                            $sql = "SELECT * FROM forgotpassword WHERE status='pending' AND id='$record_id'  AND keycode='$keycode'" ;
                                            $result = mysqli_query($link, $sql);
                                            if(!$result){
                                             echo "<div class='alert alert-success'>Unable to run first query</div>";
                                            }else{
                                                $count = mysqli_num_rows($result);
                                                if($count == 1){
                                                    $fetcher = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                                    //fetch time, user_id, username
                                                    $time = $fetcher['time'];
                                                    $user_id = $fetcher['user_id'];
                                                    $username = $fetcher['username'];
                                                    //check if arraytime is greaterthan or equal to current time
                                            //if not true echo expiredlink
                                                    if(time() >= $time){
                                                        nnn($expiredlink);
                                                        exit;
                                                    }else{
                                                        //if true
                                            //Begin password reset by echoing a POST form to collect new password(username and user_id and record_id as hidden fields, password and password2 as names of active input fields)
                                                        
                echo "<div style='text-align: center'><form  method='post' id='formform' >
                               <h1 style='font-weight=bold; text-align: center;'>Password reset form</h1>
                               <h4 style='font-weight=bold; text-align: center;'>Welcome back, <br> Let's reset your password real quick;</h4>
                             <div id='formformmessage'></div>
                             <input  type='hidden' name='username'  value='".$username."'>
                             <input  type='hidden' name='user_id'   value='".$user_id."'>
                             <input  type='hidden' name='record_id' value='".$record_id."'>
                             
                                  <label for='password' >Enter new Password:</label><br>
                                   <input id='password' type='password' name='password' maxlength='30' placeholder='Enter it ASAP...'><br>
                              
                                  <label for='password2' >Re-enter your new password:</label><br>
                                   <input id='password2' type='password' name='password2'  maxlength='30' placeholder='Re-enter your new password'><br>
                             

                               <input type='submit' name='submit' value='Save new password' class='btn btn-info'>
                        </form></div>
                                                        ";
                                                    }
                                                }else{
                                                    nnn($datamissing);
                                                }
                                            }





                                            //NOTE THAT AT THE BOTTOM OF THIS PAGE, an ajax script will be written to listen to when this form gets submitted and it will also fetch information from the external processor to be displayed on a designated div within the form.









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
                         <div id="signinerrormessages"></div>
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
      
      //Password reset functionality
$("#formform").submit(function(event){
    event.preventDefault();
    //Define data to be sent accross in a variable
    var datatopost = $(this).serializeArray();
    $.ajax({
        //WHERE DATAS ARE TO BE SENT TO
        url: 'pwdrst.php',
        //COS FORM WAS SUBMITTED USING THE POST METHOD
        type: "POST",
        //What to send...
        data: datatopost,
        //IF THE CALL IS SUCCESSFULL OR NOT, DO...
        success: function(data){
            if(data){
                   $("#formformmessage").html(data);
            }        
        },
        error: function(){
            $("#formformmessage").html('<div class="alert alert-danger">UNABLE TO SEND AJAX CALL</div>');
        }
    }) 
});




      
      
      </script>
</body>
</html>