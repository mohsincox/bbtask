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
                                View Products
                                <small>Products</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> View Products
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
                            <div class="relative">
                                <table cellspacing="0" cellpadding="0" border="0" class="datatable-custom-sort">
                                    <tbody>
                                        <tr>
                                            <td>Category : </td>
                                            <td>
                                                <select id="category_id" name="" class="">
                                                    <option value="">All</option>
                                                    <option value="Category 01">Category 01</option>
                                                    <option value="nbmhjkh22">Category 02</option>
                                                    <option value="Category 03">Category 03</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="table-responsive margin-top-40">
                                    <table id="product-table" class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="50px" class="text-center">SL.</th>
                                                <th>Product Title</th>
                                                <th>Category</th>
                                                <th>Created date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="category_list">
                                        	<?php
                                        		$i = 0;
                                        	?>
                                        	@foreach($products as $product)
                                                <?php
                                                    $cDate=date_create($product->created_at);
                                                    $createdAt = date_format($cDate,"d/m/Y");
                                                ?>
	                                            <tr>
	                                                <td class="text-center text-bold">{{ ++$i }}</td>
	                                                <td class="catTd">
	                                                    <a href="{{ $product->url }}">{{ $product->title }}</a>
	                                                </td>
	                                                
	                                                <td class="catTd">
	                                                    <ul class="no-padding no-list-style">
	                                                        <li>{{ $product->category_id }}</li>
	                                                        <li>Category 0102</li>
	                                                    </ul>
	                                                </td>

                                                    <td>{{ $createdAt }}</td>

	                                                <td class="text-center">
	                                                    <span class="action-icon editBtn">
	                                                        <a class="btn btn-primary editProduct" href='{{ url("/product/edit/$product->id") }}' title="Edit">
	                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
	                                                        </a>
	                                                    </span>

	                                                    <span class="action-icon deleteBtn">
	                                                        <a class="btn btn-danger" id="delProduct" href='{{ url("/product/delete/$product->id") }}' onclick="return  confirm('Delete this product?')" title="Delete">
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
        var table;

        $.fn.dataTable.ext.search.push(
            function (settings, data) {
                var statusData = data[1] || "";
                var filterVal = $("#category_id option:selected").val();

                if(filterVal.length > 0)
                {
                    if(statusData == filterVal)
                        return true;
                    else
                        return false;
                }
                else
                    return true;
            }
        );

        $(document).ready(function() {
            table = $('#product-table').dataTable({
                "dom": "<'#myFilter'>rpt"
            });

            table.fnDraw();
        });



        // Event listener to the two range filtering inputs to redraw on input
        $('#category_id').change( function() {
            table.fnDraw();
        } );
        
    </script>
@endsection