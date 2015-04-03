<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCashierColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->tinyInteger('stripe_active')->default(0)->after('permission');
			$table->string('stripe_id')->nullable()->after('permission');
			$table->string('stripe_subscription')->nullable()->after('permission');
			$table->string('stripe_plan', 100)->nullable()->after('permission');
			$table->string('last_four', 4)->nullable()->after('permission');
			$table->timestamp('trial_ends_at')->nullable()->after('permission');
			$table->timestamp('subscription_ends_at')->nullable()->after('permission');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn(
				'stripe_active', 'stripe_id', 'stripe_subscription', 'stripe_plan', 'last_four', 'trial_ends_at', 'subscription_ends_at'
			);
		});
	}

}
