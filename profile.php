<?php
session_start();
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];
include('connector.php');
include('intooutwatcher.php');
//fetch email address
$sql = "SELECT * FROM users WHERE username='$username' AND user_id='$user_id' AND activation='activated'";
$result= mysqli_query($link, $sql);
if(!$result){
    echo "<div style='color: red; font-size: 4em;'>Cannot verify user details</div>";
    exit;
}else{
    $coutn = mysqli_num_rows($result);
    if($coutn == 1){
        //fetch
        $fetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $email = $fetch['email'];
    }else{
        echo "<div style='color: red; font-size: 4em;'>Cannot verify user details</div>";
    exit;
    }
    
}
//Check for alert get parameters

if (isset($_GET['b'])) {
  // Display the alert based on the value of the parameter
  $alert = $_GET['b'];
    if($alert == 'e'){

        sleep(7);
         header('location:profile.php');
    }
    if($alert == 's'){

        sleep(2);
        header('location:profile.php');

    }

}
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puffers Profile page</title>
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
                           <li><a href="comments.php">Drop Comments</a></li>
                           <li ><a href="loggedinabout.php">About</a></li>
                           <li  style="color: white; padding: 15px 15px; font-weight= bold;">User :<?php echo $username; ?></li>
                           <li class="active"><a href="#">Profile</a></li>
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
                                         <h1>Welcome to your profile page</h1>
                                         <p>Here, you can update and reset your account informations</p>
                                     </div>

                                     <h3 style="color: red; width: 60%; margin: auto; margin-top: 5%; text-align: center;">Click the field on the right to get started;</h3>
                                     <table style="color: white; width: 60%; margin: auto; margin-top: 5%;" class="table table-condensed table-hover table-focused table-bordered">
                                                <div >
                                                        <tr>
                                                         <th>Username:</th>
                                                         <th onclick="alert('You do not have permision to do this. To reset your username, please contact support. You can however continue to  change your username and password. Thanks!')" style="cursor: pointer; color:red; text-align: center;"><?php echo $username; ?></th>

                                                     </tr>
                                                </div>
                                                <div >
                                                        <tr>
                                                         <th>Email address:</th>
                                                         <th id="profile2" data-target='#profileemail' data-toggle='modal' style="color: blue; cursor: pointer; text-align: center;"><?php echo $email; ?></th>

                                                     </tr>
                                                </div>
                                                <div >
                                                    <tr>
                                                     <th>Password:</th>
                                                     <th style="color: blue; text-align: center; cursor: pointer;" id="profile3" data-target='#profilepassword' data-toggle='modal'>&times; &times; &times; &times;&times;&times;&times;</th>
                                                 </tr>
                                                </div>
                                     </table>
<!--                                     PROFILE JUMBOTRONS-->
<!--       UPDATE Email-->
        <div class="modal" id="profileemail" role="dialog" aria-labelledby="PuffupModalLabel" aria-hidden="true">
               <div class="modal-dialog" style="color: black;">
                   <div class="modal-content">                                        
                         <div class="modal-footer" style="text-align: center;">
                                  <button class="close" data-dismiss="modal">&times;</button>
                                   <h3 style="font-weight=bold; text-align: center;">Hi <em><?php echo $username; ?></em>, wanna change your Puffer's email address?<br></h3>
                                   <h4>You need to verify ownership to continue, let's do this</h4>
        <!--                                                   alerts from AJAX goes in here-->
                                  <div id="profileemailalertbox" ></div>
        <!--                                                form goes in here to collect old and new email inputs-->
                               <form id="profileemailform" method="post">
                                    <input type="hidden" id="werey1" name="email" value="<?php echo $email; ?>">
                                     <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                      <input type="hidden" name="username" value="<?php echo $username; ?>">
                                    <input type="submit"  class="btn btn-lg btn-success" value="Reset my email">
                                </form>

                       </div>
                   </div>
               </div>

        </div>
<!--       UPDATE PASSWORD-->
        <div class="modal" id="profilepassword" role="dialog" aria-labelledby="PuffupModalLabel" aria-hidden="true">
               <div class="modal-dialog" style="color: black;    ">
                   <div class="modal-content">                                        
                         <div class="modal-footer" style="text-align: center;">
                          <button class="close" data-dismiss="modal">&times;</button>
                           <h3 style="font-weight=bold; text-align: center;">Hi <em><?php echo $username; ?></em>, wanna reset your password?<br>Fill this up real quick;</h3>
<!--                                                   alerts from AJAX goes in here-->
                          <div id="profilepasswordalertbox" ></div>
<!--                                                form goes in here to collect old and new email inputs-->
                       <form id="profilepasswordform" method="post">
                                   <input type="text" name="oldpassword" placeholder="Enter current password" style="margin: auto; display: block; width: 50%">
                                    <input type="text" name="newpassword" placeholder="Enter new password" style="margin: auto; display: block; width: 50%">
                                      <input type="text" name="newpassword2" placeholder="Confirm new password" style="margin: auto; display: block; width: 50%">
                                     <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                      <input type="hidden" name="username" value="<?php echo $username; ?>">
                                    <input type="submit"  class="btn btn-lg btn-success" value="Reset my password">
                        </form>

                       </div>
                   </div>
               </div>

        </div>
<!--end of password jumbotron-->
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
      <script src="profile.js"></script>
</body>
</html>