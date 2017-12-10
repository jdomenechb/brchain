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


use Jdomenechb\BRChain\Source\SourceItem\SourceItemInterface;

/**
 * Stub class for checking AbstractNavigator
 * @package Jdomenechb\BRChain\Stub\Navigation
 */
class AbstractNavigationStub extends \Jdomenechb\BRChain\Navigation\AbstractNavigation
{
    /**
     * @var int
     */
    protected $optionToCheck;

    /**
     * @return int
     */
    public function getOptionToCheck() : int
    {
        return $this->optionToCheck;
    }

    /**
     * @param int $optionToCheck
     */
    public function setOptionToCheck(int $optionToCheck): void
    {
        $this->optionToCheck = $optionToCheck;
    }

    public function process(SourceItemInterface $sourceItem): void
    {
        // Nothing
    }
}