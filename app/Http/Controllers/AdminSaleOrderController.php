<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\DB;

class AdminSaleOrderController extends CBController {


    public function cbInit()
    {
        $this->setTable("sale_order");
        $this->setPermalink("sale_order");
        $this->setPageTitle("Sale Order");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Invoice","invoice_id")->showIndex(false)->showDetail(false)->showAdd(false)->showEdit(false)->strLimit(150)->maxLength(255);
		$this->addSelectTable("Product","product_id",["table"=>"products","value_option"=>"id","display_option"=>"product_name","sql_condition"=>""]);
		$this->addNumber("Quantity","quantity");
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addNumber("Offering","offering")->showDetail(false)->showAdd(false)->showEdit(false);
        $this->addCustom("Product Price")->indexDisplayTransform(function($value, $row) {
            $result = DB::table("products")
                ->select('unit_price')
                ->where("id", $row->product_id)->first();
            return $result->unit_price;
        });
        $this->addCustom("Net Price")->indexDisplayTransform(function($value, $row) {
            $result = DB::table("products")
                ->join('sale_order', 'products.id', '=', 'sale_order.product_id')
                ->select('unit_price', 'quantity')
                ->where('sale_order.id', $row->primary_key)->first();
                return $result->unit_price*$result->quantity;
        });
    }
}
