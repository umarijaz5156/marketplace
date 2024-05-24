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
        Schema::create('affiliate_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('common_database.users')->nullOnDelete();
            $table->unsignedBigInteger('affiliate_id')->nullable();
            $table->foreign('affiliate_id')->references('id')->on('common_database.users')->nullOnDelete();
            $table->decimal('commission')->nullable();
            $table->enum('status', ['Paid', 'Pending'])->default('Pending');
            $table->boolean('verified')->default(0);
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
        Schema::dropIfExists('affiliate_users');
    }
};
