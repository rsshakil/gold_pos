<!DOCTYPE html>

<html lang="bangla">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sale Inveoice</title>
    <link href="<?php echo(\Config::get('app.url').'public/css/bootstrap/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo(\Config::get('app.url').'public/css/invoice.css');?>" rel="stylesheet">
        <!-- Bootstrap CSS -->
        

</head>

<body>
<div id="invoice" style="width:100%;">
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">

<header>
                <div class="row">
                
                    <div class="col">
                    <div class="row">
                        <div class="col-5">
                            <img class="logo_left" src="<?php echo(\Config::get('app.url').'public/images/logo.jpg'); ?>" />
                        </div>
                        <div class="col-7">
                            <h2 class="name">
                                <a target="_blank" href="#">
                                {{$sale_list->outlet_name}}
                                </a>
                            </h2>
                            <div>{{$sale_list->address}}</div>
                            <div>{{$sale_list->outlet_phone}}</div>
                            <div>{{$sale_list->outlet_email}}</div>
                            <div>Open-Close{{$sale_list->outlet_opentime}}-{{$sale_list->outlet_closetime}}</div>
                            <div>Weekend day: {{$sale_list->weekend_day}}</div>
                        </div>
                    </div>      
                    </div>
                    <div class="col">
                    <h4 class="invoice-id text-center">INVOICE</h4>
                    <p class="invoice-id  text-center" style="margin-bottom:0;">Invoice No:{{$sale_list->voucher_number}}</p>
                    <div class="date text-center">Date of Invoice: {{$sale_list->sale_date}}</div>
                        <div class="date text-center">Due Date: {{$sale_list->estimate_due_payment_date}}</div>
                    </div>
                    <div class="col company-details">
                    <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">Name:{{$sale_list->customer_name}}</h2>
                        <div class="address">Address:{{$sale_list->customer_address}}</div>
                        <div class="email"><a href="tel:{{$sale_list->customer_phone}}">Phone:{{$sale_list->customer_phone}}</a></div>
                    </div>
                </div>
            </header>
            <main>
                <!-- <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">{{$sale_list->customer_name}}</h2>
                        <div class="address">{{$sale_list->customer_address}}</div>
                        <div class="email"><a href="tel:{{$sale_list->customer_phone}}">{{$sale_list->customer_phone}}</a></div>
                    </div>
                    <div class="col invoice-details">
                        <h4 class="invoice-id">INVOICE: {{$sale_list->voucher_number}}</h4>
                        <div class="date">Date of Invoice: {{$sale_list->sale_date}}</div>
                        <div class="date">Due Date: {{$sale_list->estimate_due_payment_date}}</div>
                    </div>
                </div> -->
                <div class="row contacts">
                    <div class="col">
    <table class="table table-bordered" cellspacing="0" cellpadding="0">
        <thead>
            <tr>
                <th>#</th>
                <th>Product name</th>
                <th>Category</th>
                <th>Type</th>
                <th>Product weight</th>
                <th>Product unit price</th>
                <th>Gold price</th>
            </tr>
            
        </thead>
        <tbody>
                    <?php $i=1;?>
                    @foreach($product_list as $value)
                       <tr>
                       <td>{{$i}}</td>
                       <td>{{$value->product_name}}</td>
                       <td>{{$value->category_name.'-'.$value->product_sub_cat_name}}</td>
                       <td>{{$value->product_carat_type}}</td>
                       <td>{{$value->weight}}</td>
                       <td>{{$value->unit_price_per_gram}}</td>
                        <td>{{$value->unit_price_per_gram*$value->weight}}</td>
                    </tr>
                       <?php $i++;?>
                    @endforeach
        </tbody>
        <tfoot>
                        <tr>
                            <td colspan="6">SUBTOTAL</td>
                            <td>{{$sale_list->item_price}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">Making Cost</td>
                            <td>{{$sale_list->making_cost}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">Vat Tax</td>
                            <td>{{$sale_list->taxable_amount}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">Discount</td>
                            <td>{{$sale_list->discount_amount}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">GRAND TOTAL</td>
                            <td>{{$sale_list->sale_amount}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">PAID TOTAL</td>
                            <td>{{$sale_list->paid_amount}}</td>
                        </tr>
                        <tr>
                            <td colspan="6">DUE TOTAL</td>
                            <td>{{$sale_list->due_amount}}</td>
                        </tr>
                    </tfoot>
    </table>
    </div>
    </div>
    <div class="clearfix"></div>
    <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
            </main>

</div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>   
</body>

</html>