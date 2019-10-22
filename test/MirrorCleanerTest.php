<?php

use PHPUnit\Framework\TestCase;

class MirrorCleanerTest extends TestCase
{

    public function testCleanMirror()
    {
        $carsData = [
            [
                'accessories' => [
                    [
                        'cockpit' => [
                            [
                                'mirror' => 'Mirror Component',
                                'gearbox' => 'Gearbox Component'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = [
            [
                'accessories' => [
                    [
                        'cockpit' => [
                            [
                                'gearbox' => 'Gearbox Component'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $mirrorCleaner = new MirrorCleaner($carsData);
        $this->assertEquals($expected, $mirrorCleaner->cleanMirror());
    }

    public function testCleanMirrorNoAccessories()
    {
        $carsData = [[]];
        $mirrorCleaner = new MirrorCleaner($carsData);
        $this->assertTrue($mirrorCleaner->cleanMirror());
    }
}