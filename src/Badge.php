<?php

namespace Rougin\Gable;

use Rougin\Gable\Styles\BootstrapStyle;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Badge
{
    /**
     * @var string
     */
    protected $class;

    /**
     * @var string|null
     */
    protected $state = null;

    /**
     * @var \Rougin\Gable\StyleInterface|null
     */
    protected $style = null;

    /**
     * @var string
     */
    protected $text;

    /**
     * @param string      $text
     * @param string      $class
     * @param string|null $state
     */
    public function __construct($text, $class, $state = null)
    {
        $this->class = $class;

        $this->text = $text;

        $this->state = $state;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $item = '';

        if ($this->state)
        {
            $item = '<template x-if="' . $this->state . '">';
        }

        $class = $this->getStyle()->badge() . ' ' . $this->class;

        $item .= '<span class="' . $class . '">';

        $item .= $this->text . '</span>';

        return $this->state ? $item . '</template>' : $item;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->__toString();
    }

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
     * @return string
     */
    public function getText()
    {
        return $this->text;
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
}
