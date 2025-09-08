<?php
function CategoryDelete_ALL(Web $w){

    $p = $w->pathMatch("id");

    $Category = PosService::getInstance($w)->GetCategoryForId($p['id']);
    $Category->is_deleted = 1;

    $Category->insertOrUpdate();

    $msg = "Category Deleted";
    $w->msg($msg, "/pos-dashboard/CategoryDashboard");
}