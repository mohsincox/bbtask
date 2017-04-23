<!DOCTYPE html>
<html lang="en" ng-app="MetronicApp">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>USA User | Sign Up</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{!! asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="http://simplelineicons.com/css/simple-line-icons.css" rel="stylesheet" type="text/css" />
        <link href="{!! asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{!! asset('assets/global/plugins/select2/css/select2.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') !!}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{!! asset('assets/global/css/components.min.css') !!}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{!! asset('assets/global/css/plugins.min.css') !!}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{!! asset('assets/pages/css/login.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('assets/pages/css/custom.css') !!}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        
        <!--Angular Extension-->
        <script src="{!! asset('assets/global/plugins/jquery.min.js') !!}" type="text/javascript"></script>

    </head>
    <!-- END HEAD -->

    <body class="login common-outer-reg">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="javascript:;">
                <img src="{!! asset('assets/layouts/layout/img/logo-new.png') !!}" alt="" /> 
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN SUPPLIER -->
        
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="main-container usa-user">
                        <form action="sign-up-usa-userrr" method="post" id="usa_sign_up_form">
                            <section>
                                <p class="signup-title">USA User Sign Up</p>
                                <small class="red-text error-text">*All fields are mendatory</small>
                                
                                <!-- <h3 class="form-title font-green text-center">General Info</h3> -->
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="" name="id" value="{{ $user->id }}">

                                <div class="row margin-top-15">
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control" id="name">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control" id="password">   
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label for="">User Name</label>
                                            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Re-type Password</label>
                                            <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                        </div>

                                        <div class="alert alert-danger" id="usa_sign_up_error" style="display: none;">
								            <button class="close" data-close="alert"></button> 
								        </div>

								        <div class="alert alert-success" id="usa_sign_up_success" style="display: none;">
								            <button class="close" data-close="alert"></button> 
								        </div>

                                        <!-- <a href="javascript:;" class="btn btn-success pull-right" >Submit</a> -->
                                        <button type="Submit" class="btn btn-success pull-right" onclick="usaSignUpSubmit(event)">Submit</button>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
        	function usaSignUpSubmit(e) {
        		e.preventDefault();
        		var formData = $("#usa_sign_up_form").serialize();
        		var url = "{{ url('sign-up-usa-user') }}";
            	console.log(url);
            	if ($("#password").val() == '' && $("#confirm_password").val() == '') {
            		$("#usa_sign_up_error").text("Please enter password and re-type password");
            		$("#usa_sign_up_error").show();
            	} else if ($("#password").val() == '') {
            		$("#usa_sign_up_error").text("Please enter password");
            		$("#usa_sign_up_error").show();
            	} else if ($("#confirm_password").val() == '') {
            		$("#usa_sign_up_error").text("Please re-type password");
            		$("#usa_sign_up_error").show();
            	} else if ($("#password").val() != $("#confirm_password").val()) {
            		$("#usa_sign_up_error").text("Password and re-type password do not match");
            		$("#usa_sign_up_error").show();
            	} else {
            		$.ajax({
	                type: "POST",
	                url: url,
	                data: formData,
	                dataType: "json",
	                success: function (data) {
	                    $("#usa_sign_up_success").text("Sign Up Successfully");
            			$("#usa_sign_up_success").show();
            			$("#usa_sign_up_form")[0].reset();
	                },
	                error: function (errors) {
	                    // $('#login_error').text('');

	                    // $.each(errors.responseJSON, function (key, error) {
	                    //     $('#login_error').append('<span>'+error+'</span><br>');
	                    // });

	                    // $('#login_error').show().delay(3000).fadeOut('slow');
	                }
            	});
            	}
            	
        	}
        </script>
        <!-- END SUPPLIER -->
        <!-- <div class="copyright"> 2014 © Metronic. Admin Dashboard Template. </div> -->
        <div class="copyright powered-text">
            <span>Powered by</span> 
            <a href="http://blubirdinteractive.com/">Blubird Interactive Limited </a>
        </div>
        <!--[if lt IE 9]>
        <script src="{!! asset('assets/global/plugins/respond.min.js') !!}"></script>
        <script src="{!! asset('assets/global/plugins/excanvas.min.js') !!}"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{!! asset('assets/global/plugins/jquery.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/global/plugins/js.cookie.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/global/plugins/jquery.blockui.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{!! asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}" type="text/javascript"></script> 
        <script src="{!! asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/global/plugins/select2/js/select2.full.min.js') !!}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{!! asset('assets/global/scripts/app.min.js') !!}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{!! asset('assets/pages/scripts/login.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('assets/pages/scripts/signup.js') !!}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>