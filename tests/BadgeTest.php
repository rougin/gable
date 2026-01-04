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
    public function test_with_state()
    {
        // Arrange
        $badge = new Badge('Active', 'bg-success', 'item.status === \'active\'');

        $expect = '<template x-if="item.status === \'active\'"><span class="badge rounded-pill text-uppercase bg-success">Active</span></template>';

        // Act
        $actual = $badge->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }
}
