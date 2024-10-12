<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();            
            $table->foreignId('message_id')->constrained('messages');                       
            $table->dateTime('dispatched_date')->nullable();
            $table->dateTime('received_date')->nullabel();
            $table->string('fiscal_year')->nullable();
            $table->string('outgoing_word')->nullable();          
            $table->string('mode')->nullable();
            $table->string('language')->nullable();
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
        Schema::dropIfExists('records');
    }
}
