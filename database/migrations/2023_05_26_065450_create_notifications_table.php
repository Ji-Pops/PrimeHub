<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('maintenance_id')->nullable();
            $table->foreign('maintenance_id')->references('id')->on('maintenance');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->enum('notification_for', ['admin', 'tenant']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
