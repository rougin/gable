<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class BadgeTest extends Testcase
{
    /**
     * @return void
     */
    public function test_renders_with_custom_style()
    {
        // Arrange
        $badge = new Badge('Inactive', 'item.status === \'inactive\'', 'bg-danger');

        $expect = '<template x-if="item.status === \'inactive\'"><span class="badge rounded-pill text-uppercase bg-danger">Inactive</span></template>';

        // Act
        $actual = (string) $badge;

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_renders_with_default_style()
    {
        // Arrange
        $badge = new Badge('Active', 'item.status === \'active\'', 'bg-success');

        $expect = '<template x-if="item.status === \'active\'"><span class="badge rounded-pill text-uppercase bg-success">Active</span></template>';

        // Act
        $actual = (string) $badge;

        // Assert
        $this->assertEquals($expect, $actual);
    }
}
