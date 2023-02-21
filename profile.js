//resetprofileemail.php
//resetprofilepassword.php
//WRITE AJAX code to listen to when the two forms are submitted, fetch datas and send them over to the processors. If the processors return error, show them in designated div inside current jumbotron, if they return success, show success and redirect back to profile. set sleep delays in profile if it receives get parameters. Done. Research and learn how to export MYSQL databases from localhost to webhosting servers, move puffers to completewebhosting.com without manually creating the db/tables all over again. Test the email functionality that were showing erros during development, see what's good and study this all over again and then repeat the whole damn thing all over again for another website with more tushed functionality. Back project files up in GitHub. Connect with more people to test the designed app out. Research about payment gateway APIs, Research more about googleMaps API. Let's get our hands dirty real bad ASAP :). Says, you on the 18th of February, 2023 6:30PM SATURDAY, . Would have caught current time and written this with PHP date function but this is a comment. We meuuuve. 
$(function(){
    //Update password
$("#profilepasswordform").submit(function(event){
    event.preventDefault();
    //Define data to be sent accross in a variable
    var datatopost = $(this).serializeArray();
    $.ajax({
    
      url: "resetprofilepassword.php",
    type: 'POST',
       data: datatopost,
      success: function(datarecieved){
          if(datarecieved == 1){
             $("#profilepasswordalertbox").html('<div class="alert alert-success">Password reset was successful.</div>'); 
              window.location = 'profile.php?b=s';
    
          }else{
              //set current note id to returned value
           $("#profilepasswordalertbox").html(datarecieved); 
        
                 
             
             
          }
      },
      error: function(){
          $("#profilepasswordalertbox").html("<p>Couldn't run the ajax code bruv</p>");
      }
  });
});
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    
    //Update email
$("#profileemailform").submit(function(event){
    event.preventDefault();
    //Define data to be sent accross in a variable
    var datatopost = $(this).serializeArray();
    $.ajax({
    
      url: "resetprofileemail.php",
    type: 'POST',
       data: datatopost,
      success: function(data){
          if(data == '2'){
             $("#profileemailalertbox").html('<div class="alert alert-success">Instructions on how to reset your email address has been mailed to your current email address. Only valid for the next 15 minutes.</div>'); 
              window.location = 'profile.php?b=e';
    
          }else{
              //set current note id to returned value
           $("#profileemailalertbox").html(data); 
          }
      },
      error: function(){
          $("#profileemailalertbox").html("<p>Couldn't run the ajax code bruv</p>");
      }
  });
});
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>



    
    
    
    
    
    
    
    
//footerrrrr
})