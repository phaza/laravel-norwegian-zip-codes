<?php

use NorwegianZipCodes\Models\ZipCode;
use Orchestra\Testbench\TestCase;

class ZipCodeTest extends TestCase {
	public function testIdIsAlwaysFourDigits() {
		$model = new ZipCode(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('0001' === $model->id);
	}

	public function testIdSetter() {
		$model = new ZipCode(['id' => 1, 'name' => 'Test']);
		$this->assertTrue('0001' === $model->getAttributes()['id']);
	}

}
