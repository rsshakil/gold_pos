<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    private $api_request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->api_request = new CustomapiController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $title = "Dashboard";
        $active = 'dashboard';
        $data_counter=$this->api_request->get_all_list_counter();
        // $data['total_order']=$this->api_request->get_total_order_counter();
        // $data['total_sale']=$this->api_request->get_total_sale_counter();
        // $data['total_sold_product']=$this->api_request->get_total_sold_product_counter();
        // $data['total_unsold_product']=$this->api_request->get_total_unsold_product_counter();
        // $data['total_customer']=$this->api_request->get_total_customer_counter();
        return view('backend.home', compact('title', 'active','data_counter'));

    }
}
