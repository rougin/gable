# Gable

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]][link-license]
[![Build Status][ico-build]][link-build]
[![Coverage Status][ico-coverage]][link-coverage]
[![Total Downloads][ico-downloads]][link-downloads]

A simple HTML table generator in PHP.

## Installation

Install the package using [Composer](https://getcomposer.org/):

``` bash
$ composer require rougin/gable
```

## Basic usage

The `Table` class is the cornerstone of this package, providing a simple and intuitive API for generating HTML tables:

``` php
// index.php

use Rougin\Gable\Table;

$table = new Table;

// Define the table columns ---
$table->newColumn();
$table->setCell('Name');
$table->setCell('Age');
// ----------------------------

// Populate the table with data ---
$table->newRow();
$table->setCell('John Doe');
$table->setCell('30');

$table->newRow();
$table->setCell('Jane Doe');
$table->setCell('28');
// --------------------------------

// Use the "__toString" method ---
echo $table;
// -------------------------------
```

The code above will generate the following HTML output:

``` html
<table>
  <thead>
  <tr>
    <th>Name</th>
    <th>Age</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td>John Doe</td>
    <td>30</td>
  </tr>
  <tr>
    <td>Jane Doe</td>
    <td>28</td>
  </tr>
  </tbody>
</table>
```

## Method chaining

For a more fluent and expressive way of building tables, method chaining is also supported:

``` php
// index.php

use Rougin\Gable\Table;

$table = new Table;

echo $table->newColumn()
  ->setCell('Name')
  ->setCell('Age')
  ->newRow()
  ->setCell('John Doe')
  ->setCell('30')
  ->newRow()
  ->setCell('Jane Doe')
  ->setCell('28');
```

## Customization

The appearance of the table can be customized by adding CSS classes, inline styles, and other attributes to columns, rows, and cells:

``` php
// index.php

use Rougin\Gable\Table;

$table = new Table;

// Adds CSS classes to the <table> element ---
$table->setClass('table table-striped');
// ------------------------------------------

// Adds a CSS class to the <thead> row ---
$table->newColumn('fw-bold');
// --------------------------------------

// Aligns to center then adds a CSS class to the cell ---
$table->setCell('Name', 'center', 'text-uppercase');
// ------------------------------------------------------

// Aligns cell to the right ----
$table->setCell('Age', 'right');
// -----------------------------

// Adds a CSS class to the <tr> element ---
$table->newRow('table-primary');
// ----------------------------------------

$table->setCell('John Doe');
$table->setCell('30');

$table->newRow();

// Adds a CSS class to the current cell --------
$table->setCell('Jane Doe', null, 'fst-italic');
// ---------------------------------------------

$table->setCell('28');

echo $table;
```

``` html
<table class="table table-striped">
  <thead>
    <tr class="fw-bold">
      <th align="center" class="text-uppercase">Name</th>
      <th align="right">Age</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-primary">
      <td>John Doe</td>
      <td>30</td>
    </tr>
    <tr>
      <td class="fst-italic">Jane Doe</td>
      <td>28</td>
    </tr>
  </tbody>
</table>
```

## Pagination

The `Pagee` class provides a simple way to generate pagination links for a table:

``` php
// index.php

use Rougin\Gable\Pagee;

$pagee = new Pagee;

$pagee->setTotal(100); // Total number of items
$pagee->setLimit(10); // Items per page
$pagee->setPage(2); // Current page
$pagee->setLink('/users'); // Base URL for the links

echo $pagee;
```

``` html
<div class="d-inline-block">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="/users?p=1&l=10">
        <span>First</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=1&l=10">
        <span>Previous</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=1&l=10">
        <span>1</span>
      </a>
    </li>
    <li class="page-item active">
      <a class="page-link" href="javascript:void(0)">
        <span>2</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=3&l=10">
        <span>3</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=4&l=10">
        <span>4</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=5&l=10">
        <span>5</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=6&l=10">
        <span>6</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=7&l=10">
        <span>7</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=8&l=10">
        <span>8</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=9&l=10">
        <span>9</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=10&l=10">
        <span>10</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=3&l=10">
        <span>Next</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="/users?p=10&l=10">
        <span>Last</span>
      </a>
    </li>
  </ul>
</div>
```

## Using `alpinejs`

For creating dynamic and interactive tables, `Gable` provides a seamless integration with [alpinejs](https://alpinejs.dev/). This allows for features like real-time data updates, loading indicators, and more:

``` php
// index.php

use Rougin\Gable\Table;

$table = new Table;

// Sets the table with "users" for "alpinejs" ---
$table->withAlpine('users');
// ----------------------------------------------

// Shows a loading indicator while data is being fetched ---
$table->withLoading();
// ---------------------------------------------------------

$table->newColumn();
$table->setCell('Name')->withName('name');
$table->setCell('Email')->withName('email');

echo $table;
```

This will generate a table that is bound to an `alpinejs` component, ready to display dynamic data:

``` html
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <template x-if="items.length === 0 && loading">
      <template x-data="{ length: items && items.length ? items.length : 5 }" x-for="i in length">
        <tr>
          <td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td>
          <td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td>
        </tr>
      </template>
    </template>
    <template x-if="items.length === 0 && empty">
      <tr>
        <td colspan="2" class="align-middle text-center"><span>No items found.</span></td>
      </tr>
    </template>
    <template x-if="! loading && loadError">
      <tr>
        <td colspan="2" class="align-middle text-center"><span>An error occured in getting the items.</span></td>
      </tr>
    </template>
    <template x-if="items && items.length > 0">
      <template x-for="item in users">
        <tr>
          <td x-text="item.name"></td>
          <td x-text="item.email"></td>
        </tr>
      </template>
    </template>
  </tbody>
</table>
```

## Actions

Actions can be added to each row, allowing for operations like updating or deleting records. The `withUpdateAction` and `withDeleteAction` methods provide a convenient way to add the specified common actions:

``` php
// index.php

use Rougin\Gable\Table;

$table = new Table;

$table->newColumn();
$table->setCell('Name');
$table->setCell('Age');

// Adds an "Action" column ---
$table->withActions();
// ---------------------------

$table->withUpdateAction('update(item.id)');
$table->withDeleteAction('delete(item.id)');

$table->newRow();
$table->setCell('John Doe');
$table->setCell('30');

$table->newRow();
$table->setCell('Jane Doe');
$table->setCell('28');

// Requires "alpinejs" to be enabled ---
$table->withAlpine();
// -------------------------------------

echo $table;
```

``` html
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Age</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>John Doe</td>
      <td>30</td>
      <td>
        <div class="dropdown">
          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button>
          <div class="dropdown-menu dropdown-menu-end">
            <div><a class="dropdown-item" href="javascript:void(0)" @click="update(item.id)">Update</a></div>
            <div><hr class="dropdown-divider"></div>
            <div><a class="dropdown-item text-danger" href="javascript:void(0)" @click="delete(item.id)">Delete</a></div>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td>Jane Doe</td>
      <td>28</td>
      <td>
        <div class="dropdown">
          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button>
          <div class="dropdown-menu dropdown-menu-end">
            <div><a class="dropdown-item" href="javascript:void(0)" @click="update(item.id)">Update</a></div>
            <div><hr class="dropdown-divider"></div>
            <div><a class="dropdown-item text-danger" href="javascript:void(0)" @click="delete(item.id)">Delete</a></div>
          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>
```

## Badges

Badges can be used to highlight certain information in a cell, such as a record's status.

``` php
// index.php

use Rougin\Gable\Table;

$table = new Table;

$table->newColumn();
$table->setCell('Status')
  ->addBadge('Active', "item.status === 'active'", 'bg-success')
  ->addBadge('Inactive', "item.status === 'inactive'", 'bg-danger');
$table->setCell('Name');

$table->newRow();
// Placeholder for the badge ---
$table->setCell('');
// -----------------------------
$table->setCell('John Doe');

// Requires "alpinejs" to be enabled ---
$table->withAlpine();
// -------------------------------------

echo $table;
```

``` html
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>John Doe</td>
      <td>
        <template x-if="item.status === 'active'">
          <span class="badge rounded-pill text-uppercase bg-success">Active</span>
        </template>
        <template x-if="item.status === 'inactive'">
          <span class="badge rounded-pill text-uppercase bg-danger">Inactive</span>
        </template>
      </td>
    </tr>
  </tbody>
</table>
```

## Available methods

The following methods are available in the `Table` class:

``` php
/**
 * Adds a one-line custom HTML to the last added cell.
 *
 * @param string $html
 *
 * @return self
 */
public function addHtml($html)
```

``` php
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
```

``` php
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
```

``` php
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
```

``` php
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
```

``` php
/**
 * Enables usage of "alpine.js" in the table.
 *
 * @param string       $name
 * @param string|null  $class
 * @param string|null  $style
 * @param integer|null $width
 *
 * @return self
 */
public function withAlpine($name = 'items', $class = null, $style = null, $width = null)
```

``` php
/**
 * Adds a "Delete" action button.
 *
 * @param string $clicked
 * @param string $name
 *
 * @return self
 */
public function withDeleteAction($clicked, $name = 'Delete')
```

``` php
/**
 * Adds a loading indicator to the table.
 *
 * @param integer $count
 * @param string  $name
 *
 * @return self
 */
public function withLoading($count = 5, $name = 'loading')
```

``` php
/**
 * Adds an "Update" action button.
 *
 * @param string $clicked
 * @param string $name
 *
 * @return self
 */
public function withUpdateAction($clicked, $name = 'Update')
```

``` php
/**
 * Sets the text to display when there are no items in the table.
 *
 * @param string $text
 * @param string $key
 *
 * @return self
 */
public function withEmptyText($text, $key = 'empty')
```

``` php
/**
 * Sets the text to display when an error occurs while loading items.
 *
 * @param string $text
 * @param string $key
 *
 * @return self
 */
public function withErrorText($text, $key = 'loadError')
```

``` php
/**
 * Sets a name identifier to the last column cell.
 *
 * @param string $name
 *
 * @return self
 */
public function withName($name)
```

``` php
/**
 * Sets the width of the last cell in percentage.
 *
 * @param integer $width
 *
 * @return self
 */
public function withWidth($width)
```

## Changelog

Please see [CHANGELOG][link-changelog] for more recent changes.

## Contributing

See [CONTRIBUTING](CONTRIBUTING.md) on how to contribute.

## License

The MIT License (MIT). Please see [LICENSE][link-license] for more information.

[ico-build]: https://img.shields.io/github/actions/workflow/status/rougin/gable/build.yml?style=flat-square
[ico-coverage]: https://img.shields.io/codecov/c/github/rougin/gable?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/rougin/gable.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/rougin/gable.svg?style=flat-square

[link-build]: https://github.com/rougin/gable/actions
[link-changelog]: https://github.com/rougin/gable/blob/master/CHANGELOG.md
[link-contributing]: https://github.com/rougin/gable/blob/master/CONTRIBUTING.md
[link-coverage]: https://app.codecov.io/gh/rougin/gable
[link-downloads]: https://packagist.org/packages/rougin/gable
[link-license]: https://github.com/rougin/gable/blob/master/LICENSE.md
[link-packagist]: https://packagist.org/packages/rougin/gable
