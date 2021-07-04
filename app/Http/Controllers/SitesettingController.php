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

class SitesettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Setting Manager";
        $title2 = "Setting Manager";
        $active = 'settings';
        return view('backend.settings.index', compact('title','title2', 'active'));
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
       
        //$file = $request->file('company_logo');

        $settings = array(
                'company_name' => $request->company_name,
                'vat_tax' => $request->vat_tax,
                'platinam_21_carat_price' => $request->platinam_21_carat_price,
                'diamond_21_carat_price' => $request->diamond_21_carat_price,
                'gold_21_carat_price' => $request->gold_21_carat_price,
                'platinam_22_carat_price' => $request->platinam_22_carat_price,
                'diamond_22_carat_price' => $request->diamond_22_carat_price,
                'gold_22_carat_price' =>$request->gold_22_carat_price,
                'purchase_decrease_percent' => $request->purchase_decrease_percent,
                'ruturn_decrease_percent' =>$request->return_decrease_percent
            );
            if($request->hasFile('company_logo')){
                $image = $request->file('company_logo');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $new_name);
                $settings['company_logo']=$new_name;
            }
            sitesetting::where('setting_id',1)->update($settings);
            return $result = response()->json(['message' => 'update_success']);
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
