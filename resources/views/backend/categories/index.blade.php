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
        <div class="col-4">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{$title}}</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                @can('create_users')
                <input type="text" row_id="0" class="form-control parent_cat" value="">
                <button type="button" cat_type="1" name='view' class="btn btn-primary create_cats float-right">
                    <i class="fas fa-plus-square"></i>
                    <span class="hide-menu"> Submit </span>
                </button>
                @endcan
                    <table id="user_list_tbl" class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Purchase Category</th>
                                <th>{{__('messages.action_td')}}</th>
                            </tr>
                            </head>
                        <tbody class="admin_cat_lists_data">
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-4">
        <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{$title}}</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                @can('create_users')
                <input type="text" row_id="0" class="form-control prodct_cat" value="">
                <button type="button" cat_type="2" name='view' class="btn btn-primary create_cats float-right">
                    <i class="fas fa-plus-square"></i>
                    <span class="hide-menu"> Submit </span>
                </button>
                @endcan
                    <table id="user_list_tbl" class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Product Category</th>
                                <th>{{__('messages.action_td')}}</th>
                            </tr>
                            </head>
                        <tbody class="product_cat_lists_data">
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-4">
        <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{$title}}</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                @can('create_users')
                <br>
                <input type="hidden" class="product_sub_cat_id" name="product_sub_cat_id" value="0">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Parent Category</label>

                        <div class="col-md-8">
                            <select class="form-control parent_cat_list" required autofocus></select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Sub Category</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control sub_category_name" name="email"
                                placeholder="sub category" required>
                        </div>
                    </div>
                <button type="button" name='view' class="btn btn-primary float-right"
                    id="create_new_subs_cat">
                    <i class="fas fa-plus-square"></i>
                    <span class="hide-menu"> Submit </span>
                </button>
                <br>
                <br>
                @endcan
                    <table id="user_list_tbl" class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Product Category</th>
                                <th>Product sub Category</th>
                                <th>{{__('messages.action_td')}}</th>
                            </tr>
                            </head>
                        <tbody class="product_sub_cat_lists_data">
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col">
        <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">{{$title2}}</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
                @can('create_users')
                <button type="button" name='view' class="btn btn-primary float-right"
                    id="create_new_vendors">
                    <i class="fas fa-plus-square"></i>
                    <span class="hide-menu"> {{__('messages.create_new')}} </span>
                </button>
                @endcan
                    <table id="user_list_tbl" class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Vendor name</th>
                                <th>Vendor Email</th>
                                <th>Vendor Phone</th>
                                <th>Vendor Address</th>
                                <th>{{__('messages.action_td')}}</th>
                            </tr>
                            </head>
                        <tbody class="vendor_lists_data">
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- End Default Light Table -->

</div>
@endcan

<!-- Add new vendor Modal -->
<div class="modal fade" id="new_vendor_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vendors</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="commn_message"></div>
                <form method="POST" id="vendor_create" class="">
                    @csrf
                    <input type="hidden" class="vendor_id" name="vendor_id" value="0">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">{{__('messages.name')}}</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control" name="name" required autofocus
                                placeholder="{{__('messages.name')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">{{__('messages.email')}}</label>
                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control" name="email"
                                placeholder="{{__('messages.email')}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label">{{__('messages.outlet_phone')}}</label>
                        <div class="col-md-8">
                            <input id="phone" type="text" class="form-control" name="phone"
                                placeholder="{{__('messages.outlet_phone')}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address"
                            class="col-md-4 col-form-label">Address</label>
                        <div class="col-md-8">
                                <input id="address" type="text" class="form-control"
                                name="address" placeholder="{{__('messages.address')}}" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="new_vendor_save">{{__('messages.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Add new Vendor Modal End -->


@endsection