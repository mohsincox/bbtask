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
                    <div class="common-section ">
                        <form id="update_supplier_form">
                        	{{ csrf_field() }}
                            <div class="row">
                            	<input type="hidden" readonly="" class="form-control" id="user_profile_id" name="user_profile_id" value="{{ $roleOfUser->userProfile->user_profile_id }}">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $roleOfUser->userProfile->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" readonly="" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Role</label>
                                        <select class="form-control" disabled="" name="role_id">
                                    		@foreach($roles as $role)
												<option value="{{ $role->role_id }}" {{ $roleOfUser->role->role_id == $role->role_id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
											@endforeach
                                		</select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Email for shipping portal notifications</label>
                                        <input type="email" class="form-control" id="shipping_portal_email" name="shipping_portal_email" value="{{ $roleOfUser->userProfile->shipping_portal_email }}">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ $roleOfUser->userProfile->address }}">
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="">Export Country</label>
                                        <select class="form-control" id="export_country_id" name="export_country_id">
                                            @foreach($countries as $country)
												<option value="{{ $country->country_id }}" {{ $roleOfUser->userProfile->export_country_id == $country->country_id ? 'selected="selected"' : '' }}>{{ $country->name }}</option>
											@endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Shipping Port</label>
                                        <select class="form-control" id="shipping_port_id" name="shipping_port_id">
                                            @foreach($shippingPorts as $shippingPort)
												<option value="{{ $shippingPort->shipping_port_id }}" {{ $roleOfUser->userProfile->shipping_port_id == $shippingPort->shipping_port_id ? 'selected="selected"' : '' }}>{{ $shippingPort->name }}</option>
											@endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <!-- <label for="">Phone</label>
                                        <input type="text" class="form-control" id=""> -->
                                        <?php 
                                            $i = 1;
                                        ?>
                                        @foreach($phoneArray as $key=>$phone)
                                        	@if($key == 0)
                                        	<div class="row">
                                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="">Phone</label>
                                                        
                                                        <input type="text" class="form-control" name="phone[]" value="{{ $phone }}" id="phone-{{ $i }}">

                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-1 col-md-1 col-sm-2 text-right col-xs-12 lg-padding-left-10">
                                                    <a href="javascipt:;" class="xs-w100 btn btn-primary xs-pull-right point-plus-icon more-phone-btn margin-right-2">
                                                        <i class="icon-plus icons"></i>
                                                    </a>
                                                </div>

                                                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 lg-padding-left-10">
                                                    <a href="javascipt:;" class="xs-w100 btn btn-danger point-plus-icon pull-right remove-phone-btn" disabled>
                                                        <i class="icon-minus icons"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        	@else
                                        		<div class="dynamic-phone-section">
        											<div class="row">
            											<div class="col-sm-10 col-xs-12">
                											<div class="form-group">
                												<input type="text" class="form-control" name="phone[]" value="{{ $phone }}" id="phone-{{ $i }}">
               		 										</div>
            											</div>
            											<div class="col-lg-1 col-md-1 col-sm-2 text-right col-xs-12 lg-padding-left-10">
                											<a href="javascipt:;" class="margin-right-2 btn btn-primary xs-pull-right more-phone-btn">
                												<i class="icon-plus icons"></i>
                											</a>
            											</div>
            											<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 lg-padding-left-10">
            												<a href="javascipt:;" class="btn btn-danger remove-phone-btn pull-right">
            												<i class="icon-minus icons"></i>
            												</a>
            											</div>
        											</div>
        										</div>
                                        	@endif
                                            <?php 
                                                $i++;
                                            ?>
                                        @endforeach

                                        <div class="more-phone">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive margin-top-10">          
                                <table class="table table-striped table-hover table-bordered product-item">
                                    <thead>
                                        <tr>
                                            <th>Point of Contacts</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th class="w7 sm-w11"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php 
                                    		$j = 1;
                                    	?>
                                    	@foreach($jsonDeData as $key=>$data)
                                    		
                                        <tr>
                                            <td><input class="form-control" id="point_of_contacts-{{ $j }}" name="point_of_contacts[]" value="{{ $data->point_of_contract }}"></td>
                                            <td><input class="form-control" name="role[]" id="role-{{ $j }}" value="{{ $data->role }}"></td>
                                            <td><input class="form-control" id="contact_email-{{ $j }}" name="contact_email[]" value="{{ $data->email }}"></td>
                                            <td>
                                                <span>
                                                    <a class="btn btn-primary point-plus-icon po-add-tr more-profile-info" href="javascript:;">
                                                        <i class="icon-plus icons"></i>
                                                    </a>
                                                </span>
                                                @if($key == 0)
                                                <span>
                                                    <a class="btn btn-danger point-plus-icon pull-right margin-top-01" disabled="" href="javascript:;">
                                                        <i class="icon-minus icons"></i>
                                                    </a>
                                                </span>
                                                @else
                                                <span>
                                                    <a class="btn btn-danger point-plus-icon pull-right remove-profile-btn margin-top-01" href="javascript:;">
                                                        <i class="icon-minus icons"></i>
                                                    </a>
                                                </span>
                                                @endif
                                            </td>
                                        </tr>
                                        	
                                        <?php 
                                            $j++;
                                        ?>	
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="alert alert-danger" id="supplier_update_error" style="display: none;">
                                <button class="close" data-close="alert"></button> 
                                <div id="supplier_update_error_show">
                                            
                                </div>
                            </div>

                            <div class="alert alert-success" id="supplier_update_success" style="display: none;">
                                <button class="close" data-close="alert"></button> 
                                <div id="supplier_update_success_show">
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-success pull-right margin-top-10 clear" onclick="supplierUpdateSubmit(event)">Update</button>
                                </div>   
                            </div>
                        </form>
                    </div>

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

    <script type="text/javascript">
        function supplierUpdateSubmit(e) {
                
                e.preventDefault();
                var formData = $("#update_supplier_form").serialize();
                var url = "{{ url('update_supplier_profile') }}";
                //console.log(formData);return;
                var submit_form = true;

                var search_c_email_array = $('input[name="contact_email[]"]').map(function(){return $(this).val();}).get();
                    
                if ($("#name").val().trim() == '') {
                    $("#supplier_update_error_show").text("Please enter name");
                    $("#supplier_update_error").show();
                    submit_form = false;
                }  else if ($("#address").val().trim() == '') {
                    $("#supplier_update_error_show").text("Please enter address");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if ($("#shipping_portal_email").val().trim() == '') {
                    $("#supplier_update_error_show").text("Please enter shipping portal email");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if (!validateEmail($("#shipping_portal_email").val())) {
                    $("#supplier_update_error_show").text("Shipping portal email is not valid");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if ($("#export_country_id").val().trim() == '') {
                    $("#supplier_update_error_show").text("Please select export country");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if ($("#shipping_port_id").val().trim() == '') {
                    $("#supplier_update_error_show").text("Please select shipping port");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if ($("#phone-1").val().trim() == '') {
                    $("#supplier_update_error_show").text("Please enter phone");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if ($("#point_of_contacts-1").val().trim() == '') {
                    $("#supplier_update_error_show").text("Please enter point of contacts");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if ($("#role-1").val().trim() == '') {
                    $("#supplier_update_error_show").text("Please enter role");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if ($("#contact_email-1").val().trim() == '') {
                    $("#supplier_update_error_show").text("Please enter contact email");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if (!validateEmail($("#contact_email-1").val())) {
                    $("#supplier_update_error_show").text("Contact email is not valid");
                    $("#supplier_update_error").show();
                    submit_form = false;
                } else if ( search_c_email_array.length > 0) {

                    var arrayLength = search_c_email_array.length;
                    for (var i = 0; i < arrayLength; i++) {
                        if(search_c_email_array[i] != '' ){
                            if (!validateEmail(search_c_email_array[i])) {
                                $("#supplier_update_error_show").text("Contact email is not valid");
                                $("#supplier_update_error").show();
                                submit_form = false;
                            }
                        }
                       
                    }
                    
                }

                if(submit_form) {
                    $('#testId').prop('disabled', true);
                    //alert('fdgkjkfjg');return;
                   
                    $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    dataType: "json",

                    success: function (data) {
                        $("#supplier_update_success_show").text("Update Successfully");
                        $("#supplier_update_success").show();
                        //$("#update_supplier_form")[0].reset();
                        $(".username").html($("#name").val());
                        if(data) {
                                //console.log(data);return;
                                //window.location.href = '/hedayafashion/home';
                                
                            }
                       },
                       error: function (errors) {
                        $('#supplier_update_error_show').text('');

                        $.each(errors.responseJSON, function (key, error) {
                            $('#supplier_update_error_show').append('<span>'+error+'</span><br>');
                        });

                        $('#supplier_update_error').show();
                        $('#testId').prop('disabled', false);
                       }
                   });
                }

            }

            function validateEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            }
       // $(document).on("keyup",'[id^="phone"]',function(){
       //      var id = $(this).attr('id');
       //      var items = id.split('-');
       //      var phn = $("#phone-"+items[1]).val();
       //      console.log(phn);
       //  });

    
    </script>
	<script type="text/javascript">
            $(document).ready(function() {
                $('#product-table').DataTable({
                    paging: false,
                    searching: false,
                    bInfo : false
                });
            });


            // profile info feild repeat START
            $(document).on("click",".more-profile-info",function(){      
                var dynamic_content = '<tr>';
                    dynamic_content+='<td><input class="form-control" name="point_of_contacts[]"></td>';
                    dynamic_content+='<td><input class="form-control" name="role[]"></td>';
                    dynamic_content+='<td><input class="form-control" name="contact_email[]"></td>';
                    dynamic_content+='<td>';
                    dynamic_content+='<span>';
                    dynamic_content+='<a class="btn btn-primary point-plus-icon po-add-tr more-profile-info" href="javascript:;">';
                    dynamic_content+='<i class="icon-plus icons"></i>';
                    dynamic_content+='</a>';
                    dynamic_content+='</span>';
                    dynamic_content+='<span>';
                    dynamic_content+='<a class="btn btn-danger point-plus-icon pull-right remove-profile-btn margin-top-01" href="javascript:;">';
                    dynamic_content+='<i class="icon-minus icons"></i>';
                    dynamic_content+='</a>';
                    dynamic_content+='</span>';
                    dynamic_content+='</td>';
                    dynamic_content+='</tr>';

                $(this).parents("tbody").append(dynamic_content);
            });

            $(document).on("click",".remove-profile-btn",function(){
                var content = $(this).parents("tr");
                $(content).remove();
            });
            // Profile Info feild repeat END

            //Phone append
            $(document).on("click",".more-phone-btn",function(){
                var dynamic_content = '<div class="dynamic-phone-section">';
                dynamic_content+='<div class="row">';
                dynamic_content+='<div class="col-sm-10 col-xs-12">';
                dynamic_content+='<div class="form-group">';
                dynamic_content+='<input type="text" class="form-control" id="" name="phone[]">';
                dynamic_content+='</div>';
                dynamic_content+='</div>';
                dynamic_content+='<div class="col-lg-1 col-md-1 col-sm-2 text-right col-xs-12 lg-padding-left-10">';
                dynamic_content+='<a href="javascipt:;" class="margin-right-2 btn btn-primary xs-pull-right more-phone-btn">';
                dynamic_content+='<i class="icon-plus icons"></i>';
                dynamic_content+='</a>';
                dynamic_content+='</div>';
                dynamic_content+='<div class="col-lg-1 col-md-1 col-sm-2 col-xs-12 lg-padding-left-10">';
                dynamic_content+='<a href="javascipt:;" class="btn btn-danger remove-phone-btn pull-right">';
                dynamic_content+='<i class="icon-minus icons"></i>';
                dynamic_content+='</a>';
                dynamic_content+='</div>';
                dynamic_content+='</div>';
                dynamic_content+='</div>';

                $(".more-phone").append(dynamic_content);
            });

            $(document).on("click",".remove-phone-btn",function(){
                var content = $(this).parents(".dynamic-phone-section");
                $(content).remove();
            });

        </script>
@endsection