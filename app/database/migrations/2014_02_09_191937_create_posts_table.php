<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('articles', function(Blueprint $table)
            {
                $article = new \Likepie\Articles\Article;

                $table->increments('id');
                $table->integer('author_id');
                $table->timestamps();
                $table->softDeletes();
                $table->dateTime('published_at')->nullable();
                $table->string('title');
                $table->string('slug');
                $table->enum('status', $article->getStatusEnumValues() );
                $table->text('content');
                $table->boolean('enabled');
                $table->integer('comment_count')->defaults(0);
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('articles');
	}

}
