<?php

/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2016 France Télévisions
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and
 * to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of
 * the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Ftven\Tests\DataBuilder;

use Ftven\DataBuilder\AbstractMeta;

class MetaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Meta
     */
    protected $metaBuilder;

    public function setUp()
    {
        $this->metaBuilder = new Meta('http://dummy-url', '/dummy/uri');
    }

    public function testBuildHtml()
    {
        $html = $this->metaBuilder->buildHtml([
            "name_of_meta" => [
                ["attribute name" => "value of attribute", "second attribute name" => "value of attribute"],
            ]
        ]);

        $this->assertEquals("<meta attribute name=\"value of attribute\" second attribute name=\"value of attribute\" />\n", $html);
    }

    public function testGetDefaut()
    {
        $this->assertSame([
            "name_of_meta" => [
                ["attribute name" => "value of attribute", "second attribute name" => "value of attribute"],
            ]
        ], $this->metaBuilder->getDefaultData());
    }

    public function testUpdateMeta()
    {
        $meta = $this->metaBuilder->getDefaultData();

        $meta = $this->metaBuilder->updateMeta($meta, "name_of_meta", [
            ["attribute name updated" => "value of attribute updated"]
        ]);

        $this->assertSame([
            "name_of_meta" => [
                ["attribute name updated" => "value of attribute updated"],
            ]
        ], $meta);
    }
}

// extend for test purpose
class Meta extends AbstractMeta
{
    public function getDefaultData()
    {
        return [
            "name_of_meta" => [
                ["attribute name" => "value of attribute", "second attribute name" => "value of attribute"],
            ]
        ];
    }
}