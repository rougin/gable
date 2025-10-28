<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class DataTest extends Testcase
{
    /**
     * @return void
     */
    public function test_cells_can_be_added_to_data_object()
    {
        // Arrange
        $data = new Data();
        $expect_cell1 = new Cell('Value 1');
        $expect_cell2 = new Cell('Value 2');

        // Act
        $data->addCell($expect_cell1);
        $data->addCell($expect_cell2);

        $actual_cells = $data->getCells();

        // Assert
        $this->assertCount(2, $actual_cells);
        $this->assertEquals($expect_cell1, $actual_cells[0]);
        $this->assertEquals($expect_cell2, $actual_cells[1]);
    }

    /**
     * @return void
     */
    public function test_data_cells_render_to_html()
    {
        // Arrange
        $data = new Data();
        $cell1 = new Cell('Name', 'left', 'header-class');
        $cell2 = new Cell('Age', 'right');

        $data->addCell($cell1);
        $data->addCell($cell2);

        $expect = '<td align="left" class="header-class">Name</td><td align="right">Age</td>';

        // Act
        $actual = $data->cellsToHtml();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_data_cells_with_badges_render_to_html()
    {
        // Arrange
        $data = new Data();
        $cell = new Cell('Status');
        $badge = new Badge('Active', 'item.status === \'active\'', 'bg-success');
        $cell->addBadge($badge);

        $data->addCell($cell);

        $expect_badge_html = '<template x-if="item.status === \'active\'"><span class="badge rounded-pill text-uppercase bg-success">Active</span></template>';
        $expect = '<td>' . $expect_badge_html . '</td>';

        // Act
        $actual = $data->cellsToHtml();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_last_cell_and_index_are_retrieved_correctly()
    {
        // Arrange
        $data = new Data();
        $cell1 = new Cell('First');
        $expect_cell2 = new Cell('Last');

        // Act
        $data->addCell($cell1);
        $data->addCell($expect_cell2);

        $actual_last_cell = $data->getLast();
        $actual_last_index = $data->getLastIndex();

        // Assert
        $this->assertEquals($expect_cell2, $actual_last_cell);
        $this->assertEquals(1, $actual_last_index);
    }

    /**
     * @return void
     */
    public function test_last_cell_in_data_can_be_replaced()
    {
        // Arrange
        $data = new Data();
        $cell1 = new Cell('Original');
        $expect_cell2 = new Cell('New Last');

        // Act
        $data->addCell($cell1);
        $data->setLast($expect_cell2);

        $actual_cells = $data->getCells();

        // Assert
        $this->assertCount(1, $actual_cells);
        $this->assertEquals($expect_cell2, $actual_cells[0]);
    }

    /**
     * @return void
     */
    public function test_data_object_renders_to_html()
    {
        // Arrange
        $data = new Data();
        $cell1 = new Cell('Header 1');
        $cell2 = new Cell('Header 2');

        $data->addCell($cell1);
        $data->addCell($cell2);

        $data->setClass('row-class');

        $expect = '<tr class="row-class"><td>Header 1</td><td>Header 2</td></tr>';

        // Act
        $actual = $data->toHtml();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_data_object_renders_to_html_with_specified_type()
    {
        // Arrange
        $data = new Data();
        $cell1 = new Cell('Header 1');
        $cell2 = new Cell('Header 2');

        $data->addCell($cell1);
        $data->addCell($cell2);

        $expect = '<th>Header 1</th><th>Header 2</th>';

        // Act
        $actual = $data->cellsToHtml('th');

        // Assert
        $this->assertEquals($expect, $actual);
    }
}
