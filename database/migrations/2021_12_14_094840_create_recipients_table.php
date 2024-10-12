<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();   
            $table->boolean('is_user')->default(true);         
            $table->foreignId('user_id')->nullable()->constrained('users');          
            $table->foreignId('contact_id')->nullable()->constrained('contacts');          
            $table->foreignId('message_id')->constrained('messages');                      
            $table->dateTime('last_read')->nullable()->default(null);
            
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
        Schema::dropIfExists('recipients');
    }
}
