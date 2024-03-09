<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminShippersController extends CBController {


    public function cbInit()
    {
        $this->setTable("shippers");
        $this->setPermalink("shippers");
        $this->setPageTitle("Shippers");

        $this->addText("Company Name","company_name")->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Phone","phone")->strLimit(150)->maxLength(255);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}
