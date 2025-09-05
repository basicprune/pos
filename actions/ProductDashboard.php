<?php

function ProductDashboard_ALL(Web &$w)
{

    // var_dump(PosService::getInstance($w)->GetAllProducts()); exit;

    
    $w->setLayout('layout-bootstrap-5');
 
    PosService::getInstance($w)->navigation($w, "Product Dashboard");
    // $w->ctx("currentUsers", AuditService::getInstance($w)->getLoggedInUsers());

    $Products = PosService::getInstance($w)->GetAllProducts();


    


    $table = [];
    $tableHeaders = ['Name', 'Category', 'Sku', 'Cost', 'Retail', 'Actions'];
    if (!empty($Products)) {
        foreach ($Products as $Product) {
            $row = [];
            $row[] = $Product->name;
            $row[] = $Product->category;
            $row[] = $Product->sku;
            $row[] = $Product->cost;
            $row[] = $Product->retail;
            
            

            $actions = [];
            $actions[] = Html::b('/pos/ProductEdit/' . $Product->id, 'Edit Product Information');
            $actions[] = Html::b('/pos/ProductDelete/' . $Product->id, 'Delete', 'Are you sure you want to delete this product?', null, false, class: "btn-danger");

            $row[] = implode($actions);
            $table[] = $row;
        }
    }
    // else{
    //     var_dump("empty products"); die;
    // }
    
    $w->ctx("table",Html::table($table,null,"tablesorter",$tableHeaders));



}
