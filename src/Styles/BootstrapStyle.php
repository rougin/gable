<?php

namespace Rougin\Gable\Styles;

use Rougin\Gable\StyleInterface;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class BootstrapStyle implements StyleInterface
{
    /**
     * @return string
     */
    public function badge()
    {
        return 'badge rounded-pill text-uppercase';
    }

    /**
     * @return string
     */
    public function dropdown()
    {
        return 'dropdown';
    }

    /**
     * @return string
     */
    public function dropdownButton()
    {
        return 'btn btn-primary btn-sm dropdown-toggle';
    }

    /**
     * @return string
     */
    public function dropdownDanger()
    {
        return 'text-danger';
    }

    /**
     * @return string
     */
    public function dropdownDivider()
    {
        return 'dropdown-divider';
    }

    /**
     * @return string
     */
    public function dropdownItem()
    {
        return 'dropdown-item';
    }

    /**
     * @return string
     */
    public function dropdownMenu()
    {
        return 'dropdown-menu dropdown-menu-end';
    }

    /**
     * @return string
     */
    public function emptyCell()
    {
        return 'align-middle text-center';
    }

    /**
     * @return string
     */
    public function loadingCell()
    {
        return 'align-middle placeholder-glow';
    }

    /**
     * @return string
     */
    public function loadingSpan()
    {
        return 'placeholder col-12';
    }

    /**
     * @return string
     */
    public function paginationActive()
    {
        return 'active';
    }

    /**
     * @return string
     */
    public function paginationDisabled()
    {
        return 'disabled';
    }

    /**
     * @return string
     */
    public function paginationItem()
    {
        return 'page-item';
    }

    /**
     * @return string
     */
    public function paginationLink()
    {
        return 'page-link';
    }

    /**
     * @return string
     */
    public function paginationList()
    {
        return 'pagination';
    }

    /**
     * @return string
     */
    public function paginationWrapper()
    {
        return 'd-inline-block';
    }
}
