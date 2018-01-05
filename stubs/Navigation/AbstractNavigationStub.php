<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Stub\Navigation;

use Jdomenechb\BRChain\Navigation\AbstractNavigation;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;

/**
 * Stub class for checking AbstractNavigator.
 */
class AbstractNavigationStub extends AbstractNavigation
{
    public function process(SourceItemInterface $sourceItem): void
    {
        // Nothing
    }
}
