<!--<script  type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js" ></script>-->
<script  type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script>

$(document).ready(function(){
    $.getJSON("../../library/get_cate.php",success = function(data){
        //alert("gg");
        var options = "";
        for(var i = 0 ; i <data.length ; i++){
            options += "<option style = 'width:50px;' value'"+data[i]+"'>" + data[i] + "</option>";
        }
        $("#Color").append(options);
    });
        $('#Color').change(function(){
            $.getJSON("../../library/get_product.php?cate="+$(this).val(),success = function(data){
                //alert("gg");
                var options = "";
                for(var i = 0 ; i <data.length ; i++){
                    options += "<option style = 'width:50px;' value '"+data[i]+"'>" + data[i] + "</option>";
        }
        $("#Color2").append(options);
        } );
    });
    var i = 1;
});
var html = '<p /><div id = "more_row"><table id = "dynamic_feild"><td><select name="Color" id = "childColor"></select></td><td><select name="Color2" id = "childColor2" ></select></td><td><input type = "number" name = "qty" id= "childqty">จำนวน</td><td><a href = "#" id ="remove">remove</a></td></table></div>';
    //var html = '<div id ="gg"><td><input type = "number" name = "qty" id= "childqty">จำนวน</td><td><a href = "#" id ="remove"> remove</a></td></div>';
$(document).ready(function(){
    $("#add").click(function(){
        $("#container").append(html);
    });
});
$(document).ready(function(){   
    
    $("#container").on('click','#remove',function(e){

        //$(this).parent().parent().parent().parent().remove();
           $(this).closest("div").remove();
    });
    });
    
    
    
    /*$("#container").on('click', '#remove', function(e){
        $(this).parent('div').remove();
    });*/

</script>

<form method="post">
<div id = "container">
    <table id = "dynamic_feild">
<td><select name="Color" id = "Color">
    <option style="width:580px;" >jhkhjk</option>
        </select></td>
    
<td><select name="Color2" id = "Color2" >

    </select></td>
        <td><input type = "number" name = "qty" id= "qty">จำนวน</td>
        <td><a href = "#" id ='add'> add more</a></td>        
        

</table>
</div>
<input type="submit" name="submit" value="Get Selected Values" />
</form>

