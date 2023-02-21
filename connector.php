<?php

//connect to mysql dB
$link= @mysqli_connect("****", "****", "****", "****");
if(mysqli_connect_error()){
    die ("ERROR: Unable to connect to database. Here is the error code: " . mysqli_connect_error());}
//set default backlink for your website. This applies to all links and most redirection or button actions in forms.
$webserverbaselink = "http://sampledomain********/puffersarena/";


?>