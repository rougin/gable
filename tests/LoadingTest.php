<?php

namespace Rougin\Gable;

use Rougin\Gable\Styles\BootstrapStyle;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class LoadingTest extends Testcase
{
    /**
     * @return void
     */
    public function test_passed_if_cell_count_can_be_set()
    {
        // Arrange
        $loading = new Loading(5, 'loading');

        $loading->setCells(2);

        $expect = '<template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 5 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && empty"><tr><td colspan="2" class="align-middle text-center"><span>No items found.</span></td></tr></template><template x-if="! loading && loadError"><tr><td colspan="2" class="align-middle text-center"><span>An error occured in getting the items.</span></td></tr></template>';

        // Act
        $actual = $loading->getHtml('');

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_empty_text_can_be_customized()
    {
        // Arrange
        $loading = new Loading(3, 'loading');

        $loading->setCells(1);

        $loading->withEmptyText('No records.', 'emptyKey');

        $expect = '<template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 3 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && emptyKey"><tr><td colspan="1" class="align-middle text-center"><span>No records.</span></td></tr></template><template x-if="! loading && loadError"><tr><td colspan="1" class="align-middle text-center"><span>An error occured in getting the items.</span></td></tr></template>';

        // Act
        $actual = $loading->getHtml('');

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_error_text_can_be_customized()
    {
        // Arrange
        $loading = new Loading(3, 'loading');

        $loading->setCells(1);

        $loading->withErrorText('Load failed.', 'errorKey');

        $expect = '<template x-if="items.length === 0 && loading"><template x-data="{ length: items && items.length ? items.length : 3 }" x-for="i in length"><tr><td class="align-middle placeholder-glow"><span class="placeholder col-12"></span></td></tr></template></template><template x-if="items.length === 0 && empty"><tr><td colspan="1" class="align-middle text-center"><span>No items found.</span></td></tr></template><template x-if="! loading && errorKey"><tr><td colspan="1" class="align-middle text-center"><span>Load failed.</span></td></tr></template>';

        // Act
        $actual = $loading->getHtml('');

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_name_can_be_retrieved()
    {
        // Arrange
        $loading = new Loading(5, 'loading');

        $expect = 'loading';

        // Act
        $actual = $loading->getName();

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_style_defaults_to_bootstrap()
    {
        // Arrange
        $loading = new Loading(5, 'loading');

        $expect = 'Rougin\Gable\Styles\BootstrapStyle';

        // Act
        $actual = $loading->getStyle();

        // Assert
        $this->assertInstanceOf($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_passed_if_style_can_be_set_and_retrieved()
    {
        // Arrange
        $loading = new Loading(5, 'loading');

        $style = new BootstrapStyle;

        // Act
        $loading->useStyle($style);

        $actual = $loading->getStyle();

        // Assert
        $this->assertSame($style, $actual);
    }
}
