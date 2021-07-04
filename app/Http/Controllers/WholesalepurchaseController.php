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
use DB;
class WholesalepurchaseController extends Controller
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
        $title = "Wholesale Purchase";
        $title2 = "Wholesale";
        $active = 'wholesale_purchase';
        return view('backend.wholesale_purchase.index', compact('title','title2', 'active'));
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
    public function add_update_wholesale_purchase(Request $request){
        $vendor_id = $request->vendor_id;
        $purchase_id = $request->purchase_id;
        $purchase_cat_id = $request->purchase_cat_id;
        $item_name = $request->item_name;
        $price = $request->price;
        $weight = $request->weight;
        $ars = array(
            'admin_purchase_categeorie_id'=>$purchase_cat_id,
            'vendor_id'=>$vendor_id,
            'item_name'=>$item_name,
            'weight'=>$weight,
            'price'=>$price,
            'purchase_datetime'=>date('Y-m-d H:i:s'),
        );
        if($purchase_id==0){
            wholesale_purchase::insert($ars);
            return $result = response()->json(['message' => 'insert_success']);
        }else{
            wholesale_purchase::where('wholesale_purchase_id',$purchase_id)->update($ars);
            return $result = response()->json(['message' => 'update_success']);
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
