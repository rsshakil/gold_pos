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
class CategoryController extends Controller
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
        $title = "Category Manager";
        $title2 = "Vendor Manager";
        $active = 'category_list';
        return view('backend.categories.index', compact('title','title2', 'active'));
    }
    public function get_all_cat_list()
    {
        $admin_cat = $this->api_request->admin_purchase_categeorie();
        $product_sub_categorie = $this->api_request->product_sub_categorie();
        $product_categorie = $this->api_request->product_categorie();
        $vendor_list = $this->api_request->vendor_list();
        return $result = response()->json(['vendor_list' => $vendor_list,'product_cat_list'=>$product_categorie,'product_sub_cat_list'=>$product_sub_categorie,'admin_cat_list'=>$admin_cat]);
    }

    public function add_update_purchase_product_cat(Request $request){
        $cat_type = $request->cat_type;
        $row_id = $request->row_id;
        $cat_name = $request->cat_name;
        if($row_id==0){
            //inseert
            if($cat_type==1){
                admin_purchase_categeory::insert(['purchase_cat_name'=>$cat_name]);
            }else{
                product_category::insert(['category_name'=>$cat_name]);
            }
            return $result = response()->json(['message' => 'insert_success']);
        }else{
            //update
            if($cat_type==1){
                admin_purchase_categeory::where('admin_purchase_categeorie_id', $row_id)->update(['purchase_cat_name'=>$cat_name]);
            }else{
                product_category::where('product_categorie_id', $row_id)->update(['category_name'=>$cat_name]);
            }
            return $result = response()->json(['message' => 'update_success']);
        }
    }

    public function add_update_sub_cat(Request $request){
        $cat_id = $request->cat_id;
        $row_id = $request->row_id;
        $cat_name = $request->cat_name;
        if($row_id==0){
            //inseert
            product_sub_category::insert(['product_sub_cat_name'=>$cat_name,'product_categorie_id'=>$cat_id]);
            return $result = response()->json(['message' => 'insert_success']);
        }else{
            //update
            product_sub_category::where('product_sub_categorie_id', $row_id)->update(['product_sub_cat_name'=>$cat_name,'product_categorie_id'=>$cat_id]);
            return $result = response()->json(['message' => 'update_success']);
        }
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
