<?php

namespace Ftven\DataBuilder;

/**
 * Class to help building meta data
 */
abstract class AbstractMeta
{
    /**
     * @var string
     */
    public $rootUrl;

    /**
     * @var string
     */
    public $uri;

    /**
     * @param string $rootUrl
     * @param string $uri
     */
    public function __construct($rootUrl, $uri)
    {
        $this->rootUrl    = $rootUrl;
        $this->uri        = $uri;
    }

    /**
     * @return string
     */
    public function getUrlOrigin()
    {
        return $this->rootUrl . $this->uri;
    }

    /**
     * Place your default meta data
     *
     * @return array
     */
    abstract public function getDefaultData();

    /**
     * Update meta on the fly
     *
     * @param array $meta
     * @param string $name
     * @param array  $update
     *
     * @return array
     */
    public function updateMeta(array $meta, $name, array $update)
    {
        foreach($meta as $key => $values) {
            if ($key !== $name) {
                continue;
            }

            $meta[$key] = $update;
        }

        return $meta;
    }

    /**
     * Return html of metas
     * You may override it to implement templating
     *
     * @param array $metas
     *
     * @return string
     */
    public function buildHtml(array $metas)
    {
        $html = '';
        foreach($metas as $key => $meta) {
            foreach ($meta as $attrs) {
                $attributes = $this->generateAttribute($attrs);
                $html .= "<meta ".$attributes."/>\n";
            }
        }

        return $html;
    }

    /**
     * Generate attributes string
     * You may override it to implement templating
     *
     * @param array $attributes
     *
     * @return string
     */
    protected function generateAttribute(array $attributes)
    {
        $attributeChain = "";
        foreach ($attributes as $attrKey => $attrValue) {
            $attributeChain .= $attrKey.'="'.$attrValue.'" ';
        }

        return $attributeChain;
    }
}
