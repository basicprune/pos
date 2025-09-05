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
    }

    public function down()
    {
        $this->hasTable('product_item') ? $this->dropTable('product_item') : null;
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
