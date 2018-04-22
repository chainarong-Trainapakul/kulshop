
function checkRegisterInfo()
{   
    clear_lable();
    var format_password = /^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]+$/i ;
    var format_phone = /(\b[0]{1}?\d{2}|\b[0]{1}?[2]{1})[-.]?(\d{3}[-.]?\d{4}\b|\d{3}[-.]?\d{3}\b)/;
    var zipCodeExpression = /\b[1-9]{1}?\d{3}[0]\b/;
	with (window.document.frmAddUser) {
		if (isEmpty(txtUserName, 'กรุณากรอก userName')) {
			txtUserName.focus();
            label_user_name.style.display= 'block';
            document.getElementById('txtUserName').style.backgroundColor = 'yellow';
			return false;
        
		}
/*        else if(call_database(txtUserName.value)){
            alert('duplicate ID');
            txtUserName.focus();
            document.getElementById('txtUserName').style.backgroundColor = 'yellow';
            return false ;
        }*/
 /*       else if(validateUserName(txtUserName.value)){
           // alert("textusername :"+txtUserName.value);
            txtUserName.focus();
             document.getElementById('txtUserName').style.backgroundColor = 'yellow';
            return false;
        }*/
        else if (isEmpty(txtUserPassword, 'กรุณากรอกรหัสผ่าน')) {
			txtUserPassword.focus(); 
            label_user_password.style.display = 'block';  document.getElementById('txtUserPassword').style.backgroundColor ='yellow';
			return false;
            
		}
        else if(document.getElementById('txtUserPassword').value.length<6 ){
            alert("กรุณาใส่รหัสผ่านให้ครบ 6 หลัก");
            label_user_password.style.display = 'block';
             
            return false ;
            
        }
        else if(!format_password.test(document.getElementById('txtUserPassword').value)){
                label_user_password.style.display = 'block';
                alert("ต้องใส่เป็นตัวเลขผสมกับตัวอักษร");
                return false ;}

        else if (isEmpty(txtUserConfirmPassword, 'กรุณายืนยันรหัสผ่าน')) {
            check_callback();
            //alert("txtuserpass");
            txtUserConfirmPassword.focus();
         // document.getElementById('txtUserPassword').style.backgroundColor ='yellow';
            document.getElementById('txtConfirmPassword').style.backgroundColor = 'yellow';
    
            //alert('con pass emtpy');
			return false;
		} 
        else if (txtUserPassword.value != txtUserConfirmPassword.value) {
			alert('รหัสผ่านไม่ตรงกัน');
            txtUserConfirmPassword.focus();
          label_user_con_password.style.display = 'block';  document.getElementById('txtConfirmPassword').style.backgroundColor='yellow';
            document.getElementById('txtUserPassword').style.backgroundColor ='yellow';
			return false;
		} 
        else if (isEmpty(txtUserEmail, 'กรุณากรอกอีเมล Email')) {
			txtUserEmail.focus();
          label_user_email.style.display = 'block';  document.getElementById('txtUserEmail').style.backgroundColor='yellow';
			return false;
		} 
        else if (validateEmail(txtUserEmail.value, 'คุณกรอกอีเมล์ไม่ถูกต้อง')==false){
			txtUserEmail.focus();
          label_user_email.style.display = 'block';  document.getElementById('txtUserEmail').style.backgroundColor='yellow';
			return false;
		}

       else if(document.getElementById('txtUserPhone').value != ""){
            if(!format_phone.test(document.getElementById('txtUserPhone').value)){
                 label_user_phone.style.display = 'block';
                alert("กรุณาใส่เบอร์โทรศัพท์ให้ถูกต้อง");
                return false ;
            }
       }
        else if(txtUserPostalCode.value != "" ){
            if(zipCodeExpression.test(txtUserPostalCode.value)){
                label_user_postal.style.display = 'block';
                alert("กรุณาใส่รหัสไปรษณีย์ให้ถูกต้อง");
    	       return false;
            }
        }
        
    else {  
			return true;
		}}
 
	}
function clear_lable(){
    label_user_name.style.display= 'none';
    label_user_password.style.display = 'none';
    label_user_con_password.style.display = 'none';
    label_user_email.style.display = 'none';
    label_user_phone.style.display = 'none';
    label_user_postal.style.display = 'none';
    
    txtUserName.style.background = 'white';
    txtUserPassword.style.background = 'white';
    txtConfirmPassword.style.background = 'white';
    txtUserEmail.style.background = 'white';
    txtUserFirstName.style.background = 'white';
    txtUserLastName.style.background = 'white';
    txtUserPhone.style.background = 'white';
    txtUserAddress.style.background = 'white';
    txtUserAddress2.style.background = 'white';
    txtUserCity.style.background = 'white';
    txtUserState.style.background = 'white';
    txtUserPostalCode.style.background = 'white';
    
    
}
function check_callback(){
    if(duplicateid == true){
    alert("check puplicate");
    }
    else {
        alert("some");
    }
}
function call_database(user_name){
    //demo();
    var posting = $.post("library/check_user.php",{
        data : user_name
    });
    
    
    posting.done(function(data_data){
        if(data_data=="true"){
            callback = true ;
            return true;
        }
        else if(data_data=="false") {  

            return false ;
            }
  
    }
            );
    
    posting.fail(function(){
        alert('fail');
    });
}
function test_callback(word_return){
    $("#label_user_name").text(function(i, origText){
        return "ชื่อผู้ใช้ซ้ำ กรุณา ใช้ชื่ออื่น";
       //$("#label_user_name").text = "55+";
    });
}

function sleep(miliseconds) {
   var currentTime = new Date().getTime();

   while (currentTime + miliseconds >= new Date().getTime()) {
   }
}
function check_call(){
    if(callback == true){
        alert("callback == true");
    }
    else if (callback == false){
        alert("callback == false");
    }
    else{
        alert('false');
    }
}
function hightlight(){
     document.getElementById('txtUserName').style.backgroundColor = 'yellow';
     document.getElementById('txtUserPassword').style.backgroundColor = 'yellow';
     document.getElementById('txtConfirmPassword').style.backgroundColor = 'yellow';
     txtUserName.focus();

}
