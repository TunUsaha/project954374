<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminMembershipsController extends CBController {


    public function cbInit()
    {
        $this->setTable("memberships");
        $this->setPermalink("memberships");
        $this->setPageTitle("Memberships");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addText("Discount Rate","discount_rate")->strLimit(150)->maxLength(255);
		$this->addText("Membership Type","membership_type")->strLimit(150)->maxLength(255);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}
