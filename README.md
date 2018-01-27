# Convert xml to an array

[![Latest Version](https://img.shields.io/github/release/vyuldashev/xml-to-array.svg?style=flat-square)](https://github.com/vyuldashev/xml-to-array/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/vyuldashev/xml-to-array/master.svg?style=flat-square)](https://travis-ci.org/vyuldashev/xml-to-array)
[![Quality Score](https://img.shields.io/scrutinizer/g/vyuldashev/xml-to-array.svg?style=flat-square)](https://scrutinizer-ci.com/g/vyuldashev/xml-to-array)
[![StyleCI](https://styleci.io/repos/106673178/shield?branch=master)](https://styleci.io/repos/106673178)
[![Total Downloads](https://img.shields.io/packagist/dt/vyuldashev/xml-to-array.svg?style=flat-square)](https://packagist.org/packages/vyuldashev/xml-to-array)

This package provides a very simple class to convert an xml string to an array.

Inspired by Spatie's [array-to-xml](https://github.com/spatie/array-to-xml) ❤️ 

## Install

You can install this package via composer.

``` bash
composer require vyuldashev/xml-to-array
```

## Usage

```php
use Vyuldashev\XmlToArray\XmlToArray;

$xml = '<items>
    <good_guy>
        <name>Luke Skywalker</name>
        <weapon>Lightsaber</weapon>
    </good_guy>
    <bad_guy>
        <name>Sauron</name>
        <weapon>Evil Eye</weapon>
    </bad_guy>
</items>';

$result = XmlToArray::convert($xml);
```
After running this piece of code `$result` will contain:

```php
array:1 [
  "items" => array:2 [
    "good_guy" => array:2 [
      "name" => "Luke Skywalker"
      "weapon" => "Lightsaber"
    ]
    "bad_guy" => array:2 [
      "name" => "Sauron"
      "weapon" => "Evil Eye"
    ]
  ]
]
```

