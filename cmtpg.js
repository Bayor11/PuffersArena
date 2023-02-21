$(function(){
//Define variables
    var currentcomment_id = null;
  

//LOAD COMMENTS on opening page    
 $.ajax({
    
      url: "loadcomments.php",
      success: function(data){
          if(data == 'nonefound'){
             $("#cmtalert").html("<div class='alert alert-danger'>You haven't created any notes yet. Puff something in below</div>");
              showhide(["new1"], []);
              
          }
         else if(data == 'unabletorun'){
             $("#cmtalert").html("<div class='alert alert-danger'>An error was encountered while trying to load notes. Please try again later or contact support if the error persists. Sorry for the inconvinience.</div>");
         }else{
             
              $("#usercomments").html(data);
              readcomments();
             deletecomments();
             showhide(["loadedcomments", "new2"], []);
             
          }
      },
      error: function(){
          $("#cmtalert").html("<p>Couldnt run the ajax code bruv</p>");
      }
  });   
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    
//CREATE NOTE BUTTONCLICK NEW2
$("#new2").click(function(){
    $.ajax({
    
      url: "newcomments.php",
      success: function(data){
          if(data == 'error'){
             $("#cmtalert").html("<div class='alert alert-danger'>An error was encountered while trying to create the note. Please refresh the page</div>");    
          }else if(data == ''){
             $("#cmtalert").html("<div class='alert alert-danger'>An error was encountered while trying to create the note. Please refresh the page</div>");    
          }else{
              //set current note id to returned value
              currentcomment_id = data;
             showhide(["commentboxwrapper"], ["loadedcomments", "new2", "deletecommentbutton"]);
                 
             
             
          }
      },
      error: function(){
          $("#cmtalert").html("<p>Couldnt run the ajax code bruv</p>");
      }
  });
});
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//CREATE NOTE BUTTONCLICK NEW1
$("#new1").click(function(){
    $.ajax({
    
      url: "newcomments.php",
      success: function(data){
          if(data == 'error'){
             $("#cmtalert").html("<div class='alert alert-danger'>An error was encountered while trying to create the note. Please refresh the page</div>");    
          }else if(data == ''){
             $("#cmtalert").html("<div class='alert alert-danger'>An error was encountered while trying to create the note. Please refresh the page</div>");    
          }else{
              //set current note id to returned value
              currentcomment_id = data;
             showhide(["commentboxwrapper"], ["new1", "deletecommentbutton"]);
                 
             
             
          }
      },
      error: function(){
          $("#cmtalert").html("<p>Couldnt run the ajax code bruv</p>");
      }
  });
});
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//SAVE CREATED NOTE
$("#commentboxform").submit(function(event){
    event.preventDefault();
    //Define data to be sent accross in a variable
    var datatopost = $(this).serializeArray();
    $.ajax({
    
      url: "updatecomment.php",
    type: 'POST',
       data: {id: currentcomment_id, data: datatopost},
      success: function(data){
          if(data == 'success'){
             $("#cmtalertsuccess").html('<p>Comment saved successfully</p>'); 
              window.location = 'comments.php?a=s';
    
          }else{
              //set current note id to returned value
           $("#cmtalert").html(data); 
        
                 
             
             
          }
      },
      error: function(){
          $("#cmtalert").html("<p>Couldnt run the ajax code bruv</p>");
      }
  });
});
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

    
    
    
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
 
    
    
     
//  
  //functions goes in here
    
function showhide(array1, array2){
    for(var i = 0; i < array1.length; i++){
        $("#" + array1[i]).addClass("shown");
    }
    for(var i = 0; i < array1.length; i++){
        $("#" + array1[i]).removeClass('hidden');
    }
     for(var i = 0; i < array2.length; i++){
        $("#" + array2[i]).addClass("hidden");
    }
    for(var i = 0; i < array2.length; i++){
        $("#" + array2[i]).removeClass('shown');
    }
};

//READ COMMENTS
function readcomments(){
    
    $(".commentss").click(function(){
        //fetch currentcomment id
    var currentcomment = $(this); // Get the currently selected element
    var nextElement = currentcomment.children().first(); // Select the next element
    var comment_id = nextElement.attr("value"); // Extract the attribute value
    // Use the attribute value as needed
    currentcomment_id = comment_id;
        
        //fetch title
        var nexttElement = nextElement.next();
        var title = nexttElement.text();
        //fetch comment;
         var nextttElement = nexttElement.next();
        var comment = nextttElement.text();
        //update title and comment
        $('#titlebox').attr('value', title);
        $("#commentbox").text(comment);
        //showhide stuffs
        showhide(["commentboxwrapper"], ["loadedcomments", "new2"]);
        $('#commentboxform')[0].reset();  
});
};

    //DELETE COMMENTS
function deletecomments(){
    $("#confirmdeletecommentbutton").click(function(){
//    collect comment id and pass it to a deletecomment.php file for processing. if it returns error, show an error inside the delete jumbotron, if it returns success, redirect to comment page and show an alert that comment has been successfully deleted. 
         
$.ajax({
    url: "deletecomment.php",
    type: "POST",
    data: { ID: currentcomment_id},
    success: function(data){
        if(data == "success"){
            $("#deletejumboalertbox").html("<div class='alert alert-success'>Comment deleted successfully</div>");
            window.location= "comments.php?a=d";
        }else if(data == "error"){
            $("#deletejumboalertbox").html("<div class='alert alert-danger'><p>Can't find session variables or comment id</p></div>");
        }else{
             $("#deletejumboalertbox").html("<div class='alert alert-danger'>"+ data +"</div>");
            //force refresh

        }
        
    },
    error: function(){
      $("#deletejumboalertbox").html("<div class='alert alert-danger'><p>Couldn't run the ajax code</p></div>");
         
    }
});

});
};
  //end footer
  })