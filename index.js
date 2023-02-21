//fjjffj Javascript mode to listen to actions and make AJAX calls


//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//Sign up functionality
$("#puffupform").submit(function(event){
    event.preventDefault();
    //Define data to be sent accross in a variable
    var datatopost = $(this).serializeArray();
    $.ajax({
        //WHERE DATAS ARE TO BE SENT TO
        url: "signup.php",
        //COS FORM WAS SUBMITTED USING THE POST METHOD
        type: "POST",
        //What to send...
        data: datatopost,
        //IF THE CALL IS SUCCESSFULL OR NOT, DO...
        success: function(data){
            if(data){
                $("#signuperrormessages").html(data);
            }         
        },
        error: function(){
            $("#signuperrormessages").html('<div class="alert alert-danger">UNABLE TO SEND AJAX CALL</div>');
        }
    }) 
});








//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//Log in functionality
$("#puffinform").submit(function(event){
    event.preventDefault();
    //Define data to be sent accross in a variable
    var datatopost = $(this).serializeArray();
    $.ajax({
        //WHERE DATAS ARE TO BE SENT TO
        url: 'login.php',
        //COS FORM WAS SUBMITTED USING THE POST METHOD
        type: "POST",
        //What to send...
        data: datatopost,
        //IF THE CALL IS SUCCESSFULL OR NOT, DO...
        success: function(data){
            if(data == 'success'){
                window.location = 'loggedinindex.php';
            }else{
                 $("#signinerrormessages").html(data);
            }        
        },
        error: function(){
            $("#signinerrormessages").html('<div class="alert alert-danger">UNABLE TO SEND AJAX CALL</div>');
        }
    }) 
});





//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//Forgotten password reset functionality
$("#forgottenpasswordform").submit(function(event){
    event.preventDefault();
    //Define data to be sent accross in a variable
    var datatopost = $(this).serializeArray();
    $.ajax({
        //WHERE DATAS ARE TO BE SENT TO
        url: "forgottenpwdd.php",
        //COS FORM WAS SUBMITTED USING THE POST METHOD
        type: "POST",
        //What to send...
        data: datatopost,
        //IF THE CALL IS SUCCESSFULL OR NOT, DO...
        success: function(data){
            if(data){
                   $("#forgottenpassworderrormessages").html(data);
            }        
        },
        error: function(){
            $("#forgottenpassworderrormessages").html('<div class="alert alert-danger">An error was ran into. Please try againt later.</div>');
        }
    }) 
});







