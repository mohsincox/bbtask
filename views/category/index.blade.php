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
                                View Category
                                <small>Category</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> View Category
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

                            <div class="table-responsive margin-top-40">
                                <table id="category-table" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="50px" class="text-center">SL.</th>
                                            <th>Category Name</th>
                                            <th>Sub category Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="category_list">
                                        <?php
                                            $i = 0;
                                        ?>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td class="text-center text-bold">{{ ++$i }}</td>
                                                <td class="catTd">
                                                    <p class="catName">
                                                        {{ $category->name }}
                                                    </p>
                                                </td>

                                                <td class="catTd">
                                                    <ul class="no-padding no-list-style">
                                                        <?php
                                                            $subCats = DB::table('categories')->where('parent_id', $category->id)->get();
                                                        ?>
                                                        @foreach($subCats as $subCat)
                                                            <li>{{ $subCat->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="text-center">
                                                    <span class="action-icon editBtn">
                                                        <a class="btn btn-primary editProduct" href='{{ url("/category/edit/$category->id") }}' title="Edit">
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </a>
                                                    </span>

                                                    <span class="action-icon deleteBtn">
                                                        <a class="btn btn-danger" id="delProduct" href='{{ url("/category/delete/$category->id") }}' onclick="return  confirm('Delete this product?')" title="Delete">
                                                            <i class="fa fa-minus-circle" aria-hidden="true"></i>
                                                        </a>
                                                    </span>

                                                    <span class="action-icon saveBtn hidden">
                                                        <a class="btn btn-success saveCat" id="" href="javascript:;" title="Save">
                                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
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
    <!-- page level plugin END-->
@endsection