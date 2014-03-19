<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTaxonsRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'taxons_relationship',
            function (Blueprint $table) {
                $table->string('taxonomy')
                    ->after('id')
                    ->index();

            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'taxons_relationship',
            function (Blueprint $table) {
                $table->dropColumn('taxonomy');
            }
        );
    }
}
