
    $(document).ready(function() {
        $('#searchbymac')
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

                          macid: {
                        validators: {
                            notEmpty: {
                                message: 'The mac address is required and can\'t be empty'
                            },
                       
                            regexp: {
                                regexp: /^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/,
                                message: 'Please provide a valid MAC Address'
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
                var data = $("#searchbymac").serialize();
                $.ajax({
                    type: 'POST',
                    url: '../pages/ajax_searchbymac.php',
                    data: data,
                      beforeSend: function() {
                       
                       
                        $("#loading").fadeIn();  
                        $("#submit").attr("disabled", true);
                    },
                success: function(response) {
                     $("#error").html(response);
                     $("#loading").hide();
                    }
                });
            });
    });
  