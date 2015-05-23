<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Presenters;

use GrahamCampbell\Markdown\Facades\Markdown;

/**
 * This is the content presenter trait.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
trait ContentPresenterTrait
{
    /**
     * Get the content.
     *
     * @return string
     */
    public function content()
    {
        return Markdown::convertToHtml($this->getWrappedObject()->body);
    }
}
