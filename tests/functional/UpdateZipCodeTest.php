<?php namespace functional;

use Mockery;
use NorwegianZipCodes\Lib\RemoteZipCodeFileParser;
use NorwegianZipCodes\Models\County;
use NorwegianZipCodes\Models\Municipality;
use NorwegianZipCodes\Models\ZipCode;
use NorwegianZipCodes\Providers\NorwegianZipCodesServiceProvider;
use Orchestra\Testbench\TestCase;

class UpdateZipCodeTest extends TestCase {

	/* @var \Illuminate\Contracts\Console\Kernel */
	protected $artisan;

	public function setUp() {
		parent::setUp();

		$this->artisan = $this->app->make('Illuminate\Contracts\Console\Kernel');

		app('Illuminate\Database\DatabaseManager')->beginTransaction();

		$this->artisan->call('migrate', [
			'--realpath' => realpath(__DIR__.'/../../resources/migrations'),
		]);

		$this->artisan->call('db:seed', [
			'--class' => \NorwegianZipCodeSeeds::class,
		]);
	}

	public function tearDown() {

		app('Illuminate\Database\DatabaseManager')->rollBack();

		parent::tearDown();
	}

	public function testParseIsCalled() {
		$klass = Mockery::mock(RemoteZipCodeFileParser::class);
		$klass->shouldReceive('parse')->once();

		$this->app->singleton(RemoteZipCodeFileParser::class, function() use($klass) {
			return $klass;
		});

		$this->artisan->call('zip_codes:update');
	}

	/**
	 * This test does real calls and checks that the database is filled
	 *
	 * @group live
	 */
	public function testCommandAddsZipCodes() {

		$this->assertEquals(0, ZipCode::count());
		$this->assertEquals(0, Municipality::count());

		/* @var \Illuminate\Contracts\Console\Kernel */
		$this->artisan->call('zip_codes:update');
		$this->assertnotEquals(0, ZipCode::count());
		$this->assertnotEquals(0, Municipality::count());
	}

	protected function getEnvironmentSetUp( $app ) {
		$app['config']->set( 'database.default', 'pgsql' );
	}

	protected function getPackageProviders( $app ) {
		return [
			NorwegianZipCodesServiceProvider::class
		];
	}
}
