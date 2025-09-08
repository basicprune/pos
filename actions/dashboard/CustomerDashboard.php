<?php

function CustomerDashboard_ALL(Web &$w)
{

    // var_dump(PosService::getInstance($w)->GetAllProducts()); exit;

    
    $w->setLayout('layout-bootstrap-5');
 
    PosService::getInstance($w)->navigation($w, "Customer Dashboard");
    // $w->ctx("currentUsers", AuditService::getInstance($w)->getLoggedInUsers());

    $Customers = PosService::getInstance($w)->GetAllCustomers();


    


    $table = [];
    $tableHeaders = ['Firstname', 'Lastname', 'Email', 'Phone', 'Actions'];
    if (!empty($Customers)) {
        foreach ($Customers as $Customer) {
            $row = [];
            $row[] = $Customer->firstname;
            $row[] = $Customer->lastname;
            $row[] = $Customer->email;
            $row[] = $Customer->phone;
            
            

            $actions = [];
            $actions[] = Html::b('/pos-edit/CustomerEdit/' . $Customer->id, 'Edit Product Information');
            $actions[] = Html::b('/pos-delete/CustomerDelete/' . $Customer->id, 'Delete', 'Are you sure you want to delete this Customer?', null, false, class: "btn-danger");

            $row[] = implode($actions); 
            $table[] = $row;
        }
    }
    // else{
    //     var_dump("empty products"); die;
    // }
    
    $w->ctx("table",Html::table($table,null,"tablesorter",$tableHeaders));



}
