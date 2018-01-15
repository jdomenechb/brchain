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

namespace Jdomenechb\BRChain\Transformation;

use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\PropertyItemInterface;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;

/**
 * Abstract Transformation class implementing the most common methods a Transformation item must have.
 */
abstract class AbstractTransformation implements TransformationInterface
{
    use DynamicOptionsTrait;
    use CallStringOptionTrait;

    /**
     * {@inheritdoc}
     */
    public function process(SourceItemInterface $sourceItem): void
    {
        $vars = \get_object_vars($this);

        foreach ($vars as $var) {
            if ($var instanceof PropertyItemInterface) {
                $var->setContext($sourceItem);
            }
        }

        $this->transform($sourceItem);
    }

    abstract protected function transform(SourceItemInterface $sourceItem): void;
}
