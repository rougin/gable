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
    public function test_can_be_marked_as_danger()
    {
        // Arrange
        $action = new Action;

        // Act
        $action->asDanger();
        $actual_is_danger = $action->isDanger();

        // Assert
        $this->assertTrue($actual_is_danger);
    }

    /**
     * @return void
     */
    public function test_can_have_a_click_handler()
    {
        // Arrange
        $expect = 'testFunction()';
        $action = new Action;

        // Act
        $action->ifClicked($expect);
        $actual = $action->onClick();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_danger_state_is_correctly_reported()
    {
        // Arrange
        $action = new Action;

        // Assert (initial state)
        $this->assertFalse($action->isDanger());

        // Act
        $action->asDanger();

        // Assert (after setting danger)
        $this->assertTrue($action->isDanger());
    }

    /**
     * @return void
     */
    public function test_name_can_be_retrieved()
    {
        // Arrange
        $expect = 'Test Action';
        $action = new Action;
        $action->setName($expect);

        // Act
        $actual = $action->getName();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_name_can_be_set()
    {
        // Arrange
        $expect = 'Another Action';
        $action = new Action;

        // Act
        $action->setName($expect);
        $actual = $action->getName();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_onclick()
    {
        // Arrange
        $expect = 'anotherFunction()';
        $action = new Action;

        // Act
        $action->ifClicked($expect);
        $actual = $action->onClick();

        // Assert
        $this->assertEquals($expect, $actual);
    }
}
