<?php
session_start();
$username = $_SESSION['username'];
include('connector.php');
include('intooutwatcher.php');
include('commentparameters.php');

// Check if the 'alert' parameter was passed in the URL
if (isset($_GET['a'])) {
  // Display the alert based on the value of the parameter
//  $alert = $_GET['alert'];
//    if($alert == 'success'){
//        $mess = 'Comment saved successfully';
//        echo '<script>alert("'.$mess.'");</script>';
//        sleep(2);
//         header('location:comments.php');
//    }
//    if($alert == 'deleted'){
//        $mess = 'Comment deleted successfully';
//        echo '<script>alert("'.$mess.'");</script>';
//        sleep(2);
//        
    sleep(1);
    header('location:comments.php');
    }
  


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puffers Comments page</title>
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
                       <a href="loggedinindex.php" class="navbar-brand">Puffers Arena</a>
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
                          <li ><a href="loggedinindex.php">Home</a></li>
                           <li class="active"><a href="comments.php">Drop Comments</a></li>
                           <li  ><a href="loggedinabout.php">About</a></li>
                           <li  style="color: white; padding: 15px 15px; font-weight= bold;">User: 
                               <?php
                               echo $username;
                               ?></li>
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
                 <div id="introtext" style="margin:auto; text-align: center;">
                     <h1>We're glad to have you here. Hope you've had great time puffing around the site. <br> On this page you will be able to drop and read comments. For now, yours alone.</h1>
                     
                     
                     
    <!--                      alerts from AJAX goes in here-->
      <div id="cmtalert" class=" alert-danger" style="width: 70%; margin: auto; overflow-wrap: break-word; text-align: center;"> 
      </div>
    <div id="cmtalertsuccess" class=" alert-success" style="width: 70%; margin: auto; overflow-wrap: break-word; text-align: center;"> 
      </div>
                    
                    <div id="commentbuttons" class="row " >
<!--                       Div for button errors-->
                       <div id="hgkslsfh"></div>
                        
                        <button id='new2' style="margin:auto; border-radius: 40px;" class="btn btn-lg btn-info hidden">Add more comments</button>
                         <button id='new1' class="btn btn-lg btn-info hidden" style="margin:auto; border-radius: 40px;">Puff my first comment in</button>
                       
                  <!-- Delete Button Jumbotron       -->

                                    <div class="modal" id="deletebuttonmodal" role="dialog" aria-labelledby="PuffupModalLabel" aria-hidden="true">
                                       <div class="modal-dialog" style="color: black;    ">
                                           <div class="modal-content">                                        
                                                 <div class="modal-footer" style="text-align: center;">
                                                  <button class="close" data-dismiss="modal">&times;</button>
                                                   <h1 style="font-weight=bold; text-align: center;">Are you sure?</h1>
<!--                                                   alerts from AJAX goes in here-->
                                                  <div id="deletejumboalertbox" ></div>
                                                   <h4 id="puffupmodallabel" style="font-weight=bold; text-align: center;">This action cannot be reversed, are you sure you want to delete this comment?</h4>
                                                   <button id="confirmdeletecommentbutton" class="btn btn-info" >Yes I'm sure</button>
                                                  
                                               </div>
                                           </div>
                                       </div>

                                    </div>
<!--             Done with delete button jumbotron here-->
                   
                   
                    </div>
    <div id="commentboxwrapper" style="margin-top: 20px;" class="hidden">
      <form id="commentboxform" action="#" method="post">
                <input type="text" name="title" id="titlebox" cols="50%" rows="1" placeholder="Enter Comment Title" style="margin: auto; display: block;">
                <textarea style="margin-top: 10px;"name="comment" id="commentbox" cols="100%" rows="10" placeholder="Puff comment contents in here;"></textarea>
                <div style="text-align: center">
                         <a href="comments.php" id="backcommentbutton"  class="btn btn-lg btn-info">Back</a>
                        <input type="submit" id="savecommentbutton"  class="btn btn-lg btn-success" value="Save comment">
                </div>
        </form>
         <button id="deletecommentbutton"  class="btn btn-lg btn-danger" data-target='#deletebuttonmodal' data-toggle='modal' style="margin: auto; text-align: center;">Delete comment</button>
    </div>

                   
<!--                   FOR ACTUAL COMMENTS-->
                    <div  id="loadedcomments" style="width: 100%; padding: 30px;" class="hidden" >
                    <h3 style="color: white; margin-bottom: 10px; margin-top: 0px">Click your comments to open, edit or delete them</h3>
                    <div id="usercomments"></div> 
                 </div>
                   
                    
        </div>
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
     <script src="cmtpg.js"></script>
     
</body>
</html>