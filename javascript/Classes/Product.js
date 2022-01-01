import { get, post } from "../controller/ajax.js";
import { showLoading } from "../controller/Functions.js";

class Product
{
    constructor(_parent,{id,link,title,description,mobile,city,userType,telegram,images})
    {
        this.parent = _parent;
        this.id = id;
        this.link = link;
        this.title = title;
        this.description = description;
        this.mobile = mobile;
        this.city = city;
        this.userType = userType;
        this.telegram = telegram;
        this.images = images;
        return this;
    }

    renderProduct()
    {
        let newBox = document.createElement("div");
        let allImages = "";
        this.images.map(img=>{
            allImages =`${allImages}<img src=${img.link} class='col-3 smallImg' style='cursor:pointer;'>`
        })

        newBox.className = "col-12 p-0";
        newBox.innerHTML = `
        <div class="col-12 col-lg-8 mx-auto p-0 bg-light" style="border-radius:4px;direction:rtl;">
            <span style="display:block;font-family:Regular;" class="text-center">קטגוריה: ${this.city}</span>
            <img src="${this.link}" class="w-100 bigImg">
            <span style="display:block;font-family:Bold;background-color:#ef577a; color:#fff;font-size:1.5em;" class="text-center">תמונות אמיתיות</span>
            <span style="display:block;font-family:Bold;" class="text-center text-dark">${this.title}</span>
            <span style="display:block;font-family:Regular;" class="text-center text-dark">${this.description}</span>
            <div class="row justify-content-center p-2">
            ${allImages}
            </div>
            <div class="col-12 mb-3 mt-3 row justify-content-between m-0">
                <a href='tel:${this.mobile}'  class="col-12 mb-3 col-md-5 btn" style="background-color:#ef577a;color:#fff;">התקשר</a>
                <a href='https://t.me/${this.telegram}'  class="col-12 mb-3 col-md-5 btn" style="background-color:#ef577a;color:#fff;">שלח הודעה</a>
            </div>
        </div>
        `
        $(this.parent).append(newBox);
    }

    render()
    {
        let newBox = document.createElement("div");
        newBox.className = "col-12 mb-1 col-md-6 col-lg-4 p-2";
        let description = `${this.description.split(" ").splice(0,15).join(" ")}`;
        newBox.innerHTML = `
        <div class="col-12 p-0 bg-light" style="border-radius:4px;border:1px solid #ef577a!important;direction:rtl;">
            <span style="display:block;font-family:Regular;" class="text-center">קטגוריה: ${this.city}</span>
            <img src="${this.link}" class="w-100">
            <span style="display:block;font-family:Bold;background-color:#ef577a; color:#fff;font-size:1.5em;" class="text-center">תמונות אמיתיות</span>
            <span style="display:block;font-family:Bold;" class="text-center">${this.title}</span>
            <span style="display:block;" class="text-center mb-3">
            <span style="display:block;height:50px;overflow:scroll;white-space:pre-wrap;" class="text-center p-2">${description}...
            </span>
            <a href="product.php?id=${this.id}" class="mb-3" style="display: block;">קרא עוד</a>
            <div class="col-12 mb-3 row justify-content-between m-0">
                <a href='tel:${this.mobile}'  class="col-12 mb-3 col-md-5 btn" style="background-color:#ef577a;color:#fff;">התקשר</a>
                <a href='https://t.me/${this.telegram}'   class="col-12 mb-3 col-md-5 btn" style="background-color:#ef577a;color:#fff;">שלח הודעה</a>
            </div>
        </div>
        `
        $(this.parent).append(newBox);
    }

    managerRender()
    {
        let newBox = document.createElement("div");
        newBox.className = "col-12 mb-1 col-md-6 col-lg-4 p-2";
        newBox.innerHTML = `
        <div class="col-12 p-0 bg-light details" data-id=${this.id} style="border-radius:4px;border:1px solid #ef577a!important;direction:rtl;">
            <img src="${this.link}" class="w-100">
            <div class="form-group">
                <input type='text' class='form-control title' data-id=${this.id} value="${this.title}">
           </div>
            <div class="form-group">
                <input type='text' class='form-control description' data-id=${this.id} value="${this.description}">
            </div>
            <div class="form-group">
                <input type='text' class='form-control mobile' data-id=${this.id} value="${this.mobile}">
            </div>
            <div class="form-group">
                <input type='text' class='form-control telegram' data-id=${this.id} value="${this.telegram}">
            </div>
        </div>
        `
        let divCommend = document.createElement("div");
        divCommend.className = "col-12 mb-3 row justify-content-between m-0";

        let saveBTN = document.createElement("button");
        saveBTN.className ="col-12 mb-3 col-md-5 btn";
        saveBTN.style = "background-color:#ef577a;color:#fff;";
        saveBTN.innerHTML = "שמירה";
        saveBTN.addEventListener("click",()=>{
            this.editProduct();
        })

        let deleteBTN = document.createElement("button");
        deleteBTN.className ="col-12 mb-3 col-md-5 btn btn-danger";
        deleteBTN.innerHTML = "מחיקה";
        deleteBTN.addEventListener("click",()=>{
            this.deleteProduct();
        })

        $(divCommend).append(saveBTN,deleteBTN);
        $(this.parent).append(newBox);
        $(`.details[data-id=${this.id}]`).append(divCommend);

    }

    editProduct()
    {
        let form = 
        {
            description:$(`.description[data-id=${this.id}]`).val(),
            mobile:$(`.mobile[data-id=${this.id}]`).val(),
            title:$(`.title[data-id=${this.id}]`).val(),
            telegram:$(`.telegram[data-id=${this.id}]`).val(),
            id:this.id
        }
        
        showLoading();
        post("/Routes/products/Post.php",{model:"EDIT_PRODUCT",details:form}).then(res=>{
            if(res.state)
            {
                Swal.fire("הצלחנו",res.msg,"success");
            }
            else
            {
                Swal.fire("שגיאה",res.msg,"error"); 
            }
        }).catch(e=>{
            Swal.fire("שגיאה","שגיאה לא ידועה","error");
        })
    }

    deleteProduct()
    {   
        showLoading();
        post("/Routes/products/Post.php",{model:"DELETE_PRODUCT",id:this.id}).then(res=>{
            if(res.state)
            {
                Swal.fire("הצלחנו",res.msg,"success");
                $(`.details[data-id=${this.id}]`).parent().hide();
            }
            else
            {
                Swal.fire("שגיאה",res.msg,"error"); 
            }
        }).catch(e=>{
            Swal.fire("שגיאה","שגיאה לא ידועה","error");
        })
    }
}
export default Product;





let deleteBTN = document.createElement("button");
deleteBTN.className = "btn btn-danger";

function deleteProduct()
{
    get("./get.php")
}

let elementsAR = [
    {
        element:deleteBTN,
        event:"click",
        callback:deleteProduct()
    }
]

return new Promise((res,rej)=>{
    elementsAR.map(element=>{

        $(_parent).append(element.element);
    
        element.addEventListener(element.event,()=>{
            res({response:element.callback(),click:element.element})
        })
    })
})
