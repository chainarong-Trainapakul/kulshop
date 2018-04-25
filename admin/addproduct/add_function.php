<!--<script  type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js" ></script>-->
<script  type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script>
var count_row = 1;
var temp = 1; // static 
$(document).ready(function(){
   $('#container').change(function(){
       // alert('gg');
    });
    $.getJSON("../../library/get_cate.php",success = function(data){
        //alert("gg");
        var options = "";
        for(var i = 0 ; i <data.length ; i++){
            options += "<option style = 'width:50px;' value'"+data[i]+"'>" + data[i] + "</option>";
        }
        $("#Color"+temp).append(options);
    });
        $('#Color'+temp).change(function(){
            //  alert(temp);
            $.getJSON("../../library/get_product.php?cate="+$(this).val(),success = function(data){
                //alert("gg");
                var options = "";
                for(var i = 0 ; i <data.length ; i++){
                    options += "<option style = 'width:50px;' value '"+data[i]+"'>" + data[i] + "</option>";
        }
        $("#Color_2"+temp).empty();
        $("#Color_2"+temp).append(options);
        } );
    });
    var i = 1;
});

function test(count){
    //alert(count);
    
    $.getJSON("../../library/get_cate.php",success = function(data){
        //alert("gg");
        var options = "";
        for(var i = 0 ; i <data.length ; i++){
            options += "<option style = 'width:50px;' value'"+data[i]+"'>" + data[i] + "</option>";
        }
        $("#Color"+count).append(options);
        alert(options);
        default_pdname(count);
        //console.log(html);
    });
    
}
function default_pdname(count){
    $.getJSON("../../library/get_product.php?cate=สารกำจัดวัชพืช",success = function(data){
                alert(count);
                var options = "";
                for(var i = 0 ; i <data.length ; i++){
                    options += "<option style = 'width:50px;' value '"+data[i]+"'>" + data[i] + "</option>";
        }
        temp = count;
        $("#Color_2"+count).append(options);
        } );
}
function count(){
    //count_row += 1 ;
    alert("gg");
    
}
//var html = '<p /><div id = "more_row"><table id = "dynamic_feild"><td><select name="Color'+count_row+'" id = "Color"></select></td><td><select name="Color_2" id = "Color_2" ></select></td><td><input type = "number" name = "qty" id= "qty">จำนวน</td><td><a href = "#" id ="remove" onclick = "test('+count_row+');">remove</a></td></table></div>';
    //var html = '<div id ="gg"><td><input type = "number" name = "qty" id= "childqty">จำนวน</td><td><a href = "#" id ="remove"> remove</a></td></div>';
$(document).ready(function(){
    $("#add").click(function(){
        count_row += 1;
        var html = '<p /><div id = "more_row"><table id = "dynamic_feild"><td><select name="Color'+count_row+'" id = "Color'+count_row+'"></select></td><td><select name="Color_2'+count_row+'" id = "Color_2'+count_row+'" ></select></td><td><input type = "number" name = "qty" id= "qty">จำนวน</td><td><a href = "#" id ="remove" onclick = "test('+count_row+');">remove</a></td></table></div>';
        $("#container").append(html);
        console.log(html);
    });
});
$(document).ready(function(){   
    
    $("#container").on('click','#remove',function(e){

           //$(this).closest("div").remove();
    });
    });
    
</script>

<form method="post">
<div id = "container">
    <table id = "dynamic_feild">
<td><select name="Color1" id = "Color1" >
    <option style="width:580px;" >jhkhjk</option>
        </select></td>
    
<td><select name="Color_2" id = "Color_2" >

    </select></td>
        <td><input type = "number" name = "qty" id= "qty">จำนวน</td>
        <td><a href = "#" id ='add' > add more</a></td>        
        

</table>
</div>
<input type="submit" name="submit" value="Get Selected Values" />
</form>

