<?php
function ProductEdit_GET(Web $w){
    $w->setLayout('layout-bootstrap-5');

    $p = $w->pathMatch("id");
    $w->ctx("title","Add Product");

    var_dump($p['id']);

    if (!empty($p['id'])) 
   {
        $Product = PosService::getInstance($w)->GetProductForId($p['id']);
        $post_url = '/pos/ProductEdit/' . $p['id'];


       
   }
    else 
   {
        $Product = new ProductItem($w);
        $post_url = '/pos/ProductEdit/';
   }

    


    $form = [
       "Site Details" => [
           [
               ["Product Name", "text", "productname", $Product->name],
               ["Category", "text", "productcategory", $Product->category],
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
        $post_url = '/pos/ProductEdit/' .$p['id'];
   }
    else 
   {
        $Product = new ProductItem($w);
        $post_url = '/pos/ProductEdit/';
   }

    $Product->Name = $_POST['productname'];
    $Product->Category = $_POST['productcategory'];
    $Product->Sku = $_POST['productsku'];
    $Product->Cost = $_POST['productcost'];
    $Product->Retail = $_POST['productretail'];
    
    $Product->insertOrUpdate();
        
    $msg = "Product Data Saved";
    $w->msg($msg, "/pos/ProductDashboard");


}