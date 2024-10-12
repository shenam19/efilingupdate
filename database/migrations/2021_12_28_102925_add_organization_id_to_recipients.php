<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrganizationIdToRecipients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipients', function (Blueprint $table) {
            $table->foreignId('organization_id')->nullable()->constrained('organization_hierarchies');
        });

         Schema::table('participants', function (Blueprint $table) {
            $table->foreignId('organization_id')->nullable()->constrained('organization_hierarchies');
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
            $table->dropColumn('organization_id');
        });

        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn('organization_id');
        });
    }
}
