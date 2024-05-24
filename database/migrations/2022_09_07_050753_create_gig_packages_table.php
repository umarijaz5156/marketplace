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
        Schema::create('gig_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gig_id');
            $table->integer('type');
            $table->string('package_name');
            $table->string('package_description',1000)->nullable();
            $table->decimal('price');
            $table->integer('delivery_days');
            $table->foreign('gig_id')->references('id')
                ->on('gigs')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('gig_packages');
    }
};
