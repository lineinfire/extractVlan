<?php
  if (isset($_GET['success']) && $_GET['success'] == true)
  {
?>
    <script>alert("The IP address has been updated!!!");</script>
<?php
  }
  else if (isset($_GET['success']))
  {
?>
    <script>alert("ERROR! The IP address could not be updated!!!");</script>
<?php
  }
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.semanticui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css" rel="stylesheet">
<table id="example" class="display table table-responsive">
  <thead>
    <tr>
      <th id="name">Name</th>
      <th>IP Family</th>
      <th>IP Type</th>
      <th>IP Address</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>


<script type="text/javascript">

  $(document).ready(function(){
    var table =  $('#example').DataTable({

      processing: false,
      serverSide: false,
      deferRender: false,
      responsive: true,     

      "order": [],
      "ajax": {
        "url": "getdatas.php",
        "dataSrc": ""
      },

      "columns": [
      { "data": "name.0" },
      { "data": "ipfamily.0" },
      { "data": "hosttype.0" },
      { "data": "ipaddress.0" },
      { "data": "action" },
      ],

      select: {
        style: 'os',
        selector: 'td:first-child'
      },

      fnDrawCallback: function() {

        $('#example tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
          }
          else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
          }
        } );


        $(".bghimire").off('click').click(function(e){
        // var rows = table.rows( 0,0 ).data();
        var $row = $(this).closest("tr"),        
        $tds = $row.find("td:nth-child(1)"); 

        $.each($tds, function() {                
          // alert($(this).text()); 
        });


         // var bla = dt.row({selected: true}).data().["name.0"];
         swal({
          title: 'Are you sure?',
          text: "You are about to terminate device connection!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Proceed with termination!',
          showLoaderOnConfirm: true,

          preConfirm: function() {
            return new Promise(function(resolve) {
             e.preventDefault()
             $.ajax({
              url: 'ajax/kickmac.php',
              type: 'POST',
              data: {mca:macid},
              
            })
             .done(function(response){
              swal('MAC has been successfully terminated from device.', response.message, response.status);


            })
             .fail(function(){
              swal('Oops...', 'Something went wrong with ajax !', 'error');
            });
           });
          },
          allowOutsideClick: false        
        }); 
       });

      }
    }); 
    // setInterval( function () {
    //   table.ajax.reload();
    // }, 30000 );

  });
</script>