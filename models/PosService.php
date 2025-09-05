<?php

class PosService extends DbService
{


    public function GetProductForId($id){
    return $this->GetObject('ProductItem', $id);
    }

    public function GetAllProducts(){
        return $this->GetObjects('ProductItem', ['is_deleted'=>0]);
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
        }

        $w->ctx("navigation", $nav);
        return $nav;
    }








}  
?>