<?php

namespace Rougin\Gable;

use Rougin\Gable\Styles\BootstrapStyle;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class TableTest extends Testcase
{
    /**
     * @return void
     */
    public function test_failed_if_empty_text_without_loading()
    {
        // Assert
        $this->doExpectException('Exception');

        // Arrange
        $table = new Table;

        $table->withAlpine();

        $text = 'No items found.';

        $table->withEmptyText($text);
    }

    /**
     * @return void
     */
    public function test_failed_if_error_text_without_loading()
    {
        // Assert
        $this->doExpectException('Exception');

        // Arrange
        $table = new Table;

        $table->withAlpine();

        $text = 'An error occured in getting the items.';

        $table->withErrorText($text);
    }

    /**
     * @return void
     */
    public function test_failed_if_opacity_missing_alpine_only()
    {
        // Assert
        $this->doExpectException('Exception');

        // Arrange
        $table = new Table;

        $table->withLoading()->withOpacity(50);
    }

    /**
     * @return void
     */
    public function test_failed_if_opacity_missing_loading_alpine()
    {
        // Assert
        $this->doExpectException('Exception');

        // Arrange
        $table = new Table;

        $table->withOpacity(50);
    }

    /**
     * @return void
     */
    public function test_failed_if_use_badge_not_found_by_text()
    {
        // Assert
        $this->doExpectException('Exception');

        // Arrange
        $table = new Table;

        $table->newColumn();

        $table->setCell('Status')
            ->addBadge('Inactive', 'bg-danger');

        $table->setCell('Name');
        $table->setCell('Age');

        $table->newRow();
        $table->useBadge('Active');
        $table->setCell('John Doe');
        $table->setCell('30');
    }

    /**
     * @return void
     */
    public function test_failed_if_use_badge_without_adding_badges()
    {
        // Assert
        $this->doExpectException('Exception');

        // Arrange
        $table = new Table;

        $table->newColumn();
        $table->setCell('Status');
        $table->setCell('Name');
        $table->setCell('Age');

        $table->newRow();
        $table->useBadge('Active');
        $table->setCell('John Doe');
        $table->setCell('30');
    }

    /**
     * @return void
     */
    public function test_passed_if_actions_are_rendered()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name')->setCell('Age');

        $table->withActions();

        $table->withUpdateAction('https://roug.in/update');

        $table->withDeleteAction('https://roug.in/delete');

        $table->newRow();
        $table->setCell('John Doe');
        $table->setCell('30');

        $table->newRow();
        $table->setCell('Jane Doe');
        $table->setCell('28');

        $expect = '<table><thead><tr><th>Name</th><th>Age</th><th>Action</th></tr></thead><tbody><tr><td>John Doe</td><td>30</td><td><div class="dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button><div class="dropdown-menu dropdown-menu-end"><div><a class="dropdown-item" href="https://roug.in/update">Update</a></div><div><hr class="dropdown-divider"></div><div><a class="dropdown-item text-danger" href="https://roug.in/delete">Delete</a></div></div></div></td></tr><tr><td>Jane Doe</td><td>28</td><td><div class="dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button><div class="dropdown-menu dropdown-menu-end"><div><a class="dropdown-item" href="https://roug.in/update">Update</a></div><div><hr class="dropdown-divider"></div><div><a class="dropdown-item text-danger" href="https://roug.in/delete">Delete</a></div></div></div></td></tr></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_all_features_work_together()
    {
        $table = new Table;
        $table->withAlpine();
        $table->setClass('table mb-0');
        $table->newColumn();

        $table->setCell('Type', 'left')
            ->addBadge('Customer', 'text-bg-success', 'item.type === 0')
            ->addBadge('Supplier', 'text-bg-primary', 'item.type === 1')
            ->withWidth(5);
        $table->setCell('Client Name', 'left')
            ->addHtml('<p class="mb-0" x-text="item.name"></p>')
            ->addHtml('<p class="mb-0 small text-muted" x-text="item.code"></p>')
            ->withWidth(22);
        $table->setCell('Remarks', 'left')
            ->addHtml('<p class="mb-0 fst-italic" x-text="item.remarks"></p>')
            ->withWidth(15);
        $table->setCell('Created At', 'left')->withWidth(13);
        $table->setCell('Updated At', 'left')->withWidth(13);
        $table->withActions(null, 'left')->withWidth(5);
        $table->withUpdateAction('edit(item)');
        $table->withDeleteAction('trash(item)');
        $table->withLoading(10);
        $table->withEmptyText('No clients found.');
        $table->withErrorText('An error occured in getting the clients.');
        $table->withOpacity(50);

        $expect = '<table class="table mb-0" :class="{ \'opacity-50\': items.length > 0 && loading}"><thead><tr><th align="left" width="5%">Type</th><th align="left" width="22%">Client Name</th><th align="left" width="15%">Remarks</th><th align="left" width="13%">Created At</th><th align="left" width="13%">Updated At</th><th align="left" width="5%"></th></tr></thead><tbody><template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 10 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && empty"><tr><td colspan="6" class="align-middle text-center"><span>No clients found.</span></td></tr></template><template x-if="! loading && loadError"><tr><td colspan="6" class="align-middle text-center"><span>An error occured in getting the clients.</span></td></tr></template><template x-if="items && items.length > 0"><template x-for="item in items"><tr><td><template x-if="item.type === 0"><span class="badge rounded-pill text-uppercase text-bg-success">Customer</span></template><template x-if="item.type === 1"><span class="badge rounded-pill text-uppercase text-bg-primary">Supplier</span></template></td><td><p class="mb-0" x-text="item.name"></p><p class="mb-0 small text-muted" x-text="item.code"></p></td><td><p class="mb-0 fst-italic" x-text="item.remarks"></p></td><td x-text="item.created_at"></td><td x-text="item.updated_at"></td><td><div class="dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Actions</button><div class="dropdown-menu dropdown-menu-end"><div><a class="dropdown-item" href="javascript:void(0)" @click="edit(item)">Update</a></div><div><hr class="dropdown-divider"></div><div><a class="dropdown-item text-danger" href="javascript:void(0)" @click="trash(item)">Delete</a></div></div></div></td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_alpine_actions_are_rendered()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name')->setCell('Age');

        // Enable Alpine.js for actions to render ---
        $table->withAlpine('items');
        // ------------------------------------------

        $table->withActions();

        $table->withUpdateAction('update(item.id)');

        $table->withDeleteAction('delete(item.id)');

        $expect = '<table><thead><tr><th>Name</th><th>Age</th><th>Action</th></tr></thead><tbody><template x-if="items && items.length > 0"><template x-for="item in items"><tr><td x-text="item.name"></td><td x-text="item.age"></td><td><div class="dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">Action</button><div class="dropdown-menu dropdown-menu-end"><div><a class="dropdown-item" href="javascript:void(0)" @click="update(item.id)">Update</a></div><div><hr class="dropdown-divider"></div><div><a class="dropdown-item text-danger" href="javascript:void(0)" @click="delete(item.id)">Delete</a></div></div></div></td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_alpine_and_loading_states_render()
    {
        // Arrange
        $table = new Table;

        $table->newColumn();

        $table->setCell('Name')->withName('name');

        $table->setCell('Email')->withName('email');

        $table->withAlpine('users');

        $table->withLoading();

        $expect = '<table><thead><tr><th>Name</th><th>Email</th></tr></thead><tbody><template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 5 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && empty"><tr><td colspan="2" class="align-middle text-center"><span>No items found.</span></td></tr></template><template x-if="! loading && loadError"><tr><td colspan="2" class="align-middle text-center"><span>An error occured in getting the items.</span></td></tr></template><template x-if="items && items.length > 0"><template x-for="item in users"><tr><td x-text="item.name"></td><td x-text="item.email"></td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_badges_render_in_column()
    {
        // Arrange
        $table = new Table;

        $table->newColumn();

        $table->setCell('Status')
            ->addBadge('Active', 'bg-success', 'item.status === \'active\'')
            ->addBadge('Inactive', 'bg-danger', 'item.status === \'inactive\'');

        $table->setCell('Name');

        // Enable "alpinejs" for badges to render ---
        $table->withAlpine('items');
        // ------------------------------------------

        $expect = '<table><thead><tr><th>Status</th><th>Name</th></tr></thead><tbody><template x-if="items && items.length > 0"><template x-for="item in items"><tr><td><template x-if="item.status === \'active\'"><span class="badge rounded-pill text-uppercase bg-success">Active</span></template><template x-if="item.status === \'inactive\'"><span class="badge rounded-pill text-uppercase bg-danger">Inactive</span></template></td><td x-text="item.name"></td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_badges_render_in_row()
    {
        // Arrange
        $table = new Table;

        $table->newColumn();

        $table->setCell('Status')
            ->addBadge('Active', 'bg-success')
            ->addBadge('Inactive', 'bg-danger');

        $table->setCell('Name');
        $table->setCell('Age');

        $table->newRow();
        $table->useBadge('Active');
        $table->setCell('John Doe');
        $table->setCell('30');

        $table->newRow();
        $table->useBadge('Inactive');
        $table->setCell('Jane Doe');
        $table->setCell('28');

        $expect = '<table><thead><tr><th>Status</th><th>Name</th><th>Age</th></tr></thead><tbody><tr><td><span class="badge rounded-pill text-uppercase bg-success">Active</span></td><td>John Doe</td><td>30</td></tr><tr><td><span class="badge rounded-pill text-uppercase bg-danger">Inactive</span></td><td>Jane Doe</td><td>28</td></tr></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_basic_table_is_rendered()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name')->setCell('Age');

        $table->newRow()->setCell('John Doe')->setCell('30');

        $table->newRow()->setCell('Jane Doe')->setCell('28');

        $expect = '<table><thead><tr><th>Name</th><th>Age</th></tr></thead><tbody><tr><td>John Doe</td><td>30</td></tr><tr><td>Jane Doe</td><td>28</td></tr></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_column_width_is_set()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name')->withWidth(30);

        $expect = '<table><thead><tr><th width="30%">Name</th></tr></thead></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_columns_render_without_rows()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name');

        $expect = '<table><thead><tr><th>Name</th></tr></thead></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_custom_empty_and_error_text_render()
    {
        // Arrange
        $table = new Table;

        $table->withAlpine('users');

        $table->newColumn();

        $table->setCell('Name');

        $table->withLoading();

        $table->withEmptyText('No records found.', 'noRecords');

        $table->withErrorText('Failed to load.', 'loadFailed');

        $expect = '<table><thead><tr><th>Name</th></tr></thead><tbody><template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 5 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && noRecords"><tr><td colspan="1" class="align-middle text-center"><span>No records found.</span></td></tr></template><template x-if="! loading && loadFailed"><tr><td colspan="1" class="align-middle text-center"><span>Failed to load.</span></td></tr></template><template x-if="items && items.length > 0"><template x-for="item in users"><tr><td x-text="item.name"></td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_custom_styles_are_rendered()
    {
        // Arrange
        $table = new Table;

        $table->setClass('table table-striped');

        $table->newColumn('fw-bold')->setCell('Name', 'center', 'text-uppercase')->setCell('Age', 'right');

        $table->newRow('table-primary')->setCell('John Doe')->setCell('30');

        $table->newRow()->setCell('Jane Doe', null, 'fst-italic')->setCell('28');

        $expect = '<table class="table table-striped"><thead><tr class="fw-bold"><th align="center" class="text-uppercase">Name</th><th align="right">Age</th></tr></thead><tbody><tr class="table-primary"><td>John Doe</td><td>30</td></tr><tr><td class="fst-italic">Jane Doe</td><td>28</td></tr></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_empty_cells_are_rendered()
    {
        // Arrange
        $table = new Table;

        $table->newColumn();
        $table->setCell('Name');
        $table->setCell('Age');

        $table->newRow();
        $table->setCell('John Doe');
        $table->setCell('30');

        $table->newRow();
        $table->setEmptyCell();
        $table->setEmptyCell();

        $expect = '<table><thead><tr><th>Name</th><th>Age</th></tr></thead><tbody><tr><td>John Doe</td><td>30</td></tr><tr><td></td><td></td></tr></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_opacity_is_applied()
    {
        // Arrange
        $table = new Table;

        $table->withAlpine('users');

        $table->newColumn();

        $table->setCell('Name');

        $table->withLoading();

        $table->withOpacity(50);

        $expect = '<table :class="{ \'opacity-50\': users.length > 0 && loading}"><thead><tr><th>Name</th></tr></thead><tbody><template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 5 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && empty"><tr><td colspan="1" class="align-middle text-center"><span>No items found.</span></td></tr></template><template x-if="! loading && loadError"><tr><td colspan="1" class="align-middle text-center"><span>An error occured in getting the items.</span></td></tr></template><template x-if="items && items.length > 0"><template x-for="item in users"><tr><td x-text="item.name"></td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_row_cell_width_is_set()
    {
        // Arrange
        $table = new Table;
        $table->newColumn()->setCell('Name');
        $table->newRow()->setCell('John')->withWidth(50);

        $expect = '<table><thead><tr><th>Name</th></tr></thead><tbody><tr><td width="50%">John</td></tr></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_set_data_populates_rows()
    {
        // Arrange
        $table = new Table;

        $table->newColumn();

        $table->setCell('ID');
        $table->setCell('Name');
        $table->setCell('Age');

        $data = array();

        $item = array('id' => 1);
        $item['age'] = 25;
        $item['name'] = 'Alice';
        $data[] = $item;

        $item = array('id' => 2);
        $item['age'] = 30;
        $item['name'] = 'Bob';
        $data[] = $item;

        // Item without "age" ---
        $item = array('id' => 3);
        $item['name'] = 'George';
        $data[] = $item;
        // ----------------------

        // Act
        $table->setData($data);

        $expect = '<table><thead><tr><th>ID</th><th>Name</th><th>Age</th></tr></thead><tbody><tr><td>1</td><td>Alice</td><td>25</td></tr><tr><td>2</td><td>Bob</td><td>30</td></tr><tr><td>3</td><td>George</td><td></td></tr></tbody></table>';

        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_style_defaults_to_bootstrap()
    {
        // Arrange
        $table = new Table;

        $expect = 'Rougin\Gable\Styles\BootstrapStyle';

        // Act
        $actual = $table->getStyle();

        // Assert
        $this->assertInstanceOf($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_style_can_be_set_and_retrieved()
    {
        // Arrange
        $table = new Table;

        $style = new BootstrapStyle;

        // Act
        $table->useStyle($style);

        $actual = $table->getStyle();

        // Assert
        $this->assertSame($style, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_table_content_is_reset()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Test');

        $table->newRow()->setCell('Data');

        // Act
        $table->reset();

        $expect = '<table></table>';

        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_align_is_set_via_with_align()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name')->withAlign('center');

        $expect = '<table><thead><tr><th align="center">Name</th></tr></thead></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_class_is_set_via_with_class()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name')->withClass('text-uppercase');

        $expect = '<table><thead><tr><th class="text-uppercase">Name</th></tr></thead></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_cspan_is_set_via_with_cspan()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name')->withCspan(2);

        $expect = '<table><thead><tr><th cspan="2">Name</th></tr></thead></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_rspan_is_set_via_with_rspan()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name');
        $table->newRow()->setCell('John')->withRspan(3);

        $expect = '<table><thead><tr><th>Name</th></tr></thead><tbody><tr><td rspan="3">John</td></tr></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_style_is_set_via_with_style()
    {
        // Arrange
        $table = new Table;

        $table->newColumn()->setCell('Name')->withStyle('color: red');

        $expect = '<table><thead><tr><th style="color: red">Name</th></tr></thead></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }
}
