<?php

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