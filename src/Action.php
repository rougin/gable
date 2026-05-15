<?php

namespace Rougin\Gable;

use Rougin\Gable\Styles\BootstrapStyle;

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
    protected $alpine = false;

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
    protected $link = null;

    /**
     * @var string|null
     */
    protected $name = null;

    /**
     * @var \Rougin\Gable\StyleInterface|null
     */
    protected $style = null;

    /**
     * @return \Rougin\Gable\StyleInterface
     */
    public function getStyle()
    {
        if ($this->style instanceof StyleInterface)
        {
            return $this->style;
        }

        return new BootstrapStyle;
    }

    /**
     * @param \Rougin\Gable\Cell     $cell
     * @param \Rougin\Gable\Action[] $items
     *
     * @return string
     */
    public static function setMenu(Cell $cell, $items)
    {
        $style = count($items) > 0 ? $items[0]->getStyle() : new BootstrapStyle;

        $html = '<div class="' . $style->dropdown() . '">';
        $html .= '<button class="' . $style->dropdownButton() . '" type="button" data-bs-toggle="dropdown">';

        $value = $cell->getValue();

        $html .= is_string($value) ? $value : 'Action' . (count($items) > 1 ? 's' : '');
        $html .= '</button>';
        $html .= '<div class="' . $style->dropdownMenu() . '">';

        $hasDanger = false;

        foreach ($items as $item)
        {
            if ($item->isDanger() && ! $hasDanger)
            {
                $hasDanger = true;
            }

            $html .= $item->getHtml($hasDanger);
        }

        return $html . '</div></div>';
    }

    /**
     * @param \Rougin\Gable\StyleInterface $style
     *
     * @return self
     */
    public function useStyle(StyleInterface $style)
    {
        $this->style = $style;

        return $this;
    }

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
        $style = $this->getStyle();

        $hrClass = $style->dropdownDivider();

        $itemClass = $style->dropdownItem();

        $danger = $this->isDanger() ? ' ' . $style->dropdownDanger() : '';

        $itemClass = $itemClass . $danger;

        $html = '';

        if ($danger)
        {
            $html .= '<div><hr class="' . $hrClass . '"></div>';
        }

        $link = $this->alpine ? 'javascript:void(0)' : $this->link;

        $html .= '<div><a class="' . $itemClass . '" href="' . $link . '">' . $this->getName() . '</a></div>';

        if ($this->alpine)
        {
            $search = '">' . $this->getName();

            $click = '" @click="' . $this->onClick();

            $html = str_replace($search, $click . $search, $html);
        }

        return $html;
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
     * @param string $link
     *
     * @return self
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
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

    /**
     * @return self
     */
    public function withAlpine()
    {
        $this->alpine = true;

        return $this;
    }
}
