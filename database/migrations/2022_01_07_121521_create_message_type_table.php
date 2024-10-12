<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_type', function (Blueprint $table) {
            $table->id();
            $table->string('name_english')->nullable();
            $table->string('name_tibetan')->nullable();
            $table->string('description')->nullable();

            //if some type of message is associated to a specific department
            $table->foreignId('organization_id')->nullable()->constrained('organization_hierarchies');                  
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
        Schema::dropIfExists('message_type');
    }
}
