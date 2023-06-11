<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWorkOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropColumn(['approved_by_first_name', 'approved_by_last_name']);
            $table->string('approved_by_fullname');
        });
    }

    public function down()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropColumn('approved_by_fullname');
            $table->string('approved_by_first_name');
            $table->string('approved_by_last_name');
        });
    }
}