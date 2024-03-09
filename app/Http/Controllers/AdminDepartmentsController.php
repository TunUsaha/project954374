<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminDepartmentsController extends CBController {


    public function cbInit()
    {
        $this->setTable("departments");
        $this->setPermalink("departments");
        $this->setPageTitle("Departments");
        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addWysiwyg("Description","description")->strLimit(1500);
		$this->addText("Title","title")->strLimit(150)->maxLength(255);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);


    }
}
