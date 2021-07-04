@extends('backend.layouts.master')
@section('title')
<title>{{__('messages.dashboard_text')}}</title>
@endsection

@section('content')

<div class="main-content-container container-fluid px-4">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <!-- <span class="text-uppercase page-subtitle">Dashboard</span> -->
            {{-- <h3 class="page-title">Portal Overview</h3> --}}
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Small Stats Blocks -->
    <div class="row">
        <div class="col-lg col-md-6 col-sm-6 mb-4">
            <div class="stats-small stats-small--1 card card-small">
            
                 
              
</head>
<body>
<!---------------------- Start Import Part Here ------------------------------>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-3">
           <!-- Form -->
          <form class="md-form" method='post' action="<?php echo(\Config::get('app.url').'csv_upload_do')?>" enctype='multipart/form-data' >
            <div class="file-field">
              @csrf
                <input class="btn btn-primary" type='file' name='file' >
                <span>Choose file</span>
                <input style="margin-top: 20px; margin-bottom: 20px;" type='submit' id="submit" class="btn btn-success" name='submit'>
            </div>
          </form>
      </div>
    </div>
  </div> 

<!---------------------- End Import Part Here ------------------------------>

<!---------------------- Start CSV file View  Here ------------------------------>

  <div class="container">
    <div class="row">
      <div style="overflow-x:auto;">
        <table class="table table-bordered" id="old_csv_table">
          <tbody>
          <?php 
             if ($datas!=="no") {
              $c=1;
              /* echo "<pre>";
               print_r($datas);
              die;*/
            foreach  ($datas as $data) { ?>
              <tr id="sour0<?php echo $c++; $tdsl=0; ?>">
                <?php $tes=0; foreach ($data as $value) {?>
                      <?php if(!isset($value)) {  break;}  ?>
                    <td class="" data-tdsl="<?=$tdsl;?>" ><?php  echo $value; $tes++; $tdsl++; ?></td>
                <?php } ?>
              </tr>
            <?php } ?>
         <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<!---------------------- End  CSV File view Here ------------------------------>

<!----------------------start CSV File Operational Tool Here ------------------------------>

              <div class="container csv_view">
                <div class="row">
                  
                    <div class="col-md-2"></div>
                      <div class="col-md-2">
                        <div class="row">
                          <div  class="form-group">
                            <input id="rule_name" class="form-control"  placeholder="Rule Create"/>
                          </div>
                        </div>
                      </div>
                
                  <div class="col-md-2">
                    <select id="select" class="form-control" onchange="getRulesDetails(this)">
                      <option value="no">Rule List Select</option>
                        <?php foreach ($rules_data as $rules)  { ?>
                        <option value="<?=$rules->rule_id?>"><?=$rules->rule_name?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-4">
                    <button  type="button" class="btn btn-success">Load</button>
                    <button onclick="ruleUpdate()"  type="button" class="btn btn-primary">Update</button>
                    <button onclick="ruleInsert()"  type="button" id="rule_submit" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="col-md-1"></div>
                </div>
              </div>
              <!---------------------- End CSV File Operational Tool Herer ------------------------------>

              <!---------------------- Start CSV File Change ------------------------------>
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <table id="csv_header_view" class="table table-bordered">
                        <tbody>
                          <?php  $c=1; foreach ($datas as $key => $data){  
                            if ($key==0){
                          ?>
                          
                            <?php foreach ($data as $i =>$value) {?>
                              <tr class="old-data">
                              <td style="max-width: 50%;width: 50%;min-width: 50%;" 
                                  onclick="setHeader('<?php echo $value; ?>','<?php echo $i; ?>')">
                                  <?php echo $value; ?>
                              </td>
                              </tr>
                            <?php } ?>
                          
                          <?php  } ?>
                           <?php  } ?>
                        </tbody>
                      </table>
                    </div>

                    <div class="col-md-6">

                      <table class="table table-bordered" id="down_csv">
                        <tbody id="td_col_name_input">
                        </tbody>
                      </table>
                       <button class="btn btn-primary pull-right" id="add_new_col">+New Colum Add</button>
                       <button id="csvCreate" onclick="makeCsv()" class="btn btn-primary">New CSV</button>
                    </div>
                  </div>
                </div>

              
              <div class="container">
                <div class="row">
                  <div class="col-md-6"> 
                    <table id="nameeee" class="table table-bordered" id="">
                      <tbody>
                        <tr>
                          <th>Key name</th>
                          <th>Key Value</th>
                          <th>Operation</th>
                        </tr>

                        <?php
                         foreach ($key_data as $data) { ?> 
                          <tr onclick="set_key_Header('<?php echo $data->key_name; ?>','<?=$data->key_value;?>')" class="key_row">
                          <td><?php echo $data->key_name; ?></td>
                          <td><?php echo $data->key_value; ?></td>
                          <td style="width: 30%">
                            <button type="button" id="key_delete" value="{{ $data->key_id }}" class="btn btn-danger">Delete</button>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                       
                  </div>
                  <div class="col-md-6">
                    <div style="margin-top: 40px;" class="col-md-6"> 
                      <table id="modified_csv" class="table table-bordered" id="">
                        
                      </table>
                      <button id="down_btn" class="btn btn-primary">Download CSV</button>
                    </div>
                  </div>
                </div>
              </div>


              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <table class="table table-bordered" id="keytable">
                      <tbody>
                        <tr>
                          <th>Key name</th>
                          <th>Key Value</th>
                          <th>Operation</th>
                        </tr>
                        <!--  <tr id="myTableRow">
                          <td><input type="text" class="form-control" placeholder="key name here"></td>
                          <td><input type="text" class="form-control" placeholder="Value name here"></td>
                          <td style="width: 30%">
                            <button type="button" class="btn btn-primary">Submit</button>
                            <button id="remove_key" type="button" class="btn btn-danger">Delete</button>
                          </td>
                        </tr> -->
                      </tbody>
                    </table>
                        <button class="btn btn-primary" id="add_new_key_col">+Add new key</button>
                  </div>
                  <div class="col-md-6"></div>
                </div>
              </div>
              <!--------------End Custom JS Code ---------------->
            </div>
        </div>

    </div>
</div>
@endsection
