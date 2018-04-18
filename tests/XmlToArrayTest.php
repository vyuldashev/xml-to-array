<?php

declare(strict_types=1);

namespace Vyuldashev\XmlToArray\Test;

use PHPUnit\Framework\TestCase;
use Spatie\ArrayToXml\ArrayToXml;
use Vyuldashev\XmlToArray\XmlToArray;

class XmlToArrayTest extends TestCase
{
    /** @dataProvider data
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
                        'name' => 'Luke Skywalker',
                        'weapon' => 'Lightsaber',
                    ],
                    'bad_guy' => [
                        'name' => 'Sauron',
                        'weapon' => 'Evil Eye',
                    ],
                ],
            ],
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
                ],
            ],
            [
                [
                    'good_guy' => [
                        'name' => [
                            '_cdata' => '<h1>Luke Skywalker</h1>',
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

    /** @dataProvider sameNameData
     * @param array $array
     * @test
     */
    public function sameNameTest(array $array)
    {
        $xml = ArrayToXml::convert($array, 'items');
        $convertedArr = XmlToArray::convert($xml);
        $this->assertSame(['items' => $array], XmlToArray::convert($xml));
    }

    public function sameNameData()
    {
        return [
            [
                [
                    'Facilities' => [
                        'Facility' => [
                            [
                                '_attributes' => ['Code'=>'*EC'],
                                '_cdata' =>  'Earliest check-in at 14:00',
                            ],
                            [
                                '_attributes' => ['Code'=>'*LF'],
                                '_cdata' =>  '1 lift',
                            ],
                            [
                                '_attributes' => ['Code'=>'*RS'],
                                '_cdata' =>  'Room Service from 18:00 to 21:00',
                            ],
                        ],
                    ],
                ],
            ]
        ];
    }
}