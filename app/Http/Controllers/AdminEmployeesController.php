<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;

class AdminEmployeesController extends CBController {


    public function cbInit()
    {
        $this->setTable("employees");
        $this->setPermalink("employees");
        $this->setPageTitle("Employees");

        $this->addText("Address","address")->strLimit(150)->maxLength(255);
		$this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addSelectTable("Department","department_id",["table"=>"departments","value_option"=>"id","display_option"=>"title","sql_condition"=>""]);
		$this->addEmail("Email","email");
		$this->addText("Employee Name","employee_name")->strLimit(150)->maxLength(255);
		$this->addText("Phone","phone")->strLimit(150)->maxLength(255);
		$this->addSelectTable("Position","position_id",["table"=>"positions","value_option"=>"id","display_option"=>"title","sql_condition"=>""]);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
		

    }
}
