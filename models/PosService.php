<?php

class PosService extends DbService
{


    public function GetProductForId($id){
    return $this->GetObject('ProductItem', $id);
    }

    public function GetAllProducts(){
        return $this->GetObjects('ProductItem', ['is_deleted'=>0]);
    }

    public function GetCustomerForId($id){
    return $this->GetObject('CustomerItem', $id);
    }

    public function GetAllCustomers(){
        return $this->GetObjects('CustomerItem', ['is_deleted'=>0]);
    }

    public function GetTicketForId($id){
    return $this->GetObject('TicketItem', $id);
    }

    public function GetAllTickets(){
        return $this->GetObjects('TicketItem', ['is_deleted'=>0]);
    }

    public function GetCategoryForId($id){
    return $this->GetObject('CategoryItem', $id);
    }

    public function GetAllCategories(){
        return $this->GetObjects('CategoryItem', ['is_deleted'=>0]);
    }

    public function navigation(Web $w, $title = null, $prenav = null)
    {
        if ($title) {
            $w->ctx('title', $title);
        }

        $nav = $prenav ? $prenav : [];
        if (AuthService::getInstance($w)->loggedIn()) {
            $w->menuLink('pos/', 'Home', $nav);
            $w->menuLink('pos/ProductDashboard', 'Product Dashboard', $nav);
            $w->menuLink('pos/CustomerDashboard', 'Customer Dashboard', $nav);
        }

        $w->ctx("navigation", $nav);
        return $nav;
    }








}  
?>