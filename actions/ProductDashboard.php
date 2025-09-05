<?php

function ProductDashboard_ALL(Web &$w)
{

    // var_dump(PosService::getInstance($w)->GetAllProducts()); exit;

    
    $w->setLayout('layout-bootstrap-5');
 
    PosService::getInstance($w)->navigation($w, "Product Dashboard");
    // $w->ctx("currentUsers", AuditService::getInstance($w)->getLoggedInUsers());

    $Products = PosService::getInstance($w)->GetAllProducts();


    


    $table = [];
    $tableHeaders = ['Name', 'Category', 'Sku', 'Cost', 'Retail', 'Actions'];
    if (!empty($Products)) {
        foreach ($Products as $Product) {
            $row = [];
            $row[] = $Product->name;
            $row[] = $Product->category;
            $row[] = $Product->sku;
            $row[] = $Product->cost;
            $row[] = $Product->retail;
            

            

            // // Display 'Latest Avaliable Date' with correct dates and correct color formatting
            // if ($Site->is_booked == true)
            // {
            //     $guest = ParkmanagerService::getInstance($w)->GetGuestBySiteId($Site->id);
            //     $NextAvaliableBooking = new DateTime(ParkmanagerService::getInstance($w)->GetBookingForId($guest->booking_id)->dt_endofstaydate->modify("+1 Day")->format('m/d/Y'), new DateTimeZone($_SESSION['usertimezone']));

            //     $row[] = "<font color=#c4c400><b>" . $NextAvaliableBooking->format('d/m/Y') . "</b></font>"; 
            // }
            // else if($Site->is_closed == true)
            // {
            //     $row[] = "<font color=red><b>" . "Currently Unkown" . "</b></font>";
            // }
            // else 
            // {
            //     $Now = new DateTime('now', new DateTimeZone($_SESSION['usertimezone']));
            //     $row[] = "<font color=green><b>" . $Now->format('d/m/Y') . "</b></font>";
            // }
            

            $actions = [];
            $actions[] = Html::b('/pos/ProductEdit/' . $Product->id, 'Edit Product Information');

            $row[] = implode($actions);
            $table[] = $row;
        }
    }
    // else{
    //     var_dump("empty products"); die;
    // }
    
    $w->ctx("table",Html::table($table,null,"tablesorter",$tableHeaders));



}
