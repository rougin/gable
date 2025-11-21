<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Alpine
{
    /**
     * @var \Rougin\Gable\Action[]
     */
    protected $actions = array();

    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function endAction()
    {
        return '</div></div>';
    }

    /**
     * @return string
     */
    public function endItems()
    {
        return '</template></template>';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Rougin\Gable\Action[] $actions
     *
     * @return self
     */
    public function setActions($actions)
    {
        $this->actions = $actions;

        return $this;
    }

    /**
     * @param \Rougin\Gable\Cell $cell
     *
     * @return string
     */
    public function startAction(Cell $cell)
    {
        $html = '<div class="dropdown">';
        $html .= '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">';
        $html .= $cell->getName() ? $cell->getName() : 'Action' . (count($this->actions) > 1 ? 's' : '');
        $html .= '</button>';
        $html .= '<div class="dropdown-menu dropdown-menu-end">';

        return $html;
    }

    /**
     * @return string
     */
    public function startItems()
    {
        $html = '<template x-if="items && items.length > 0">';

        $html .= '<template x-for="item in ' . $this->name . '">';

        return $html;
    }
}
