@extends('layouts.master')

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Product List</span>
                    </li>
                </ul>
        
                <!-- page toolbar START-->

                <!-- page toolbar END-->
            </div>
            <!-- END PAGE BAR -->
            
            <!-- BEGIN PAGE TITLE-->
            <!-- <h3 class="page-title"> Dashboard
            </h3> -->
            <!-- END PAGE TITLE-->

            <!-- END PAGE HEADER-->
            <!-- Users page content START-->
            <div>

                <!-- BEGIN MAIN CONTENT AREA-->
                <div class="page-main-content user-details margin-bottom-30">
                <form action="update-usa-user_profilee" method="post" id="usa_profile_form">
                    <div class="common-section ">
                    	{{ csrf_field() }}
                        <div class="row">
                        	<input type="hidden" readonly="" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $roleOfUser->userProfile->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" readonly="" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select class="form-control" disabled="" name="role_id">
                                        @foreach($roles as $role)
    										<option value="{{ $role->role_id }}" {{ $roleOfUser->role->role_id == $role->role_id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
    									@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            	<div class="alert alert-danger" id="usa_profile_error" style="display: none;">
						            <button class="close" data-close="alert"></button> 
                                    <div id="usa_profile_error_show">
                                        
                                    </div>
						        </div>

						        <div class="alert alert-success" id="usa_profile_success" style="display: none;">
						            <button class="close" data-close="alert"></button> 
                                    <div id="usa_profile_success_show">
                                        
                                    </div>
						        </div>
						    </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-success pull-right margin-top-10 clear" type="submit" onclick="usaProfileSubmit(event)">Update</button>
                            </div>   
                        </div>
                    </div>
                </form>
                </div>
                <!-- END MAIN CONTENT AREA -->
            </div>

            <!-- Users page content END-->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection


@section('js')

	<script>
        	function usaProfileSubmit(e) {
        		e.preventDefault();
        		var formData = $("#usa_profile_form").serialize();
        		var url = "{{ url('update-usa-user_profile') }}";
                if ($("#name").val().trim() == '') {
                    $("#usa_profile_error_show").text("Please enter name");
                    $("#usa_profile_error").show();
            	}  else {          
            		$.ajax({
	                type: "POST",
	                url: url,
	                data: formData,
	                dataType: "json",
	                success: function (data) {
                        $('#testId').prop('disabled', true);

	                    $("#usa_profile_success_show").text("Profile Update Successfully");
            			$("#usa_profile_success").show();
            			//$("#usa_profile_form")[0].reset();
            			$(".username").html($("#name").val());
	                },
	                error: function (errors) {
	                    $('#usa_profile_success_show').text('');

	                    $.each(errors.responseJSON, function (key, error) {
	                        $('#usa_profile_success_show').append('<span>'+error+'</span><br>');
	                    });

	                    $('#usa_profile_success').show();

                        $('#testId').prop('disabled', false);
	                }
            	});
            	}
            	
        	}
        </script>

@endsection