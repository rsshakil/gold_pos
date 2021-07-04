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
                    <h6 class="m-0">{{$title}}</h6>
                </div>
                <div class="card-body p-0 pb-3 text-center">
              
                    <table id="user_list_tbl" class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Voucher Number</th>
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Total weight</th>
                                <th>Sale amount</th>
                                <th>Discount Amount</th>
                                <th>Due amount</th>
                                <th>Order Date</th>
                                <th>{{__('messages.action_td')}}</th>
                                <th></th>
                            </tr>
                            </head>
                        <tbody class="orders_lists_data">
                            
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- End Default Light Table -->

</div>
@endcan

<!-- Add new user Modal -->
<div class="modal fade" id="new_outlet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.add_outlet')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="outlet_message"></div>
                <form method="POST" id="outlet_create" class="">
                    @csrf
                    <input type="hidden" class="outlet_id" name="outlet_id" value="0">
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
                        <label for="outlet_phone" class="col-md-4 col-form-label">{{__('messages.outlet_phone')}}</label>
                        <div class="col-md-8">
                            <input id="outlet_phone" type="text" class="form-control" name="outlet_phone"
                                placeholder="{{__('messages.outlet_phone')}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address"
                            class="col-md-4 col-form-label">{{__('messages.address')}}</label>
                        <div class="col-md-8">
                                <input id="address" type="text" class="form-control"
                                name="address" placeholder="{{__('messages.address')}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="outlet_opentime"
                            class="col-md-4 col-form-label">{{__('messages.outlet_opentime')}}</label>
                        <div class="col-md-8">
                                <input id="outlet_opentime" type="text" class="form-control"
                                name="outlet_opentime" placeholder="{{__('messages.outlet_opentime')}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="outlet_closetime"
                            class="col-md-4 col-form-label">{{__('messages.outlet_closetime')}}</label>
                        <div class="col-md-8">
                                <input id="outlet_closetime" type="text" class="form-control"
                                name="outlet_closetime" placeholder="{{__('messages.outlet_closetime')}}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="weekend_day"
                            class="col-md-4 col-form-label">{{__('messages.weekend_day')}}</label>
                        <div class="col-md-8">
                                <input id="weekend_day" type="text" class="form-control"
                                name="weekend_day" placeholder="{{__('messages.weekend_day')}}" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="new_outlet_save">{{__('messages.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Add new user Modal End -->
@endsection