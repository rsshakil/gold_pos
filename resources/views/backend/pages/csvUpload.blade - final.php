<!DOCTYPE html>
<html>
<head>
	<title>sadf</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/0.9.1/jquery.tablednd.js" integrity="sha256-d3rtug+Hg1GZPB7Y/yTcRixO/wlI78+2m08tosoRn7A=" crossorigin="anonymous"></script>
    <style type="text/css">
      .col_name_input{
        width: 85%;
        border: none;
        outline: none;
        text-align: left;
        float: left;
      }

      /*#button {
        position: absolute;
        height: 40px;
        width: 200px;
        border: 4px solid gray;
      }*/

      .clearfix {
  clear: both;
}

body {
  padding: 0px;
  margin: 0px;
}

.nodes {
  width: 500px
}

.node {
  width: 100px;
  background: #ddd;
  color: #fff;
  margin-bottom: 10px;
}

.group1 span {
  background: #666;
  border-radius: 50%;
  width: 10px;
  height: 10px;
  margin-top: 5px;
}

.group2 span {
  border: 1px solid #666;
  border-radius: 50%;
  width: 10px;
  height: 10px;
  margin-top: 5px;
}

.node span:hover {
  background: #ff0000;
  cursor: pointer;
}

.group1 {
  float: left;
}

.group2 {
  float: right;
}

.group2 .node span {
  float: left;
  position: relative;
  left: -15px;
}

.group1 .node span {
  float: right;
  position: relative;
  right: -15px;
}

.node span[data-connect=true] {
  background: #ff00ff !important;
}

.node span[data-use=true] {
  background: #ff0000 !important;
}

   
    </style>
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
        <table class="table table-bordered">
          <tbody>
         	<?php 

         		 if ($datas=="no") {
          			echo "";
          		} else{ 
          
        		foreach ($datas as $data) { ?>
        			<tr>
        				<?php $tes=0; for($i=0; $i<500000; $i++){  ?>
        			        <?php if(!isset($data[$i])) {  break;}  ?>
        			    	<td><?php  echo $data[$i]; $tes++; ?></td>
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

<!----------------------start CSV File Operational Tool Herer ------------------------------>
 
  <div class="container csv_view">
  	<div class="row">
      <div class="col-md-2"></div>
  			<form>
    			<div class="col-md-3">
  					<div class="row">
  	          <div  class="form-group">
  	           <input class="form-control" id="firstname" placeholder="Rule Create" />
    	        </div>
          	</div>
    			</div>
  			</form>
  		<div class="col-md-2">
  			<div class="dropdown">
  		  	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  		    	Rule List Select
  		  	</button>
  			  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
  			    <a class="dropdown-item" href="#">Action</a>
  			    <a class="dropdown-item" href="#">Another action</a>
  			    <a class="dropdown-item" href="#">Something else here</a>
  			  </div>
  			</div>
  		</div>
  		<div class="col-md-4">
  			<button  type="button" class="btn btn-success">Load</button>
        <button class="btn btn-primary">Submit</button>
  		</div>
  		<div class="col-md-2"></div>
  	</div>
  </div>
<!---------------------- End CSV File Operational Tool Herer ------------------------------>

<!---------------------- Start CSV File Change ------------------------------>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <table class="table table-bordered" id="table-1">
          <tbody id="wrk_spc">
            <?php for ($i=0; $i < $tes; $i++) {  ?>
            <tr>
              <td style="max-width: 50%;width: 50%;min-width: 50%;"><?php echo $datas[0][$i] ?></td>
             
            </tr>
             <?php  } ?>
          </tbody>
        </table>
      </div>

       <div class="col-md-6">
        <table class="table table-bordered" id="table-1">
          <tbody id="wrk_spc">
            <?php for ($i=0; $i < $tes; $i++) {  ?>
            <tr>
              <td style="max-width: 50%;width: 50%;min-width: 50%;" id="td_col_name_input"></td>
            </tr>
             <?php  } ?>
          </tbody>
        </table>
         <button class="btn btn-primary pull-right" id="add_new_col">+Add</button>
         <!-- <div id="center">
            <div id="button">
                <input style="height: 32px; width: 192px;" type="text" name="keyword" placeholder="Keyword Type Here">
            </div>
          </div> -->
      </div>
    </div>
  </div>

<!---------------------- End CSV File Change ------------------------------>

<div class="container">
  <div class="row">
    
    <div id="parentNodes_11">
  <div class="nodes">
    <div class="group1">
      <div class="node">1<span class="node1" data-connect="false" data-id="0" data-use="false"></span></div>
      <div class="node">2 <span class="node2" data-connect="false" data-id="1" data-use="false"></span></div>
      <div class="node">3 <span class="node3" data-connect="false" data-id="2" data-use="false"></span></div>
    </div>
    <div class="group2">
      <div class="node">A <span class="node4" data-connect="false" data-id="0" data-use="false"></span></div>
      <div class="node">B <span class="node5" data-connect="false" data-id="1" data-use="false"></span></div>
      <div class="node">C <span class="node6" data-connect="false" data-id="2" data-use="false"></span></div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<br>


  </div>
</div>


<!-------------- Start Custom JS Code ---------------->

  <script>

    $(document).ready(function(){
      $('#add_new_col').click(function(){
          $("td#td_col_name_input").each(function() {
              if(! $(this).html() ){
                 $(this).html('<input type="text" class="col_name_input" style="background-color:#e1e2e3;">  <span class="del_col_name_input glyphicon glyphicon-trash pull-right" style="cursor: pointer"></span>');
                 return  false ; 
              } 
          });
      });

      $(document).on("click","span.del_col_name_input",function() {
          $(this).closest("tr").find("td#td_col_name_input").html("");
      });
    });
 
    $(document).ready(function() {
        // Initialise the table
        $("#table-1").tableDnD({
        });
    });

    $(document).ready(function() {
      $('#button').draggable();
    });

  </script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#parentNodes_11 .nodes').connect('#parentNodes_11');
    $('#parentNodes_12 .nodes').connect('#parentNodes_12');
  });


(function($) {
  $.fn.connect = function(param) {
    var _canvas;
    var _ctx;
    var _lines = new Array(); //This array will store all lines (option)
    var _me = this;
    var _parent = param || document;
    var _lengthLines = $(_parent + ' .group1 .node').length;
    var _selectFirst = null;
    //Initialize Canvas object

    _canvas = $('<canvas/>')
      .attr('width', $(_me).width())
      .attr('height', $(_me).height())
      .css('position', 'absolute');
    $(_parent).prepend(_canvas);
    //$(_canvas).insertBefore(_parent);
    this.drawLine = function(option) {
      //It will push line to array.
      _lines.push(option);
      this.connect(option);

    };

    this.drawAllLine = function(option) {

      /*Mandatory Fields------------------
      left_selector = '.class',
      data_attribute = 'data-right',
      */

      if (option.left_selector != '' && typeof option.left_selector !== 'undefined' && $(option.left_selector).length > 0) {
        $(option.left_selector).each(function(index) {
          var option2 = new Object();
          $.extend(option2, option);
          option2.left_node = $(this).attr('id');
          option2.right_node = $(this).data(option.data_attribute);
          if (option2.right_node != '' && typeof option2.right_node !== 'undefined') {
            _me.drawLine(option2);

          }
        });
      }
    };

    //This Function is used to connect two different div with a dotted line.
    this.connect = function(option) {

      _ctx = _canvas[0].getContext('2d');
      //
      _ctx.beginPath();
      try {
        var _color;
        var _dash;
        var _left = new Object(); //This will store _left elements offset  
        var _right = new Object(); //This will store _right elements offset 
        var _error = (option.error == 'show') || false;
        /*
        option = {
          left_node - Left Element by ID - Mandatory
          right_node - Right Element ID - Mandatory
          status - accepted, rejected, modified, (none) - Optional
          style - (dashed), solid, dotted - Optional  
          horizantal_gap - (0), Horizantal Gap from original point
          error - show, (hide) - To show error or not
          width - (2) - Width of the line
        }
        */

        if (option.left_node != '' && typeof option.left_node !== 'undefined' && option.right_node != '' && typeof option.right_node !== 'undefined' && $(option.left_node).length > 0 && $(option.right_node).length > 0) {

          //To decide colour of the line
          switch (option.status) {
            case 'accepted':
              _color = '#0969a2';
              break;

            case 'rejected':
              _color = '#e7005d';
              break;

            case 'modified':
              _color = '#bfb230';
              break;

            case 'none':
              _color = 'grey';
              break;

            default:
              _color = 'grey';
              break;
          }

          //To decide style of the line. dotted or solid
          switch (option.style) {
            case 'dashed':
              _dash = [4, 2];
              break;

            case 'solid':
              _dash = [0, 0];
              break;

            case 'dotted':
              _dash = [4, 2];
              break;

            default:
              _dash = [4, 2];
              break;
          }
          /*
            console.log($(option.left_node));
            $(option.left_node)
            $(option.right_node).data('connect',true);
          */
          //If left_node is actually right side, following code will switch elements.
          $(option.right_node).each(function(index, value) {
            _left_node = $(option.left_node);
            _right_node = $(value);

            _left_node.attr('data-connect', true);
            _right_node.attr('data-connect', true);

            if (_left_node.offset().left >= _right_node.offset().left) {
              _tmp = _left_node
              _left_node = _right_node
              _right_node = _tmp;
            }

            //Get Left point and Right Point
            _left.x = _left_node.offset().left + _left_node.outerWidth();
            _left.y = _left_node.offset().top + (_left_node.outerHeight() / 2);
            _right.x = _right_node.offset().left;
            _right.y = _right_node.offset().top + (_right_node.outerHeight() / 2);

            //Create a group
            //var g = _canvas.group({strokeWidth: 2, strokeDashArray:_dash});   

            //Draw Line
            var _gap = option.horizantal_gap || 0;

            _ctx.moveTo(_left.x, _left.y);
            if (_gap != 0) {
              _ctx.lineTo(_left.x + _gap, _left.y);
              _ctx.lineTo(_right.x - _gap, _right.y);
            }
            _ctx.lineTo(_right.x, _right.y);

            if (!_ctx.setLineDash) {
              _ctx.setLineDash = function() {}
            } else {
              _ctx.setLineDash(_dash);
            }
            _ctx.lineWidth = option.width || 2;
            _ctx.strokeStyle = _color;
            _ctx.stroke();
          });
          
          //option.resize = option.resize || false;
        } else {
          if (_error) alert('Mandatory Fields are missing or incorrect');
        }
      } catch (err) {
        if (_error) alert('Mandatory Fields are missing or incorrect');
      }
      //console.log(_canvas);
    };

    //It will redraw all line when screen resizes
    $(window).resize(function() {
      console.log(_me);
      _me.redrawLines();
    });

    $(_parent + ' .group1 .node span').click(function() {
      //console.log($(this).attr('data-connect'));
      //[data-use="false"]
      _this = this;
      if ($(_this).attr('data-connect') != 'true' && $(_this).attr('data-use') == 'false') {
        $(_parent + ' .group1 .node span').attr('data-use', 'false');
        $(_this).attr('data-use', 'true');
        _selectFirst = _this;
      } else if ($(_this).attr('data-connect') == 'true') {
        //console.log($(this).attr('data-id'));
        //console.log(entry);
        _lines.forEach(function(entry, index) {
          if ($(_this).attr('data-id') == entry.id_left) {
            $(entry.left_node).attr('data-use', 'false').attr('data-connect', 'false')
            $(entry.right_node).attr('data-use', 'false').attr('data-connect', 'false')
            _lines.splice(index, 1)
          }
        });
        _me.redrawLines();
      }
    });

    $(_parent + ' .group2 .node span[data-use="false"]').click(function() {
      if ($(_parent + ' .group1 .node span[data-use="true"]').length == 1 && _selectFirst != null) {
        if ($(this).attr('data-connect') != 'true') {
          _me.drawLine({
            id_left: $(_selectFirst).attr('data-id'),
            id_right: $(this).attr('data-id'),
            left_node: _selectFirst,
            right_node: this,
            horizantal_gap: 10,
            error: 'show',
            width: 1,
            status: 'accepted'
          });
          $(_selectFirst).attr('data-use', 'false');
          $(_selectFirst).attr('data-connect', 'true');
          $(this).attr('data-use', 'false');
          $(this).attr('data-connect', 'true');
        }
      }
    });

    this.redrawLines = function() {
      _ctx.clearRect(0, 0, $(_me).width(), $(_me).height());
      _lines.forEach(function(entry) {
        entry.resize = true;
        _me.connect(entry);
      });
    };
    return this;
  };
}(jQuery));

</script>

  <!--------------End Custom JS Code ---------------->


</html>

