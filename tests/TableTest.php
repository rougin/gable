<?php

namespace Rougin\Gable;

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
    public function test_renders_alpine_and_loading_states()
    {
        // Arrange
        $table = new Table;

        $table->newColumn();

        $table->setCell('Name')->withName('name');

        $table->setCell('Email')->withName('email');

        $table->withAlpine('users');

        $table->withLoading();

        $expect = '<table><thead><tr><th>Name</th><th>Email</th></tr></thead><tbody><template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 5 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && empty"><tr><td colspan="2" class="align-middle text-center"><span>No items found.</span></td></tr></template><template x-if="! loading && loadError"><tr><td colspan="2" class="align-middle text-center"><span>An error occured in getting the items.</span></td></tr></template><template x-if="items && items.length > 0"><template x-for="item in users"><tr><td><div class="dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">name</button><div class="dropdown-menu dropdown-menu-end"></div></div></td><td x-text="item.email"></td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_renders_badges_in_column()
    {
        // Arrange
        $table = new Table;

        $table->newColumn();

        $table->setCell('Status')
            ->addBadge('Active', 'item.status === \'active\'', 'bg-success')
            ->addBadge('Inactive', 'item.status === \'inactive\'', 'bg-danger');

        $table->setCell('Name');

        // Enable Alpine.js for badges to render ---
        $table->withAlpine('items');
        // -----------------------------------------

        $table->newRow();

        // Placeholder for the badge ---
        $table->setCell('');
        // -----------------------------

        $table->setCell('John Doe');

        $expect = '<table><thead><tr><th>Status</th><th>Name</th></tr></thead><tbody><template x-if="items && items.length > 0"><template x-for="item in items"><tr><td><template x-if="item.status === \'active\'"><span class="badge rounded-pill text-uppercase bg-success">Active</span></template><template x-if="item.status === \'inactive\'"><span class="badge rounded-pill text-uppercase bg-danger">Inactive</span></template></td><td x-text="item.name"></td></tr><tr><td></td><td>John Doe</td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_renders_basic_table()
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
    public function test_renders_column_width()
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
    public function test_renders_columns_with_no_rows()
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
    public function test_renders_no_items_and_error_text()
    {
        // Arrange
        $table = new Table;

        $table->newColumn(); // Added this line

        $table->setCell('Name'); // Added this line

        $table->withAlpine('users');

        $table->withLoading();

        $table->withNoItemsText('No records found.', 'noRecords');

        $table->withLoadErrorText('Failed to load.', 'loadFailed');

        $expect = '<table><thead><tr><th>Name</th></tr></thead><tbody><template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 5 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && noRecords"><tr><td colspan="1" class="align-middle text-center"><span>No records found.</span></td></tr></template><template x-if="! loading && loadFailed"><tr><td colspan="1" class="align-middle text-center"><span>Failed to load.</span></td></tr></template><template x-if="items && items.length > 0"><template x-for="item in users"><tr><td><div class="dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">name</button><div class="dropdown-menu dropdown-menu-end"></div></div></td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_renders_row_cell_width()
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
    public function test_renders_with_actions()
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

        $table->newRow()->setCell('John Doe')->setCell('30');

        $table->newRow()->setCell('Jane Doe')->setCell('28');

        $expect = '<table><thead><tr><th>Name</th><th>Age</th></tr></thead><tbody><template x-if="items && items.length > 0"><template x-for="item in items"><tr><td><div class="dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">name</button><div class="dropdown-menu dropdown-menu-end"></div></div></td><td x-text="item.age"></td><td>Action</td></tr><tr><td>John Doe</td><td>30</td></tr><tr><td>Jane Doe</td><td>28</td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_renders_with_custom_styles()
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
    public function test_renders_with_opacity()
    {
        // Arrange
        $table = new Table;

        $table->newColumn(); // Added this line

        $table->setCell('Name'); // Added this line

        $table->withAlpine('users');

        $table->withLoading();

        $table->withOpacity(50);

        $expect = '<table :class="{ \'opacity-50\': users.length > 0 && loading}"><thead><tr><th>Name</th></tr></thead><tbody><template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 5 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && empty"><tr><td colspan="1" class="align-middle text-center"><span>No items found.</span></td></tr></template><template x-if="! loading && loadError"><tr><td colspan="1" class="align-middle text-center"><span>An error occured in getting the items.</span></td></tr></template><template x-if="items && items.length > 0"><template x-for="item in users"><tr><td><div class="dropdown"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">name</button><div class="dropdown-menu dropdown-menu-end"></div></div></td></tr></template></template></tbody></table>';

        // Act
        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_resets_table_content()
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
    public function test_set_data_populates_rows()
    {
        // Arrange
        $table = new Table;

        $table->newColumn(); // First column definition

        $table->setCell('ID')->withName('id');

        $table->newColumn(); // Second column definition

        $table->setCell('Name')->withName('name');

        $table->setCell('Age')->withName('age');

        $data = array();
        $data[] = array('id' => 1, 'name' => 'Alice', 'age' => 25);
        $data[] = array('id' => 2, 'name' => 'Bob', 'age' => 30);

        // Act
        $table->setData($data);

        // Expected HTML based on the corrected setData logic
        $expect = '<table><thead><tr><th>ID</th></tr><tr><th>Name</th><th>Age</th></tr></thead><tbody><tr><td>1</td><td>Alice</td><td>25</td></tr><tr><td>2</td><td>Bob</td><td>30</td></tr></tbody></table>';

        $actual = $table->__toString();

        // Assert
        $this->assertEquals($expect, $actual);
    }
}
