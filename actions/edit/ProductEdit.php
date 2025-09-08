<?php
use Html\Form\Select;
function ProductEdit_GET(Web $w){
    $w->setLayout('layout-bootstrap-5');

    $p = $w->pathMatch("id");
    $w->ctx("title","Add Product");

    var_dump($p['id']);

    if (!empty($p['id'])) 
   {
        $Product = PosService::getInstance($w)->GetProductForId($p['id']);
        $post_url = '/pos-edit/ProductEdit/' . $p['id'];


       
   }
    else 
   {
        $Product = new ProductItem($w);
        $post_url = '/pos-edit/ProductEdit/';
   }

    


    $form = [
       "Site Details" => [
           [
               ["Product Name", "text", "productname", $Product->name],
                (new Select([
                    "id|name" => "productcategory",
                    "label" => "Category",
                    "style" => "width: 100%"
                ]))
                ->setOptions(PosService::getInstance($w)->GetAllCategories()),
               ["Sku", "text", "productsku", $Product->sku],
               ["Cost", "text", "productcost", $Product->cost],
               ["Retail", "text", "productretail", $Product->retail],
           ]
       ]
    ];


    $w->out(Html::multiColForm($form, $post_url));
}


function ProductEdit_POST(Web $w){

    $p = $w->pathMatch("id");
 if (!empty($p['id'])) 
   {
        $Product = PosService::getInstance($w)->GetProductForId($p['id']);
        $post_url = '/pos-edit/ProductEdit/' .$p['id'];
   }
    else 
   {
        $Product = new ProductItem($w);
        $post_url = '/pos-edit/ProductEdit/';
   }

    $Product->Name = $_POST['productname'];
    $Product->Category = $_POST['productcategory'];
    $Product->Sku = $_POST['productsku'];
    $Product->Cost = $_POST['productcost'];
    $Product->Retail = $_POST['productretail'];
    
    $Product->insertOrUpdate();
        
    $msg = "Product Data Saved";
    $w->msg($msg, "/pos-dashboard/ProductDashboard");


}