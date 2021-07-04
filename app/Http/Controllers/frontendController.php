<?php

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
class frontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $api_request;

    public function __construct()
    {
        $this->api_request = new CustomapiController();
    }

    public function index()
    {
        $title = 'Fariha jewllery';
        $product_list = $this->api_request->product_list();
        $product_sub_categorie = $this->api_request->product_sub_categorie();
        $product_categorie = $this->api_request->product_categorie();
        $cat_list = array();
        foreach($product_categorie->original['product_categories'] as $cat){
            $cat_list[$cat->category_name]= $this->api_request->product_sub_categorie_list_by_cat_id($cat->product_categorie_id);
        }
        return view('frontend.welcome', compact('title','product_list','cat_list','product_sub_categorie','product_categorie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
