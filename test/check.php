<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<div style="width:500px; margin: 0 auto;">
<form id="vform" data-toggle="validator" role="form" method="post">
  <div class="form-group">
    <label for="switchName" id="switchName" class="control-label">Name</label>
    <input type="text" class="form-control" id="switchid" value="192.168.7.229">
  </div>
  <span id="error"></span>
  <div class="form-group">
    <label for="vlanID" class="control-label">VLAN ID</label>
    <div class="input-group">
      <input type="text" class="form-control" id="vlanid" onblur="checkvlan()">
    </div>    
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

<script type="text/javascript">
  function checkvlan()
  {
    var vlanid = $("#vlanid").val();
    var switchName = $("#switchid").val();

    var dataString = 'switchid='+ switchName
                        + '&vlanid=' + vlanid
    // console.log(dataString);
    $.ajax({
      type: "POST",
      url: "switch.php",
      data: dataString,      
      success:  function(data){
        // alert(data);
        console.log(data);
        // if json obj. alert(JSON.stringify(data));
      }
    });
  }
</script>