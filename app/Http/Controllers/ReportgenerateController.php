<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
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
use App\product;
use App\sitesetting;
use App\sale;
use App\saledetail;
use App\payment_type;
use DB;
use PDF;

class ReportgenerateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function demoPdf(){
        $delivery_order_info = array();
        $page_name = 'pdf_gen';
        //$page_name = 'demo';
        return $this->pdf_gen('',$page_name,$delivery_order_info);
    }

    public function pdf_gen($paper_size='A4',$page_name,$delivery_order_info)
    {
        $file_name = 'test.pdf';
        $pdf = PDF::loadView('backend.report.pdf_gen',compact('delivery_order_info'));
        $pdf->setPaper($paper_size, 'portrait'); //landscape
        $pdf->save(storage_path().'/app/public/All_Report/'.$file_name);
        return $pdf->download($file_name);
        //return $pdf->stream($file_name);
    }  

    public function print_sale($sale_id){
        $sale_list=DB::table('sales')
            ->join('outlets', 'outlets.outlet_id', '=', 'sales.outlet_id')
            ->join('customers', 'customers.customer_id', '=', 'sales.customer_id')
            ->join('payment_types', 'payment_types.payment_type_id', '=', 'sales.payment_type_id')
            ->select('sales.*','outlets.*','customers.customer_name', 'customers.customer_phone','payment_types.payment_type_name')
            ->where('sales.delete_status', "0")
            ->where('sales.sale_id', $sale_id)
            ->orderBy('sales.sale_id', 'desc')
            ->first();
        

            $product_list=DB::table('saledetails')
            ->join('products', 'saledetails.product_id', '=', 'products.product_id')
            ->join('product_categories', 'product_categories.product_categorie_id', '=', 'products.product_categorie_id')
            ->join('product_sub_categories', 'product_sub_categories.product_sub_categorie_id', '=', 'products.product_sub_categorie_id')
            ->select('products.*','saledetails.unit_price_per_gram','product_categories.category_name', 'product_sub_categories.product_sub_cat_name')
            ->where('saledetails.sale_id', $sale_id)
            ->orderBy('saledetails.product_id', 'desc')
            ->get();
            return view('backend.report.print_sale', compact('sale_list','product_list'));

        $file_name = 'test.pdf';
        $pdf = PDF::loadView('backend.report.print_sale',compact('sale_list','product_list'));
        $paper_size='A4';
        $pdf->setPaper($paper_size, 'portrait'); //landscape//portrait
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
       // $pdf->save(storage_path().'/app/public/All_Report/'.$file_name);
        //return $pdf->download($file_name);
        return $pdf->stream($file_name);
    }
    public function barcode_generator(Request $request){
        $product_id = $request->product_id;
        
        $product_list = DB::table('products')
        ->whereIn('product_id', $product_id)
        ->get();
        $file_name = 'barcode.pdf';
        // return view('backend.report.barcode_print', compact('product_list'));
        // $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf = PDF::loadView('backend.report.barcode_print',compact('product_list'));
        // $pdf->loadView('backend.report.barcode_print',compact('product_list'));
        $paper_size='A4';
        $customPaper = array(0,0,180,170);
        $pdf->setPaper($customPaper, 'portrait'); //landscape//portrait
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        // $pdf->save(storage_path().'/app/public/All_Report/'.$file_name);
        //return $pdf->download($file_name);
        return $pdf->stream($file_name);
    }
}
