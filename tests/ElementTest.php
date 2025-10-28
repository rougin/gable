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
    public function test_attributes_can_be_set_and_retrieved()
    {
        // Arrange
        $element = new Element();
        $element->withAttr('id', 'test-id');
        $element->withAttr('data-test', 'value');

        $expect_attrs = [
            'id' => 'test-id',
            'data-test' => 'value',
        ];

        // Act
        $actual_attrs = $element->getAttrs();

        // Assert
        $this->assertEquals($expect_attrs, $actual_attrs);
    }

    /**
     * @return void
     */
    public function test_class_attribute_can_be_set()
    {
        // Arrange
        $element = new Element();
        $expect_class = 'my-class';

        // Act
        $element->setClass($expect_class);
        $actual_class = $element->getAttrs()['class'];

        // Assert
        $this->assertEquals($expect_class, $actual_class);
    }

    /**
     * @return void
     */
    public function test_style_attribute_can_be_set()
    {
        // Arrange
        $element = new Element();
        $expect_style = 'color: blue;';

        // Act
        $element->setStyle($expect_style);
        $actual_style = $element->getAttrs()['style'];

        // Assert
        $this->assertEquals($expect_style, $actual_style);
    }

    /**
     * @return void
     */
    public function test_width_attribute_can_be_set()
    {
        // Arrange
        $element = new Element();
        $expect_width = 100;

        // Act
        $element->setWidth($expect_width);
        $actual_width = $element->getAttrs()['width'];

        // Assert
        $this->assertEquals($expect_width, $actual_width);
    }

    /**
     * @return void
     */
    public function test_parsed_attributes_are_generated_correctly()
    {
        // Arrange
        $element = new Element();
        $element->withAttr('id', 'test-element');
        $element->setClass('test-class');
        $element->setWidth(50);

        $expect_parsed_attrs = 'id="test-element" class="test-class" width="50%"';

        // Act
        $actual_parsed_attrs = $element->getParsedAttrs();

        // Assert
        $this->assertEquals($expect_parsed_attrs, $actual_parsed_attrs);
    }

    /**
     * @return void
     */
    public function test_empty_string_returned_for_null_attributes()
    {
        // Arrange
        $element = new Element();
        $element->withAttr('id', null);
        $element->setClass(null);

        $expect_parsed_attrs = '';

        // Act
        $actual_parsed_attrs = $element->getParsedAttrs();

        // Assert
        $this->assertEquals($expect_parsed_attrs, $actual_parsed_attrs);
    }
}
