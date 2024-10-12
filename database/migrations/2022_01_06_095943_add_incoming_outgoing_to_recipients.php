<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncomingOutgoingToRecipients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipients', function (Blueprint $table) {
            $table->unsignedBigInteger('incoming_no')->nullable();            
        });

        Schema::table('organization_hierarchies', function (Blueprint $table) {
            $table->unsignedBigInteger('incoming_register')->nullable();
            $table->unsignedBigInteger('outgoing_register')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipients', function (Blueprint $table) {
            $table->dropColumn('incoming_no');
        });

        Schema::table('organization_hierarchies', function (Blueprint $table) {
            $table->dropColumn(['incoming_register','outgoing_register']);
        });
    }
}
