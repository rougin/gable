<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class CellTest extends Testcase
{
    /**
     * @return void
     */
    public function test_all_props()
    {
        // Arrange
        $value = 'Test Value';

        $align = 'center';

        $name = 'test_value';

        $colspan = 2;

        $rowspan = 3;

        $attrs = 'align="center" class="test-class" cspan="2" rspan="3" style="color: red;" width="50%"';

        // Act
        $cell = new Cell($value, $align, 'test-class', $colspan, $rowspan, 'color: red;', 50);

        // Assert
        $actual = $cell->getColspan();

        $this->assertEquals($colspan, $actual);

        $actual = $cell->getValue();

        $this->assertEquals($value, $actual);

        $actual = $cell->getAlign();

        $this->assertEquals($align, $actual);

        $actual = $cell->getRowspan();

        $this->assertEquals($rowspan, $actual);

        $actual = $cell->getName();

        $this->assertEquals($name, $actual);

        $actual = $cell->getParsedAttrs();

        $this->assertEquals($attrs, $actual);
    }

    /**
     * @return void
     */
    public function test_badges()
    {
        // Arrange
        $cell = new Cell;

        $badge1 = new Badge('Active', 'true', 'bg-success');

        $badge2 = new Badge('Inactive', 'false', 'bg-danger');

        // Act
        $cell->addBadge($badge1);

        $cell->addBadge($badge2);

        // Assert
        $actual = $cell->getBadges();

        $this->assertEquals($badge1, $actual[0]);

        $this->assertEquals($badge2, $actual[1]);
    }

    /**
     * @return void
     */
    public function test_badges_as_array()
    {
        // Arrange
        $cell = new Cell;

        $badge1 = new Badge('Active', 'bg-success');

        $badge2 = new Badge('Inactive', 'bg-danger');

        $badges = array($badge1, $badge2);

        // Act
        $cell->setBadges($badges);

        // Assert
        $actual = $cell->getBadges();

        $this->assertEquals($badge1, $actual[0]);

        $this->assertEquals($badge2, $actual[1]);
    }

    /**
     * @return void
     */
    public function test_empty_attrs()
    {
        // Arrange
        $cell = new Cell;

        // Act
        $actual = $cell->getParsedAttrs();

        // Assert
        $this->assertEmpty($actual);
    }

    /**
     * @return void
     */
    public function test_name_as_snake_case()
    {
        // Test case 1: "First Name" ---------
        // Arrange
        $cell = new Cell('First Name');

        $expect = 'first_name';

        // Act
        $actual = $cell->getName();

        // Assert
        $this->assertEquals($expect, $actual);
        // -----------------------------------

        // Test case 2: "AnotherValue" -------
        // Arrange
        $cell = new Cell('AnotherValue');

        $expect = 'another_value';

        // Act
        $actual = $cell->getName();

        // Assert
        $this->assertEquals($expect, $actual);
        // -----------------------------------

        // Test case 3: "ID" -----------------
        // Arrange
        $cell = new Cell('ID');

        $expect = 'id';

        // Act
        $actual = $cell->getName();

        // Assert
        $this->assertEquals($expect, $actual);
        // -----------------------------------

        // Test case 4: "User ID" ------------
        // Arrange
        $cell = new Cell('User ID');

        $expect = 'user_id';

        // Act
        $actual = $cell->getName();

        // Assert
        $this->assertEquals($expect, $actual);
        // -----------------------------------
    }

    /**
     * @return void
     */
    public function test_setting_name()
    {
        // Arrange
        $cell = new Cell;

        $expect = 'custom_name';

        // Act
        $cell->setName($expect);

        $actual = $cell->getName();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_setting_value()
    {
        // Arrange
        $cell = new Cell;

        $expect = 'New Value';

        // Act
        $cell->setValue($expect);

        $actual = $cell->getValue();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_with_attrs()
    {
        // Arrange
        $cell = new Cell;

        $expect = 'id="my-cell" class="custom-class" style="font-size: 12px;" width="75%"';

        // Act
        $cell->withAttr('id', 'my-cell');

        $cell->setClass('custom-class');

        $cell->setStyle('font-size: 12px;');

        $cell->setWidth(75);

        // Assert
        $actual = $cell->getParsedAttrs();

        $this->assertEquals($expect, $actual);
    }
}
