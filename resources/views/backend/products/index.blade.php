@extends('backend.layouts.master')
@section('title')
<title>{{__('messages.manage_users')}}</title>
@endsection

@section('content')

@if(Session::get('message'))
<div class="alert {{Session::get('class_name')}} alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <i class="fa fa-check mx-2"></i>
    <strong>{{__('messages.message')}}</strong>{{ Session::get('message') }}

</div>
@endif
@can('retrieve_users')
<div id="user_main_message"></div>
<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <!-- <span class="text-uppercase page-subtitle">Overview</span> -->
            <!-- <h3 class="page-title">{{$title}}</h3> -->
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    <div class="row" id="div">
        <form style="width:100%" action="{{ url('barcode_generator')  }}" method="post">
     
        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{$title}}</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                <span>Total Number of product:</span><span class="total_product"></span>
                <span>Total Weight of product:</span><span class="total_wieght"></span>
                <button class="btn btn-info print_barcode" style="float:right;margin-left:15px;" type="submit">Barcode Print</button>
                @if(Auth::user()->outletid==0)
                <button type="button" outlet_id="0" data_purchase_id="0" data_cat_id="0" data_sub_cat_id="0" row_id="0" class="btn btn-primary edit_products float-right">
                    <i class="fas fa-plus-square"></i>
                    <span class="hide-menu"> {{__('messages.create_new')}} </span>
                </button>
                @endif

                
                    <table id="user_list_tbl" class="table table-striped table-bordered mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th><input type="checkbox" class="form-controll checked_all_product"></th>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Product Carat</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Weight</th>
                                <th>Image</th>
                                <th>Outlet</th>
                                @if(Auth::user()->outletid==0)
                                <th>{{__('messages.action_td')}}</th>
                                @endif
                            </tr>
                            </head>
                        <tbody class="product_lists_data">
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- End Default Light Table -->

</div>
@endcan

<!-- Add new user Modal -->
<div class="modal fade" id="new_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Products</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="outlet_message"></div>
                <form method="POST" id="product_create" enctype="multipart/form-data" class="">
                    @csrf
                    <input type="hidden" class="product_id" name="product_id" value="0">
                    <div class="form-group row">
                        <label for="product_name" class="col-md-4 col-form-label">Product Name</label>

                        <div class="col-md-8">
                            <input id="product_name" type="text" class="form-control" name="product_name" required autofocus
                                placeholder="Product Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product_name" class="col-md-4 col-form-label">Product Carat Type</label>

                        <div class="col-md-8">
                            <select id="product_carat_type" type="text" class="form-control" name="product_carat_type">
                                <option value="22">22 Carat</option>
                                <option value="21">21 Carat</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wholesale_purchase_id" class="col-md-4 col-form-label">Purchase From</label>
                        <div class="col-md-8">
                            <select id="wholesale_purchase_id" class="form-control" name="wholesale_purchase_id"></select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="product_categorie_id" class="col-md-4 col-form-label">Category</label>
                        <div class="col-md-8">
                            <select id="product_categorie_id" class="form-control" name="product_categorie_id"></select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="product_sub_categorie_id" class="col-md-4 col-form-label">Sub Category</label>
                        <div class="col-md-8">
                            <select id="product_sub_categorie_id" class="form-control" name="product_sub_categorie_id"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="outlet_id" class="col-md-4 col-form-label">Outlet</label>
                        <div class="col-md-8">
                            <select id="outlet_id" class="form-control" name="outlet_id"></select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="weight" class="col-md-4 col-form-label">weight</label>
                        <div class="col-md-8">
                            <input id="weight" type="text" class="form-control" name="weight"
                                placeholder="weight" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="product_image"
                            class="col-md-4 col-form-label">product image</label>
                        <div class="col-md-8">
                                <input id="product_image" type="file" class="form-control"
                                name="product_image">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="product_desc"
                            class="col-md-4 col-form-label">product description</label>
                        <div class="col-md-8">
                                <input id="product_desc" type="text" class="form-control"
                                name="product_desc" placeholder="product description" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="new_product_save">{{__('messages.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Add new user Modal End -->
@endsection