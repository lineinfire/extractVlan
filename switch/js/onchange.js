$(document).on('change', '#portid', function() { 
    var id = $(this).find(':selected')[0];
      $.ajax({
        type: 'POST',
        url: 'getdata.php',
                               data: {
          switchcode: function() {
            return $( "#switchcode" ).val();
          },
          portid: function() {
            return $( "#portid" ).val();
          }

        },
        success: function (response) {
            // the next thing you want to do 
              var result = JSON.parse(response);
 				$("#empname").attr('type','disabled');
               $("#empname").val(result[0].name);
               $("#currentvlan").attr('type','disabled');
			$("#currentvlan").val(result[0].vlanid);
			$("#id").val(result[0].id);
            
          
          

            //manually trigger a change event for the contry so that the change handler will get triggered
            
        }
    });










});