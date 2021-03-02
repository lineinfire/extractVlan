script type="text/javascript">

$(document).ready(function() {
$('#bghimire').bootstrapValidator({
      
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'fa fa-refresh fa-spin'
            },
            fields: {
                 modulegroupcode: {
                
                validators: {
          notEmpty: {
                            message: 'Module Group Code is required'
                        },
                        regexp: {
                            regexp: '[A-Z]+',
                            message: 'The value is not a valid module group code'
                            
                        },

                }
            },
      
      
      
         modulegroupname: {
                
                validators: {
          notEmpty: {
                            message: 'Module Group  Name is required *'
                        },
    
                }
            },


             modulename: {
                
                validators: {
          notEmpty: {
                            message: 'Module Name is required *'
                        },
    
                }
            },
      
      
      
      
      
      
      
      
      
      
      
      
      
      
              
        modulecode: {
                
                validators: {
          notEmpty: {
                            message: 'Module Code is required'
                        },
    
                }
            },
        







 modulegrouporder: {
                
                validators: {
          notEmpty: {
                            message: 'Module Group  order is required *'
                        },
    
                }
            },




 moduleorder: {
                
                validators: {
          notEmpty: {
                            message: 'Module order is required *'
                        },
    
                }
            },






 modulepagename: {
                
                validators: {
          notEmpty: {
                            message: 'Module Page Name is required *'
                        },
    
                }
            },



 status: {
                
                validators: {
          notEmpty: {
                            message: 'Activation Status is required *'
                        },
    
                }
            },












        /*
      email: {
                
                validators: {
        notEmpty: {
        message: 'The email ID required'
                        },
              stringLength: {
                min: 10,
                max: 200,
                message:'Please enter the vlaue between 10 to 200'
              },

                remote: {
              
              message: 'The email ID already exists..',
              url: 'emailcheck.php',
              type: 'POST',
              async: true,
              
                 
              
              
                
          
            },
    
                }
            },
      */
      
      
      
            }
        }) .on('success.form.bv', function(e) {
           
      
           

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
      
            jQuery.ajax({
                type: "POST",
                url: 'ajaxcreatemodule.php', 
                data: $("#register-form").serialize(), 
                timeout: 7000,
        beforeSend: function()
      { 
        
        
        
        setTimeout(
        function() 
        {
        $("#btn-login").html('</span> <img src="ajax-loader.gif" /> &nbsp; Connected to the database ...');
        
        }, 1000)
        
        setTimeout(
        function() 
        {
        $("#btn-login").html('</span> <img src="ajax-loader.gif" /> &nbsp; Creating the user ...');
        
        }, 2000);
        
        
      
      
      
      
        setTimeout(
        function() 
        {
          
        $("#btn-login").html('<img src="ajax-loader.gif" /> &nbsp; Updating the database...');
      
        
        }, 3000);
        
        $("#btn-login").html('<img src="ajax-loader.gif" /> &nbsp; Connecting to the database ...');
        
      },
        
        
        
        
          success: function(response){
        
    
                if(response == "Successful"){
                setTimeout(function() {


                  response="Module creation was Successful";
          
                  $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create User');
                  $("#error").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');



                }, 6000);




                                }
                
                else if(response == "User Registration Failed")
        {
          console.log(response);
                          setTimeout(function() {


                  
                  $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create User');
                  $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');



                }, 6000);

                                }
    
    
    
    
    
    
    
    
    
    
    
    
        // put on console what server sent back...
    }
            });
        });
    });
</script>
<script>
$(document).ready(function(){
$("select#switchid").change(function(){
  var data = $("#bghimire").serialize();
  var switchid =  $("select#switchid option:selected").attr('value'); 
// alert(country_id); 
  $("#switchid").html( "" );
  $("#city").html( "" );
  if (switchid.length > 0 ) { 
    
   $.ajax({
      type: "POST",
      url: "fetch_state.php",
      data: "switchid="+switchid,
      cache: false,
      beforeSend: function () { 
        $('#modulecode').html('<img src="loader.gif" alt="" width="24" height="24">');
      },
      success: function(html) {    
        $("#modulecode").html( html );
      }
    });
  } 
});
});
</script>