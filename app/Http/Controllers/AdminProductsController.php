<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminProductsController extends CBController {


    public function cbInit()
    {
        $this->setTable("products");
        $this->setPermalink("products");
        $this->setPageTitle("Products");

        $this->addSelectTable("Category","category_id",["table"=>"categories","value_option"=>"id","display_option"=>"category_name","sql_condition"=>""]);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Product Name","product_name")->strLimit(150)->maxLength(255);
		$this->addText("Stock Amount","stock_amount")->strLimit(150)->maxLength(255);
		$this->addSelectTable("Supplier","supplier_id",["table"=>"suppliers","value_option"=>"id","display_option"=>"company_name","sql_condition"=>""]);
		$this->addNumber("Unit Price","unit_price");
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addCustom("Product Image")->indexDisplayTransform(function($value, $row) {
            return "<img src=".asset("product/$row->primary_key.png")." style='max-width: 100px; max-height: 100px;'>";
        });


    }
}
