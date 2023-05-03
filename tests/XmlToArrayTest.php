<?php

declare(strict_types=1);

namespace Vyuldashev\XmlToArray\Test;

use PHPUnit\Framework\TestCase;
use Spatie\ArrayToXml\ArrayToXml;
use Vyuldashev\XmlToArray\XmlToArray;

class XmlToArrayTest extends TestCase
{
    /**
     * @dataProvider data
     *
     * @param  array  $array
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

    /**
     * @dataProvider sameNameData
     *
     * @param  array  $array
     *
     * @test
     */
    public function sameNameTest(array $array)
    {
        $xml = ArrayToXml::convert($array, 'items');

        $convertedArr = XmlToArray::convert($xml);

        $this->assertSame(['items' => $array], $convertedArr);
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
            ],
        ];
    }

    /**
     * @dataProvider sameMultiDimensionalData
     *
     * @param  array  $array
     *
     * @test
     */
    public function sameMultiDimensionalTest(array $array)
    {
        $xml = ArrayToXml::convert($array, 'items');

        $convertedArr = XmlToArray::convert($xml);

        $this->assertSame(['items' => $array], $convertedArr);
    }

    public function sameMultiDimensionalData()
    {
        return [
            [
                [
                    'Good_guys' => [
                        'Guy' => [
                            ['name' => 'Luke Skywalker', 'weapon' => 'Lightsaber'],
                            ['name' => 'Captain America', 'weapon' => 'Shield'],
                        ],
                    ],
                    'Bad_guys' => [
                        'Guy' => [
                            ['name' => 'Sauron', 'weapon' => 'Evil Eye'],
                            ['name' => 'Darth Vader', 'weapon' => 'Lightsaber'],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     *  @dataProvider sameMultiDimensionalData
     *
     *  @test
     */
    public function convert_WhenXmlHasNewLinesAndCarrigageReturns_ShouldCorrectConvertToArray(array $array)
    {
        $xml = "
        <?xml version=\"1.0\"?> \r\n
        <root> \r\n
            <Good_guys> \r\n
                <Guy> \r\n
                    <name>Luke Skywalker</name> \r\n
                    <weapon>Lightsaber</weapon> \r\n
                </Guy> \r\n
                <Guy> \r\n
                    <name>Captain America</name> \r\n
                    <weapon>Shield</weapon> \r\n
                </Guy> \r\n
            </Good_guys> \r\n
            <Bad_guys> \r\n
                <Guy> \r\n
                    <name>Sauron</name> \r\n
                    <weapon>Evil Eye</weapon> \r\n
                </Guy> \r\n
                <Guy> \r\n
                    <name>Darth Vader</name> \r\n
                    <weapon>Lightsaber</weapon> \r\n
                </Guy> \r\n
            </Bad_guys> \r\n
        </root>
        ";

        $arrayExpected['root'] = $array;

        $convertedArr = XmlToArray::convert($xml);

        $this->assertSame($arrayExpected, $convertedArr);
    }
}
