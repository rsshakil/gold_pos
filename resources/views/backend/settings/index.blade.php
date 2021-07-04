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
                                <th>Company Name</th>
                                <th>Company Logo</th>
                                <th>Vat tax</th>
                                <th>currency</th>
                                <th>22 carat gold price</th>
                                <th>21 carat gold price</th>
                                <th>22 carat diamond price</th>
                                <th>21 carat diamond price</th>
                                <th>22 carat Platinaam price</th>
                                <th>21 carat Platinaam price</th>
                                <th>Return Decrease percent </th>
                                <th>Purchase decrease percent</th>
                                <th>{{__('messages.action_td')}}</th>
                            </tr>
                            </head>
                        <tbody class="settings_lists_data">
                            
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
<div class="modal fade" id="new_setting_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Settings Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="comn_msgss"></div>
                <form method="POST" id="setting_update" enctype="multipart/form-data" class="">
                    @csrf
                    <input type="hidden" class="setting_id" name="setting_id" value="1">
                    <div class="form-group row">
                        <label for="company_name" class="col-md-4 col-form-label">Company Name</label>

                        <div class="col-md-8">
                            <input id="company_name" type="text" class="form-control company_names" name="company_name" required autofocus
                                placeholder="Company name">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="company_logo" class="col-md-4 col-form-label">Company Logo </label>
                        <div class="col-md-8">
                            <input id="company_logo" type="file" class="form-control company_logos" name="company_logo" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="vat_tax" class="col-md-4 col-form-label">Vat tax</label>
                        <div class="col-md-8">
                            <input id="vat_tax" type="number" class="form-control" name="vat_tax"
                                placeholder="Vat tax" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="platinam_21_carat_price" class="col-md-4 col-form-label">Platinam 21 Carat Price</label>
                        <div class="col-md-8">
                            <input id="platinam_21_carat_price" type="text" class="form-control" name="platinam_21_carat_price"
                                placeholder="Platinam 21 Carat Price" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="platinam_22_carat_price" class="col-md-4 col-form-label">Platinam 22 Carat Price</label>
                        <div class="col-md-8">
                            <input id="platinam_22_carat_price" type="text" class="form-control" name="platinam_22_carat_price"
                                placeholder="Platinam 22 Carat Price" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gold_21_carat_price" class="col-md-4 col-form-label">Gold 21 Carat Price</label>
                        <div class="col-md-8">
                            <input id="gold_21_carat_price" type="text" class="form-control" name="gold_21_carat_price"
                                placeholder="Gold 21 Carat Price" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="gold_22_carat_price" class="col-md-4 col-form-label">Gold 22 Carat Price</label>
                        <div class="col-md-8">
                            <input id="gold_22_carat_price" type="text" class="form-control" name="gold_22_carat_price"
                                placeholder="Gold 22 Carat Price" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="diamond_21_carat_price" class="col-md-4 col-form-label">Diamond 21 Carat Price</label>
                        <div class="col-md-8">
                            <input id="diamond_21_carat_price" type="text" class="form-control" name="diamond_21_carat_price"
                                placeholder="Diamond 21 Carat Price" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="diamond_22_carat_price" class="col-md-4 col-form-label">Diamond 22 Carat Price</label>
                        <div class="col-md-8">
                            <input id="diamond_22_carat_price" type="text" class="form-control" name="diamond_22_carat_price"
                                placeholder="Diamond 22 Carat Price" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="return_decrease_percent" class="col-md-4 col-form-label">Return decrease percent</label>
                        <div class="col-md-8">
                            <input id="return_decrease_percent" type="number" class="form-control" name="return_decrease_percent"
                                placeholder="return decrease percent" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="purchase_decrease_percent" class="col-md-4 col-form-label">purchase decrease percent</label>
                        <div class="col-md-8">
                            <input id="purchase_decrease_percent" type="number" class="form-control" name="purchase_decrease_percent"
                                placeholder="Purchase decrease percent" required>
                        </div>
                    </div>
                    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="settings_update">{{__('messages.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Add new user Modal End -->
@endsection