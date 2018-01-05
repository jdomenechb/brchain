<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\String;

use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;

/**
 * Class that implements basic methods that almost all strings should follow.
 */
abstract class AbstractString implements StringInterface
{
    use CallStringOptionTrait;
    use DynamicOptionsTrait;

    /**
     * AbstractString constructor.
     *
     * @param array $options
     *
     * @throws OptionDoesNotExistException
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }
}
