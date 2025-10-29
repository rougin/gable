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
    public function test_adds_and_gets_cells()
    {
        // Arrange
        $data = new Data;

        $cell1 = new Cell('Value 1');

        $cell2 = new Cell('Value 2');

        // Act
        $data->addCell($cell1);

        $data->addCell($cell2);

        $actual = $data->getCells();

        // Assert
        $this->assertEquals($cell1, $actual[0]);

        $this->assertEquals($cell2, $actual[1]);
    }

    /**
     * @return void
     */
    public function test_gets_last_cell_and_index()
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
    public function test_renders_badges_in_cell()
    {
        // Arrange
        $data = new Data;

        $cell = new Cell('Status');

        $badge = new Badge('Active', 'item.status === \'active\'', 'bg-success');

        $cell->addBadge($badge);

        $data->addCell($cell);

        $expect = '<td><template x-if="item.status === \'active\'"><span class="badge rounded-pill text-uppercase bg-success">Active</span></template></td>';

        // Act
        $actual = $data->cellsToHtml();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_renders_cells_to_td()
    {
        // Arrange
        $data = new Data;

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
    public function test_renders_cells_with_custom_tag()
    {
        // Arrange
        $data = new Data;

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

    /**
     * @return void
     */
    public function test_renders_full_row_to_tr()
    {
        // Arrange
        $data = new Data;

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
    public function test_replaces_last_cell()
    {
        // Arrange
        $data = new Data;

        $cell1 = new Cell('Original');

        $cell2 = new Cell('New Last');

        // Act
        $data->addCell($cell1);

        $data->setLast($cell2);

        $actual = $data->getCells();

        // Assert
        $this->assertEquals($cell2, $actual[0]);
    }
}
