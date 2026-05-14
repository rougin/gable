<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
interface StyleInterface
{
    /**
     * @return string
     */
    public function badge();

    /**
     * @return string
     */
    public function dropdown();

    /**
     * @return string
     */
    public function dropdownButton();

    /**
     * @return string
     */
    public function dropdownDanger();

    /**
     * @return string
     */
    public function dropdownDivider();

    /**
     * @return string
     */
    public function dropdownItem();

    /**
     * @return string
     */
    public function dropdownMenu();

    /**
     * @return string
     */
    public function emptyCell();

    /**
     * @return string
     */
    public function loadingCell();

    /**
     * @return string
     */
    public function loadingSpan();

    /**
     * @return string
     */
    public function paginationActive();

    /**
     * @return string
     */
    public function paginationDisabled();

    /**
     * @return string
     */
    public function paginationItem();

    /**
     * @return string
     */
    public function paginationLink();

    /**
     * @return string
     */
    public function paginationList();

    /**
     * @return string
     */
    public function paginationWrapper();
}
