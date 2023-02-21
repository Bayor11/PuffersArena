
<?php
session_start();
$username = $_SESSION['username'];
include('connector.php');
include('intooutwatcher.php');

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puff Arena</title>
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
                       <a href="#" class="navbar-brand">Puffers Arena</a>
                       <button type="button" class="navbar-toggle" data-target="#igbo" data-toggle="collapse">
                           <span class="sr-only">Navigation button</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                   </div>
<!--                   Collapsible stuffs-->
                   <div id="igbo" class="navbar-collapse collapse">
    <!--        signout button-->
                        <form action="logout.php" method="get" class="navbar-form navbar-right" style="margin-right: 2px">
                            <input type="submit" class="btn btn-sm btn-danger" id="logout" value="Puff-out" name="logout" >
                        </form>

<!--                  Menu navigation items                     -->
                       <ul class="nav navbar-nav navbar-right">
                          <li class="active" ><a href="#">Home</a></li>
                           <li><a href="comments.php">Drop Comments</a></li>
                           <li ><a href="loggedinabout.php">About</a></li>
                           <li  style="color: white; padding: 15px 15px; font-weight= bold;">User: 
                               <?php
                               echo $username;
                               ?>
                               
                           </li>
                           <li ><a href="profile.php">Profile</a></li>
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
                     <blockquote style="width: 80%; margin: auto; margin-top: 15%">
                     <h2>"Shit happens when you stop giving a fu** about everything. Know what? Start giving a puff today. "</h2>
                     <h3 style="text-align: center; color: #5bc0de; font-weight: bold;">---Puff Lord</h3>
                     </blockquote>
                 </div>
                <h2 style="color: red; width: 60%; text-align: center; margin: auto; background: rgba(20, 30, 30, 0.4)" >Welcome to your personal homepage. Here, you can check the nav buttons out as they've changed. Also start puffing stuffs into the comment box.
                Don't use that search box just yet :)</h2>
                <div style="width: 100%; display: block;">
<!--                Midpage signup button-->
                    <a class="btn btn-lg btn-info crazy" style="border-radius: 20px; display: block; margin: auto;" href="comments.php" >Click here to start commenting</a>
                    <br>
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
                         <div class="signuperrormessages"></div>
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
</body>
</html>