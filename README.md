# Convert xml to an array

This package provides a very simple class to convert an xml string to an array.

Inspired by Spatie's [array-to-xml](https://github.com/spatie/array-to-xml) package. ❤️ 

## Install

You can install this package via composer.

``` bash
composer require vyuldaashev/xml-to-array
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

