<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->boolean('is_reported')->default(false);
            $table->unsignedBigInteger('blocked_by')->nullable();
            $table->foreign('chat_id')->references('id')->on('chats')->cascadeOnDelete();
            $table->foreign('blocked_by')->references('id')->on('common_database.users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_statuses');
    }
};
