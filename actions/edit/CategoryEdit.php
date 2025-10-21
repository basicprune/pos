<?php
function CategoryEdit_GET(Web $w){
    $w->setLayout('layout-bootstrap-5');

    $p = $w->pathMatch("id");
    $w->ctx("title","Add Category");

    if (!empty($p['id'])) 
   {
        $Category = PosService::getInstance($w)->GetCategoryForId($p['id']);
        $post_url = '/pos-edit/CategoryEdit/' . $p['id'];
   }
    else 
   {
        $Category = new CategoryItem($w);
        $post_url = '/pos-edit/CategoryEdit/';
   }
   

   // Make search for customer's    
   // Add fields for private notes and diagnostic notes
   // Add product selection window
   // add status selection

            //    ["Phone", "text", "ticketdiagnosticpath", $Ticket->diagnosticpath],
            //    ["Phone", "text", "ticketprivatepath", $Ticket->privatepath],
    $form = [
       "Category Details" => [
           [
               ["Title", "text", "categorytitle", $Category->title],
           ]
       ]
    ];


    $w->out(Html::multiColForm($form, $post_url));
}


function CategoryEdit_POST(Web $w){

    $p = $w->pathMatch("id");
 if (!empty($p['id'])) 
   {
        $Category = PosService::getInstance($w)->GetCategoryForId($p['id']);
        $post_url = '/pos-edit/CategoryEdit/' .$p['id'];
   }
    else 
   {
        $Category = new CategoryItem($w);
        $post_url = '/pos-edit/CategoryEdit/';
   }

    $Category->title = $_POST['categorytitle'];
    
    
    $Category->insertOrUpdate();
        
    $msg = "New Category Added";
    $w->msg($msg, "/pos-dashboard/CategoryDashboard");


}