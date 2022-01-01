import {get} from "../controller/ajax.js";
import {getUrlVars,showLoading} from "../controller/Functions.js"
import Product from "../Classes/Product.js?123"
import {userType} from "../Const/userType.js"

window.onload = ()=>
{
    init();
    declareViewEvent();
}

const init = async()=>
{
    showLoading()
    getProduct(getUrlVars().id).then(res=>{
        if(res.state)
        {
            Swal.close();
            getInfoProduct(res.msg);
        }
        else
        {
            Swal.fire("שגיאה",res.msg,'error');
        }
    });
}

const getProduct = (_id)=>
{
    return get("/Routes/products/Get.php",{model:"getProduct",id:_id}).then(res=>res).catch(e=>
        {
            return {state:false,msg:"אין נתונים"};}
        )
}

const getInfoProduct = (_product)=>
{
    console.log(_product);
    let product = new Product(".product",_product);
    product.renderProduct();
}

const declareViewEvent = ()=>
{
    $(".product").on("click",".smallImg",function(){
        $(".bigImg").attr("src",$(this).attr("src"));
    })
}