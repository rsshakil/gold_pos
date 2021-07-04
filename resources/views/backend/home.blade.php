@extends('backend.layouts.master')
@section('title')
<title>{{__('messages.dashboard_text')}}</title>
@endsection

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Small Stats Blocks -->
    <?php 
    $info = $data_counter->original['total_counter_list'];
    ?>
    <div class="row">
            <div class="col">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body ">
                      Total Products
                      <div class="text-white-50 small">{{$info['basic_info']['total_product']}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Total Outlet
                      <div class="text-white-50 small">{{$info['basic_info']['total_outlet']}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                    Total Sale
                      <div class="text-white-50 small">{{$info['basic_info']['total_sale']}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    Total sold product
                      <div class="text-white-50 small">{{$info['basic_info']['total_sold_product']}}</div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    Total unsold product
                      <div class="text-white-50 small">{{$info['basic_info']['total_unsold_product']}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    Customers
                      <div class="text-white-50 small">{{$info['basic_info']['total_customer']}}</div>
                    </div>
                </div>
            </div>


        </div>

        <br>

    <div class="row">
  
    <div class="col-3">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">total_sold_product_outlet_1</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['outlet_product_info']['total_sold_product_outlet_1']}}</div>
            </div>
            
            </div>
        </div>
        </div>
    </div>
    <div class="col-3">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">total_sold_product_outlet_2</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['outlet_product_info']['total_sold_product_outlet_2']}}</div>
            </div>
            
            </div>
        </div>
        </div>
    </div>
    <div class="col-3">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">total_unsold_product_outlet_1</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['outlet_product_info']['total_unsold_product_outlet_1']}}</div>
            </div>
            
            </div>
        </div>
        </div>
    </div>

    <div class="col-3">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">total_unsold_product_outlet_2</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$info['outlet_product_info']['total_unsold_product_outlet_2']}}</div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    </div>
    <div class="clearfix"></div>
    <br>
    <div class="row">
            <div class="col">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body ">
                    total_sale_amount
                      <div class="text-white-50 small">{{$info['total_sale_amount_info']->total_sale_amount}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                    total_sale_weight
                      <div class="text-white-50 small">{{$info['total_sale_amount_info']->total_sale_weight}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                    total_paid_amount
                      <div class="text-white-50 small">{{$info['total_sale_amount_info']->total_paid_amount}}</div>
                    </div>
                </div>
            </div>

            
            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_due_amount
                      <div class="text-white-50 small">{{$info['total_sale_amount_info']->total_due_amount}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_sale_qty
                      <div class="text-white-50 small">{{$info['total_sale_amount_info']->total_sale_qty}}</div>
                    </div>
                </div>
            </div>

            <!-- <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_gold_price
                      <div class="text-white-50 small">{{$info['total_sale_amount_info']->total_gold_price}}</div>
                    </div>
                </div>
            </div> -->


        </div>

        <br>
        <h4>Todays</h4>
    <div class="row">
    
    <div class="clearfix"></div>
            <div class="col">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body ">
                    total_sale_amount
                      <div class="text-white-50 small">{{$info['today_sale_amount_info']->total_sale_amount}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                    total_sale_weight
                      <div class="text-white-50 small">{{$info['today_sale_amount_info']->total_sale_weight}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                    total_paid_amount
                      <div class="text-white-50 small">{{$info['today_sale_amount_info']->total_paid_amount}}</div>
                    </div>
                </div>
            </div>

            
            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_due_amount
                      <div class="text-white-50 small">{{$info['today_sale_amount_info']->total_due_amount}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_sale_qty
                      <div class="text-white-50 small">{{$info['today_sale_amount_info']->total_sale_qty}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_gold_price
                      <div class="text-white-50 small">{{$info['today_sale_amount_info']->total_gold_price}}</div>
                    </div>
                </div>
            </div>


        </div>

        <br>
        <h4>Outlet 1 Totals</h4>
    <div class="row">
    
            <div class="col">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body ">
                    total_sale_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_1']->total_sale_amount}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                    total_sale_weight
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_1']->total_sale_weight}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                    total_paid_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_1']->total_paid_amount}}</div>
                    </div>
                </div>
            </div>

            
            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_due_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_1']->total_due_amount}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_sale_qty
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_1']->total_sale_qty}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_gold_price
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_1']->total_gold_price}}</div>
                    </div>
                </div>
            </div>


        </div>

        <br>
        <h4>Outlet 2 Totals</h4>
    <div class="row">
    
            <div class="col">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body ">
                    total_sale_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_2']->total_sale_amount}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                    total_sale_weight
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_2']->total_sale_weight}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                    total_paid_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_2']->total_paid_amount}}</div>
                    </div>
                </div>
            </div>

            
            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_due_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_2']->total_due_amount}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_sale_qty
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_2']->total_sale_qty}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_gold_price
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['total_sale_amount_info_outlet_2']->total_gold_price}}</div>
                    </div>
                </div>
            </div>


        </div>

        <!--stat-->
        <br>
        <h4>Todays Outlet 1 Totals</h4>
    <div class="row">
    
            <div class="col">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body ">
                    total_sale_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_1']->total_sale_amount}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                    total_sale_weight
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_1']->total_sale_weight}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                    total_paid_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_1']->total_paid_amount}}</div>
                    </div>
                </div>
            </div>

            
            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_due_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_1']->total_due_amount}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_sale_qty
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_1']->total_sale_qty}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_gold_price
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_1']->total_gold_price}}</div>
                    </div>
                </div>
            </div>


        </div>

        <br>
        <h4>Todays Outlet 2 Totals</h4>
    <div class="row">
    
            <div class="col">
                <div class="card bg-primary text-white shadow">
                    <div class="card-body ">
                    total_sale_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_2']->total_sale_amount}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                    total_sale_weight
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_2']->total_sale_weight}}</div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                    total_paid_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_2']->total_paid_amount}}</div>
                    </div>
                </div>
            </div>

            
            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_due_amount
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_2']->total_due_amount}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_sale_qty
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_2']->total_sale_qty}}</div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                    total_gold_price
                      <div class="text-white-50 small">{{$info['outlet_sales_info']['today_sale_amount_info_outlet_outlet_2']->total_gold_price}}</div>
                    </div>
                </div>
            </div>


        </div>
        <!--stat-->
<br>
       
</div>
@endsection