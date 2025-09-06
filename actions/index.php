<?php

function index_ALL(Web &$w)
{

    // var_dump(PosService::getInstance($w)->GetAllProducts()); exit;

    
    $w->setLayout('layout-bootstrap-5');
 
    PosService::getInstance($w)->navigation($w, "POS DASHBOARD");
    // $w->ctx("currentUsers", AuditService::getInstance($w)->getLoggedInUsers());

    $w->ctx("currentUsers", AuditService::getInstance($w)->getLoggedInUsers());



}
