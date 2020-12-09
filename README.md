# Convert xml to an array

[![Latest Stable Version](https://poser.pugx.org/vyuldashev/xml-to-array/v/stable?format=flat-square)](https://packagist.org/packages/vyuldashev/xml-to-array)
[![Build Status](https://github.com/vyuldashev/xml-to-array/workflows/Tests/badge.svg)](https://github.com/vyuldashev/xml-to-array/actions)
[![Total Downloads](https://poser.pugx.org/vyuldashev/xml-to-array/downloads?format=flat-square)](https://packagist.org/packages/vyuldashev/xml-to-array)
[![StyleCI](https://styleci.io/repos/106673178/shield)](https://styleci.io/repos/106673178)
[![License](https://poser.pugx.org/vyuldashev/xml-to-array/license?format=flat-square)](https://packagist.org/packages/vyuldashev/xml-to-array)

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

