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
                <!-- <button type="submit" class="btn btn-info print_bar_code">Barcode Print</button> -->
                @can('create_users')
                <button row_id="0" maker_id="0" item_id="0" class="btn btn-primary edit_maker_item float-right">
                    <i class="fas fa-plus-square"></i>
                    <span class="hide-menu"> {{__('messages.create_new')}} </span>
                </button>
                @endcan
                    <table id="user_list_tbl" class="table mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Maker Name</th>
                                <th>Making Start Date</th>
                                <th>Making End Date</th>
                                <th>Delivery Date</th>
                                <th>Delivery Status</th>
                                <th>{{__('messages.action_td')}}</th>
                            </tr>
                            </head>
                        <tbody class="maker_item_lists_data">
                            
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
<div class="modal fade" id="new_maker_item_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Maker Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="outlet_message"></div>
                <form method="POST" id="maker_item_create" enctype="multipart/form-data" class="">
                    @csrf
                    <input type="hidden" class="maker_item_id" name="maker_item_id" value="0">

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">Maker Name</label>
                        <div class="col-md-6">
                        <select class="form-control maker_id" name="maker_id"></select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" user_type="2" class="btn btn-info add_new_maker">Add</button>
                        </div>
                    </div>


                    <button class=" btn btn-primary text-right pull-right addrow_maker_item"> 
        Add row 
    </button> 
      
    <table class="table table-border table-striped"> 
        <thead> 
            <tr> 
                <th>Item name</th> 
                <th>Caret</th> 
                <th>Given Weight</th> 
                <th>Retrun Weight</th> 
                <th>Sample</th> 
                <th>Quantity</th> 
                <th>Action</th> 
            </tr> 
        </thead> 
        <tbody class="add_maker_items_inputs"> 
        </tbody> 
    </table> 

                   

                    <div class="form-group row">
                        <label for="making_end_date"
                            class="col-md-4 col-form-label">Making End Date</label>
                        <div class="col-md-8">
                                <input type="text" class="form-control making_end_date"
                                name="making_end_date" placeholder="making end date" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="weekend_day"
                            class="col-md-4 col-form-label">Delivery Status</label>
                        <div class="col-md-8">
                        <select class="form-control delivery_status" name="delivery_status">
                            <option value="0">Not Delivered</option>
                            <option value="1">Delivered</option>
                        </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="new_maker_item_save">{{__('messages.submit')}}</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Add new user Modal End -->

<!-- maker item print Modal -->
<div class="modal fade" id="maker_item_print_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Maker Item Print Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
              
                <div class="maker_item_printable_area" id="maker_item_printable_sec">
                    <div class="row">
                        <div class="col-md-6" style="float:left;width:60%;">
                            <?php 
                            $setting = DB::table('sitesettings')->first();
                            ?>
                           <img style="float:left;margin-right:15px;width:170px" class="img_maker_item" src="<?php echo(\Config::get('app.url').'/public/images/').$setting->company_logo;?>"/>
                            <h4 style="margin-bottom:10px;color:green;"><?php echo $setting->company_name;?></h4>
                             <p style="margin-bottom:10px;">Phone:01936755674</p>
                             <p style="margin-bottom:10px;">Email:fariha@gmail.com<p>
                             <address>
                                Addresss:Baitul mokarom,dhaka-1207
                            </address>
                        </div>
                        <div class="col-md-6" style="float:left;width:40%;">
                            <h4 style="margin-bottom:10px;">Maker Name:<span style="color:red;" class="makers_nmese"></span></h4>
                            <p style="margin-bottom:10px;">Phone:<span class="makerphones"></span></p>
                            <address>
                                Addresss:<span class="makersaddresses"></span>
                            </address>
                            <p style="margin-bottom:10px;">Making End Date:<span class="making_end_date"></span></p>
                            <p style="margin-bottom:10px;">Delivery status:<span class="mker_item_delivery_status"></span></p>
                            <p style="margin-bottom:10px;">Delivery Date:<span class="mker_item_delivery_date"></span></p>
                        </div>
                    </div>
                    <hr style="width:100%;border:2px dashed #000;margin-top:15px;margin-bottom:20px;">
                    <table class="table table-border table-striped"> 
                        <thead> 
                            <tr> 
                                <th>Item name</th> 
                                <th>Caret</th> 
                                <th>Given Weight</th> 
                                <th>Retrun Weight</th> 
                                <th>Sample</th> 
                                <th>Quantity</th> 
                            </tr> 
                        </thead> 
                        <tbody class="print_maker_items"> 
                        </tbody> 
                    </table> 
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.close')}}</button>
                <button type="submit" class="btn btn-primary" id="maker_item_print_exec">Print</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Add new user Modal End -->
@endsection