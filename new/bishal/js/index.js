
var form = $('.form');
var btn = $('#submit');
var topbar = $('.topbar');
var input = $('#password');
var input = $('#username');
var article =$('.article');
var tries = 0;
var data = $(".form").serialize();
var h = input.height();
$('.spanColor').height(h+23);
$('#findpass').on('click',function(){
  $(this).text('this-is-soo-cool');
});
input.on('focus',function(){
  topbar.removeClass('error success');
  input.text('');
});

btn.on('click',function(){
  if(tries<=3){
    var user = $('#username').val();
    var pass = $('#password').val();

    $.ajax({
      type : 'POST',
      url  : 'test.php',
   data: { username: $("#username").val(), password: $("#password").val() },

 
          success :  function(response)
         {            
          if(response =="success"){
            
            
        setTimeout(function(){
      btn.text('Authentication Successful!');
    },-1000);
    topbar.addClass('success');
    form.addClass('goAway');
    
    tries=0;
     setTimeout(function(){
    top.location.href="dashboard.php";

  },1000);
            
          }
          else if (response=="Account Disabled.") {

                  setTimeout(function(){
      btn.text('Account Disabled!');
    },-100);
                  topbar.addClass('error');

    input.prop('disabled',true);
      
      input.addClass('disabled');



          }
       

//else block

 else {
      topbar.addClass('error');
      tries++;
      switch(tries){
        case 0:
          btn.text('Login');
          break;
        case 1:
          setTimeout(function(){
          btn.text('You have 2 tries left');
          },500);
          break;
        case 2:
          setTimeout(function(){
          btn.text('Only 1 more');
          },500);
          break;
        case 3:
          setTimeout(function(){
          btn.text('Recover password?');
          },500);
          input.prop('disabled',true);
          topbar.removeClass('error');
          input.addClass('disabled');
          btn.addClass('recover');
          break;
         defaut:
          btn.text('Login');
          break;
      }
    }










        }


    


});




  }
  
  
});






$('.form').keypress(function(e){
   if(e.keyCode==13)
   submit.click();
});
input.keypress(function(){
  topbar.removeClass('success error');
});