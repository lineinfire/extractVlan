
    $(document).ready(function() {
        $('#register-form')
            .bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    emp_vlanid: {
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
                    emp_ip: {
                        validators: {
                            notEmpty: {
                                message: 'The ip address is required and can\'t be empty'
                            },
                              remote: {
                            message: 'The IP Address has already been registered',
                            method: 'POST',
                            url: '../validation/ip.php',
                        },
                            regexp: {
                                regexp: /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/,
                                message: 'The IP can only consist of a valid IP address'
                            }

                        }
                    },
                      phoneip: {
                        validators: {
                            notEmpty: {
                                message: 'The IP Phone Address is required and can\'t be empty'
                            },
                              remote: {
                            message: 'The IP Phone Address has already been registered',
                            method: 'POST',
                            url: '../validation/phoneip.php',
                        },
                            regexp: {
                                regexp: /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/,
                                message: 'The IP can only consist of a valid IP address'
                            }

                        }
                    },


                     emp_mac: {
                        validators: {
                            notEmpty: {
                                message: 'The mac address is required and can\'t be empty'
                            },
                              remote: {
                            message: 'This MAC ID has already been registered',
                            method: 'POST',
                            url: '../validation/macid.php',
                        },
                            regexp: {
                                regexp: /^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/,
                                message: 'Please provide a valid MAC Address'
                            }

                        }
                    },



                        emp_port: {
                        validators: {
                            notEmpty: {
                                message: 'The Port ID is required and can\'t be empty'
                            },
                              remote: {
                            message: 'This port ID has already been registered',
                            method: 'POST',
                            url: '../validation/portid.php',
                            data: {
          switchcode: function() {
            return $( "#switchcode" ).val();
          }
        }
                        },
                            regexp: {
                                regexp: /^(2[0-4]|1[0-9]|[1-9])$/,
                                message: 'Please provide a valid portid'
                            }

                        }
                    },




         department: {
                        validators: {
                            notEmpty: {
                                message: 'department is required and can\'t be empty'
                            },
                    
                        }
                    },
                         



                              switchcode: {
                        validators: {
                            notEmpty: {
                                message: 'Switch Location is required and can\'t be empty'
                            },
                    
                        }
                    },
                         

                              supervisor: {
                        validators: {
                            notEmpty: {
                                message: 'Supervisor is required and can\'t be empty'
                            },
                    
                        }
                    },







                              emp_name: {
                        validators: {
                            notEmpty: {
                                message: 'Employee name is required and can\'t be empty'
                            },
                    
                        }
                    },
                                emp_address: {
                        validators: {
                            notEmpty: {
                                message: 'Employee address is required and can\'t be empty'
                            },
                    
                        }
                    },


                              email: {
                        validators: {
                            notEmpty: {
                                message: 'The email address is required and can\'t be empty'
                            },

                                      remote: {
                            message: 'The Email Address has already been registered',
                            method: 'POST',
                            url: '../validation/email.php',
                        },

                          regexp: {
                                regexp: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
                                message: 'Please enter a valid email address'
                            }
                        }
                    },



                              emp_mobile: {
                        validators: {
                            notEmpty: {
                                message: 'The mobile number is required and can\'t be empty'
                            },

                                      remote: {
                            message: 'The Mobile number has already been registered',
                            method: 'POST',
                            url: '../validation/mobile.php',
                        },
                            regexp: {
                                regexp: /^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)/,
                                message: 'Please enter a valid mobile number'
                            }

                        }
                    },
                       













                    emp_extension: {
                        validators: {
                            notEmpty: {
                                message: 'The extension number is required and can\'t be empty'
                            },
                                    remote: {
                            message: 'The Entension Number has already been registered',
                            method: 'POST',
                            url: '../validation/extension.php',
                        },
                            regexp: {
                                regexp: /^[0-9]{3}$/,
                                message: 'The extension number can only consist of three digit'
                            }
                        }
                    }
                    
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
                var data = $("#register-form").serialize();
                $.ajax({
                    type: 'POST',
                    url: '../pages/insert.php',
                    data: data,
               
                    success: function(response) {
                        if (response == "Connection succes") {
                              $("#error").html('<div class="alert alert-success" role="alert"><strong>Success!</strong> Node Successfully Registered..</div>');
                    $("#loading").hide();  

                        } else {
                           alert ("Updated failed");
                        }
                    }
                });
            });
    });
  