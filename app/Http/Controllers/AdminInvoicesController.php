<?php namespace App\Http\Controllers;

use crocodicstudio\crudbooster\controllers\CBController;
use Illuminate\Support\Facades\DB;
use crocodicstudio\crudbooster\controllers\partials\ButtonColor;


class AdminInvoicesController extends CBController {


    public function cbInit()
    {
        $this->setTable("invoices");
        $this->setPermalink("invoices");
        $this->setPageTitle("Invoices");

        $this->addDatetime("Created At","created_at")->required(false)->showAdd(false)->showEdit(false);
		$this->addSelectTable("Customer","customer_id",["table"=>"customers","value_option"=>"id","display_option"=>"customer_name","sql_condition"=>""]);
		$this->addSelectTable("Employee","employee_id",["table"=>"employees","value_option"=>"id","display_option"=>"employee_name","sql_condition"=>""]);
		$this->addDate("Invoice Date","invoice_date")->format('Y-m-d');
		$this->addSelectTable("Shipper","shipper_id",["table"=>"shippers","value_option"=>"id","display_option"=>"company_name","sql_condition"=>""]);
		$this->addNumber("Total Amount","total_amount")->showDetail(false)->showAdd(false)->showEdit(false);
		$this->addDatetime("Updated At","updated_at")->required(false)->showAdd(false)->showEdit(false);
        $this->addText("Invoice number","invoice_number");
        $this->addCustom("Customer name")->indexDisplayTransform(function($value, $row) {
            $result = DB::table("customers")
                ->select('customer_name')
                ->where("id", $row->customer_id)->first();
            return $result->customer_name;
        });
		$this->addSubModule("Sale Order", AdminSaleOrderController::class, "invoice_id", function ($row) {
            return [
            "Invoice ID"=> $row->primary_key,
            ];
            });
            $this->addActionButton("Print", function($row) {
                return action("AdminInvoicesController@getPrint",["id"=>$row->primary_key]);
            }, NULL, "fa fa-print", ButtonColor::LIGHT_BLUE, true);
            $this->addCustom("Discount Rate")->indexDisplayTransform(function($value, $row) {
                $result = DB::table("memberships")
                    ->select('discount_rate')
                    ->join('customers','memberships.id','=','customers.membership_id')
                    ->join('invoices','customers.id','=','invoices.customer_id')
                    ->where("invoices.id", $row->primary_key)
                    ->first();

                if ($result) {
                    return $result->discount_rate;
                } else {
                    return "0";
                }
            });
    }


public function getPrint($id) {
        // ดึงข้อมูลออร์เดอร์
        $invoices = DB::table('invoices')->where('id', $id)->first();

        // ถ้าไม่มีข้อมูลออร์เดอร์ กลับไปหน้าก่อนหน้า
        if (!$invoices) {
            return redirect()->back()->with('error', 'Order not found');
        }

        // ดึงรายละเอียดของออร์เดอร์
        $sale_order = DB::table('sale_order')
                        ->join('products', 'sale_order.product_id', '=', 'products.id')
                        ->where('invoice_id', $id)->get();

        // ถ้าไม่มีรายละเอียดของออร์เดอร์ กลับไปหน้าก่อนหน้า
        if (!$sale_order->count()) {
            return redirect()->back()->with('error', 'Order details not found');
        }

        // ดึงข้อมูลลูกค้า
        $customers = DB::table('customers')->where('id', $invoices->customer_id)->first();

        // ถ้าไม่มีข้อมูลลูกค้า กลับไปหน้าก่อนหน้า
        if (!$customers) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        // ถ้ามีข้อมูลลูกค้า
        if ($customers) {
            // ดึงข้อมูลสมาชิก
            $memberships = DB::table('memberships')->where('id', $customers->membership_id)->first();
        } else {
            $memberships = null;
        }

        return view("print", compact("invoices", "sale_order", "customers", "memberships"));
    }

}
