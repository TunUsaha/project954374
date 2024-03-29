<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminCategoriesController extends CBController {


    public function cbInit()
    {
        $this->setTable("categories");
        $this->setPermalink("categories");
        $this->setPageTitle("Categories");

        $this->addText("Category Name","category_name")->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addWysiwyg("Description","description")->strLimit(1500);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}
