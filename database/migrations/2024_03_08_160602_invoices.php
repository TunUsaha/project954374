<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            
            $table->timestamps();
			$table->bigIncrements('id');
			$table->date('invoice_date')->nullable();
			$table->integer('customer_id')->nullable();
			$table->integer('shipper_id')->nullable();
			$table->integer('employee_id')->nullable();
			$table->double('total_amount')->nullable();
			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
