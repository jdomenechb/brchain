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

namespace Jdomenechb\BRChain\Exception;

use Throwable;

/**
 * Exception thrown when a source item is not processable.
 */
class SourceItemNotProcessableExtension extends BRChainException
{
    /**
     * SourceItemNotProcessable constructor.
     *
     * @param string         $wrongSourceItemClassName
     * @param string         $itemName
     * @param Throwable|null $previous
     */
    public function __construct(string $wrongSourceItemClassName, string $itemName, Throwable $previous = null)
    {
        $msg = 'The SourceItem "' . $wrongSourceItemClassName . '" cannot be processed by the item "' . $itemName . '"';
        parent::__construct($msg, 0, $previous);
    }
}
