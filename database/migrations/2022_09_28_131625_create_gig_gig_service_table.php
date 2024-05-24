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
        Schema::create('gig_package_gig_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gig_service_id')->nullable();
            $table->unsignedBigInteger('gig_package_id')->nullable();
            $table->foreign('gig_service_id')->references('id')->on('gig_services')->nullOnDelete();
            $table->foreign('gig_package_id')->references('id')->on('gig_packages')->nullOnDelete();
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
        Schema::dropIfExists('gig_package_gig_service');
    }
};
