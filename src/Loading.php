<?php

namespace Rougin\Gable;

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
        $html .= '<template x-if="items.length === 0 && ' . $this->name . '">';
        $html .= '<template x-data="{ length: items && items.length ? items.length : ' . $this->count . ' }" x-for="i in length">';
        $html .= '<tr>';

        foreach (range(1, $this->cells) as $item)
        {
            $html .= '<td class="align-middle placeholder-glow">';
            $html .= '<span class="placeholder col-12"></span>';
            $html .= '</td>';
        }

        $html .= '</tr>';
        $html .= '</template>';
        $html .= '</template>';

        // Show "no items found" text if loading is enabled -------------------------
        $html .= '<template x-if="items.length === 0 && ' . $this->empty['name'] . '">';
        $html .= '<tr>';
        $html .= '<td colspan="' . $this->cells . '" class="align-middle text-center">';
        $html .= '<span>' . $this->empty['text'] . '</span>';
        $html .= '</td>';
        $html .= '</tr>';
        $html .= '</template>';
        // --------------------------------------------------------------------------

        // Show "loading error" text if there is an error when loading --------------------------
        $html .= '<template x-if="! ' . $this->name . ' && ' . $this->error['name'] . '">';
        $html .= '<tr>';
        $html .= '<td colspan="' . $this->cells . '" class="align-middle text-center">';
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
}
