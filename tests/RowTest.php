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
    public function row_is_initialized_with_provided_properties()
    {
        // Arrange
        $expect_class = 'test-class';
        $expect_style = 'color: blue;';
        $expect_width = 100;

        // Act
        $row = new Row($expect_class, $expect_style, $expect_width);

        // Assert
        $this->assertEquals($expect_class, $row->getAttrs()['class']);
        $this->assertEquals($expect_style, $row->getAttrs()['style']);
        $this->assertEquals($expect_width, $row->getAttrs()['width']);
    }

    /**
     * @return void
     */
    public function test_to_html_generates_correct_html()
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

    /**
     * @return void
     */
    public function test_to_html_with_different_cell_type_generates_correct_html()
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
}
