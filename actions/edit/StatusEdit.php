<?php
function StatusEdit_GET(Web $w){
    $w->setLayout('layout-bootstrap-5');

    $p = $w->pathMatch("id");
    $w->ctx("title","Add Status");


    if (!empty($p['id'])) 
   {
        $Status = PosService::getInstance($w)->GetStatusForId($p['id']);
        $post_url = '/pos-edit/StatusEdit/' . $p['id'];
   }
    else 
   {
        $Status = new StatusItem($w);
        $post_url = '/pos-edit/StatusEdit/';
   }
   

   // Make search for customer's    
   // Add fields for private notes and diagnostic notes
   // Add product selection window
   // add status selection

            //    ["Phone", "text", "ticketdiagnosticpath", $Ticket->diagnosticpath],
            //    ["Phone", "text", "ticketprivatepath", $Ticket->privatepath],
    $form = [
       "Status Details" => [
           [
               ["Status Title", "text", "statustitle", $Status->title],
           ]
       ]
    ];


    $w->out(Html::multiColForm($form, $post_url));
}


function StatusEdit_POST(Web $w){

    $p = $w->pathMatch("id");
 if (!empty($p['id'])) 
   {
        $Status = PosService::getInstance($w)->GetStatusForId($p['id']);
        $post_url = '/pos-edit/StatusEdit/' .$p['id'];
   }
    else 
   {
        $Status = new StatusItem($w);
        $post_url = '/pos-edit/StatusEdit/';
   }

    $Status->title = $_POST['statustitle'];
    
    
    $Status->insertOrUpdate();
        
    $msg = "Status Data Saved";
    $w->msg($msg, "/pos");


}