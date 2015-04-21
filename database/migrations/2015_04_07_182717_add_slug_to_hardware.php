<?php

use App\Hardware;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToHardware extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hardware', function(Blueprint $table)
		{
			$table->string('slug')->after('name');
		});

		$this->makeSlugs();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hardware', function(Blueprint $table)
		{
			$table->dropColumn('slug');
		});
	}

	public function makeSlugs()
	{
		foreach(Hardware::all() as $hardware) {
			$hardware->slug = $this->slugify($hardware->name);
			$hardware->save();
		}
	}

}
