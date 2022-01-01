import {get,post,postFile} from "/javascript/controller/ajax.js";
import {showLoading} from "/javascript/controller/Functions.js"

window.onload = ()=>
{
    declareViewEvent();
}

const declareViewEvent = ()=>
{
    $(".createCategory").on("click",function(){
        var form_data = new FormData();    
        let form = 
        {
            title:$("#category").val(),
            description:$("#description").val(),
            category:$("#selectCategory").val(),
            telegram:$("#telegram").val(),
            mobile:$("#mobile").val()
        }
        let errors = [];
        if(!form.title)
        {
            errors.push("חובה לציין את שם המוצר");
        }
        if(!form.category)
        {
            errors.push("חובה לבחור קטגוריה");
        }
        if(!form.description)
        {
            errors.push("חובה לציין את תיאור המוצר");
        }
        if(!$("#firstFile").prop('files')[0])
        {
            errors.push("חובה לבחור תמונה ראשית");
        }
        if(errors.length)
        {
            Swal.fire("שגיאה",errors.join("<br>"),'error');
        }
        else
        {
            showLoading();
            var totalfiles = document.getElementById('files').files.length;

            if(totalfiles > 0 )
            {
                for (var index = 0; index < totalfiles; index++) {
                form_data.append("files[]", document.getElementById('files').files[index]);
              }
            }
            form_data.append('model', "createProduct");
            form_data.append('form', JSON.stringify(form));
            form_data.append('firstFile', $("#firstFile").prop('files')[0]);
            postFile("/Routes/admin/Post.php",form_data).then(res=>{
                if(res.state)
                {
                    Swal.fire("הפעולה בוצעה בהצלחה","הצלחנו","success").then(()=>{
                        location.reload();
                    });
                }
                else
                {
                    Swal.fire("הפעולה נכשלה",res.msg,'error');  
                }
            }).catch(e=>{
                console.log(e);
            })
        }
    })
}