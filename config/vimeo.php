<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Default Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the connections below you wish to use as
	| your default connection for all work. Of course, you may use many
	| connections at once using the manager class.
	|
	*/

	'default' => 'main',

	/*
    |--------------------------------------------------------------------------
    | Vimeo Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

	'connections' => [

		'main' => [
			'client_id' => '5315047f9c52aee13a19e9d1cfaf92e1b7bfc77f',
			'client_secret' => 'sKYFe2uNMx4ppczBH479gSjVKe+9o7W66AZn1e15+Y9BcK1KVxxkJlomRbp1v69rrl7rkv2rrjhN/',
			'access_token' => 'f5f0f2ab9682194687abf2ffa487a202'
		],

		'alternative' => [
			'client_id' => 'your-client-id',
			'client_secret' => 'your-client-secret',
			'access_token' => null
		],

	]

];
