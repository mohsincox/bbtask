@extends('layouts.master')

@section('css')
    <!-- page level plugin START-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datepicker_master/jquery.datetimepicker.css') }}" rel="stylesheet">
    <!-- page level plugin END-->
@endsection

@section('content')
	

	<div id="page-wrapper">
        <div class="main-body-content">
            <div class="container-fluid">

            	@if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
                <!-- Page Heading -->
                <div class="Page-heading">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Create Products
                                <small>products</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-user"></i> Create Products
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Page content START-->
                <div class="Page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Create Products
                                </div>

                                <div class="panel-body">
                                    <form action="product" method="post" enctype="multipart/form-data" id="myform">
                                    	{{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input class="form-control" type="text" name="title" id="title" required="">
                                                </div>
                                                <span id="error_show_title"></span>
                                            </div>

                                            <div class="col-sm-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Price</label>
                                                            <input class="form-control" type="number" name="price">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select name="category_id" id="" class="form-control">
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-8 col-xs-12">
                                                <div class="form-group">
                                                    <label>Url:</label>
                                                    <span id="url"></span><span id="error_show"></span><button type="button" style="display: none;" id="button_edit">Edit</button><button type="button" style="display: none;" id="button_ok">Ok</button>
                                                    <input class="form-control" type="hidden" name="url" id="url_hidden">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 col-xs-12">
                                                <label>Description</label>
                                                <textarea rows="6" name="description">  </textarea>
                                            </div>

                                            <div class="col-sm-6 col-xs-12">
                                                <div class="front-img">
                                                    <label>Front Image Upload</label>
                                                    <label for="files">Select multiple files: </label>
                                                    <input id="files" type="file" class="form-control" multiple name="front_image[]" />
                                                    <output id="result" />
                                                </div>

                                                <div class="download-img">
                                                    <label>Back Image Upload</label>
                                                    <label for="files">Select multiple files: </label>
                                                    <input id="files01" type="file" class="form-control" multiple name="back_image[]" />
                                                    <output id="result01" />
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-primary pull-right margin-top-10" id="submit_button" type="submit">Create Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>
    <!-- /#page-wrapper -->
@endsection

@section('js')
    <!-- page level plugin START-->
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datepicker_master/jquery.datetimepicker.full.js') }}"></script>
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <!-- page level plugin END-->
    <script type="text/javascript">
        $(document).ready(function(){
            $("#title").change(function(){
                // if($("#title").val().trim() == "") {

                // } else {

                // }
                var title = $("#title").val();
                title = title.replace(/\s+/g, '-');
                title = title.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,'');
                var baseUrl = "{{ url('/') }}";
                var slash = "/";
                var fullUrl = baseUrl + slash + title;
                $("#url").text(fullUrl);
                $("#url_title").val(title);
                $("#url_hidden").val(fullUrl);
                $("#button_edit").show();

                var urlHidden = $('#url_hidden').val();
                var url  = "{{ url('/test') }}"
                url = url + "?url="+ urlHidden;
                //console.log(url);
                $.get(url, function (data) {
                    $('#error_show').html(data);
                });

                //var urlHidden = $('#url_hidden').val();
                //var urlTitle  = "{{ url('/product-title-unique') }}"
                var urlTitle  = "{{ url('/product-title-unique') }}"
                urlTitle = urlTitle + "?title="+ title;
                console.log(urlTitle);
                $.get(urlTitle, function (data) {
                    $('#error_show_title').html(data);
                });
            });
        });

        $(document).ready(function(){
            $("#button_edit").click(function(){
                var title = $("#title").val().trim();
                console.log(title);
                title = title.replace(/\s+/g, '-');
                title = title.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,'');
                var baseUrl = "{{ url('/') }}";
                var slash = "/";
                var fullUrl = baseUrl + slash + title;
                var inputField = '<input class="form-control" type="text" style="width: 100px;" id="input_field" value="'+title+'">';
                $("#input_field").val(inputField);
                $("#url").html(baseUrl + slash + inputField);
                $("#button_edit").hide();
                $("#button_ok").show();
            });
        });

        $(document).ready(function(){
            $("#button_ok").click(function(){
                var title = $("#title").val();
                title = title.replace(/\s+/g, '-');
                title = title.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,'');
                var baseUrl = "{{ url('/') }}";
                var slash = "/";
                var retitle = $("#input_field").val();
                retitle = retitle.replace(/\s+/g, '-');
                retitle = retitle.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g,'');
                $("#url").html(baseUrl + slash + retitle);
                $("#url_hidden").val(baseUrl + slash + retitle);
                $("#button_ok").hide();
                $("#button_edit").show();
            });
        });
    </script>
    
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#button_edit', function(){
                var urlHidden = $('#url_hidden').val();
                var url  = "{{ url('/test') }}"
                url = url + "?url="+ urlHidden;
                console.log(url);
                $.get(url, function (data) {
                    $('#error_show').html(data);
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '#button_ok', function(){
                var urlHidden = $('#url_hidden').val();
                var url  = "{{ url('/test') }}"
                url = url + "?url="+ urlHidden;
                console.log(url);
                $.get(url, function (data) {
                    $('#error_show').html(data);
                });
            });
        });
    </script>
@endsection