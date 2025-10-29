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
    public function test_danger_state_is_false_by_default()
    {
        // Arrange
        $action = new Action;

        $actual = $action->isDanger();

        // Assert (initial state)
        $this->assertFalse($actual);

        // Act
        $action->asDanger();

        $actual = $action->isDanger();

        // Assert (after setting danger)
        $this->assertTrue($actual);
    }

    /**
     * @return void
     */
    public function test_marks_action_as_danger()
    {
        // Arrange
        $action = new Action;

        // Act
        $action->asDanger();

        $actual = $action->isDanger();

        // Assert
        $this->assertTrue($actual);
    }

    /**
     * @return void
     */
    public function test_on_click_accessor()
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

    /**
     * @return void
     */
    public function test_retrieves_set_name()
    {
        // Arrange
        $expect = 'Test Action';

        $action = new Action;

        $action->setName($expect);

        // Act
        $actual = $action->getName();

        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_sets_and_retrieves_name()
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
    public function test_sets_correct_click_handler()
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
}
