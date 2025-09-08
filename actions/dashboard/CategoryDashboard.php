<?php

function CategoryDashboard_ALL(Web &$w)
{

    // var_dump(PosService::getInstance($w)->GetAllProducts()); exit;

    
    $w->setLayout('layout-bootstrap-5');
 
    PosService::getInstance($w)->navigation($w, "Category Dashboard");
    // $w->ctx("currentUsers", AuditService::getInstance($w)->getLoggedInUsers());

    $Categories = PosService::getInstance($w)->GetAllCategories();


    


    $table = [];
    $tableHeaders = ['Category Title', 'Actions'];
    if (!empty($Categories)) {
        foreach ($Categories as $Category) {
            $row = [];
            $row[] = $Category->title;
            
            

            $actions = [];
            $actions[] = Html::b('/pos-edit/CategoryEdit/' . $Category->id, 'Edit Category Information');
            $actions[] = Html::b('/pos-delete/CategoryDelete/' . $Category->id, 'Delete', 'Are you sure you want to delete this Category?', null, false, class: "btn-danger");

            $row[] = implode($actions);
            $table[] = $row;
        }
    }
    // else{
    //     var_dump("empty products"); die;
    // }
    
    $w->ctx("table",Html::table($table,null,"tablesorter",$tableHeaders));



}
