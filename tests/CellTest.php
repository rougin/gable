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
    public function test_cell_is_initialized_with_provided_properties()
    {
        // Arrange
        $expect_value = 'Test Value';
        $expect_align = 'center';
        $expect_name = 'test_value';
        $expect_colspan = 2;
        $expect_rowspan = 3;
        $expect_parsed_attrs = 'align="center" class="test-class" cspan="2" rspan="3" style="color: red;" width="50%"';

        // Act
        $cell = new Cell($expect_value, $expect_align, 'test-class', $expect_colspan, $expect_rowspan, 'color: red;', 50);

        // Assert
        $this->assertEquals($expect_value, $cell->getValue());
        $this->assertEquals($expect_align, $cell->getAlign());
        $this->assertEquals($expect_name, $cell->getName());
        $this->assertEquals($expect_colspan, $cell->getColspan());
        $this->assertEquals($expect_rowspan, $cell->getRowspan());
        $this->assertEquals($expect_parsed_attrs, $cell->getParsedAttrs());
    }

    /**
     * @return void
     */
    public function test_badges_can_be_added_to_a_cell()
    {
        // Arrange
        $cell = new Cell();
        $expect_badge1 = new Badge('Active', 'true', 'bg-success');
        $expect_badge2 = new Badge('Inactive', 'false', 'bg-danger');

        // Act
        $cell->addBadge($expect_badge1);
        $cell->addBadge($expect_badge2);

        $actual_badges = $cell->getBadges();

        // Assert
        $this->assertCount(2, $actual_badges);
        $this->assertEquals($expect_badge1, $actual_badges[0]);
        $this->assertEquals($expect_badge2, $actual_badges[1]);
    }

    /**
     * @return void
     */
    public function test_existing_badges_can_be_replaced_in_a_cell()
    {
        // Arrange
        $cell = new Cell();
        $expect_badge1 = new Badge('Active', 'true', 'bg-success');
        $expect_badge2 = new Badge('Inactive', 'false', 'bg-danger');
        $expect_badges = [$expect_badge1, $expect_badge2];

        // Act
        $cell->setBadges($expect_badges);

        $actual_badges = $cell->getBadges();

        // Assert
        $this->assertCount(2, $actual_badges);
        $this->assertEquals($expect_badge1, $actual_badges[0]);
        $this->assertEquals($expect_badge2, $actual_badges[1]);
    }

    /**
     * @return void
     */
    public function test_cell_name_can_be_set_and_retrieved()
    {
        // Arrange
        $cell = new Cell();
        $expect_name = 'custom_name';

        // Act
        $cell->setName($expect_name);
        $actual_name = $cell->getName();

        // Assert
        $this->assertEquals($expect_name, $actual_name);
    }

    /**
     * @return void
     */
    public function test_cell_value_can_be_set_and_retrieved()
    {
        // Arrange
        $cell = new Cell();
        $expect_value = 'New Value';

        // Act
        $cell->setValue($expect_value);
        $actual_value = $cell->getValue();

        // Assert
        $this->assertEquals($expect_value, $actual_value);
    }

    /**
     * @return void
     */
    public function test_cell_attributes_are_parsed_correctly()
    {
        // Arrange
        $cell = new Cell();
        $cell->withAttr('id', 'my-cell');
        $cell->setClass('custom-class');
        $cell->setStyle('font-size: 12px;');
        $cell->setWidth(75);

        $expect_attrs = 'id="my-cell" class="custom-class" style="font-size: 12px;" width="75%"';

        // Act
        $actual_attrs = $cell->getParsedAttrs();

        // Assert
        $this->assertEquals($expect_attrs, $actual_attrs);
    }

    /**
     * @return void
     */
    public function test_cell_returns_empty_attributes_for_null_values()
    {
        // Arrange
        $cell = new Cell(null, null, null, null, null, null, null);
        $expect_attrs = '';

        // Act
        $actual_attrs = $cell->getParsedAttrs();

        // Assert
        $this->assertEquals($expect_attrs, $actual_attrs);
    }

    /**
     * @return void
     */
    public function test_cell_name_is_generated_from_value()
    {
        // Test case 1: "First Name"
        // Arrange
        $cell1 = new Cell('First Name');
        $expect_name1 = 'first_name';
        // Act
        $actual_name1 = $cell1->getName();
        // Assert
        $this->assertEquals($expect_name1, $actual_name1);

        // Test case 2: "AnotherValue"
        // Arrange
        $cell2 = new Cell('AnotherValue');
        $expect_name2 = 'another_value';
        // Act
        $actual_name2 = $cell2->getName();
        // Assert
        $this->assertEquals($expect_name2, $actual_name2);

        // Test case 3: "ID"
        // Arrange
        $cell3 = new Cell('ID');
        $expect_name3 = 'id';
        // Act
        $actual_name3 = $cell3->getName();
        // Assert
        $this->assertEquals($expect_name3, $actual_name3);

        // Test case 4: "User ID"
        // Arrange
        $cell4 = new Cell('User ID');
        $expect_name4 = 'user_id';
        // Act
        $actual_name4 = $cell4->getName();
        // Assert
        $this->assertEquals($expect_name4, $actual_name4);
    }
}
