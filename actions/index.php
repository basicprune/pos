<?php

function index_ALL(Web &$w)
{

    // var_dump(PosService::getInstance($w)->GetAllProducts()); exit;

    
    $w->setLayout('layout-bootstrap-5');
 
    PosService::getInstance($w)->navigation($w, "POS DASHBOARD");
    // $w->ctx("currentUsers", AuditService::getInstance($w)->getLoggedInUsers());

    $w->ctx("currentUsers", AuditService::getInstance($w)->getLoggedInUsers());

     $Tickets = PosService::getInstance($w)->GetAllOpenTickets();


    


    $table = [];
    $tableHeaders = ['Ticket ID', 'Customer', 'Status', 'Actions'];
    if (!empty($Tickets)) {
        foreach ($Tickets as $Ticket) {
            $Customer = PosService::getInstance($w)->GetCustomerForId($Ticket->customerid);
            $CustomerName = $Customer->firstname . ' '. $Customer->lastname;
            

            $row = [];
            $row[] = 'T-' . $Ticket->id;
            // $row[] = PosService::getInstance($w)->GetCustomerFullName($Ticket->id);
            $row[] = $CustomerName;
            $row[] = PosService::getInstance($w)->GetStatusForId($Ticket->status)->title;
            
            

            $actions = [];
            $actions[] = Html::b('/pos-edit/TicketEdit/' . $Ticket->id, 'Edit Ticket Information');
            $actions[] = Html::b('/pos-delete/TicketDelete/' . $Ticket->id, 'Delete', 'Are you sure you want to delete this product?', null, false, class: "btn-danger");

            $row[] = implode($actions);
            $table[] = $row;
        }
    }
    // else{
    //     var_dump("empty products"); die;
    // }
    
    $w->ctx("table",Html::table($table,null,"tablesorter",$tableHeaders));


}
