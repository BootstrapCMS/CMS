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

        $this->get('blog/posts/1/comments');

        $this->assertEquals(404, $this->response->status());
    }

    public function testIndexSuccess()
    {
        $this->visit('blog/posts/1/comments')->see('[{"comment_id":"1","comment_ver":"1"}]');
    }
}
