<?php
namespace Intercom\Tests;
require '../src/NestedArray.php';
use Intercom\NestedArray;

class NestedArrayTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Not relevant to our code, no need to test
     *
    /**
     * @expectedException     \TypeError
     *
    public function testWithInteger()
    {
        (new NestedArray())->flatten(2);
    }

    /**
     * @expectedException     \TypeError
     *
    public function testWithFloat()
    {
        (new NestedArray())->flatten(2.5);
    }

    /**
     * @expectedException     \TypeError
     *
    public function testWithString()
    {
        (new NestedArray())->flatten("one");
    }

    /**
     * @expectedException     \TypeError
     *
    public function testWithObject()
    {
        (new NestedArray())->flatten(new \stdClass());
    }
    */

    public function testWithEmptyArray()
    {
        $flattened = (new NestedArray())->flatten([]);
        $this->assertEmpty($flattened);
    }

    public function testWithArrayOfEmptyStrings()
    {
        $flattened  = (new NestedArray())->flatten(['', '', '', ['', '']]);
        $expected   = ['', '', '', '', ''];
        $this->assertEquals($expected, $flattened);
    }

    public function testWithArrayOfIntegers()
    {
        $flattened = (new NestedArray())->flatten([1,
            [2,
                [3,
                    [4,
                        [5, 6,
                            [7, 8, 9,
                                [10]
                            ],
                            11, 12, 13]
                    ],
                    14,
                    [15,
                        [16]
                    ]
                ],
                [17, 18, 19]
            ],
            [20]
        ]);
        $expected = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
        $this->assertEquals($expected, $flattened);
    }

    public function testWithArrayOfFloats()
    {
        $flattened = (new NestedArray())->flatten([1.1,
            [2.2,
                [3.3,
                    [4.4,
                        [5.5, 6.6,
                            [7.7, 8.8, 9.9,
                                [10.1],
                                11.1, 12.2, 13.3]
                        ],
                        14.4,
                        [15.5,
                            [16.6]
                        ]
                    ],
                    [17.7, 18.8, 19.9]
                ],
                [20.2]
            ]
        ]);
        $expected = [1.1, 2.2, 3.3, 4.4, 5.5, 6.6, 7.7, 8.8, 9.9, 10.1, 11.1,
                        12.2, 13.3, 14.4, 15.5, 16.6, 17.7, 18.8, 19.9, 20.2];
        $this->assertEquals($expected, $flattened);
    }

    public function testWithArrayOfStrings()
    {
        $flattened = (new NestedArray())->flatten(["one",
            ["two",
                ["three",
                    ["four",
                        ["five", "six",
                            ["seven", "eight", "nine",
                                ["ten"],
                                "eleven", "twelve", "thirteen"]
                        ],
                        "fourteen",
                        ["fifteen",
                            ["sixteen"]
                        ]
                    ],
                    ["seventeen", "eighteen", "nineteen"]
                ],
                ["twenty"]
            ]
        ]);
        $expected = ['one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
                    'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen', 'twenty'];
        $this->assertEquals($expected, $flattened);
    }

    public function testWithArrayOfObject()
    {
        $flattened = (new NestedArray())->flatten([new \stdClass(),
            [new \stdClass(),
                [new \stdClass(),
                    [new \stdClass(),
                        [new \stdClass(), new \stdClass()],
                    ],
                ],
            ],
        ]);
        $this->assertCount(6, $flattened);
    }

    public function testWithArrayOfNulls()
    {
        $flattened = (new NestedArray())->flatten([null,
            [null,
                [null,
                    [null,
                        [null, null],
                    ],
                ],
            ],
        ]);
        $this->assertCount(6, $flattened);
        $this->assertEmpty(array_filter($flattened));
    }

    public function testWithArrayOfMixedTypes()
    {
        $flattened = (new NestedArray())->flatten(["one",
            [2,
                [3.3,
                    [4,
                        [null, "six",
                            [new \stdClass(), "eight", "nine",
                                [10.10],
                                "eleven", 11, "thirteen"]
                        ],
                        "fourteen",
                        [null,
                            ["sixteen"]
                        ]
                    ],
                    [17, "eighteen", 19.19]
                ],
                ["twenty"]
            ]
        ]);
        $this->assertCount(20, $flattened);
        $this->assertCount(18, array_filter($flattened));
    }
}