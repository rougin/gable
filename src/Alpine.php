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
     * @return string
     */
    public function startItems()
    {
        $html = '<template x-if="items && items.length > 0">';

        $html .= '<template x-for="item in ' . $this->name . '">';

        return $html;
    }
}
