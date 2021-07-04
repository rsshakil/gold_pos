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
   <?php 
   $payment_list_types = $data['payment_type_list']->original['payment_type_list'];
   $customerlist = $data['customer_list']->original['customerlist'];
   $sale_item = $data['sale_item']->original['sale_list'];
   $product_item = $data['product_list_item'];
   ?>
    <div class="row" id="div">
        <div class="col">
            <div class="card card-small mb-4">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Update Sale</h6>
                </div>
                <div class="card-body p-0 pb-0 text-center">
                    <br>
                    <form action="" method="POST">
                    <input type="hidden" class="sale_id" value="{{$sale_item[0]->sale_id}}">
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Customer </label>
                        <div class="col-md-6">
                            <select class="form-control maker_id" name="maker_id" readonly>
                            <?php 
                                    if($customerlist){
                                        $selected_cust = '';
                                        foreach($customerlist as $val){
                                            $selected_cust = ($val['customer_id']==$sale_item[0]->customer_id?'selected':'');
                                            echo '<option value="'.$val['customer_id'].'" '.$selected_cust .'>'.$val['customer_name'].'('.$val['customer_phone'].')</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <!-- <div class="col-md-2"><button user_type="1" class="btn btn-primary add_new_maker">Add customer</button></div> -->
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Payment type </label>
                        <div class="col-md-8">
                            <select class="form-control payment_type_id" name="payment_type_id" readonly>
                                <?php 
                                    if($payment_list_types){
                                        $selected_payment = '';
                                        foreach($payment_list_types as $val){
                                            $selected_payment = ($val['payment_type_id']==$sale_item[0]->payment_type_id?'selected':'');
                                            echo '<option value="'.$val['payment_type_id'].'">'.$val['payment_type_name'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Product barcode</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control product_barcode" name="product_barcode">
                        </div>
                    </div>
                    <table id="user_list_tbl" class="table table-bordered mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Item name</th>
                                <th>Item Type</th>
                                <th>Item Category</th>
                                <th>Item Weight</th>
                                <th>Unit price</th>
                                <th>Total golde price</th>
                                <th>{{__('messages.action_td')}}</th>
                            </tr>
                            </head>
                        <tbody class="product_sale_data">
                                <?php $i=1;?>
                            @foreach($product_item as $item)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$item->product_name}}</td>
                                    <td>{{$item->product_carat_type}}</td>
                                    <td>{{$item->category_name}}-{{$item->product_sub_cat_name}}</td>
                                    <td>{{$item->weight}}</td>
                                    <td data_product_id="{{$item->product_id}}">{{$item->unit_price_per_gram}}</td>
                                    <td>{{$item->price}}</td>
                                    <td><button class="btn btn-danger delete_p_row">Delete</button></td>
                                </tr>
                                <?php $i++;?>
                            @endforeach;
                        </tbody>
                        <tfoot>
                        <tr>
                                <td colspan="6" style="text-align:right;">Total Gold Price</td>
                                <td class="total_gold_price" total_item="{{$sale_item[0]->total_item}}" total_weight="{{$sale_item[0]->total_weight}}">{{$sale_item[0]->item_price}}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right;">Making Cost</td>
                                <td class="making_cost_amount">{{$sale_item[0]->making_cost}}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right;">Vat Tax</td>
                                <td class="vat_tax_amount">{{$sale_item[0]->taxable_amount}}</td>
                                <td></td>
                            </tr>
                            
                            <tr>
                                <td colspan="6" style="text-align:right;">Discount Amount</td>
                                <td class="td_no_padding"><input type="number" onkeyup="javascript:add_sale_calculation();" class="form-control sale_td_input_cs discount_amount" value="{{$sale_item[0]->discount_amount}}"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right;">Total Payable Amount</td>
                                <td class="total_payable_amount">{{$sale_item[0]->sale_amount}}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right;">Paid Amount</td>
                                <td class="td_no_padding"><input type="number" onkeyup="javascript:add_sale_calculation();" class="form-control sale_td_input_cs total_paid_amount" value="{{$sale_item[0]->paid_amount}}"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right;">Due Amount</td>
                                <td class="total_due_amount">{{$sale_item[0]->due_amount}}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align:right;">Estimate due given Date</td>
                                <td class="td_no_padding"><input type="text" class="form-control common_date_type_field sale_td_input_cs estimate_due_given_date" value="{{$sale_item[0]->due_given_payment_date}}"></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    </form>
                    <button type="submit" class="btn btn-primary add_sale_to_db">Update Sale</button>
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