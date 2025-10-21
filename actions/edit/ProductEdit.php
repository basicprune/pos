<?php
use Html\Form\Select;
use Html\Form\InputField\Text;

function ProductEdit_GET(Web $w){
    $w->setLayout('layout-bootstrap-5');

    $p = $w->pathMatch("id");
    $w->ctx("title","Add Product");


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

    

    $Categories = PosService::getInstance($w)->GetAllCategories();
    $form = [
        "Product Details" => [
            [
                new Text([
                "id|name" => "productname",
                "label" => "Product Name",
                "style" => "width: 100%",
                "value" => $Product->name,
                ]),
                (new Select([
                    "id|name" => "productcategory",
                    "label" => "Category",
                    "options" => $Categories,
                    "style" => "width: 30%",
                    "value" => $Product->category
                ])),
                new Text([
                "id|name" => "productsku",
                "label" => "Sku",
                "style" => "width: 30%",
                "value" => $Product->sku
                ]),
                new Text([
                "id|name" => "productcost",
                "label" => "Cost",
                "style" => "width: 10%",
                "value" => $Product->cost
                ]),
                new Text([
                "id|name" => "productretail",
                "label" => "Retail",
                "style" => "width: 10%",
                "value" => $Product->retail
                ]),

                
                
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
    
    $Product->insertOrUpdate(true);
        
    $msg = "Product Data Saved";
    $w->msg($msg, "/pos-dashboard/ProductDashboard");


}