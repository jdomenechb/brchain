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

namespace Jdomenechb\BRChain\Stub\Transformation;

use Jdomenechb\BRChain\SourceItem\SourceItemInterface;
use Jdomenechb\BRChain\Transformation\AbstractTransformation;

/**
 * Stub class for checking AbstractNavigator.
 */
class AbstractTransformationStub extends AbstractTransformation
{
    public function transform(SourceItemInterface $sourceItem): void
    {
        // Nothing
    }
}
