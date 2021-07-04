<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\import_data;
use App\rule_format;
use App\rule;
use App\User;
use DB;
use Hash;
use App\keyword;


    class CsvController extends Controller
    {

        public function index(Request $request){ 
            $data["key_data"]  = DB::table('keywords')->get();
            $data["rules_data"] = DB::table('rules')->get();
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
            // \Log::debug('----- CSV file read completed from this url: (' . $baseUrl . ')-----');
            return $csv_data;
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

        public function key_delete($key_id){
            return $key_id;
        }

        public function rule_insert(Request $request) {

            $rule_name = $request->ruleName;
            $col_count = $request->colCount;
            $oldCsvHeaders = $request->oldCsvHeaders;
            $ruleFormat = $request->ruleFormat;
            $format_array=array();
            $last_id =  import_data::insertGetId([
                'col_count'=> $col_count,
                'col_header'=> $oldCsvHeaders
            ]);

            $last_rule_id =  rule::insertGetId([

            'import_data_id'=> $last_id,
            'rule_name'=>$rule_name

           ]);
            // return "inserted";
            // return $last_id;

            foreach ($ruleFormat as $key => $value) {
                $test['rule_id']=$last_rule_id;
                $test['source_type']=$value['source'];
                $test['source']=$value['ex_name'];
                $test['destination']=$value['new_name'];
                $test['serial']=$key+1;
                $format_array[]=$test;
            }
            rule_format::insert($format_array);
            return "Inserted";
        } 



        public function rule_update(Request $request){

            $updatdRules = $request->updatdRules;
            $id = $request->id;
          
            $format_array=array();
            $i=1;
            $delete = DB::table('rule_formats')->where('rule_id', '=', $id)->delete();
                foreach ($updatdRules as $value) {
                    $test['rule_id']=$id;
                    $test['source_type']=$value['source_type'];
                    $test['source']=$value['oldName'];
                    $test['destination']=$value['newName'];
                    $test['serial']=$i++;
                    $format_array[]=$test;
                }

            DB::table('rule_formats')->insert($format_array);
            return "updated ";
            }
        public function ruleDataShow($r_id){

            $users["rule_data"] = DB::table('rules')
                ->join('rule_formats', 'rules.rule_id', '=', 'rule_formats.rule_id')
                ->join('import_datas', 'rules.import_data_id', '=', 'import_datas.import_data_id')
                ->select('rules.*', 'rule_formats.source_type', 'rule_formats.source','rule_formats.destination',
                    'rule_formats.serial','import_datas.col_count','import_datas.col_header')
                ->where('rules.rule_id', $r_id)->get();
            print_r(json_encode ($users["rule_data"]));
            
            }








        ///Api Start From here 

        public function get_rule_list($r_id){
            $users["rule_data"] = DB::table('rules')
                ->join('rule_formats', 'rules.rule_id', '=', 'rule_formats.rule_id')
                ->join('import_datas', 'rules.import_data_id', '=', 'import_datas.import_data_id')
                ->select('rules.*', 'rule_formats.source_type', 'rule_formats.source','rule_formats.destination',
                    'rule_formats.serial','import_datas.col_count','import_datas.col_header')
                ->where('rules.rule_id', $r_id)->get();
            print_r(json_encode ($users["rule_data"]));
        }


        public function getRules(Request $request){
    
            $user = User::where('name', '=', $request['user_name'])->first();
            $password = $request['pass'];
            if (Hash::check($password, $user->password)) {
                return DB::table('rules')->get();
            }else {
                return "don't know this user";
            }
        }


        public function getKeys(Request $request){
    
                return DB::table('keywords')->get();
        
        }
            /*  ["BBB,CCCC"],
            ["11,12,"],
            ["21,22,"],
            ["31,32,"],
            ["41,42,"]*/
        public function changeDataUsingRules(Request $request){

            $csvData=$request['data'];
            $firstColum=$request['data'][0];
            $afterCheck = array();
            $rule = rule_format::where('rule_id','=', $request['rule_id'])->orderBy('serial', 'asc')->get();
            $ruleNames= [];
            foreach ($rule as $key => $value) {
                array_push($ruleNames,$value["source"]);
            }

            // echo "<pre>";
            // print_r($ruleNames);
            // die;     
           foreach ($ruleNames as  $key => $name) {
            $user = rule_format::where('source', '=', $name)->where('rule_id', '=', $request['rule_id'])->first();
                if ($user!=NULL) {
                    $array_push['nameEx']=$name;
                    $array_push['nameNew']=$user['destination'];
                    $array_push['key_file']=$user['source_type'];
                    $array_push['index']= $key;
                    $array_push['oldcsvpos']=  array_search($name,$firstColum);
                    $kewordData =  DB::table('keywords')->where('key_name', '=', $name)->first();
                    $array_push['keyValue']= $kewordData->key_value;
                    array_push($afterCheck,$array_push);
                }
            }

            $tempArray=[];
            $index=0;

            foreach ($csvData as $key => $single) {

                $ara=[];
                if ($index==0) {
                 array_push($tempArray, $ruleNames);
                }else{
                    foreach ($afterCheck as $key => $value) {
                        if ($value["key_file"]=="key") {
                            array_push( $ara,$value["keyValue"]);
                        }else{
                            array_push( $ara,$single[$value["oldcsvpos"]]);
                        }
                    }
                    array_push($tempArray, $ara);
                }
                $index++;
            }
            return $tempArray;
        }
    }
  