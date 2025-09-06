<?php
function CustomerDelete_ALL(Web $w){

    $p = $w->pathMatch("id");

    $Product = PosService::getInstance($w)->GetProductForId($p['id']);
    $Product->is_deleted = 1;

    $Product->insertOrUpdate();

    $msg = "Customer Deleted";
    $w->msg($msg, "/pos/CustomerDashboard");
}