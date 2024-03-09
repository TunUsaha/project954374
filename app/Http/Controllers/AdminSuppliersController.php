<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminSuppliersController extends CBController {


    public function cbInit()
    {
        $this->setTable("suppliers");
        $this->setPermalink("suppliers");
        $this->setPageTitle("Suppliers");

        $this->addText("Address","address")->strLimit(150)->maxLength(255);
		$this->addText("Company Name","company_name")->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addEmail("Email","email");
		$this->addText("Phone","phone")->strLimit(150)->maxLength(255);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}
