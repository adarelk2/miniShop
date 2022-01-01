import {get,post} from "/javascript/controller/ajax.js";
import {showLoading} from "/javascript/controller/Functions.js"

window.onload = ()=>
{
    init();
    declareViewEvent();
}

let ALL_CATEGORIES =[]

const init = async()=>
{
    ALL_CATEGORIES = await getCategories();
    console.log(ALL_CATEGORIES);
    createCategoires();
}

const createCategoires = ()=>
{
    $("#show_list").empty();

    ALL_CATEGORIES.map(category=>{
        addToTable("#show_list",category);
    })
}

const addToTable = (_parent,_category)=>
{
    let newTr = document.createElement("tr");
    newTr.innerHTML = `
    <td><button class='btn btn-danger deleteCategory' data-id=${_category.id}>מחיקה</button></td>
    <td>${_category.city}</td>
    `
    $(newTr).attr("data-id",_category.id);
    $(_parent).append(newTr)
}

const getCategories = ()=>
{
    return get("/Routes/products/Get.php",{model:"GET_CATEGORIES"}).then(res=>res.msg);
}

const declareViewEvent = ()=>
{
    $(".createCategory").on("click",async function(){
       if($("#category").val())
       {
          showLoading();
          let response = await createNewCategory($("#category").val())
          if(response.state)
          {
            Swal.fire("הפעולה בוצעה בהצלחה",response.msg,'success');
            init();
          }
          else
          {
            Swal.fire("הפעולה נכשלה",response.msg,'error');
          }
       } 
       else
       {
            Swal.fire("חובה לציין שם קטגוריה")
       }
    })

    $("#show_list").on("click",".deleteCategory",function(){
        let cAlert = confirm("פעולה זאת תמחק את כל המוצרים השייכים לאותו קטגוריה");
        if(cAlert)
        {
            showLoading()
            deleteCategory($(this).attr("data-id"));
        }
    })
}

const deleteCategory = (_id)=>
{
    return post("/Routes/admin/Post.php",{model:"deleteCategory",id:_id})
    .then(res=>{
        if(res.state)
        {
            Swal.fire("הפעולה בוצעה הצלחה",res.msg,'success');
            init();
        }
        else
        {
            Swal.fire("הפעולה נכשלה",res.msg,'error');
        }
    })
}

const createNewCategory = (_category)=>
{
    return post("/Routes/admin/Post.php",{model:"createCategory",name:_category})
    .then(res=>res)
}