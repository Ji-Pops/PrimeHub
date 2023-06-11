<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('work_order_number');
            $table->unsignedBigInteger('maintenance_id');
            $table->foreign('maintenance_id')->references('id')->on('maintenance');
            $table->string('unit_name');
            $table->text('description');
            $table->enum('department', ['Electrical', 'Plumbing', 'Air-conditioning', 'Structural']);
            $table->enum('status', ['Pending', 'In-Progress', 'Completed']);
            $table->text('notes')->nullable();
            $table->string('personnel')->nullable();
            $table->string('approved_by_full_name');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
}
