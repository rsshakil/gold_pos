<?php
use App\Http\Controllers\CustomapiController;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\outlet;
use App\admin_purchase_categeory;
use App\product_category;
use App\product_sub_category;
use App\wholesale_purchase;
use App\vendor;
use App\customer;
use App\product;
use App\sitesetting;
use DB;

class SaleController extends Controller
{
    private $api_request;

    public function __construct()
    {
        $this->api_request = new CustomapiController();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Sale Manager";
        $title2 = "Sale Manager";
        $active = 'sales';
        $data['sale_list'] = $this->api_request->get_all_sale_list();
        return view('backend.sales.index', compact('title','title2', 'active','data'));
    }

    public function edit_sale($sale_id)
    {
        $title = "sale Update";
        $title2 = "Sale Update";
        $active = 'sales';
        $data['sale_item'] = $this->api_request->get_all_sale_list($sale_id);
        $data['product_list_item'] = $this->api_request->sale_product_list($sale_id);
        $data['payment_type_list'] = $this->api_request->get_all_payment_type_list();
        $data['customer_list'] = $this->api_request->customer_list();
        return view('backend.sales.edit_sale', compact('title','title2', 'active','data'));
    }
    public function order_list()
    {
        $title = "Order Manager";
        $title2 = "Order Manager";
        $active = 'orders';
        $data['order_list'] = $this->api_request->get_all_order_list();
        return view('backend.sales.order_list', compact('title','title2', 'active','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add sale";
        $title2 = "Add sale";
        $active = 'add_sale';
        $data['payment_type_list'] = $this->api_request->get_all_payment_type_list();
        $data['customer_list'] = $this->api_request->customer_list();
        return view('backend.sales.add_sale', compact('title','title2', 'active','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
