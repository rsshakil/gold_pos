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
use App\maker;
use App\maker_item;
use App\maker_item_detail;
use App\product;
use App\sitesetting;
use App\sale;
use App\saledetail;
use App\return_purchase;
use App\return_purchase_detail;
use App\payment_type;
use DB;
use Auth;
use Session;
use Redirect;
class CustomapiController extends Controller
{
    private $outlet_id;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->outlet_id = Auth::user()->outletid;
            return $next($request);
        });
    }

    /**
     * Display a listing of outlet_list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $outlet_lists=outlet::where('delete_status', "0")->get();
        return $result = response()->json(['outlet_list' => $outlet_lists]);

    }
    public function single_outlet_byid($id)
    {
        $outlet_lists=outlet::where('outlet_id', $id)->first();
        return $result = response()->json(['outlet_list' => $outlet_lists]);
    }


    public function vendor_list()
    {
        $vendorlist=vendor::where('delete_status', "0")->orderBy('vendor_id', 'desc')->get();
        return $result = response()->json(['vendorlist' => $vendorlist]);
    }

    public function customer_list()
    {
        $customerlist=customer::where('delete_status', "0")->orderBy('customer_id', 'desc')->get();
        return $result = response()->json(['customerlist' => $customerlist]);
    }
    public function get_all_payment_type_list()
    {
        $payment_type_list=payment_type::where('delete_status', "0")->orderBy('payment_type_id', 'asc')->get();
        return $result = response()->json(['payment_type_list' => $payment_type_list]);
    }

    public function delete_outlet_by_id($id)
    {
        $outlet_lists=outlet::where('outlet_id', $id)->update(['delete_status'=>'1']);
        Session::flash('message','Entry has been deleted!'); 
        Session::flash('class_name','alert-danger'); 
        return response()->json(['message' => 'delete_success']);
    }
    public function delete_vendor_by_id($id)
    {
        $vendor_lists=vendor::where('vendor_id', $id)->update(['delete_status'=>'1']);
        Session::flash('message','Entry has been deleted!'); 
        Session::flash('class_name','alert-danger'); 
        return Redirect::back()->with('message', 'entry has been deleted');
        return response()->json(['message' => 'delete_success']);
    }
    public function delete_customer_by_id($id)
    {
        $customer_lists=customer::where('customer_id', $id)->update(['delete_status'=>'1']);
        Session::flash('message','Entry has been deleted!'); 
        Session::flash('class_name','alert-danger'); 
        return response()->json(['message' => 'delete_success']);
    }
    public function product_categorie()
    {
        $product_categories=product_category::where('delete_status', "0")->orderBy('product_categorie_id', 'desc')->get();
        return $result = response()->json(['product_categories' => $product_categories]);
    }

    public function delete_product_category_by_id($id)
    {
        // echo $id;exit;
        $product_category_lists=product_category::where('product_categorie_id', $id)->update(['delete_status'=>'1']);
        Session::flash('message','Entry has been deleted!'); 
        Session::flash('class_name','alert-danger'); 
        return Redirect::back()->with('message', 'entry has been deleted');
        return response()->json(['message' => 'delete_success']);
    }

    public function delete_admin_purchase_categeorie($id)
    {
            $admin_cat=admin_purchase_categeory::where('admin_purchase_categeorie_id',$id)->update(['delete_status'=>"1"]);
            Session::flash('message','Entry has been deleted!'); 
            Session::flash('class_name','alert-danger'); 
            return Redirect::back()->with('message', 'entry has been deleted');
            return $result = response()->json(['success' => 'maker delete success']);
    }
    public function delete_product_sub_category_by_id($id)
    {
            $admin_cat=product_sub_category::where('product_sub_categorie_id',$id)->update(['delete_status'=>"1"]);
            Session::flash('message','Entry has been deleted!'); 
            Session::flash('class_name','alert-danger'); 
           return Redirect::back()->with('message', 'entry has been deleted');
            return $result = response()->json(['success' => 'maker delete success']);
    }

    public function product_sub_categorie()
    {
            $product_sub_categories=DB::table('product_sub_categories')
            ->join('product_categories', 'product_sub_categories.product_categorie_id', '=', 'product_categories.product_categorie_id')
            ->select('product_sub_categories.product_sub_categorie_id','product_sub_categories.product_categorie_id','product_sub_categories.product_sub_cat_name', 'product_categories.category_name')
            ->where('product_sub_categories.delete_status', "0")
            ->get();
            return $result = response()->json(['product_sub_categories' => $product_sub_categories]);
    }

    public function get_all_maker_list(){
        $maker_list=maker::where('delete_status', "0")->orderBy('maker_id', 'desc')->get();
        return $result = response()->json(['maker_list' => $maker_list]);
    }

    public function get_all_maker_cat_list(){
        $data['item_list']=$this->wholesale_purchase_list();
        $data['maker_list']=$this->get_all_maker_list();
        return $data;
    }

    public function sale_product_list($sale_id=0){
        $product_list=DB::table('saledetails')
            ->join('products', 'saledetails.product_id', '=', 'products.product_id')
            ->join('product_categories', 'product_categories.product_categorie_id', '=', 'products.product_categorie_id')
            ->join('product_sub_categories', 'product_sub_categories.product_sub_categorie_id', '=', 'products.product_sub_categorie_id')
            ->select('products.*','saledetails.unit_price_per_gram','product_categories.category_name', 'product_sub_categories.product_sub_cat_name')
            ->where('saledetails.sale_id', $sale_id)
            ->orderBy('saledetails.product_id', 'desc')
            ->get();
            return $product_list;
    }

    public function return_product_list($return_id=0){
        $product_list=DB::table('return_purchase_details')
            ->join('products', 'return_purchase_details.product_id', '=', 'products.product_id')
            ->join('product_categories', 'product_categories.product_categorie_id', '=', 'products.product_categorie_id')
            ->join('product_sub_categories', 'product_sub_categories.product_sub_categorie_id', '=', 'products.product_sub_categorie_id')
            ->select('products.*','return_purchase_details.unit_price_per_gram','product_categories.category_name', 'product_sub_categories.product_sub_cat_name')
            ->where('return_purchase_details.return_purchase_id', $return_id)
            ->orderBy('return_purchase_details.product_id', 'desc')
            ->get();
            return $product_list;
    }

    /*get all return list*/

    public function get_all_return_list($return_id=0){
        $outlet_id = $this->outlet_id;
        
        $return_list = DB::table('return_purchases')
            ->join('outlets', 'outlets.outlet_id', '=', 'return_purchases.outlet_id')
            ->join('customers', 'customers.customer_id', '=', 'return_purchases.customer_id')
            ->join('payment_types', 'payment_types.payment_type_id', '=', 'return_purchases.payment_type_id')
            ->select('return_purchases.*','outlets.*','customers.customer_name', 'customers.customer_phone','payment_types.payment_type_name')
            ->where('return_purchases.delete_status', "0")
            ->where('return_purchases.purchase_status', "1");
            if($return_id!=0){
                $return_list->where('return_purchases.return_purchase_id', $return_id);
            }
            if($outlet_id!=0){
                $return_list = $return_list->where('return_purchases.outlet_id',$outlet_id)->orderBy('return_purchases.return_purchase_id', 'desc')->get();
            }else{
                $return_list = $return_list->orderBy('return_purchases.return_purchase_id', 'desc')->get();
            }
            
            return $result = response()->json(['return_list' => $return_list]);
    }

    /*get all return list*/

    /*get all sales list*/

    public function get_all_sale_list($sale_id=0){
        $outlet_id = $this->outlet_id;
        
        $sale_list=DB::table('sales')
            ->join('outlets', 'outlets.outlet_id', '=', 'sales.outlet_id')
            ->join('customers', 'customers.customer_id', '=', 'sales.customer_id')
            ->join('payment_types', 'payment_types.payment_type_id', '=', 'sales.payment_type_id')
            ->select('sales.*','outlets.*','customers.customer_name', 'customers.customer_phone','payment_types.payment_type_name')
            ->where('sales.delete_status', "0")
            ->where('sales.sale_status', "1");
            if($sale_id!=0){
                $sale_list->where('sales.sale_id', $sale_id);
            }
            if($outlet_id!=0){
                $sale_list = $sale_list->where('sales.outlet_id',$outlet_id)->orderBy('sales.sale_id', 'desc')->get();
            }else{
                $sale_list = $sale_list->orderBy('sales.sale_id', 'desc')->get();
            }
            
            return $result = response()->json(['sale_list' => $sale_list]);
    }

    /*get all sales list*/

    public function get_all_order_list(){
        $outlet_id = $this->outlet_id;
        $sale_list=DB::table('sales')
            ->join('outlets', 'outlets.outlet_id', '=', 'sales.outlet_id')
            ->join('customers', 'customers.customer_id', '=', 'sales.customer_id')
            ->join('payment_types', 'payment_types.payment_type_id', '=', 'sales.payment_type_id')
            ->select('sales.*','outlets.*','customers.customer_name', 'customers.customer_phone','payment_types.payment_type_name')
            ->where('sales.delete_status', "0")
            ->where('sales.sale_status', "0");
            if($outlet_id!=0){
                $sale_list = $sale_list->where('sales.outlet_id',$outlet_id)->orderBy('sales.sale_id', 'desc')->get();
            }else{
                $sale_list = $sale_list->orderBy('sales.sale_id', 'desc')->get();
            }
            
            return $result = response()->json(['order_list' => $sale_list]);
    }


    public function product_sub_categorie_list_by_cat_id($id)
    {
            $product_sub_categories=DB::table('product_sub_categories')
            ->join('product_categories', 'product_sub_categories.product_categorie_id', '=', 'product_categories.product_categorie_id')
            ->select('product_sub_categories.product_sub_categorie_id','product_sub_categories.product_categorie_id','product_sub_categories.product_sub_cat_name', 'product_categories.category_name')
            ->where('product_sub_categories.product_categorie_id', $id)
            ->where('product_sub_categories.delete_status', "0")
            ->get();
            return $result = response()->json(['product_sub_categories' => $product_sub_categories]);
    }
    public function product_list()
    {
            $outlet_id = $this->outlet_id;
            $outlet_id = ($outlet_id==''?0:$outlet_id);

            $product_sub_categories=DB::table('products')
            ->join('product_categories', 'products.product_categorie_id', '=', 'product_categories.product_categorie_id')
            ->join('product_sub_categories', 'product_sub_categories.product_sub_categorie_id', '=', 'products.product_sub_categorie_id')
            ->leftJoin('outlets', 'products.outlet_id', '=', 'outlets.outlet_id')
            ->select('products.*','product_sub_categories.product_sub_cat_name','outlets.outlet_name', 'product_categories.category_name')
            ->where('products.delete_status', "0")
            ->where('products.stock', "1");
            if($outlet_id!=0){
                $product_list=$product_sub_categories->where('products.outlet_id', $outlet_id)->orderBy('products.product_id', 'desc')->get();
            }else{
                $product_list=$product_sub_categories->orderBy('products.product_id', 'desc')->get();
            }
            $wh = '';
            $wh = ($outlet_id==0?'':' and outlet_id='.$outlet_id);
            $product_count_weight =  collect(\DB::select("select count(product_id) as total_product,SUM(weight) as total_weight from products where stock='1' and delete_status='0' $wh"))->first();
            return $result = response()->json(['product_lists' => $product_list,'product_count_weight'=>$product_count_weight]);
    }

    public function sold_out_product_list()
    {
            $outlet_id = $this->outlet_id;
            $product_sub_categories=DB::table('products')
            ->join('product_categories', 'products.product_categorie_id', '=', 'product_categories.product_categorie_id')
            ->join('product_sub_categories', 'product_sub_categories.product_sub_categorie_id', '=', 'products.product_sub_categorie_id')
            ->leftJoin('outlets', 'products.outlet_id', '=', 'outlets.outlet_id')
            ->select('products.*','product_sub_categories.product_sub_cat_name','outlets.outlet_name', 'product_categories.category_name')
            ->where('products.delete_status', "0")
            ->where('products.stock', "0");
            if($outlet_id!=0){
                $product_sub_categories=$product_sub_categories->where('products.outlet_id',  $outlet_id)->orderBy('products.product_id', 'desc')->get();
            }else{
                $product_sub_categories=$product_sub_categories->orderBy('products.product_id', 'desc')->get();
            }
            
            return $result = response()->json(['product_lists' => $product_sub_categories]);
    }

    public function get_product_info(Request $request)
    {
            $product_id = $request->product_id;
            $product_sub_categories=DB::table('products')
            ->join('product_categories', 'products.product_categorie_id', '=', 'product_categories.product_categorie_id')
            ->join('product_sub_categories', 'product_sub_categories.product_sub_categorie_id', '=', 'products.product_sub_categorie_id')
            ->leftJoin('outlets', 'products.outlet_id', '=', 'outlets.outlet_id')
            ->select('products.*','product_sub_categories.product_sub_cat_name','outlets.outlet_name', 'product_categories.category_name')
            ->where('products.delete_status', "0")
            ->where('products.product_id', $product_id)
            ->orderBy('products.product_id', 'desc')
            ->first();
            return $result = response()->json(['product_lists' => $product_sub_categories]);
    }

    public function get_all_product_cat_list(){
        $data['purchase_list'] = $this->wholesale_purchase_list(); 
        $data['product_category'] = $this->product_categorie(); 
        $data['outlet_lists'] = $this->index(); 
        return $data;
    }
    public function get_all_maker_item_list(){
        $maker_item_list=DB::table('maker_items')
            ->join('makers', 'makers.maker_id', '=', 'maker_items.maker_id')
            ->select('maker_items.*', 'makers.maker_name')
            ->where('maker_items.delete_status', "0")
            ->orderBy('maker_items.maker_id', 'desc')
            ->get();
            return $result = response()->json(['maker_item_list' => $maker_item_list]);
    }
    public function delete_maker_detail_item_id($id){
        maker_item_detail::where('maker_item_detail_id',$id)->delete();
        return $result = response()->json(['success'=>'1']);
    }
    public function get_all_maker_item_list_by_item_id($id){
        $maker_item_list=DB::table('maker_items')
            ->join('makers', 'makers.maker_id', '=', 'maker_items.maker_id')
            ->join('maker_item_details', 'maker_item_details.maker_item_id', '=', 'maker_items.maker_item_id')
            ->select('maker_items.*','maker_item_details.*', 'makers.maker_name', 'makers.maker_phone', 'makers.maker_address')
            ->where('maker_items.delete_status', "0")
            ->where('maker_items.maker_item_id',$id)
            ->orderBy('maker_items.maker_id', 'desc')
            ->get();
            
        $data['maker_list']=$this->get_all_maker_list();
        $data['maker_item_list']=$maker_item_list;
            return $result = response()->json($data);
    }

    public function delete_maker_item(Request $request){
        maker_item::where('maker_item_id',$request->maker_item_id)->update(['delete_status'=>'1']);
        return $result = response()->json(['success' => 'maker delete success']);
    }
    public function admin_purchase_categeorie()
    {
            $admin_cat=admin_purchase_categeory::where('delete_status', "0")->get();
            return $result = response()->json(['admin_cat' => $admin_cat]);
    }
    
    /*admin purchase list*/
    public function wholesale_purchase_list()
    {
            $wholesale_purchase_list=DB::table('wholesale_purchases')
            ->join('admin_purchase_categeories', 'wholesale_purchases.admin_purchase_categeorie_id', '=', 'admin_purchase_categeories.admin_purchase_categeorie_id')
            ->join('vendors', 'wholesale_purchases.vendor_id', '=', 'vendors.vendor_id')
            ->select('wholesale_purchases.*', 'vendors.vendor_name','admin_purchase_categeories.purchase_cat_name')
            ->where('wholesale_purchases.delete_status', "0")
            ->orderBy('wholesale_purchases.wholesale_purchase_id', 'desc')
            ->get();
            return $result = response()->json(['wholesale_purchase_list' => $wholesale_purchase_list]);
    }
/*add sale*/
    public function add_into_dbs(Request $request){
        
        $sale_status = $request->sale_status;
        $sale_id = $request->sale_id;
        
        if($sale_status==1){
            $outlet_id = Auth::user()->outletid;
        }else{
            $outlet_id = $request->outlet_id;
        }
        $c_id = str_pad($request->customer_id,5,"0",STR_PAD_LEFT);
        $voucher_number = date('ymdHis').$outlet_id;

if($sale_id==0){
            $sale_id = sale::insertGetId(['outlet_id'=>$outlet_id,'customer_id'=>$request->customer_id,'payment_type_id'=>$request->payment_type_id,
            'total_weight'=>$request->total_weight,'sale_amount'=>$request->total_payable_amount,
            'discount_amount'=>$request->discount_amount,'paid_amount'=>$request->total_paid_amount,'sale_status'=>$sale_status,
            'due_amount'=>$request->total_due_amount,'taxable_amount'=>$request->vat_tax_amount,'total_item'=>$request->total_item,
            'making_cost'=>$request->making_cost_amount,'item_price'=>$request->total_gold_price,'voucher_number'=>$voucher_number,
            'estimate_due_payment_date'=>$request->estimate_due_given_date,'sale_date'=>date('Y-m-d'),'sale_datetime'=>date('Y-m-d H:i:s'),
            ]);
            $prodct_id_unit_price = $request->product_id_unit_price;
            foreach($prodct_id_unit_price as $vl){
                saledetail::insert(['sale_id'=>$sale_id,'product_id'=>$vl['product_id'],'unit_price_per_gram'=>$vl['unit_price']]);
                if($sale_status==1){
                    product::where('product_id',$vl['product_id'])->update(['stock'=>0]);
                }
            }
        }else{

            sale::where('sale_id',$sale_id)->update(['outlet_id'=>$outlet_id,'customer_id'=>$request->customer_id,'payment_type_id'=>$request->payment_type_id,
            'total_weight'=>$request->total_weight,'sale_amount'=>$request->total_payable_amount,
            'discount_amount'=>$request->discount_amount,'paid_amount'=>$request->total_paid_amount,'sale_status'=>$sale_status,
            'due_amount'=>$request->total_due_amount,'taxable_amount'=>$request->vat_tax_amount,'total_item'=>$request->total_item,
            'making_cost'=>$request->making_cost_amount,'item_price'=>$request->total_gold_price,
            'estimate_due_payment_date'=>$request->estimate_due_given_date,
            ]);
            $prodct_id_unit_price = $request->product_id_unit_price;
            $product_sale_list = saledetail::where('sale_id',$sale_id)->get();
            foreach($product_sale_list as $product){
                product::where('product_id',$product->product_id)->update(['stock'=>1]);
            }
            saledetail::where('sale_id',$sale_id)->delete();
            foreach($prodct_id_unit_price as $vl){
                saledetail::insert(['sale_id'=>$sale_id,'product_id'=>$vl['product_id'],'unit_price_per_gram'=>$vl['unit_price']]);
                if($sale_status==1){
                    product::where('product_id',$vl['product_id'])->update(['stock'=>0]);
                }
            }

        }



            return $result = response()->json(['sale_id' => $sale_id]);
    }
    /*add sale*/

    /*add return*/
    public function add_return_into_dbs(Request $request){
        
        $sale_status = $request->sale_status;
        $return_id = $request->return_id;
        if($sale_status==1){
            $outlet_id = Auth::user()->outletid;
        }else{
            $outlet_id = $request->outlet_id;
        }
        $c_id = str_pad($request->customer_id,5,"0",STR_PAD_LEFT);
        $voucher_number = date('YmdHis').$c_id.$outlet_id;

        if($return_id==0){
            $return_id = return_purchase::insertGetId(['outlet_id'=>$outlet_id,'customer_id'=>$request->customer_id,'payment_type_id'=>$request->payment_type_id,
            'total_weight'=>$request->total_weight,'purchase_amount'=>$request->total_payable_amount,
            'discount_amount'=>$request->discount_amount,
            'return_type'=>$request->return_type,
            'return_decrease_amount'=>$request->return_decrease_amount,
            'paid_amount'=>$request->total_paid_amount,'purchase_status'=>$sale_status,
            'due_amount'=>$request->total_due_amount,'taxable_amount'=>$request->vat_tax_amount,'total_item'=>$request->total_item,
            'item_price'=>$request->total_gold_price,'voucher_number'=>$voucher_number,
            'estimate_due_payment_date'=>$request->estimate_due_given_date,'purchase_date'=>date('Y-m-d'),'purchase_datetime'=>date('Y-m-d H:i:s'),
            ]);
            $prodct_id_unit_price = $request->product_id_unit_price;
            foreach($prodct_id_unit_price as $vl){
                return_purchase_detail::insert(['return_purchase_id'=>$return_id,'product_id'=>$vl['product_id'],'unit_price_per_gram'=>$vl['unit_price']]);
                if($sale_status==1){
                    product::where('product_id',$vl['product_id'])->update(['stock'=>1,'weight'=>$vl['unit_gram']]);
                }
            }
        }else{

            return_purchase::where('return_purchase_id',$return_id)->update(['outlet_id'=>$outlet_id,'customer_id'=>$request->customer_id,'payment_type_id'=>$request->payment_type_id,
            'total_weight'=>$request->total_weight,'purchase_amount'=>$request->total_payable_amount,
            'discount_amount'=>$request->discount_amount,'return_type'=>$request->return_type,'paid_amount'=>$request->total_paid_amount,'purchase_status'=>$sale_status,
            'due_amount'=>$request->total_due_amount,'taxable_amount'=>$request->vat_tax_amount,'total_item'=>$request->total_item,
            'return_decrease_amount'=>$request->return_decrease_amount,'item_price'=>$request->total_gold_price,
            'estimate_due_payment_date'=>$request->estimate_due_given_date,
            ]);
            $prodct_id_unit_price = $request->product_id_unit_price;
            $product_sale_list = return_purchase_detail::where('return_purchase_id',$return_id)->get();
            foreach($product_sale_list as $product){
                product::where('product_id',$product->product_id)->update(['stock'=>0]);
            }
            return_purchase_detail::where('return_purchase_id',$return_id)->delete();
            foreach($prodct_id_unit_price as $vl){
                return_purchase_detail::insert(['return_purchase_id'=>$return_id,'product_id'=>$vl['product_id'],'unit_price_per_gram'=>$vl['unit_price']]);
                if($sale_status==1){
                    product::where('product_id',$vl['product_id'])->update(['stock'=>0,'weight'=>$vl['unit_gram']]);
                }
            }

        }



            return $result = response()->json(['return_id' => $return_id]);
    }
    /*add return*/

    public function get_settings()
    {
        $settings=sitesetting::where('setting_id', 1)->first();
        return $result = response()->json(['settings' => $settings]);
    }
    
    public function get_all_list_counter(){
        $outlet_id = Auth::user()->outletid;
        $data=array();
        $basic_info = array();
        $product_info = array();
        $sales_info = array();
        $basic_info['total_product'] = product::where('delete_status',"0")->get()->count();
        $basic_info['total_outlet'] = outlet::where('delete_status',"0")->get()->count();
        $basic_info['total_sale'] = sale::where('delete_status',"0")->get()->count();
        $basic_info['total_sold_product'] = product::where(['delete_status'=>"0","stock"=>"0"])->get()->count();
        $basic_info['total_unsold_product'] = product::where(['delete_status'=>"0","stock"=>"1"])->get()->count();
        $basic_info['total_customer'] = customer::where('delete_status',"0")->get()->count();
        $data['basic_info']=$basic_info;
        $outlet_list = outlet::where('delete_status',"0")->get();
        foreach($outlet_list as $outlet){
            $product_info['total_sold_product_outlet_'.$outlet->outlet_id]= product::where(['delete_status'=>"0","stock"=>"0","outlet_id"=>$outlet->outlet_id])->get()->count();
            $product_info['total_unsold_product_outlet_'.$outlet->outlet_id]= product::where(['delete_status'=>"0","stock"=>"1","outlet_id"=>$outlet->outlet_id])->get()->count();
            $sales_info['total_sale_amount_info_outlet_'.$outlet->outlet_id] = collect(\DB::select("select SUM(sale_amount) as total_sale_amount, SUM(total_weight) as total_sale_weight,SUM(paid_amount) as total_paid_amount,SUM(due_amount) as total_due_amount,SUM(total_item) as total_sale_qty,SUM(item_price) as total_gold_price from sales where outlet_id='".$outlet->outlet_id."'"))->first();
            $sales_info['today_sale_amount_info_outlet_outlet_'.$outlet->outlet_id] = collect(\DB::select("select SUM(sale_amount) as total_sale_amount, SUM(total_weight) as total_sale_weight,SUM(paid_amount) as total_paid_amount,SUM(due_amount) as total_due_amount,SUM(total_item) as total_sale_qty,SUM(item_price) as total_gold_price from sales where sale_date=CURDATE() and outlet_id='".$outlet->outlet_id."'"))->first();
        }
        $data['outlet_product_info']=$product_info;
        $data['total_sale_amount_info'] = collect(\DB::select("select SUM(sale_amount) as total_sale_amount, SUM(total_weight) as total_sale_weight,SUM(paid_amount) as total_paid_amount,SUM(due_amount) as total_due_amount,SUM(total_item) as total_sale_qty,SUM(item_price) as total_gold_price from sales"))->first();
        $data['today_sale_amount_info'] = collect(\DB::select("select SUM(sale_amount) as total_sale_amount, SUM(total_weight) as total_sale_weight,SUM(paid_amount) as total_paid_amount,SUM(due_amount) as total_due_amount,SUM(total_item) as total_sale_qty,SUM(item_price) as total_gold_price from sales where sale_date=CURDATE()"))->first();
        $data['outlet_sales_info']=$sales_info;
        return $result = response()->json(['total_counter_list' => $data]);
    }
}
