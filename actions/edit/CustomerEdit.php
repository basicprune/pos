<?php
function CustomerEdit_GET(Web $w){
    $w->setLayout('layout-bootstrap-5');

    $p = $w->pathMatch("id");
    $w->ctx("title","Add Customer");


    if (!empty($p['id'])) 
   {
        $Customer = PosService::getInstance($w)->GetCustomerForId($p['id']);
        $post_url = '/pos-edit/CustomerEdit/' . $p['id'];


       
   }
    else 
   {
        $Customer = new CustomerItem($w);
        $post_url = '/pos-edit/CustomerEdit/';
   }

    


    $form = [
       "Customer Details" => [
           [
               ["First Name", "text", "customerfirst", $Customer->firstname],
               ["Last Name", "text", "customerlast", $Customer->lastname],
               ["Email", "text", "customeremail", $Customer->email],
               ["Phone", "text", "customerphone", $Customer->phone],
           ]
       ]
    ];


    $w->out(Html::multiColForm($form, $post_url));
}


function CustomerEdit_POST(Web $w){

    $p = $w->pathMatch("id");
 if (!empty($p['id'])) 
   {
        $Customer = PosService::getInstance($w)->GetCustomerForId($p['id']);
        $post_url = '/pos-edit/CustomerEdit/' .$p['id'];
   }
    else 
   {
        $Customer = new CustomerItem($w);
        $post_url = '/pos-edit/CustomerEdit/';
   }

    $Customer->firstname = preg_replace('/\s+/', '', $_POST['customerfirst']);
    $Customer->lastname = preg_replace('/\s+/', '', $_POST['customerfirst']);
    $Customer->fullname = $Customer->firstname . ' ' . $Customer->lastname;
    $Customer->email = $_POST['customeremail'];
    $Customer->phone = $_POST['customerphone'];
    
    $Customer->insertOrUpdate();
        
    $msg = "Product Data Saved";
    $w->msg($msg, "/pos-dashboard/CustomerDashboard");


}