<?php
use Html\Form\Select;
use Html\Form\Html5Autocomplete;

function TicketEdit_GET(Web $w){
    $w->setLayout('layout-bootstrap-5');

    $p = $w->pathMatch("id");
    $w->ctx("title","Add Ticket");

    if (!empty($p['id'])) 
   {
        $Ticket = PosService::getInstance($w)->GetTicketForId($p['id']);
        $post_url = '/pos-edit/TicketEdit/' . $p['id'];       
   }
    else 
   {
        $Ticket = new TicketItem($w);
        $post_url = '/pos-edit/TicketEdit/';
   }
   

   // Make search for customer's    
   // Add fields for private notes and diagnostic notes
   // Add product selection window
   // add status selection

            //    ["Phone", "text", "ticketdiagnosticpath", $Ticket->diagnosticpath],
            //    ["Phone", "text", "ticketprivatepath", $Ticket->privatepath],
    $Customers = PosService::getInstance($w)->GetAllCustomers();
    $form = [
       "Ticket Details" => [
           [
            (new Html5Autocomplete([
                    "id|name" => "customer",
                    "label" => "Customer",
                    "placeholder" => "Search",
                    "value" => !empty($Ticket->customerid) ? $Ticket->customerid : null,
                    "source" => $w->localUrl("/pos-ajax/ajaxSearch"),
                    "minItems" => 2,
            ])),
               (new Select([
                    "id|name" => "status",
                    "label" => "Status",
                    "style" => "width: 100%"
                ]))
                ->setOptions(PosService::getInstance($w)->GetAllStatuses()),
               ["Diagnostic Note", "text", "diagnosticnote", $Ticket->diagnosticnote],
               ["Private Note", "text", "privatenote", $Ticket->privatenote],

           ]
       ]
    ];


    $w->out(Html::multiColForm($form, $post_url));
}


function TicketEdit_POST(Web $w){

    $p = $w->pathMatch("id");
 if (!empty($p['id'])) 
   {
        $Ticket = PosService::getInstance($w)->GetTicketForId($p['id']);
        $post_url = '/pos-edit/TicketEdit/' .$p['id'];
   }
    else 
   {
        $Ticket = new TicketItem($w);
        $post_url = '/pos-edit/TicketEdit/';
   }
    $Ticket->invoiceid = "NULL";
    $Ticket->itemid = "NULL";
    $Ticket->customerid = $_POST['customer'];
    $Ticket->status = $_POST['status'];
    $Ticket->diagnosticnote = $_POST['diagnosticnote'];
    $Ticket->privatenote = $_POST['privatenote'];
    
    $Ticket->insertOrUpdate(true);
        
    $msg = "Ticket Data Saved";
    $w->msg($msg, "/pos-dashboard/TicketDashboard");


}