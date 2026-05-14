<?php

namespace Rougin\Gable;

use LegacyPHPUnit\TestCase as Legacy;

/**
 * @package Gable
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Testcase extends Legacy
{
    /**
     * @param class-string $exception
     *
     * @return void
     */
    public function doExpectException($exception)
    {
        /** @phpstan-ignore-next-line */
        if (method_exists($this, 'expectException'))
        {
            /** @phpstan-ignore-next-line */
            $this->expectException($exception);

            return;
        }

        /** @phpstan-ignore-next-line */
        $this->setExpectedException($exception);
    }
}
