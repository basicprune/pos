<?php
function TicketEdit_GET(Web $w){
    $w->setLayout('layout-bootstrap-5');

    $p = $w->pathMatch("id");
    $w->ctx("title","Add Ticket");

    var_dump($p['id']);

    if (!empty($p['id'])) 
   {
        $Ticket = PosService::getInstance($w)->GetTicketForId($p['id']);
        $post_url = '/pos/TicketEdit/' . $p['id'];


       
   }
    else 
   {
        $Ticket = new TicketItem($w);
        $post_url = '/pos/TicketEdit/';
   }
   

   // Make search for customer's    
   // Add fields for private notes and diagnostic notes
   // Add product selection window
   // add status selection

            //    ["Phone", "text", "ticketdiagnosticpath", $Ticket->diagnosticpath],
            //    ["Phone", "text", "ticketprivatepath", $Ticket->privatepath],
    $form = [
       "Customer Details" => [
           [
               ["Customer", "select", "ticketcustomerid", $Ticket->customerid],
               ["Email", "text", "ticketitemid", $Ticket->itemid],
               ["Phone", "text", "ticketstatus", $Ticket->status],
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
        $post_url = '/pos/TicketEdit/' .$p['id'];
   }
    else 
   {
        $Ticket = new TicketItem($w);
        $post_url = '/pos/TicketEdit/';
   }

    $Ticket->firstname = $_POST['customerfirst'];
    $Ticket->lastname = $_POST['customerlast'];
    $Ticket->email = $_POST['customeremail'];
    $Ticket->phone = $_POST['customerphone'];
    
    $Ticket->insertOrUpdate();
        
    $msg = "Product Data Saved";
    $w->msg($msg, "/pos/CustomerDashboard");


}