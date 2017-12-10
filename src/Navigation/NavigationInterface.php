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


use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;

/**
 * Interface to be implemented by all Navigation items.
 * @package Jdomenechb\BRChain\Navigation
 */
interface NavigationInterface extends ChainableItemInterface, ChainContainerItemInterface
{

}