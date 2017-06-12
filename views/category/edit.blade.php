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

                <!-- Page Heading -->
                <div class="Page-heading">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Categories
                                <small>Edit Category</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> Edit Category
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Page content START-->
                <div class="Page-body">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Edit Category
                                </div>

                                <div class="panel-body">
                                    
                                    <form action="">
                                        <!-- add category input-->
                                        <div class="row" id="">
                                            <?php
                                                $subCats = DB::table('categories')->where('parent_id', $category->id)->get();
                                                $i = 1;
                                            ?>
                                            @foreach($subCats as $subCat)
                                                <div class="col-lg-12" id="divrmv-{{ $i }}">
                                                    <div class="input-group margin-bottom-15">
                                                        <label>Category Name</label>
                                                            <input type="text" class="form-control" value="{{ $subCat->name }}">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default margin-top-22" type="button"><span class="glyphicon glyphicon-remove" id="rmv-{{ $i }}"></span></button>
                                                            </span>
                                                    </div>
                                                </div>
                                                <?php
                                                    $i++;
                                                ?>
                                            @endforeach

                                            <!-- <div class="col-lg-12" >
                                                <div class="input-group margin-bottom-15">
                                                    <label>Category Name</label>
                                                    <input type="text" class="form-control" value="Category 02">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default margin-top-22" type="button"><span class="glyphicon glyphicon-remove" ></span></button>
                                                    </span>
                                                </div>
                                            </div> -->

                                            <div class="col-lg-12">
                                                <div class="input-group margin-bottom-15">
                                                    <label>Parent Category</label>
                                                    <select class="form-control" id="cate-select">
                                                        @foreach($pCategories as $pCategory)
                                                <option value="{{ $pCategory->id }}" {{ $pCategory->id == $category->id ? 'selected="selected"' : '' }}>{{ $pCategory->name }}</option>
                                            @endforeach
                                                    </select>
                                                    <input type="text" id="parent-cat-hidden" class="form-control hidden">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default margin-top-22" id="edit-cat-name" type="button"><span class="glyphicon glyphicon-edit"></span></button>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-lg-12">
                                                <!-- Edit button for Use -->
                                                <!-- <button class="btn btn-info pull-right">Edit</button> -->

                                                <div class="">
                                                    <button class="btn btn-info pull-right  margin-left-10">Save</button> 
                                                    <a href='{{ url("/category") }}'><button class="btn btn-warning pull-right" type="button">Cancel</button></a>
                                                </div>
                                            </div>
                                        </div>
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
            $('[id^="rmv"]').click(function(){
                var id = $(this).attr('id');
                var items = id.split('-');
                $('#divrmv-'+items[1]).remove();
            });
        });
    </script>
@endsection