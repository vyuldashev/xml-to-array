<?php

declare(strict_types=1);

namespace Vyuldashev\XmlToArray\Test;

use PHPUnit\Framework\TestCase;
use Spatie\ArrayToXml\ArrayToXml;
use Vyuldashev\XmlToArray\XmlToArray;

class XmlToArrayTest extends TestCase
{
    /** @dataProvider data
     *
     * @param array $array
     */
    public function test(array $array)
    {
        $xml = ArrayToXml::convert($array, 'items');

        $this->assertSame(['items' => $array], XmlToArray::convert($xml));
    }

    public function data()
    {
        return [
            [
                [
                    'good_guy' => [
                        '_attributes' => ['attr1' => 'value'],
                        'name' => 'Luke Skywalker',
                        'weapon' => 'Lightsaber',
                    ],
                    'bad_guy' => [
                        'name' => 'Sauron',
                        'weapon' => 'Evil Eye',
                    ],
                ]
            ],
            [
                [
                    'good_guy' => [
                        'name' => [
                            '_cdata' => '<h1>Luke Skywalker</h1>'
                        ],
                        'weapon' => 'Lightsaber',
                    ],
                    'bad_guy' => [
                        'name' => '<h1>Sauron</h1>',
                        'weapon' => 'Evil Eye',
                    ],
                ],
            ],
        ];
    }
}