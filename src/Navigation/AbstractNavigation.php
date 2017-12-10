<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Navigation;


use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\Chain\ChainContainerItemTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;

/**
 * Abstract Navigation class implementing the most common methods a Navigation item must have.
 * @package Jdomenechb\BRChain\Navigation
 */
abstract class AbstractNavigation implements NavigationInterface
{
    use DynamicOptionsTrait;
    use CallStringOptionTrait;
    use ChainContainerItemTrait;

    /**
     * AbstractNavigation constructor.
     * @param array $options
     * @throws OptionDoesNotExistException
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }
}