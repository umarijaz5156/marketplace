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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('common_database.users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->double('min_budget');
            $table->double('max_budget');
            $table->double('duration');
            $table->text('requirements')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->nullOnDelete();
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
        Schema::dropIfExists('requests');
    }
};
