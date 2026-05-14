<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class ElementTest extends Testcase
{
    /**
     * @return void
     */
    public function test_passed_if_all_attrs_are_parsed()
    {
        // Arrange
        $el = new Element;

        $el->withAttr('id', 'test-element');

        $el->setClass('test-class');

        $el->setWidth(50);

        $expect = 'id="test-element" class="test-class" width="50%"';

        // Act
        $actual = $el->getParsedAttrs();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_class_attr_is_set()
    {
        // Arrange
        $el = new Element;

        $expect = 'my-class';

        // Act
        $el->setClass($expect);

        $attrs = $el->getAttrs();

        $actual = $attrs['class'];

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_custom_attrs_are_set()
    {
        // Arrange
        $el = new Element;

        $el->withAttr('id', 'test-id');

        $el->withAttr('data-test', 'value');

        $expect = array('id' => 'test-id');

        $expect['data-test'] = 'value';

        // Act
        $actual = $el->getAttrs();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_null_attrs_returns_empty()
    {
        // Arrange
        $el = new Element;

        $el->withAttr('id', null);

        $expect = '';

        // Act
        $actual = $el->getParsedAttrs();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_style_attr_is_set()
    {
        // Arrange
        $el = new Element;

        $expect = 'color: blue;';

        // Act
        $el->setStyle($expect);

        $attrs = $el->getAttrs();

        $actual = $attrs['style'];

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_width_attr_is_set()
    {
        // Arrange
        $el = new Element;

        $expect = 100;

        // Act
        $el->setWidth($expect);

        $attrs = $el->getAttrs();

        $actual = $attrs['width'];

        // Assert
        $this->assertEquals($expect, $actual);
    }
}
