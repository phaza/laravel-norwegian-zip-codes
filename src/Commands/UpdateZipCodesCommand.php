<?php namespace NorwegianZipCodes\Commands;

use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use NorwegianZipCodes\Lib\RemoteZipCodeFileParser;
use NorwegianZipCodes\Models\County;
use NorwegianZipCodes\Models\Municipality;
use NorwegianZipCodes\Models\ZipCode;

class UpdateZipCodesCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'zip_codes:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Updates the norwegian zip codes and municipalities with data from the official authority';

	/**
	 *
	 * @var Collection
	 */
	protected $counties;

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->counties = County::all();
		$url            = $this->getRemoteZipCodeFile();

		$parser = app(RemoteZipCodeFileParser::class);

		$parser->parse($url, function(RemoteZipCodeObject $object) {

			$municipality = $this->updateMunicipality($object->municipality_id, $object->municipality_name);
			$this->updateZipCode($municipality, $object->id, $object->name);

		});
	}

	protected function getCounty($municipality_id) {
		$county_id = substr(str_pad($municipality_id, 4, '0', STR_PAD_LEFT), 0, 2);
		/* @var County $county */
		$county = $this->counties->find($county_id);

		return $county;
	}

	protected function updateMunicipality($id, $name) {
		$county = $this->getCounty($id);

		$municipality = Municipality::find($id);

		if(is_null($municipality)) {
			$municipality = new Municipality(['id' => $id, 'name' => $name]);
			$county->municipalities()->save($municipality);
		}
		else {
			$municipality->update(['name' => $name]);
		}

		return $municipality;
	}

	protected function updateZipCode(Municipality $municipality, $id, $name) {

		$zipCode = ZipCode::find($id);

		if(is_null($zipCode)) {
			$zipCode = new ZipCode(['id' => $id, 'name' => $name]);
			$municipality->zip_codes()->save($zipCode);
		}
		else {
			$zipCode->update(['name' => $name]);
		}
	}

	protected function getRemoteZipCodeFile() {
		$client = new Client();
		$crawler = $client->request('GET', 'http://www.bring.no/hele-bring/produkter-og-tjenester/brev-og-postreklame/andre-tjenester/postnummertabeller');
		$link = $crawler->filterXPath('//td[text() = "Postnummer i rekkefølge"]/following-sibling::td/a[contains(., "TAB")]');
		$url = $link->attr('href');
		return $url;
	}

}
