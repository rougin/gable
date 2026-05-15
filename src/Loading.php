<?php

namespace Rougin\Gable;

use Rougin\Gable\Styles\BootstrapStyle;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Loading
{
    /**
     * @var integer
     */
    protected $cells = 0;

    /**
     * @var integer
     */
    protected $count;

    /**
     * @var array<string, string>
     */
    protected $empty = array(

        'name' => 'empty',
        'text' => 'No items found.',

    );

    /**
     * @var array<string, string>
     */
    protected $error = array(

        'name' => 'loadError',
        'text' => 'An error occured in getting the items.',

    );

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Rougin\Gable\StyleInterface|null
     */
    protected $style = null;

    /**
     * @param integer $count
     * @param string  $name
     */
    public function __construct($count, $name)
    {
        $this->count = $count;

        $this->name = $name;
    }

    /**
     * @param string $html
     *
     * @return string
     */
    public function getHtml($html)
    {
        $style = $this->getStyle();

        $html .= '<template x-if="items.length === 0 && ' . $this->name . '">';
        $html .= '<template x-data="{ length: items && items.length ? items.length : ' . $this->count . ' }" x-for="i in length">';
        $html .= '<tr>';

        foreach (range(1, $this->cells) as $item)
        {
            $html .= '<td class="' . $style->loadingCell() . '">';
            $html .= '<span class="' . $style->loadingSpan() . '"></span>';
            $html .= '</td>';
        }

        $html .= '</tr>';
        $html .= '</template>';
        $html .= '</template>';

        // Show "no items found" text if loading is enabled -------------------------
        $html .= '<template x-if="items.length === 0 && ' . $this->empty['name'] . '">';
        $html .= '<tr>';
        $html .= '<td colspan="' . $this->cells . '" class="' . $style->emptyCell() . '">';
        $html .= '<span>' . $this->empty['text'] . '</span>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</template>';
        // --------------------------------------------------------------------------

        // Show "loading error" text if there is an error when loading --------------------------
        $html .= '<template x-if="! ' . $this->name . ' && ' . $this->error['name'] . '">';
        $html .= '<tr>';
        $html .= '<td colspan="' . $this->cells . '" class="' . $style->emptyCell() . '">';
        $html .= '<span>' . $this->error['text'] . '</span>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</template>';
        // --------------------------------------------------------------------------------------

        return $html;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @param integer $cells
     *
     * @return self
     */
    public function setCells($cells)
    {
        $this->cells = $cells;

        return $this;
    }

    /**
     * @param string $text
     * @param string $name
     *
     * @return self
     */
    public function withEmptyText($text, $name = 'empty')
    {
        $data = array('name' => $name);

        $data['text'] = $text;

        $this->empty = $data;

        return $this;
    }

    /**
     * @param string $text
     * @param string $name
     *
     * @return self
     */
    public function withErrorText($text, $name = 'loadError')
    {
        $data = array('name' => $name);

        $data['text'] = $text;

        $this->error = $data;

        return $this;
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
