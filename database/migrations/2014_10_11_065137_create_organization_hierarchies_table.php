<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationHierarchiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_hierarchies', function (Blueprint $table) {
            $table->id();            
            $table->string('name_short');
            $table->string('name')->nullable();            
            $table->foreignId('type_id')->references('id')->on('organization_types')->onUpdate('cascade');            
            $table->foreignId('belongs_to_id')
                ->nullable()
                ->references('id')
                ->on('organization_hierarchies')
                ->onUpdate('cascade')
                ->onDelete('cascade'); // when a section is deleted it's sub+ sections are automatically deleted
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
        Schema::dropIfExists('organization_hierarchies');
    }
}
