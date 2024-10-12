<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');            
            $table->string('email')->nullable();
            $table->string('phone',15)->nullable();
            $table->string('address',200)->nullable();                        
            $table->foreignId('parent_id')->nullable()->constrained('contacts');
            $table->foreignId('org_id')->nullable()->constrained('organization_hierarchies');
            $table->string('type')->nullable(); // individual, NGO, Settlement Office, School
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
        Schema::dropIfExists('contacts');
    }
}
