<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('taxons', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('parent_id')
                    ->defaults(0);
                $table->integer('taxonomic_unit_id')
                    ->defaults(0);
                $table->integer('author_id')
                    ->defaults(0);
                $table->timestamps();
                $table->softDeletes();
                $table->string('name');
                $table->string('slug');
                $table->text('description');
                $table->integer('use_count')
                    ->unsigned()
                    ->defaults(0);
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists('taxons');
	}

}
