<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\BootstrapCMS\Acceptance;

use GrahamCampbell\BootstrapCMS\Facades\PostRepository;

/**
 * This is the comment test class.
 *
 * @group comment
 *
 * @author Graham Campbell <graham@alt-three.com>
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
