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
    public function test_adding_cells()
    {
        // Arrange
        $data = new Data;

        $cell1 = new Cell('Value 1');

        $cell2 = new Cell('Value 2');

        // Act
        $data->addCell($cell1);

        $data->addCell($cell2);

        // Assert
        $actual = $data->getCells();

        $this->assertEquals($cell1, $actual[0]);

        $this->assertEquals($cell2, $actual[1]);
    }

    /**
     * @return void
     */
    public function test_badge_in_cell()
    {
        // Arrange
        $data = new Data;

        $cell = new Cell('Status');

        $badge = new Badge('Active', 'bg-success');

        $expect = '<td><span class="badge rounded-pill text-uppercase bg-success">Active</span></td>';

        // Act
        $cell->addBadge($badge);

        $data->addCell($cell);

        // Assert
        $actual = $data->cellsToHtml();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_cells_as_td()
    {
        // Arrange
        $data = new Data;

        $cell1 = new Cell('Name', 'left', 'header-class');

        $cell2 = new Cell('Age', 'right');

        $expect = '<td align="left" class="header-class">Name</td><td align="right">Age</td>';

        // Act
        $data->addCell($cell1);

        $data->addCell($cell2);

        // Assert
        $actual = $data->cellsToHtml();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_cells_as_th()
    {
        // Arrange
        $data = new Data;

        $cell1 = new Cell('Header 1');

        $cell2 = new Cell('Header 2');

        $expect = '<th>Header 1</th><th>Header 2</th>';

        // Act
        $data->addCell($cell1);

        $data->addCell($cell2);

        // Assert
        $actual = $data->cellsToHtml('th');

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_cells_with_class_in_tr()
    {
        // Arrange
        $data = new Data;

        $cell1 = new Cell('Header 1');

        $cell2 = new Cell('Header 2');

        $expect = '<tr class="row-class"><td>Header 1</td><td>Header 2</td></tr>';

        // Act
        $data->addCell($cell1);

        $data->addCell($cell2);

        $data->setClass('row-class');

        // Assert
        $actual = $data->toHtml();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_last_cell_index()
    {
        // Arrange
        $data = new Data;

        $cell1 = new Cell('First');

        $cell2 = new Cell('Second');

        $cell3 = new Cell('Last');

        // Act
        $data->addCell($cell1);

        $data->addCell($cell2);

        $data->addCell($cell3);

        // Assert
        $actual = $data->getLast();

        $this->assertEquals($cell3, $actual);

        $actual = $data->getLastIndex();

        $this->assertEquals(2, $actual);
    }

    /**
     * @return void
     */
    public function test_replaces_last_cell()
    {
        // Arrange
        $data = new Data;

        $cell1 = new Cell('Original');

        $cell2 = new Cell('New Last');

        // Act
        $data->addCell($cell1);

        $data->setLast($cell2);

        // Assert
        $actual = $data->getCells();

        $this->assertEquals($cell2, $actual[0]);
    }
}
