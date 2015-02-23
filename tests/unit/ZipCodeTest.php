<?php

use NorwegianZipCodes\Models\ZipCode;

class ZipCodeTest extends ZipCodeTestCase {
	public function testIdIsAlwaysFourDigits() {
		$model = new ZipCode(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('0001' === $model->id);
	}

	public function testIdSetter() {
		$model = new ZipCode(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('0001' === $model->getAttributes()['id']);
	}

	public function testFindZipCode() {
		$county = \NorwegianZipCodes\Models\County::create(['id' => 1, 'name' => 'TestCounty']);
		$municipality = new \NorwegianZipCodes\Models\Municipality(['id' => 101, 'name' => 'Test']);
		$county->municipalities()->save($municipality);

		$municipality->zip_codes()->save(new ZipCode(['id' => '0111', 'name' => 'TestZipCode']));


		$this->assertInstanceOf(ZipCode::class, ZipCode::find('0111'));
		$this->assertInstanceOf(ZipCode::class, ZipCode::find('111'));
		$this->assertInstanceOf(ZipCode::class, ZipCode::find(111));
	}

}
