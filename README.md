# HackerEarth API


This package is using HackerEarth api to Compile and Run the code.

HackerEarth Code Checker API. Extremely simple REST API. Supports more than a dozen languages. All powered by reliable HackerEarth servers. You can use your own scoring system or build your own online judge.

## Installation

Run this command in your terminal from your project directory:

```sh
composer require ankitjain28may/hackerearth-api
```

## Laravel Configuration

When the download is complete, you have to call this package service in `config/app.php` config file. To do that, add this line in `app.php` in `providers` array:

```php
Ankitjain28may\HackerEarth\HackerEarthServiceProvider::class,
```

To use facade you have to add this line in `app.php` to the `aliases` array:

```php
'HackerEarth' => Ankitjain28may\HackerEarth\Facades\HackerEarth::class,
```

Now run this command in your terminal to publish this package resources:

```
php artisan vendor:publish --provider="Ankitjain28may\HackerEarth\HackerEarthServiceProvider"
```

after publishing your config file then open `config/hackerearth.php` and add your hackerearth app key:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | HackerEarth API KEY
    |--------------------------------------------------------------------------
    |
    | https://api.hackerearth.com/v3/code/
	| https://api.hackerearth.com/v3/code/
    |
    */
    'api_key' => env('HACKEREARTH_SECRET_KEY', 'CLIENT_SECRET_KEY'),
];
```

also you can add api key in `.env` :
```
 HACKEREARTH_SECRET_KEY = YOUR_HACKER_EARTH_API_KEY
```

Thats it.

## API List

- Run($lang, $source, $input, $time_limit, $memory_limit)
- Compile($lang, $source, $input, $time_limit, $memory_limit)

## Usages

```php
use Ankitjain28may\HackerEarth\HackerEarth;

$config = [
    	"api_key"     => 'hackerearth_app_key',
    ];


 $hackerearth = new HackerEarth($config);

 $result = $hackerearth->Compile('php', '<?php echo "hello World!"; ?>');

 var_dump($result);

 $result = $hackerearth->Run('php', '<?php echo "hello World!"; ?>');

 var_dump($result);

 ```


## For Laravel Usage

 ### Code Compile

 ```php
 use Ankitjain28may\HackerEarth\Facades\HackerEarth;
 //..
 //..
 $result = HackerEarth::Compile('php', '<?php echo "hello World!"; ?>');

 dd($result);
 ```

 ### Code Run

 ```php
 use Ankitjain28may\HackerEarth\Facades\HackerEarth;
 //..
 //..
 $result = HackerEarth::Run('php', '<?php echo "hello World!"; ?>');

 dd($result);
 ```

 ## Also Compile and Run files by passing realpath of the uploaded file--

 ```php
 use Ankitjain28may\HackerEarth\Facades\HackerEarth;
 //..
 //..
 $result = HackerEarth::Run('php', realpath("test.txt"));
 $result = HackerEarth::Compile('php', realpath("test.txt"));

 ```


 ## Contribute

>Feel free to contribute

## License

>Copyright (c) 2017 Ankit Jain - Released under the MIT License

