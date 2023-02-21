

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
                           <li class="active" ><a href="#">About</a></li>
                           <li  style="color: white; padding: 15px 15px; font-weight= bold;">User :<?php echo $username; ?></li>
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