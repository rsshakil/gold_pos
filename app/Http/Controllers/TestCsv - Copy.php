<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\keyword;

class TestCsv extends Controller
{
    /**
     * Show the page to manage Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    
    public function index(Request $request){ 

        
        $data["key_data"] = DB::table('keywords')->get();

        $file = $request->file('file');
        if(isset($file)){
            $file_name = time().'_'.$file->getClientOriginalName();// File Name change 
            $file_temp_path = public_path('All_csv');//temporary path 

            $file->move($file_temp_path, $file_name);
            $baseUrl = public_path('/All_csv/') . $file_name;
            $data['datas'] =  $this->csvReader($baseUrl);

           
            
            return view('backend.pages.csvUpload',$data); 
        }else{
            $data['datas']="no";
            return view('backend.pages.csvUpload',$data);
        } 
    }


       
    public function csvReader($baseUrl)
    {
        $data = array_map('str_getcsv', file($baseUrl));
        
        $csv_data = array_slice($data, 0);

        $data = [];
        foreach ($csv_data as $key => $values) {
            // if($key > 0){
                foreach ($values as $i => $value) {
                    // echo $csv_data[0][$i].'-'.$value.'<br/>';
                    // array_push($data, var)
                    $data[$key][$csv_data[0][$i]] = $value;
                    // $values[$csv_data[0][$i]] = $value;
                }
            // }
        }
        /*echo '<pre>';
        print_r($data);
        die();*/
        // \Log::debug('----- CSV file read completed from this url: (' . $baseUrl . ')-----');
        return $data;
    }

    public function key_add(Request $request){
        // return $request->all(); 
        $key = $request->keyName;
        $value = $request->keyValue;

        keyword::insert([
            'key_name'=>$key,
            'key_value'=> $value
        ]);

    }

    // public function key_view(){
         
    // }


}