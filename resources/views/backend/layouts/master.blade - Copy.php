<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('title')
    <link rel="shortcut icon" href="<?php echo(\Config::get('app.url') . '/public/backend/images/logo/favicon.ico');?>">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo(\Config::get('app.url').'/public/css/app.css');?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.css">

    <link href="<?php echo(\Config::get('app.url').'/public/dashboard/styles/shards-dashboards.1.1.0.min.css');?>"
        rel="stylesheet">
    <link rel="stylesheet"
        href="<?php echo(\Config::get('app.url').'/public/dashboard/styles/extras.1.1.0.min.css');?>">
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    {{-- Select2 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    
    @include('backend.layouts.js_variable')
</head>
<style type="text/css">

    .clicked {
        background-color: yellow;
    }

</style>
<body>
    <div class="container-fluid" id="app">
        <div class="row">
            <!-- Sidebar -->
            @include('backend.pages.sidebar')
            @include('backend.pages.header')
            @yield('content')
            @include('backend.modals.delete_modal')
            @include('backend.modals.permission_show_modal')
            @include('backend.pages.footer')
</div>
   


    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/0.9.1/jquery.tablednd.js" integrity="sha256-d3rtug+Hg1GZPB7Y/yTcRixO/wlI78+2m08tosoRn7A=" crossorigin="anonymous"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/js/app.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/dashboard/scripts/extras.1.1.0.min.js')?>"></script>
    {{-- Select2 --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script src="<?php echo(\Config::get('app.url').'/public/js/role_permission.js')?>"></script>
 
    <script>
    var autoIndex = 0;
    var i = 1;
    var selectIndex;
    var newHeader = [];
    $(document).ready(function(){

        //New colum add for creatting csv table 
          $('#add_new_col').click(function(){
             newHeader.push({newName: '',oldName: ''});
            $("tbody#td_col_name_input").append('<tr><td style="width:40%"><input type="text" name="new_input_header" id="new_input_header-'+ autoIndex + '" class="form-control new_input" data-value="'+autoIndex+'" style="background-color:#e1e2e3;"></td><td style="width:40%" class="old-header" id="old_header-'+ autoIndex + '" data-index="'+autoIndex+'"></td> <td id="del_col_name_input"><button id="remove_key" type="button" class="btn btn-danger">Delete</button></td></tr>');
            autoIndex++;
            i++
          });


        //Add new Key Table for adding csv table 
        $("#add_new_key_col").click(function () {
            var new_row = '<tr id="myTableRow"><td><input type="text" class="form-control" id="key_name" placeholder="key name here"></td><td><input type="text" class="form-control" id="key_value" placeholder="Value name here"></td><td style="width: 30%"><button type="submit" class="btn btn-primary" id="key_button">Submit</button><button id="new_rol_delete" type="button" class="btn btn-danger">Delete</button></td></tr>';
            $('table#keytable').find('tbody').append(new_row);
        });

    // Fore Deleting Remove key row 
        $(document).ready(function(){
            $(document).on("click","#remove_key",function() {
                $(this).closest('tr').remove();
            });
        });

        //click header for coloring  old headr 
        $(document).on("click",".old-header",function() {
            $(this).toggleClass('clicked');
        });

        //click header for coloring  old headr for matching new new csv table 
        $(document).on("click",".old-data",function() {
            $(this).toggleClass('clicked');
        });

        // click  key table row for select data 
        $(document).on("click",".key_row",function() {
            $(this).toggleClass('clicked');
        });

        // remove key table colum 
        $(document).ready(function(){
            $(document).on("click","#new_rol_delete",function() {
                $(this).closest('tr').remove();
            });
        });
    });

    $(document).on("click",".old-header",function(e) {
        //select index for matching or adjust data-index with new csv table 
        selectIndex = $(event.target).data('index');
        var new_input = $('#new_input_header-'+selectIndex).val();
        var old_header = $('#old_header-'+selectIndex).text();
        // eta ki  janina 
        newHeader[selectIndex] = {newName: new_input,oldName: old_header};
      
    });

    function setHeader(name,index) {
        $('#td_col_name_input tr').length;
        $("tbody#td_col_name_input tr").each(function(i,b) {
            if(selectIndex==i){
                $(this).find('.old-header').html(name);
                newHeader[selectIndex].oldName = name;
            }
        });
    }

    var tempDataFromView=[];
    var removeIndexes=[];
    var updatedArray=[];





    function csvCreateFun(){

        var old_csv_data = <?php echo json_encode($datas); ?>;

        //for temporary data arrray 
        tempDataFromView=[];

        //for temporary index remove
        removeIndexes=[];

        //how manu row create fro new CSV  
        var rowCount = $('#down_csv tr').length

        alert(rowCount);

        //change old name instead new name  
        for (var i = 0; i <= rowCount-1; i++) {
            var dataObj = {ex_name:"", new_name:""}
            dataObj.ex_name=$("#old_header-"+i).text();
            dataObj.new_name=$("#new_input_header-"+i).val();
            tempDataFromView.push(dataObj);
        }

        for (var i = 0; i <old_csv_data[0].length; i++){
           //console.log(old_csv_data[0][i]);
           old_csv_data[0][i]=getNameFromTemp(old_csv_data[0][i],i);
        }
        
        //console.log(old_csv_data);
       // console.log(removeIndexes);

        updatedArray=old_csv_data;
        for (var i = 0; i < removeIndexes.length; i++) {
            updatedArray=  removeEl(updatedArray,removeIndexes[i]-i);
        }

        var table = $('#modified_csv');
        var row, cell;
        for(var i=0; i<updatedArray.length; i++){
            row = $( '<tr />' );
            table.append( row );
            for(var j=0; j<updatedArray[i].length; j++){
                cell = $('<td>'+updatedArray[i][j]+'</td>')
                row.append( cell );
            }
        }
        //console.log(updatedArray);
            
    }










    function getNameFromTemp(name2,index){
        var name="";
        for (var i =0; i < tempDataFromView.length; i++) {
            if (name2==tempDataFromView[i].ex_name) {
                return tempDataFromView[i].new_name;
            }
        }
        removeIndexes.push(index);
        return name;
    }

    function removeEl(array, remIdx) {
        return array.map(function(arr) {
            return arr.filter(function(el,idx){return idx !== remIdx});  
        });
    };

    function set_key_Header(name,index) {
 
        $('#td_col_name_input tr').length;
        //console.log(selectIndex,name);
        $("tbody#td_col_name_input tr").each(function(i,b) {
            if(selectIndex==i){
                $(this).find('.old-header').html(name);
            }
        });
    }

    $(document).on("click","#key_button",function() {
        var key_name  = $("#key_name").val();
        var key_value = $("#key_value").val();
       
        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`). attr("content")}
        });
        $.ajax({
            url:"key_insert",
            type:"post",
            dataType: "JSON",
            data:{
                keyName:key_name,
                keyValue:key_value
            },
           success:function(data){
              console.log("success");
           }
        });
    });

    $(document).on("click","#key_delete",function(){
         var key_id = $(this).val();

         $.ajax({
            type: "DELETE",
            url: "keyDelete/"+key_id,
            data:{
                keyId:key_id
            },
            success: function(data){
                console.log(data);
            }
         })

    })


    $(document).on("input",".new_input",function() {
        var index = $(this).data('value');
        var new_input = $(this).val();
        var old_header = $('#old_header-'+index).text();
        newHeader[index] = {newName: new_input,oldName: old_header};
        //console.log($(this).val(),$(this).parent().next());
    });

    function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
}

function export_table_to_csv(html, filename) {
    var csv = [];
    var rows = document.querySelectorAll("#modified_csv tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV
    download_csv(csv.join("\n"), filename);
}

document.querySelector("#down_btn").addEventListener("click", function () {
    var html = document.querySelector("#modified_csv").outerHTML;
    export_table_to_csv(html, "table.csv");
});


</script>
</body>

</html>