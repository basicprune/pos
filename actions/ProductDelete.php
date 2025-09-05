<?php
function ProductDelete_ALL(Web $w){

    $p = $w->pathMatch("id");

    $Product = PosService::getInstance($w)->GetProductForId($p['id']);
    $Product->is_deleted = 1;

    $Product->insertOrUpdate();

    $msg = "Product Deleted";
    $w->msg($msg, "/pos/ProductDashboard");
}