<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_number');
            $table->string('unit_name');
            $table->unsignedBigInteger('contacts_tenant_id')->nullable();
            $table->timestamps();
            $table->foreign('contacts_tenant_id')->references('id')->on('contacts')
                ->where('user_type', '=', 'tenant');
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
}
