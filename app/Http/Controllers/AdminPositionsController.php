<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminPositionsController extends CBController {


    public function cbInit()
    {
        $this->setTable("positions");
        $this->setPermalink("positions");
        $this->setPageTitle("Positions");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Salary","salary")->strLimit(150)->maxLength(255);
		$this->addText("Title","title")->strLimit(150)->maxLength(255);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}
