<?php

namespace Rougin\Gable;

use Rougin\Gable\Styles\BootstrapStyle;

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
    public function test_passed_if_action_is_marked_as_danger()
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
    public function test_passed_if_action_name_is_retrieved()
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
    public function test_passed_if_action_name_is_set()
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
    public function test_passed_if_click_event_is_set()
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
    public function test_passed_if_danger_defaults_to_false()
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
    public function test_passed_if_style_defaults_to_bootstrap()
    {
        // Arrange
        $action = new Action;

        $expect = 'Rougin\Gable\Styles\BootstrapStyle';

        // Act
        $actual = $action->getStyle();

        // Assert
        $this->assertInstanceOf($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_style_can_be_set_and_retrieved()
    {
        // Arrange
        $action = new Action;

        $style = new BootstrapStyle;

        // Act
        $action->withStyle($style);

        $actual = $action->getStyle();

        // Assert
        $this->assertSame($style, $actual);
    }
}
