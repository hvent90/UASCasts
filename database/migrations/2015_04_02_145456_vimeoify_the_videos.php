<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VimeoifyTheVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('videos', function(Blueprint $table)
		{
			$table->dropColumn('video_url');
			$table->dropColumn('duration');
			$table->string('vimeo_video_url_sd')->after('font_awesome');
			$table->string('vimeo_video_url_hd')->after('font_awesome');
			$table->integer('vimeo_duration')->after('font_awesome');
			$table->string('vimeo_link')->after('font_awesome');
			$table->string('vimeo_uri')->after('font_awesome');
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
			$table->dropColumn('vimeo_uri');
			$table->dropColumn('vimeo_link');
			$table->dropColumn('vimeo_duration');
			$table->dropColumn('vimeo_video_url_hd');
			$table->dropColumn('vimeo_video_url_sd');
			$table->string('video_url')->after('thumbnail_url');
			$table->integer('duration')->after('font_awesome');
		});
	}

}
