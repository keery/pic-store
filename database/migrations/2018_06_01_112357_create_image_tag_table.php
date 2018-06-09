<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTagTable extends Migration {

    public function up()
    {
		Schema::create('image_tag', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('image_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			$table->foreign('image_id')->references('id')->on('image')
						->onDelete('restrict')
						->onUpdate('restrict');

			$table->foreign('tag_id')->references('id')->on('tagging_tags')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		// Schema::table('image_tag', function(Blueprint $table) {
		// 	$table->dropForeign('image_tag_image_id_foreign');
		// 	$table->dropForeign('image_tag_tag_id_foreign');
		// });

		Schema::drop('image_tag');
	}
}