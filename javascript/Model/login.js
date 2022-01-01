import {get, post} from "../controller/ajax.js";
import { showLoading } from "../controller/Functions.js";

window.onload = ()=>
{
    declareViewEvent();
}

const declareViewEvent =()=>
{
    $(".loginBTN").on("click",function(){
       if($("#userName").val() && $("#password").val())
       {
           showLoading();
           post("/Routes/admin/Post.php",{model:"Login",userName:$("#userName").val(),password:$("#password").val()})
           .then(res=>{
               if(res.state)
               {
                  location.replace("/Admin");
               }
               else
               {
                   Swal.fire("שגיאה",res.msg,'error');
               }
           })
       }
       else
       {
           Swal.fire("שגיאה","חובה למלא שם משתמש וסיסמה","error");
       }
    })
}