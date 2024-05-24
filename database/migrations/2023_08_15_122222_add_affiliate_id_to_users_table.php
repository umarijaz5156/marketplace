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
        Schema::connection('common_database')->table('users', function (Blueprint $table) {
            $table->boolean('is_affiliate')->default(false);
            $table->longText('affiliate_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('common_database')->table('users', function (Blueprint $table) {
            $table->removeColumn('is_affiliate');
            $table->removeColumn('affiliate_link');
        });
    }
};
