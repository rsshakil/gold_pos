<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\outlet;
use App\admin_purchase_categeory;
use App\product_category;
use App\product_sub_category;
use App\wholesale_purchase;
use App\vendor;
use App\maker;
use App\customer;
use App\maker_item;
use App\maker_item_detail;
use DB;

class MakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Maker Item";
        $active = 'maker_item';
        return view('backend.maker_items.index', compact('title', 'active'));
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
       
        // if($request->hasFile('sample_img')){
        //     foreach ( $request->file('sample_img') as $file){
        //         $fileName = rand(1, 999).date('m-d-Y_hia').$file->getClientOriginalExtension();
        //         $file->move(public_path('images'), $fileName);
        //     }
        // }
        
        $maker_item_id = $request->maker_item_id;
        $maker_items=array(
                'maker_id' =>$request->maker_id,
                'wholesale_purchase_id' => 1,
                'making_end_date' => $request->making_end_date,
                'delivery_status' => $request->delivery_status,
            );
            if($maker_item_id==0){
                $maker_items['making_start_date']=date('Y-m-d');
                $maker_items_id = maker_item::insertGetId($maker_items);
                $i = 0;
                foreach ( $request->file('sample_img') as $file){
                    $fileName = rand(1, 999).date('m-d-Y_hia').'.'.$file->getClientOriginalExtension();
                    $file->move(public_path('images'), $fileName);
                    maker_item_detail::insert(['maker_item_id'=>$maker_items_id,'item_name'=>$request->item_name[$i],'sample_img'=>$fileName,'given_weight'=>$request->given_waight[$i],'return_weight'=>$request->return_waight[$i],'item_type'=>$request->carat_type[$i],'quantity'=>$request->maker_quantity[$i]]);
                    $i++;
                }
                
                return $result = response()->json(['message' =>'insert_success']);
            }else{
                if($request->delivery_status==1){
                    $maker_items['delivery_date']=date('Y-m-d'); 
                }
                $maker_items=array(
                    'maker_id' =>$request->maker_id,
                    'wholesale_purchase_id' => 1,
                    'making_end_date' => $request->making_end_date
                );
                maker_item::where('maker_item_id',$maker_item_id)->update($maker_items);
                $i =0;
                foreach($request->maker_item_detail_id as $item){

                    $updated_items_arry= array(
                        'item_name'=>$request->item_name[$i],
                        'given_weight'=>$request->given_waight[$i],
                        'return_weight'=>$request->return_waight[$i],
                        'item_type'=>$request->carat_type[$i],
                        'quantity'=>$request->maker_quantity[$i]
                    );
                    if(isset($request->sample_img[$i])){
                        $fileName = rand(1, 999).date('m-d-Y_hia').'.'.$request->sample_img[$i]->getClientOriginalExtension();
                        $request->sample_img[$i]->move(public_path('images'), $fileName);
                        $updated_items_arry['sample_img']=$fileName;
                    }
                    maker_item_detail::where('maker_item_detail_id',$request->maker_item_detail_id[$i])->update($updated_items_arry);
                    $i++;
                }
                return $result = response()->json(['message' =>'update_success']);
            }

    }
    public function add_maker(Request $request)
    {
       
        if($request->user_type==1){
            $data = array(
                'customer_name'=>$request->username,
                'customer_phone'=>$request->userphone,
                'customer_email'=>$request->useremail,
                'customer_address'=>$request->useraddress,
            );
            $maker_info = customer::insertGetId($data);
        }else{
            $data = array(
                'maker_name'=>$request->username,
                'maker_phone'=>$request->userphone,
                'maker_email'=>$request->useremail,
                'maker_address'=>$request->useraddress,
            );
            $maker_info = maker::insertGetId($data);
        }
       
        return response()->json(['message' => 'insert_success','maker_id'=>$maker_info]);
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
