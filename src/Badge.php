<?php

namespace Rougin\Gable;

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

        // TODO: Replace with "StyleInterface" ----------------------
        $class = 'badge rounded-pill text-uppercase ' . $this->class;
        // ----------------------------------------------------------

        $item .= '<span class="' . $class . '">';

        $item .= $this->text . '</span>';

        return $this->state ? $item . '</template>' : $item;
    }
}
