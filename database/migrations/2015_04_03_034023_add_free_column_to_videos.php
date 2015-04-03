<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFreeColumnToVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('videos', function(Blueprint $table)
		{
			$table->boolean('free')->nullable()->after('font_awesome');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('videos', function(Blueprint $table)
		{
			$table->dropColumn('free');
		});
	}

}
