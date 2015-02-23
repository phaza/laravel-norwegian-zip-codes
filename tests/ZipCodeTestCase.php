<?php 

use Orchestra\Testbench\TestCase;

class ZipCodeTestCase extends TestCase {

	/* @var \Illuminate\Contracts\Console\Kernel */
	protected $artisan;

	public function setUp() {
		parent::setUp();
		app('Illuminate\Database\DatabaseManager')->beginTransaction();

		$this->artisan = $this->app->make('Illuminate\Contracts\Console\Kernel');

		$this->artisan->call('migrate', [
			'--realpath' => realpath(__DIR__.'/../resources/migrations'),
		]);
	}

	public function tearDown() {
		app('Illuminate\Database\DatabaseManager')->rollBack();
		parent::tearDown();
	}

	protected function getEnvironmentSetUp( $app ) {
		$app['config']->set( 'database.default', 'pgsql' );
	}

	protected function getPackageProviders( $app ) {
		return [
			\NorwegianZipCodes\Providers\NorwegianZipCodesServiceProvider::class
		];
	}
}
