import {get} from "../controller/ajax.js";
import {getUrlVars,showLoading} from "../controller/Functions.js"
import Product from "../Classes/Product.js?123"
import {userType} from "../Const/userType.js"

window.onload = ()=>
{
    init();
}

const resNum = 
{
    products:0,
    categories:1
}

const init = async()=>
{
    showLoading()
    let category = getUrlVars().category;
    let productList = getProductsList(category);
    let categories = getCategories();

    Promise.all([productList,categories]).then(res=>{
        Swal.close();
        createProduct(res[resNum.products].msg);
        if(category)
        {
            let index = res[resNum.categories].msg.find(Element=>{
                return Element.id == category ? true : false;
            })
            $(".categoires").html(`<h2 class='text-center'>${index.city}</h1>`);            
        }
        else
        {
            createCategories(res[resNum.categories].msg);
        }
    })
}

const createProduct = (_productsAr)=>
{
    $("#show_list").empty();
    $(".title").empty();
    if(_productsAr.length)
    {
        _productsAr.map(prod=>{
            let product = new Product("#show_list",prod);
            let method = "render";
            if(product.userType == userType.Manager)
            {
                method = "managerRender";
            }

            product[method]();
        })
    }
    else
    {
        $(".title").html("<h1 class='text-center text-light'>לא נמצאו תוצאות</h1>");
    }
}

const createCategories = (_categoriesAr)=>
{
    if(_categoriesAr.length)
    {
        _categoriesAr.map((category,index)=>{
            let newCategory = document.createElement("button");
            newCategory.innerHTML = category.city
            newCategory.className = "btn btn-light mx-2 mb-2";
            $(".categoires").append(newCategory)

            newCategory.addEventListener("click",function(){
                getProductsList(category.id).then(res=>{
                    createProduct(res.msg);
                });
            })
        })
    }
}

const getProductsList = (_category)=>
{
    return get("/Routes/products/Get.php",{model:"GET_PRODUCTS_LIST",category:_category}).then(res=>res).catch(e=>{
        return [];
    });
}

const getCategories = ()=>
{
    return get("/Routes/products/Get.php",{model:"GET_CATEGORIES"}).then(res=>res).catch(e=>{
        console.log(e);
        return [];
    });
}
