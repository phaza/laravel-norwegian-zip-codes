<?php

use Illuminate\Database\Seeder;
use NorwegianZipCodes\Models\County;

class NorwegianZipCodeSeeds extends Seeder {
	public function run() {
		County::create( [ 'id' => '01', 'name' => 'Østfold' ] );
		County::create( [ 'id' => '02', 'name' => 'Akershus' ] );
		County::create( [ 'id' => '03', 'name' => 'Oslo' ] );
		County::create( [ 'id' => '04', 'name' => 'Hedmark' ] );
		County::create( [ 'id' => '05', 'name' => 'Oppland' ] );
		County::create( [ 'id' => '06', 'name' => 'Buskerud' ] );
		County::create( [ 'id' => '07', 'name' => 'Vestfold' ] );
		County::create( [ 'id' => '08', 'name' => 'Telemark' ] );
		County::create( [ 'id' => '09', 'name' => 'Aust-Agder' ] );
		County::create( [ 'id' => '10', 'name' => 'Vest-Agder' ] );
		County::create( [ 'id' => '11', 'name' => 'Rogaland' ] );
		County::create( [ 'id' => '12', 'name' => 'Hordaland' ] );
		County::create( [ 'id' => '14', 'name' => 'Sogn og Fjordane' ] );
		County::create( [ 'id' => '15', 'name' => 'Møre og Romsdal' ] );
		County::create( [ 'id' => '16', 'name' => 'Sør-Trøndelag' ] );
		County::create( [ 'id' => '17', 'name' => 'Nord-Trøndelag' ] );
		County::create( [ 'id' => '18', 'name' => 'Nordland' ] );
		County::create( [ 'id' => '19', 'name' => 'Troms' ] );
		County::create( [ 'id' => '20', 'name' => 'Finnmark' ] );
		County::create( [ 'id' => '21', 'name' => 'Svalbard' ] );
		County::create( [ 'id' => '22', 'name' => 'Jan Mayen' ] );
		County::create( [ 'id' => '23', 'name' => 'Kontinentalsokkelen' ] );
	}
}
