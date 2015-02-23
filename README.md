## This package was sponsored by [tjenestetorget.no][1] / [helsetjenester.no][2]


# What?
This package contains **models**, **migrations** and **commands** to *automatically* setup
and update the administrative hierarchy of zip codes, municipalities and counties in Norway.

# How

**Install the package**  
    
	composer require "phaza/laravel-norwegian-zip-codes"

**Add service provider**  
Add NorwegianZipCodes\Providers\NorwegianZipCodesServiceProvider in *config/app.php* to the 'providers' array

**Copy migrations to your migrations folder**  

	php artisan vendor:publish --provider="NorwegianZipCodes\Providers\NorwegianZipCodesServiceProvider"

**Run migrations**  
	
	php artisan migrate

**Populate the database**
	
	php artisan zip_codes:update
 
**Start using the models**  
```PHP
	$zip_code     = \NorwegianZipCodes\Models\ZipCode::find('7340');
	$municipality = $zip_code->municipality;
	$county       = $municipality->county
```

## ER diagram

![ER diagram][ER]

## Note

All IDs for counties, municipalities and zip_codes are strings. This is because officially the IDs are zero padded, fixed size. (4 for zip codes and municipalities, 2 for counties)

[1]: http://tjenestetorget.no
[2]: http://helsetjenester.no
[ER]: https://cloud.githubusercontent.com/assets/4553/6326216/b502e9f4-bb4f-11e4-81be-a03e91e9cbc4.png
