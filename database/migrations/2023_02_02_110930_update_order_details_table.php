<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

        $records = DB::table('order_details')->select('id','buyer_requirements')->get();
        foreach($records as $record){
            DB::table('order_details')
            ->where('id', $record->id)
            ->update([
                'buyer_requirements' => json_encode($record->buyer_requirements)
            ]);
        }
        Schema::table('order_details', function(Blueprint $table){
            
            $table->json('buyer_requirements')->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function(Blueprint $table){
            
            $table->text('buyer_requirements')->change();
        });
    }
};
