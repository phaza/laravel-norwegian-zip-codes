<?php 

use NorwegianZipCodes\Models\Municipality;

class MunicipalityTest extends ZipCodeTestCase {
	public function testIdIsAlwaysFourDigits() {
		$model = new Municipality(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('0001' === $model->id);
	}

	public function testIdSetter() {
		$model = new Municipality(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('0001' === $model->getAttributes()['id']);
	}

	public function testFindMunicipality() {
		$county = \NorwegianZipCodes\Models\County::create(['id' => 1, 'name' => 'TestCounty']);
		$county->municipalities()->save(new Municipality(['id' => 101, 'name' => 'Test']));
		$this->assertInstanceOf(Municipality::class, Municipality::find('101'));
		$this->assertInstanceOf(Municipality::class, Municipality::find('0101'));
		$this->assertInstanceOf(Municipality::class, Municipality::find(101));
	}

}
