<?php

declare(strict_types=1);

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Stub\String;

use Jdomenechb\BRChain\String\AbstractString;

/**
 * Stub class for checking AbstractString.
 */
class AbstractStringStub extends AbstractString
{
    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return '';
    }
}
