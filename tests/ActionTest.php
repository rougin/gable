<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class ActionTest extends Testcase
{
    /**
     * @return void
     */
    public function test_as_danger()
    {
        // Arrange
        $action = new Action;

        // Act
        $action->asDanger();

        // Assert
        $actual = $action->isDanger();

        $this->assertTrue($actual);
    }

    /**
     * @return void
     */
    public function test_danger_is_false()
    {
        // Arrange
        $action = new Action;

        // Act
        $actual = $action->isDanger();

        // Assert
        $this->assertFalse($actual);
    }

    /**
     * @return void
     */
    public function test_getting_name()
    {
        // Arrange
        $expect = 'Another Action';

        $action = new Action;

        // Act
        $action->setName($expect);

        $actual = $action->getName();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_if_clicked()
    {
        // Arrange
        $expect = 'anotherFunction()';

        $action = new Action;

        // Act
        $action->ifClicked($expect);

        // Assert
        $actual = $action->onClick();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_setting_name()
    {
        // Arrange
        $expect = 'Test Action';

        $action = new Action;

        $action->setName($expect);

        // Act
        $actual = $action->getName();

        $this->assertEquals($expect, $actual);
    }
}
