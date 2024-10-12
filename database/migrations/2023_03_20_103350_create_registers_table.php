<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->references('id')->on('organization_hierarchies');
            $table->string('fiscal_year'); //Will be saved in the format 'year-year' , e.g '2022-2023'
            $table->unsignedInteger('outgoing_no')->default(1);
            $table->unsignedInteger('incoming_no')->default(1);
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
        Schema::dropIfExists('registers');
    }
}
