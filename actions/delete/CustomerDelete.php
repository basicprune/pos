<?php
function CustomerDelete_ALL(Web $w){

    $p = $w->pathMatch("id");

    $Customer = PosService::getInstance($w)->GetCustomerForId($p['id']);
    $Customer->is_deleted = 1;

    $Customer->insertOrUpdate();

    $msg = "Customer Deleted";
    $w->msg($msg, "/pos-dashboard/CustomerDashboard");
}