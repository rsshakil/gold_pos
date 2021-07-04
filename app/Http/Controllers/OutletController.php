<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\outlet;
use App\admin_purchase_categeory;
use App\product_category;
use App\product_sub_category;
use App\wholesale_purchase;
use App\vendor;
use DB;
class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title = "Outlets";
        $active = 'outlets';
        return view('backend.outlets.index', compact('title', 'active'));
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
        $form_data = $request->form_data;
        parse_str($form_data, $searcharray);
       $data_ins_array = array(
        "outlet_name" => $searcharray['name'],
        "outlet_email" => $searcharray['email'],
        "outlet_phone" => $searcharray['outlet_phone'],
        "address" => $searcharray['address'],
        "outlet_opentime" => $searcharray['outlet_opentime'],
        "outlet_closetime" => $searcharray['outlet_closetime'],
        "weekend_day" => $searcharray['weekend_day'],
       );
       $outlet_id = $searcharray['outlet_id'];
       if($outlet_id==0){
        outlet::insert($data_ins_array);
        return response()->json(['message' => 'insert_success']);
       }else{
        outlet::where('outlet_id', '=', $outlet_id)->update($data_ins_array);
        return response()->json(['message' => 'update_success']);
       }
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
