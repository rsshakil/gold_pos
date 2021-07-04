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

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Product Manager";
        $title2 = "Product Manager";
        $active = 'category_list';
        return view('backend.products.index', compact('title','title2', 'active'));
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
        $product_id = $request->product_id;
        $products = array(
                'wholesale_purchase_id' => $request->wholesale_purchase_id,
                'product_categorie_id' => $request->product_categorie_id,
                'product_sub_categorie_id' => $request->product_sub_categorie_id,
                'product_name' => $request->product_name,
                'product_desc' => $request->product_desc,
                'weight' => $request->weight,
                'product_carat_type' => $request->product_carat_type,
                'outlet_id' => $request->outlet_id,
        );
        if($request->hasFile('product_image')){
            $image = $request->file('product_image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $products['product_image'] = $new_name;
        }
        if($product_id==0){
            $products['product_datetime'] = date('Y-m-d H:i:s');
            $s_c_id = str_pad($request->product_sub_categorie_id,4,"0",STR_PAD_LEFT);
            $products['barcode']=date('ymdHis').$request->outlet_id;
            product::insert($products);
            return response()->json(['message' => 'insert_success']);
        }else{
            product::where('product_id', '=', $product_id)->update($products);
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
