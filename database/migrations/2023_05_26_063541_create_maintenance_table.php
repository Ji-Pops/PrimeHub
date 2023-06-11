<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceTable extends Migration
{
    public function up()
    {
        Schema::create('maintenance', function (Blueprint $table) {
            $table->id();
            $table->string('maintenance_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('unit_number');
            $table->string('unit_name');
            $table->text('description');
            $table->enum('category', [
                'Electrical - Power Outage',
                'Electrical - Faulty Wiring',
                'Electrical - Tripping Circuit Breaker',
                'Electrical - Dim or Flickering Lights',
                'Plumbing - Leaking Faucet',
                'Plumbing - Clogged Drain',
                'Plumbing - Burst Pipe',
                'Plumbing - Low Water Pressure',
                'Air-conditioning - Air Conditioner Not Cooling',
                'Air-conditioning - Strange Noises from the AC Unit',
                'Air-conditioning - AC Unit Leaking Water',
                'Air-conditioning - AC Unit Not Turning On',
                'Structural - Cracked Walls or Ceilings',
                'Structural - Foundation Issues',
                'Structural - Damaged Windows or Doors',
                'Structural - Flooring Problems',
            ])->nullable();
            $table->enum('status', ['Open', 'Cancelled', 'Pending', 'In-Progress', 'Completed', 'Rejected']);
            $table->string('photo')->nullable();
            $table->string('maintenance_photo_path')->nullable();
            $table->text('remarks')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('maintenance');
    }
}
