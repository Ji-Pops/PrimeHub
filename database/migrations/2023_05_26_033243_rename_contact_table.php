<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameContactTable extends Migration
{
    public function up()
    {
        Schema::rename('contact', 'contacts');
    }

    public function down()
    {
        Schema::rename('contacts', 'contact');
    }
}
