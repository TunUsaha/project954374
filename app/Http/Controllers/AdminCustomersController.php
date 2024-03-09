<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminCustomersController extends CBController {


    public function cbInit()
    {
        $this->setTable("customers");
        $this->setPermalink("customers");
        $this->setPageTitle("Customers");

        $this->addText("Address","address")->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Customer Name","customer_name")->strLimit(150)->maxLength(255);
		$this->addEmail("Email","email");
		$this->addSelectTable("Membership","membership_id",["table"=>"memberships","value_option"=>"id","display_option"=>"membership_type","sql_condition"=>""]);
		$this->addText("Phone","phone")->strLimit(150)->maxLength(255);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}
