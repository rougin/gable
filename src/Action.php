<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Action
{
    /**
     * @var boolean
     */
    protected $danger = false;

    /**
     * @var string|null
     */
    protected $event = null;

    /**
     * @var string|null
     */
    protected $name = null;

    /**
     * @return self
     */
    public function asDanger()
    {
        $this->danger = true;

        return $this;
    }

    /**
     * @param boolean $danger
     *
     * @return string
     */
    public function getHtml($danger = false)
    {
        // TODO: Replace with "StyleInterface" -----------
        $hrClass = 'dropdown-divider';

        $itemClass = 'dropdown-item';

        $danger = $this->isDanger() ? ' text-danger' : '';
        // -----------------------------------------------

        $html = '';

        if ($danger)
        {
            $html .= '<div><hr class="' . $hrClass . '"></div>';
        }

        return $html . '<div><a class="' . $itemClass . $danger . '" href="javascript:void(0)" @click="' . $this->onClick() . '">' . $this->getName() . '</a></div>';
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $event
     *
     * @return self
     */
    public function ifClicked($event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isDanger()
    {
        return $this->danger;
    }

    /**
     * @return string|null
     */
    public function onClick()
    {
        return $this->event;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
