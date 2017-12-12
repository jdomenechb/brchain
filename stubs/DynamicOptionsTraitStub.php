<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jdomenechb\BRChain\Stub;


use Jdomenechb\BRChain\DynamicOptionsTrait;

class DynamicOptionsTraitStub
{
    use DynamicOptionsTrait;

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
     * @param mixed $optionToCheck
     */
    public function setOptionToCheck(int $optionToCheck): void
    {
        $this->optionToCheck = $optionToCheck;
    }
}