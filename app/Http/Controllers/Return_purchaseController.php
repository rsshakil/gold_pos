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
class Return_purchaseController extends Controller
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
        $title = "Exchange product Manager";
        $title2 = "Exchange product Manager";
        $active = 'exchange_product';
        $data['return_list'] = $this->api_request->get_all_return_list();
        return view('backend.return_purchase.index', compact('title','title2', 'active','data'));
    }

    public function edit_return($return_id)
    {
        $title = "Return Update";
        $title2 = "Return Update";
        $active = 'exchange_product';
        $data['sale_item'] = $this->api_request->get_all_return_list($return_id);
        $data['product_list_item'] = $this->api_request->return_product_list($return_id);
        $data['payment_type_list'] = $this->api_request->get_all_payment_type_list();
        $data['customer_list'] = $this->api_request->customer_list();
        return view('backend.return_purchase.edit_return_purchase', compact('title','title2', 'active','data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Return purchase";
        $title2 = "Add Return";
        $active = 'add_return';
        $data['payment_type_list'] = $this->api_request->get_all_payment_type_list();
        $data['customer_list'] = $this->api_request->customer_list();
        return view('backend.return_purchase.add_return_purchase', compact('title','title2', 'active','data'));
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
