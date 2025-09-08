<?php

class PosService extends DbService
{

    #region GetItems
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

    public function GetStatusForId($id){
    return $this->GetObject('StatusItem', $id);
    }


    public function GetAllStatuses(){
        return $this->GetObjects('StatusItem', ['is_deleted'=>0]);
    }

    #endregion

    public function GetSelectStatus($status){
        
        if ($status == 0){
            return 'Cancled';
        }else if( $status == 1){
            return 'Ongoing';
        }else if( $status == 2){
            return 'Completed';
        }
        
    }

    public function SelectStatus($status){

        if ($status == 0){
            return 'Cancled';
        }else if( $status == 1){
            return 'Ongoing';
        }else if( $status == 2){
            return 'Completed';
        }
    }

    public function GetCustomerFullName($id){

        $customer = $this->GetObject('CustomerItem', $id);

        return $customer->firstname . ' '. $customer->lastname;
    }

    public function GetAllOpenTickets(){
        return $this->GetObjects('TicketItem', ['status'=>2]);
    }

    public function navigation(Web $w, $title = null, $prenav = null)
    {
        if ($title) {
            $w->ctx('title', $title);
        }

        $nav = $prenav ? $prenav : [];
        if (AuthService::getInstance($w)->loggedIn()) {
            $w->menuLink('pos/', 'Home', $nav);
            $w->menuLink('pos-dashboard/ProductDashboard', 'Product Dashboard', $nav);
            $w->menuLink('pos-dashboard/CustomerDashboard', 'Customer Dashboard', $nav);
            $w->menuLink('pos-dashboard/CategoryDashboard', 'Category Dashboard', $nav);
            $w->menuLink('pos-dashboard/TicketDashboard', 'Ticket Dashboard', $nav);
        }

        $w->ctx("navigation", $nav);
        return $nav;
    }








}  
?>