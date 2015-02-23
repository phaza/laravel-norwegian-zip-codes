<?php namespace unit;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Exceptions\Handler;
use Mockery;
use NorwegianZipCodes\Commands\UpdateZipCodesCommand;
use NorwegianZipCodes\Events\ZipCodesUpdated;
use NorwegianZipCodes\Lib\RemoteZipCodeFileParser;
use NorwegianZipCodes\Models\County;
use NorwegianZipCodes\Models\Municipality;


class UpdateZipCodesCommandTest extends \ZipCodeTestCase {

	public function setUp() {

		parent::setUp();

		$this->artisan->call('db:seed', [
			'--class' => \NorwegianZipCodeSeeds::class,
		]);

	}

	public function testParseIsCalled() {
		$klass = Mockery::mock(RemoteZipCodeFileParser::class);
		$klass->shouldReceive('parse')->once();

		$event = app(Dispatcher::class);

		$this->app->singleton(RemoteZipCodeFileParser::class, function() use($klass) {
			return $klass;
		});

		$cmd = new TestUpdateZipCodesCommand();
		$cmd->fire($event);
	}

	public function testOldAreChanged() {

		/* @var County $county */
		$county = County::find('04');

		$county->municipalities()->save(new Municipality(['id' => '0403', 'name' => 'Hamar']));
		$county->municipalities()->save(new Municipality(['id' => '0417', 'name' => 'STANGE']));

		$fired = false;
		$event = app(Dispatcher::class);
		$event->listen(ZipCodesUpdated::class, function(ZipCodesUpdated $update) use(&$fired) {
			$fired = true;
			$this->assertEquals(1, $update->changed);
		});

		$cmd = new TestUpdateZipCodesCommand();
		$cmd->fire($event);
//
		$this->assertTrue($fired);
	}

	public function testNewAreCounted() {
		$fired = false;

		$event = app(Dispatcher::class);
		$event->listen(ZipCodesUpdated::class, function(ZipCodesUpdated $update) use(&$fired) {
			$fired = true;
			$this->assertEquals(7, $update->added);
			$this->assertEquals(0, $update->changed);
		});

		$cmd = new TestUpdateZipCodesCommand();
		$cmd->fire($event);

		$this->assertTrue($fired);
	}
}

class TestUpdateZipCodesCommand extends UpdateZipCodesCommand {
	protected function getRemoteZipCodeFile() {
		return __DIR__.'/../testfile.tsv';
	}
}
