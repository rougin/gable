<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Table extends Element
{
    const TYPE_COL = 0;

    const TYPE_ROW = 1;

    /**
     * @var integer
     */
    protected $actionIndex = 0;

    /**
     * @var \Rougin\Gable\Action[]
     */
    protected $actions = array();

    /**
     * @var \Rougin\Gable\Alpine|null
     */
    protected $alpine = null;

    /**
     * @var \Rougin\Gable\Badge[][]
     */
    protected $badges = array();

    /**
     * @var \Rougin\Gable\Row[]
     */
    protected $cols = array();

    /**
     * @var boolean
     */
    protected $hasAction = false;

    /**
     * @var string[][]
     */
    protected $htmls = array();

    /**
     * @var \Rougin\Gable\Loading|null
     */
    protected $loading = null;

    /**
     * @var \Rougin\Gable\Row[]
     */
    protected $rows = array();

    /**
     * @var integer|null
     */
    protected $type = null;

    /**
     * @return string
     */
    public function __toString()
    {
        $html = '<table ' . $this->getParsedAttrs() . '>';

        if (count($this->cols) > 0)
        {
            $html .= '<thead>';

            foreach ($this->cols as $col)
            {
                $html .= $col->toHtml('th');
            }

            $html .= '</thead>';
        }

        if (count($this->rows) === 0)
        {
            $html .= '</table>';

            return str_replace('<table >', '<table>', $html);
        }

        $html .= '<tbody>';

        if ($this->alpine && $this->loading)
        {
            $cells = count($this->cols[0]->getCells());

            $this->loading->setCells($cells);

            $html = $this->loading->getHtml($html);
        }

        if ($this->alpine)
        {
            $html .= $this->alpine->startItems();
        }

        foreach ($this->rows as $row)
        {
            $html .= $row->toHtml();
        }

        if ($this->alpine)
        {
            $html .= $this->alpine->endItems();
        }

        $html .= '</tbody>';

        $html .= '</table>';

        return str_replace('<table >', '<table>', $html);
    }

    /**
     * @param \Rougin\Gable\Action $action
     *
     * @return self
     */
    public function addAction(Action $action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * @param string $text
     * @param string $state
     * @param string $class
     *
     * @return self
     */
    public function addBadge($text, $state, $class = 'text-bg-secondary')
    {
        $lastRow = count($this->cols) - 1;

        $index = $this->cols[$lastRow]->getLastIndex();

        if (! array_key_exists($index, $this->badges))
        {
            $this->badges[$index] = array();
        }

        $badge = new Badge($text, $state, $class);

        $this->badges[$index][] = $badge;

        return $this;
    }

    /**
     * @param \Rougin\Gable\Cell $cell
     *
     * @return self
     */
    public function addCell(Cell $cell)
    {
        if ($this->type === self::TYPE_COL)
        {
            $index = count($this->cols) - 1;

            $this->cols[$index]->addCell($cell);

            return $this;
        }

        $index = count($this->rows) - 1;

        $this->rows[$index]->addCell($cell);

        return $this;
    }

    /**
     * Adds a one-line custom HTML to the last added cell.
     *
     * @param string $html
     *
     * @return self
     */
    public function addHtml($html)
    {
        $lastRow = count($this->cols) - 1;

        $index = $this->cols[$lastRow]->getLastIndex();

        if (! array_key_exists($index, $this->htmls))
        {
            $this->htmls[$index] = array();
        }

        $this->htmls[$index][] = $html;

        return $this;
    }

    /**
     * Adds a new "<tr>" element to the "<thead>".
     *
     * @param string|null  $class
     * @param string|null  $style
     * @param integer|null $width
     *
     * @return self
     */
    public function newColumn($class = null, $style = null, $width = null)
    {
        $this->type = self::TYPE_COL;

        $this->cols[] = new Row($class, $style, $width);

        return $this;
    }

    /**
     * Adds a new "<tr>" element to the "<tbody>".
     *
     * @param string|null  $class
     * @param string|null  $style
     * @param integer|null $width
     *
     * @return self
     */
    public function newRow($class = null, $style = null, $width = null)
    {
        $this->type = self::TYPE_ROW;

        $this->rows[] = new Row($class, $style, $width);

        return $this;
    }

    /**
     * @return self
     */
    public function reset()
    {
        $this->cols = array();

        $this->type = null;

        $this->rows = array();

        return $this;
    }

    /**
     * Adds a new "<td>" element.
     *
     * @param mixed|null   $value
     * @param string|null  $align
     * @param string|null  $class
     * @param integer|null $cspan
     * @param integer|null $rspan
     * @param string|null  $style
     * @param integer|null $width
     *
     * @return self
     */
    public function setCell($value, $align = null, $class = null, $cspan = null, $rspan = null, $style = null, $width = null)
    {
        return $this->addCell(new Cell($value, $align, $class, $cspan, $rspan, $style, $width));
    }

    /**
     * @param array<string, mixed>[] $data
     *
     * @return self
     */
    public function setData($data = array())
    {
        $cells = array();

        foreach ($this->cols as $col)
        {
            $cells = array_merge($cells, $col->getCells());
        }

        foreach ($data as $item)
        {
            $this->newRow();

            foreach ($cells as $cell)
            {
                $name = $cell->getName();

                $exists = array_key_exists($name, $item);

                if (! $exists)
                {
                    $this->setEmptyCell();

                    continue;
                }

                $this->setCell($item[$cell->getName()]);
            }
        }

        return $this;
    }

    /**
     * @param string|null  $align
     * @param string|null  $class
     * @param integer|null $cspan
     * @param integer|null $rspan
     * @param string|null  $style
     * @param integer|null $width
     *
     * @return self
     */
    public function setEmptyCell($align = null, $class = null, $cspan = null, $rspan = null, $style = null, $width = null)
    {
        return $this->setCell(null, $align, $class, $cspan, $rspan, $style, $width);
    }

    /**
     * Adds a column for action buttons.
     *
     * @param mixed|null   $value
     * @param string|null  $align
     * @param string|null  $class
     * @param integer|null $cspan
     * @param integer|null $rspan
     * @param string|null  $style
     * @param integer|null $width
     *
     * @return self
     */
    public function withActions($value = 'Action', $align = null, $class = null, $cspan = null, $rspan = null, $style = null, $width = null)
    {
        $this->setCell($value, $align, $class, $cspan, $rspan, $style, $width);

        $this->hasAction = true;

        // Get the last cell as the action's index ---
        $index = count($this->cols) - 1;

        $cells = $this->cols[$index]->getCells();

        $this->actionIndex = count($cells) - 1;
        // -------------------------------------------

        return $this;
    }

    /**
     * Enables usage of "alpine.js" to the table.
     *
     * @param string       $name
     * @param string|null  $class
     * @param string|null  $style
     * @param integer|null $width
     *
     * @return self
     */
    public function withAlpine($name = 'items', $class = null, $style = null, $width = null)
    {
        $this->alpine = new Alpine($name);

        $col = $this->cols[count($this->cols) - 1];

        $this->newRow($class, $style, $width);

        foreach ($col->getCells() as $index => $cell)
        {
            $hasBadges = array_key_exists($index, $this->badges);

            $hasHtml = array_key_exists($index, $this->htmls);

            $new = new Cell(null, null, $class, null, null, $style, $width);

            // Add badges to the specified column cell ---
            if ($hasBadges)
            {
                $new->setBadges($this->badges[$index]);
            }
            // -------------------------------------------

            if ($index === $this->actionIndex)
            {
                $this->alpine->setActions($this->actions);

                $html = $this->alpine->startAction($cell);

                $hasDanger = false;

                foreach ($this->actions as $action)
                {
                    if ($action->isDanger() && ! $hasDanger)
                    {
                        $hasDanger = true;
                    }

                    $html .= $action->getHtml($hasDanger);
                }

                $html .= $this->alpine->endAction();

                $this->addCell($new->setValue($html));

                continue;
            }

            if (! $hasBadges && ! $hasHtml)
            {
                $new->withAttr('x-text', 'item.' . $cell->getName());
            }

            if (! $hasBadges && $hasHtml)
            {
                $new->setValue(implode('', $this->htmls[$index]));
            }

            $this->addCell($new);
        }

        return $this;
    }

    /**
     * Adds a "Delete" action button.
     *
     * @param string $clicked
     * @param string $name
     *
     * @return self
     */
    public function withDeleteAction($clicked, $name = 'Delete')
    {
        $action = new Action;

        $action->setName($name);

        $action->ifClicked($clicked);

        $action->asDanger();

        $this->addAction($action);

        return $this;
    }

    /**
     * Sets the text to display when there are no items in the table.
     *
     * @param string $text
     * @param string $key
     *
     * @return self
     */
    public function withEmptyText($text, $key = 'empty')
    {
        if (! $this->loading)
        {
            throw new \Exception('"withLoading" disabled');
        }

        $this->loading->withEmptyText($text, $key);

        return $this;
    }

    /**
     * Sets the text to display when an error occurs while loading items.
     *
     * @param string $text
     * @param string $key
     *
     * @return self
     */
    public function withErrorText($text, $key = 'loadError')
    {
        if (! $this->loading)
        {
            throw new \Exception('"withLoading" disabled');
        }

        $this->loading->withErrorText($text, $key);

        return $this;
    }

    /**
     * Adds a loading indicator to the table.
     *
     * @param integer $count
     * @param string  $name
     *
     * @return self
     */
    public function withLoading($count = 5, $name = 'loading')
    {
        $this->loading = new Loading($count, $name);

        return $this;
    }

    /**
     * Sets a name identifier to the last column cell.
     *
     * @param string $name
     *
     * @return self
     */
    public function withName($name)
    {
        $index = count($this->cols) - 1;

        $cell = $this->cols[$index]->getLast();

        $cell->setName($name);

        $this->cols[$index]->setLast($cell);

        return $this;
    }

    /**
     * @param integer $value
     *
     * @return self
     */
    public function withOpacity($value)
    {
        if (! $this->loading)
        {
            throw new \Exception('"withLoading" disabled');
        }

        if (! $this->alpine)
        {
            throw new \Exception('"withAlpine" disabled');
        }

        $loading = $this->loading->getName();

        $name = $this->alpine->getName();

        $this->withAttr(':class', '{ \'opacity-' . $value . '\': ' . $name . '.length > 0 && ' . $loading . '}');

        return $this;
    }

    /**
     * Adds an "Update" action button.
     *
     * @param string $clicked
     * @param string $name
     *
     * @return self
     */
    public function withUpdateAction($clicked, $name = 'Update')
    {
        $action = new Action;

        $action->setName($name);

        $action->ifClicked($clicked);

        $this->addAction($action);

        return $this;
    }

    /**
     * Sets the width of the last cell in percentage.
     *
     * @param integer $width
     *
     * @return self
     */
    public function withWidth($width)
    {
        if ($this->type === self::TYPE_COL)
        {
            $index = count($this->cols) - 1;

            $cell = $this->cols[$index]->getLast();

            $cell->setWidth($width);

            $this->cols[$index]->setLast($cell);

            return $this;
        }

        $index = count($this->rows) - 1;

        $cell = $this->rows[$index]->getLast();

        $cell->setWidth($width);

        $this->rows[$index]->setLast($cell);

        return $this;
    }
}
