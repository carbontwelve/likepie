<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaxonsRelationshipTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'taxons_relationship',
            function (Blueprint $table) {
                $table->increments('id');

                $table->integer('taxon_id')
                    ->unsigned()
                    ->default(0);
                $table->integer('classifiable_id')
                    ->unsigned()
                    ->default(0);
                $table->string('classifiable_type');
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
        Schema::drop('taxons_relationship');
    }

}
