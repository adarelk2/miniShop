<?php
class Product
{
    public $errors = array(),$id = "",$title="",$category="",$active="",$description="",$mobile="",$telegram="";
     protected $query = "";
     public function __construct($_id ="")/// בחירת איידי של בקשה
     {
         global $mysqli;
 
         if ($_id == "") 
         {
             array_push($this->errors, "לא נבחר איידי");
         } 
         else 
         {
             $query = $mysqli->query("Select * from Products where id='$_id'");
 
             if ($query->num_rows) 
             {
                 foreach ($query->fetch_assoc() as $key=>$val) 
                 {
                     if (isset($this->$key)) 
                     {
                         $this->$key = $val;
                     }
                 }
                 $this->query = $query->fetch_assoc();
             } 
             else 
             {
                 array_push($this->errors, "לא נמצאו נתונים עבור איידי זה");
             }
         }
         return $this;
     }

     function updateProduct($_form)
     {
        if($this->id && empty($this->errors))
        {
            $id = $this->id;

            $updateAr = array(
            "description"=>['s',$_form['description']],
            "telegram"=>['s',$_form['telegram']],
            "title"=>['s',$_form['title']],
            "mobile"=>['s',$_form['mobile']]);

            foreach($updateAr as $key=>$value)
            {
                if(!isset($_form[$key]))
                {
                    unset($updateAr[$key]);
                }
            }

            $update = SQL_UpdateBind($updateAr,"Products","where id=$id");
            if($update)
            {
                return RESPONSE_SUCCESS;
            }
            else
            {
                array_push($this->errors,RESPONSE_ERROR);
                return $this;
            }
        } 
        else 
        {
            if (empty($this->errors)) 
            {
                array_push($this->errors, "לא נמצאו נתונים");
            }

            return $this;
        }
     }

     function deleteProduct()
     {
         global $mysqli;
        if($this->id && empty($this->errors))
        {
            
            $update = SQL_UpdateBind(array("active"=>['i',0]),"Products","where id=".$this->id);
            if($update)
            {
                return RESPONSE_SUCCESS;
            }
            else
            {
                array_push($this->errors,RESPONSE_ERROR);
                return $this;
            }
        } 
        else 
        {
            if (empty($this->errors)) 
            {
                array_push($this->errors, "לא נמצאו נתונים");
            }

            return $this;
        }
     }

     function getProfile()
     {
         global $mysqli;
        if($this->id && empty($this->errors))
        {
            return $mysqli->query("Select * from Products_img where type=1 and productID=".$this->id)->fetch_assoc()['link'];
        } 
        else 
        {
            if (empty($this->errors)) 
            {
                array_push($this->errors, "לא נמצאו נתונים");
            }

            return $this;
        }
     }

     function getAllImage()
     {
         global $mysqli;
        if($this->id && empty($this->errors))
        {
            return $mysqli->query("Select * from Products_img where productID=".$this->id)->fetch_all(MYSQLI_ASSOC);
        } 
        else 
        {
            if (empty($this->errors)) 
            {
                array_push($this->errors, "לא נמצאו נתונים");
            }

            return $this;
        }
     }
}
?>