
    $(document).ready(function() {
        $('#changevlan')
            .bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    newvlan: {
                        message: 'The vlan id not valid',
                        validators: {
                            notEmpty: {
                                message: 'The vlan id is required and can\'t be empty'
                            },
                            stringLength: {
                                max: 2,
                                message: 'The  vlan id must be 2 digit long'
                            },
                            regexp: {
                                regexp: /[1-9]/,
                                message: 'please enter the valid vlan id'
                            }
                        }
                    },
  

                 portid: {
                        validators: {
                            notEmpty: {
                                message: 'The Port ID is required and can\'t be empty'
                            },
    
                            regexp: {
                                regexp: /^(2[0-4]|1[0-9]|[1-9])$/,
                                message: 'Please provide a valid portid'
                            }

                        }
                    },


                              switchcode: {
                        validators: {
                            notEmpty: {
                                message: 'Switch Location is required and can\'t be empty'
                            },
                    
                        }
                    },
                    
                }
            })
            .on('success.form.bv', function(e) {
                // Prevent form submission
                e.preventDefault();
                // Get the form instance
                var $form = $(e.target);
                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');
                // Use Ajax to submit form data
                var data = $("#changevlan").serialize();
                $.ajax({
                    type: 'POST',
                    url: '../pages/update_vlan.php',
                    data: data,
                      beforeSend: function() {
                       
                       
                        $("#loading").fadeIn();  
                        $("#submit").attr("disabled", true);
                    },
                success: function(response) {
                        if (response == "Update Successful") {
                          // alert ("Database Successfully Updated");
                        

                          $("#error").html('<div class="alert alert-success" role="alert"><strong>Success!</strong> Vlan has been successfully updated.</div>');
                    $("#loading").hide();  




                        } else {
                         alert ("Updated failed");
                        }
                    }
                });
            });
    });
  