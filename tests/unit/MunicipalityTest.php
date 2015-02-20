<?php 

use NorwegianZipCodes\Models\Municipality;
use Orchestra\Testbench\TestCase;

class MunicipalityTest extends TestCase {
	public function testIdIsAlwaysFourDigits() {
		$model = new Municipality(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('0001' === $model->id);
	}

	public function testIdSetter() {
		$model = new Municipality(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('0001' === $model->getAttributes()['id']);
	}

}
