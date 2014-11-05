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

namespace GrahamCampbell\Tests\BootstrapCMS\Acceptance;

use GrahamCampbell\BootstrapCMS\Facades\PostRepository;

/**
 * This is the comment test class.
 *
 * @group comment
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Bootstrap-CMS/blob/master/LICENSE.md> AGPL 3.0
 */
class CommentTest extends AbstractTestCase
{
    public function testIndexFail()
    {
        PostRepository::shouldReceive('find')->once()->with(1, ['id']);
        $content = $this->call('GET', 'blog/posts/1/comments', [], [], [], ['HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest'])->getContent();

        $this->assertResponseStatus(404);
        $this->assertEquals('{"success":false,"code":404,"msg":"The post you were viewing has been deleted.","url":"http:\/\/localhost\/blog\/posts"}', $content);
    }

    public function testIndexSuccess()
    {
        $content = $this->call('GET', 'blog/posts/1/comments', [], [], [], ['HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest'])->getContent();

        $this->assertResponseOk();
        $this->assertEquals('[{"comment_id":"1","comment_ver":"1"}]', $content);
    }
}
