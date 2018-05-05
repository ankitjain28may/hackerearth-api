# HackerEarth API

[![Latest Stable Version](https://poser.pugx.org/ankitjain28may/hackerearth-api/v/stable)](https://packagist.org/packages/ankitjain28may/hackerearth-api)
[![Build Status](https://travis-ci.org/ankitjain28may/hackerearth-api.svg?branch=master)](https://travis-ci.org/ankitjain28may/hackerearth-api)
[![Coverage Status](https://coveralls.io/repos/github/ankitjain28may/hackerearth-api/badge.svg?branch=master)](https://coveralls.io/github/ankitjain28may/hackerearth-api?branch=master)
[![Packagist](https://img.shields.io/packagist/dt/ankitjain28may/hackerearth-api.svg?style=flat-square)](https://packagist.org/packages/ankitjain28may/hackerearth-api)


This package is using HackerEarth api to Compile and Run the code.

HackerEarth Code Checker API. Extremely simple REST API. Supports more than a dozen languages. All powered by reliable HackerEarth servers. You can use your own scoring system or build your own online judge.

![](https://files.phpclasses.org/graphics/phpclasses/innovation-award-logo.png)

PHP Innovation Award for the PHP package Hacker Earth API [Certification Link](https://www.phpclasses.org/certificate/package/10529.pdf)

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
php artisan vendor:publish --tag=migrations
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

```php
    $data = [
        "lang" => '',
        "source" => '',
        "input" => '',
        "async" => 0,                   // default (1 => async req and 0 => sync req)
        "callback" => '',
        'id' => '',
        'time_limit'    => 5,           // default
        'memory_limit'  => 262144,      // default
    ]
```

- Run([$data, ..])
- RunFile([$data, ..])
- Compile([$data, ..])
- CompileFile([$data, ..])

## Asynchronous Request

- Set `async = 1`.
- You need to add the callback url, Output will be returned directly to the callback url as a post request.

## Synchronous Request

- Set `async = 0`.
- Output will be returned with the request's response.


## For Core PHP Usage

- create the database
```
create database [database name]
```
- import table
```
mysql -u[user] -p[password] [database name] < vendor\ankitjain28may\hackerearth-api\src\Database\migrate.sql
```

```php
use Ankitjain28may\HackerEarth\HackerEarth;

$config = [
    	"api_key"     => 'hackerearth_app_key',
    ];


 $hackerearth = new HackerEarth($config);

 $data = [
    "lang" => 'php',
    "source" => '<?php echo "hello World!"; ?>'
 ];

 $result = $hackerearth->Compile([$data]);

 var_dump($result);

 $result = $hackerearth->Run([$data]);

 var_dump($result);

 // Asynchronous

 $data = [
    "lang" => 'php',
    "source" => '<?php echo "hello World!"; ?>',
    "async" => 1,
    "callback" => 'http://callback_url',
    "id" => 12  // Id from the db where to save or update response
 ]

 $result = $hackerearth->Run([$data]);

 vardump($result);

 // Response at Callback URL will need to save to DB with reference to the ID, Id returned is encoded using `bin2hex` which can be decoded using `hex2bin`.

 ```


## For Laravel Usage

 ### Code Compile

 ```php

 use Ankitjain28may\HackerEarth\Facades\HackerEarth;
 use Ankitjain28may\HackerEarth\Models\Output;
 //..
 //..

 $data = [
    "lang" => 'php',
    "source" => '<?php echo "hello World!"; ?>'
 ];

 $result = HackerEarth::Compile([$data, ..]);

 dd($result);

 // Asynchronous

 $data = [
    "lang" => 'php',
    "source" => '<?php echo "hello World!"; ?>',
    "async" => 1,
    "callback" => 'http://callback_url',
    "id" => 12  // Id from the db where to save or update response
 ]

 $result = $hackerearth->Compile([$data]);

 dd($result);

  OR

 Output::saveResult(json_decode($result, True)); // Save directly to the DB


 // Response at Callback URL will save to DB with reference to the ID

 Output::savePayload(json_decode($_POST['payload'], True));

 ```

 ### Code Run

 ```php

 use Ankitjain28may\HackerEarth\Facades\HackerEarth;
 use Ankitjain28may\HackerEarth\Models\Output;

 //..
 //..

 $data = [
    "lang" => 'php',
    "source" => '<?php echo "hello World!"; ?>'
 ];

 $result = HackerEarth::Run([$data, ..]);

 dd($result);

 // Asynchronous

 $data = [
    "lang" => 'php',
    "source" => '<?php echo "hello World!"; ?>',
    "async" => 1,
    "callback" => 'http://callback_url',
    "id" => 12  // Id from the db where to save or update response
 ]

 $result = $hackerearth->Run([$data]);

 dd($result);

  OR

 Output::saveResult(json_decode($result, True)); // Save directly to the DB


 // Response at Callback URL will save to DB with reference to the ID

 Output::savePayload(json_decode($_POST['payload'], True));

 ```

 ## Also Compile and Run files by passing realpath of the uploaded file--

 ```php
 use Ankitjain28may\HackerEarth\Facades\HackerEarth;

 //..
 //..

 $data = [
    "lang" => 'php',
    "source" => realpath("test.txt")
 ];

 $result = HackerEarth::RunFile([$data]);
 $result = HackerEarth::CompileFile([$data]);

 ```


 ## Contribute

>Feel free to contribute

## License

>Copyright (c) 2017 Ankit Jain - Released under the MIT License

