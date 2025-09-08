<?php

class PosInitialmigration extends CmfiveMigration
{
    public function up()
    {
        // UP
        $column = parent::Column();
        $column->setName('id')
                ->setType('biginteger')
                ->setIdentity(true);
        
        if (!$this->hasTable("product_item")) {
            $this->table("product_item", [
                "id" => false,
                "primary_key" => "id"
            ])->addColumn($column)
                ->addColumn('name', 'string')
                ->addColumn('category', 'string')
                ->addColumn('sku', 'string')
                ->addMoneyColumn('cost')
                ->addMoneyColumn('retail')
                ->addCmfiveParameters()
                ->create();
        }

        if (!$this->hasTable("customer_item")) {
            $this->table("customer_item", [
                "id" => false,
                "primary_key" => "id"
            ])->addColumn($column)
                ->addColumn('firstname', 'string')
                ->addColumn('lastname', 'string')
                ->addColumn('email', 'string')
                ->addColumn('phone', 'string')
                ->addCmfiveParameters()
                ->create();
        }

        if (!$this->hasTable("invoice_item")) {
            $this->table("invoice_item", [
                "id" => false,
                "primary_key" => "id"
            ])->addColumn($column)
                ->addMoneyColumn('total')
                ->addMoneyColumn('paid')
                ->addCmfiveParameters()
                ->create();
        }

        if (!$this->hasTable("ticket_item")) {
            $this->table("ticket_item", [
                "id" => false,
                "primary_key" => "id"
            ])->addColumn($column)
                ->addColumn('customerid', 'string')
                ->addColumn('invoiceid', 'string')
                ->addColumn('itemid', 'string')
                ->addColumn('status', 'string')
                ->addColumn('diagnosticnote', 'string')
                ->addColumn('privatenote', 'string')
                ->addCmfiveParameters()
                ->create();
        }

        if (!$this->hasTable("category_item")) {
            $this->table("category_item", [
                "id" => false,
                "primary_key" => "id"
            ])->addColumn($column)
                ->addColumn('title', 'string')
                ->addCmfiveParameters()
                ->create();
        }

        if (!$this->hasTable("status_item")) {
            $this->table("status_item", [
                "id" => false,
                "primary_key" => "id"
            ])->addColumn($column)
                ->addColumn('title', 'string')
                ->addCmfiveParameters()
                ->create();
        }
    }

    public function down()
    {
        $this->hasTable('product_item') ? $this->dropTable('product_item') : null;
        $this->hasTable('customer_item') ? $this->dropTable('customer_item') : null;
        $this->hasTable('invoice_item') ? $this->dropTable('invoice_item') : null;
        $this->hasTable('ticket_item') ? $this->dropTable('ticket_item') : null;
        $this->hasTable('category_item') ? $this->dropTable('category_item') : null;
        // DOWN
    }

    public function preText()
    {
        return null;
    }

    public function postText()
    {
        return null;
    }

    public function description()
    {
        return null;
    }
}
