<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class RowTest extends Testcase
{
    /**
     * @return void
     */
    public function test_initializes_with_all_props()
    {
        // Arrange
        $class = 'test-class';

        $style = 'color: blue;';

        $width = 100;

        // Act
        $row = new Row($class, $style, $width);

        $actual = $row->getAttrs();

        // Assert
        $this->assertEquals($class, $actual['class']);

        $this->assertEquals($style, $actual['style']);

        $this->assertEquals($width, $actual['width']);
    }

    /**
     * @return void
     */
    public function test_renders_cells_with_custom_tag()
    {
        // Arrange
        $row = new Row();

        $cell1 = new Cell('Header 1');

        $cell2 = new Cell('Header 2');

        $row->addCell($cell1);

        $row->addCell($cell2);

        $expect = '<th>Header 1</th><th>Header 2</th>';

        // Act
        $actual = $row->cellsToHtml('th');

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_renders_row_with_cells()
    {
        // Arrange
        $row = new Row('row-class');

        $cell1 = new Cell('Data 1');

        $cell2 = new Cell('Data 2');

        $row->addCell($cell1);

        $row->addCell($cell2);

        $expect = '<tr class="row-class"><td>Data 1</td><td>Data 2</td></tr>';

        // Act
        $actual = $row->toHtml();

        // Assert
        $this->assertEquals($expect, $actual);
    }
}
