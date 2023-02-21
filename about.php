
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
    <title>Puffers About page</title>
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
                          <li ><a href="index.php">Home</a></li>
                           <li><a href="#dudee" data-toggle="modal">Drop Comments</a></li>
                           <li class="active" ><a href="#">About</a></li>
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
                     <h1>Yup, here is where it all goes down.</h1>
                     <p>I don't care much about the user interface just yet.</p>
                 </div>
                 
                 <h3 style="color: red; width: 60%; margin: auto; margin-top: 5%;">This is a drill to test my skill level with php backend architecture</h3>
                 <h1 style="color: red; width: 60%; margin: auto; margin-top: 5%;" class="table table-hover table-condensed table-bordered">
                 Puffers Arena is just a crazy idea that occured to me while learning. I sketched the app skeleton and was able to build it from scratch. The going isn't easy but yeah, things have been getting better. I've been getting better.
                 <br>
                 Thanks for taking your time to check this out. I'm like a toddler at this at this moment.
                 wrote this very line on the 14th of January, 2023, 10:43pm <br> 
                 Let's soar higher together.
                 </h1>
                    
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
                         <div id="forgottenpassworderrormessages"></div>
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