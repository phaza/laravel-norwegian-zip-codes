<?php namespace functional;

use Mockery;
use NorwegianZipCodes\Lib\RemoteZipCodeFileParser;
use NorwegianZipCodes\Models\Municipality;
use NorwegianZipCodes\Models\ZipCode;

class UpdateZipCodeTest extends \ZipCodeTestCase {

	public function setUp() {
		parent::setUp();

		$this->artisan->call('db:seed', [
			'--class' => \NorwegianZipCodeSeeds::class,
		]);
	}

	/**
	 * This test does real calls and checks that the database is filled
	 *
	 * @group live
	 */
	public function testCommandAddsZipCodes() {

		$this->assertEquals(0, ZipCode::count());
		$this->assertEquals(0, Municipality::count());

		$this->artisan->call('zip_codes:update');
		$this->assertEquals('oppdal', strtolower(ZipCode::find('7340')->name));
		$this->assertEquals('oppdal', strtolower(Municipality::find('1634')->name));
		$this->assertnotEquals(0, ZipCode::count());
		$this->assertnotEquals(0, Municipality::count());
	}
}
