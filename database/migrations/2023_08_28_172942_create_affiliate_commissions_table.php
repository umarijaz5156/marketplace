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
        Schema::create('affiliate_commissions', function (Blueprint $table) {
            $table->id();
            $table->decimal('commission')->nullable();
            $table->integer('order_id')->nullable();
            $table->foreignId('affiliate_user_id')->nullable()->constrained('affiliate_users')->nullOnDelete();
            $table->enum('status', ['Paid', 'Pending'])->default('Pending');
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
        Schema::dropIfExists('affiliate_commissions');
    }
};
