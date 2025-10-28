<?php

namespace Rougin\Gable;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class PageeTest extends Testcase
{
    /**
     * @return void
     */
    public function test_pagination_is_initialized_with_provided_properties()
    {
        // Arrange
        $expect_page = 2;
        $expect_limit = 20;
        $expect_link = '/users';

        // Act
        $pagee = new Pagee($expect_page, $expect_limit, $expect_link);

        // Assert
        $this->assertEquals($expect_page, $pagee->getPage());
        $this->assertEquals($expect_limit, $pagee->getLimit());
        $this->assertEquals($expect_link, $pagee->getLink());
    }

    /**
     * @return void
     */
    public function test_non_alpine_pagination_renders_correctly()
    {
        // Arrange
        $pagee = new Pagee();
        $pagee->setTotal(100);
        $pagee->setLimit(10);
        $pagee->setPage(2);
        $pagee->setLink('/users');

        $expect = '<div class="d-inline-block"><ul class="pagination"><li class="page-item"><a class="page-link" href="/users?p=1&l=10"><span>First</span></a></li><li class="page-item"><a class="page-link" href="/users?p=1&l=10"><span>Previous</span></a></li><li class="page-item"><a class="page-link" href="/users?p=1&l=10"><span>1</span></a></li><li class="page-item active"><a class="page-link" href="javascript:void(0)"><span>2</span></a></li><li class="page-item"><a class="page-link" href="/users?p=3&l=10"><span>3</span></a></li><li class="page-item"><a class="page-link" href="/users?p=4&l=10"><span>4</span></a></li><li class="page-item"><a class="page-link" href="/users?p=5&l=10"><span>5</span></a></li><li class="page-item"><a class="page-link" href="/users?p=6&l=10"><span>6</span></a></li><li class="page-item"><a class="page-link" href="/users?p=7&l=10"><span>7</span></a></li><li class="page-item"><a class="page-link" href="/users?p=8&l=10"><span>8</span></a></li><li class="page-item"><a class="page-link" href="/users?p=9&l=10"><span>9</span></a></li><li class="page-item"><a class="page-link" href="/users?p=10&l=10"><span>10</span></a></li><li class="page-item"><a class="page-link" href="/users?p=3&l=10"><span>Next</span></a></li><li class="page-item"><a class="page-link" href="/users?p=10&l=10"><span>Last</span></a></li></ul></div>';

        // Act
        $actual = (string) $pagee;

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_alpine_pagination_renders_correctly()
    {
        // Arrange
        $pagee = new Pagee();
        $pagee->asAlpine();
        $pagee->setTotal(100);
        $pagee->setLimit(10);
        $pagee->setPage(2);
        $pagee->setLink('/users');

        $expect = '<div class="d-inline-block"><ul class="pagination"><li class="page-item" :class="{ \'disabled\': pagee.page === 1 }"><a class="page-link" :href="pagee.url(1)" :page="1" @click.prevent="pagee.view($dispatch, $el)">First</a></li><li class="page-item" :class="{ \'disabled\': pagee.page <= 1 }"><a class="page-link" :href="pagee.url(pagee.page - 1)" :page="pagee.page - 1" @click.prevent="pagee.view($dispatch, $el)">Prev</a></li><template x-for="(page, index) in pagee.items()" :key="index"><li class="page-item" :class="{ \'active\': (index + 1) === pagee.page }"><a class="page-link" :href="pagee.url(index + 1)" :page="index + 1" @click.prevent="pagee.view($dispatch, $el)" x-text="index + 1"></a></li></template><li class="page-item" :class="{ \'disabled\': pagee.page >= pagee.pages }"><a class="page-link" :href="pagee.url(pagee.page + 1)" :page="pagee.page + 1" @click.prevent="pagee.view($dispatch, $el)">Next</a></li><li class="page-item" :class="{ \'disabled\': pagee.page === pagee.pages }"><a class="page-link" :href="pagee.url(pagee.pages)" :page="pagee.pages" @click.prevent="pagee.view($dispatch, $el)">Last</a></li></ul></div>';

        // Act
        $actual = (string) $pagee;

        // Assert
        $this->assertEquals($expect, $actual);
    }

    /**
     * @return void
     */
    public function test_pagination_limit_can_be_set_and_retrieved()
    {
        // Arrange
        $pagee = new Pagee();
        $expect_limit = 25;

        // Act
        $pagee->setLimit($expect_limit);
        $actual_limit = $pagee->getLimit();

        // Assert
        $this->assertEquals($expect_limit, $actual_limit);
    }

    /**
     * @return void
     */
    public function test_pagination_limit_key_can_be_set_and_retrieved()
    {
        // Arrange
        $pagee = new Pagee();
        $expect_limit_key = 'items_per_page';

        // Act
        $pagee->setLimitKey($expect_limit_key);
        $actual_limit_key = $pagee->getLimitKey();

        // Assert
        $this->assertEquals($expect_limit_key, $actual_limit_key);
    }

    /**
     * @return void
     */
    public function test_pagination_link_can_be_set_and_retrieved()
    {
        // Arrange
        $pagee = new Pagee();
        $expect_link = '/products';

        // Act
        $pagee->setLink($expect_link);
        $actual_link = $pagee->getLink();

        // Assert
        $this->assertEquals($expect_link, $actual_link);
    }

    /**
     * @return void
     */
    public function test_pagination_page_can_be_set_and_retrieved()
    {
        // Arrange
        $pagee = new Pagee();
        $expect_page = 5;

        // Act
        $pagee->setPage($expect_page);
        $actual_page = $pagee->getPage();

        // Assert
        $this->assertEquals($expect_page, $actual_page);
    }

    /**
     * @return void
     */
    public function test_pagination_page_key_can_be_set_and_retrieved()
    {
        // Arrange
        $pagee = new Pagee();
        $expect_page_key = 'current_page';

        // Act
        $pagee->setPageKey($expect_page_key);
        $actual_page_key = $pagee->getPageKey();

        // Assert
        $this->assertEquals($expect_page_key, $actual_page_key);
    }

    /**
     * @return void
     */
    public function test_pagination_total_can_be_set_and_retrieved()
    {
        // Arrange
        $pagee = new Pagee();
        $expect_total = 500;

        // Act
        $pagee->setTotal($expect_total);
        $actual_total = $pagee->getTotal();

        // Assert
        $this->assertEquals($expect_total, $actual_total);
    }

    /**
     * @return void
     */
    public function test_pagination_renders_to_javascript_object()
    {
        // Arrange
        $pagee = new Pagee();
        $pagee->setTotal(100);
        $pagee->setLimit(10);
        $pagee->setPage(2);
        $pagee->setLink('/users');
        $pagee->setLimitKey('l');
        $pagee->setPageKey('p');

        $expect_object = 'myDispatch.pagee={limit:10,limitKey:"l",link:"/users",dispatchKey:"myDispatch",page:"2",pageKey:"p",pages:0,total:100,items:function(){if(0===this.pages){const t=this.total/this.limit;this.pages=Math.ceil(t)}return Array.from({length:this.pages})},url:function(t){return this.link+"?"+this.pageKey+"="+t+"&"+this.limitKey+"="+this.limit},view:function(t,i){const e=parseInt(i.getAttribute("page"));e!==this.page&&(history.pushState({},"",i.href),t(this.dispatchKey,e))}}';

        // Act
        $actual_object = $pagee->toObject('myDispatch');

        // Assert
        $this->assertEquals($expect_object, $actual_object);
    }
}
