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
        Schema::connection('common_database')->table('users', function(Blueprint $table) {
            $table->boolean('is_seller')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_ticket_manager')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('common_database')->table('users', function(Blueprint $table) {
            $table->dropColumn('is_seller');
            $table->dropColumn('is_admin');
        });
    }
};
