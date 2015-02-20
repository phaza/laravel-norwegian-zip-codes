<?php namespace NorwegianZipCodes\Providers;

use Illuminate\Support\ServiceProvider;
use NorwegianZipCodes\Commands\UpdateZipCodesCommand;
use NorwegianZipCodes\Lib\RemoteZipCodeFileParser;

class NorwegianZipCodesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	protected $command = 'command.zip_codes.update';

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(RemoteZipCodeFileParser::class, function($app) {
			return new RemoteZipCodeFileParser();
		});

		$this->app->singleton($this->command, function($app) {
			return new UpdateZipCodesCommand();
		});

		$this->commands($this->command);
	}

	public function provides()
	{
		return [
			$this->command
		];
	}


}
