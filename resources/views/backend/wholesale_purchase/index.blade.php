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
            <h3 class="page-title">{{$title}}</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    <div class="row" id="div">
        
        <div class="col">
        <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{$title2}}</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                @can('create_users')
                <button type="button" name='view' class="btn btn-primary float-right"
                    id="create_new_wholesale_purchases">
                    <i class="fas fa-plus-square"></i>
                    <span class="hide-menu"> {{__('messages.create_new')}} </span>
                </button>
                @endcan
                    <table id="user_list_tbl" class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Vendor name</th>
                                <th>Item name</th>
                                <th>Category name</th>
                                <th>weight</th>
                                <th>Price</th>
                                <th>{{__('messages.action_td')}}</th>
                            </tr>
                            </head>
                        <tbody class="wholesale_purchase_lists_data">
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- End Default Light Table -->

</div>
@endcan

<!-- Add new wholesale purchase Modal -->
<div class="modal fade" id="new_wholesale_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Wholesale purchase</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="commn_message"></div>
                <form method="POST" id="wholsale_purchase_create" class="">
                    @csrf
                    <input type="hidden" class="wholesale_purchase_id" name="wholesale_purchase_id" value="0">
                    <div class="form-group row">
                        <label for="select_vendor" class="col-md-4 col-form-label">Vendor Name</label>
                        <div class="col-md-8">
                            <select name="select_vendor" class="form-control select_a_vendor" required autofocus></select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="item_names" class="col-md-4 col-form-label">Item name</label>
                        <div class="col-md-8">
                            <input id="item_names" type="email" class="form-control item_namess" name="item_names"
                                placeholder="Item Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="select_a_purchase_cat" class="col-md-4 col-form-label">Category</label>
                        <div class="col-md-8">
                        <select name="select_a_purchase_cat" class="form-control select_a_purchase_cat" required autofocus></select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="weight"
                            class="col-md-4 col-form-label">Weight</label>
                        <div class="col-md-8">
                                <input id="weight" type="number" class="form-control weight"
                                name="weight" placeholder="weight" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price"
                            class="col-md-4 col-form-label">Price</label>
                        <div class="col-md-8">
                                <input id="price" type="number" class="form-control price"
                                name="price" placeholder="price" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="new_wholesale_purchase_save">{{__('messages.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Add new Vendor Modal End -->


@endsection