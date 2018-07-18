<?php

namespace ProcessMaker\i18next\Tests;

use PHPUnit\Framework\TestCase;
use ProcessMaker\i18next\Helpers\i18Next;

class i18nextTest extends TestCase
{
    /**
     * @dataProvider laravelToI18nextDataProvider
     */
    public function testLaravelToI18next($translation, $expected, $flatten)
    {
        $i18next = new i18Next();

        $transformed = $i18next->laravelToI18next($translation, $flatten);

        $this->assertEquals($expected, $transformed);
    }

    public function laravelToI18nextDataProvider()
    {
        return [
            // Test transforming a single key => value
            [
                [
                    "my.translation.key" => "This is a :test",
                ],
                [
                    "my.translation.key" => "This is a {{test}}"
                ],
                false,
            ],
            // Test transforming keys and values
            [
                [
                    "My :translation key" => "My translation :value",
                ],
                [
                    "My {{translation}} key" => "My translation {{value}}",
                ],
                false,
            ],
            // Test transforming a multidimensional
            [
                [
                    "my" => [
                        "key" => ":value",
                    ],
                ],
                [
                    "my" => [
                        "key" => "{{value}}",
                    ],
                ],
                false,
            ],
            // Test transforming a multidimensional with keys
            [
                [
                    ":my" => [
                        "key" => ":value",
                    ],
                ],
                [
                    "{{my}}" => [
                        "key" => "{{value}}",
                    ],
                ],
                false,
            ],
            // Test transforming a multidimensional array and flattening it
            [
                [
                    "my" => [
                        "key" => ":value",
                    ],
                ],
                [
                    "my.key" => "{{value}}",
                ],
                true,
            ],
        ];
    }
}