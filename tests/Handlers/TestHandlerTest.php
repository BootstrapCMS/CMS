<?php

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 */

namespace GrahamCampbell\Tests\BootstrapCMS\Handlers;

use ReflectionClass;
use GrahamCampbell\BootstrapCMS\Handlers\TestHandler;
use GrahamCampbell\TestBench\Classes\AbstractTestCase;

/**
 * This is the test handler test class.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */
class TestHandlerTest extends AbstractTestCase
{
    public function testRun()
    {
        $method = $this->getReflection()->getMethod('run');
        $method->setAccessible(true);

        $return = null;

        try {
            $method->invoke($this->getTestHandler());
        } catch (\Exception $e) {
            $return = $e;
        }

        $this->assertInstanceOf('Exception', $return);
        $this->assertEquals('TestHandler Error Test!', $return->getMessage());
    }

    protected function getTestHandler()
    {
        return new TestHandler();
    }

    protected function getReflection()
    {
        return new ReflectionClass('GrahamCampbell\BootstrapCMS\Handlers\TestHandler');
    }
}
