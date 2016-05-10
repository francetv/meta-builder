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
