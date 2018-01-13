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

namespace Jdomenechb\BRChain\String;

use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;

/**
 * String that represents simple values.
 */
class Value extends AbstractString
{
    /**
     * @var string
     */
    protected $value;

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getValue();
    }

    /**
     * Value constructor.
     *
     * @param array $options
     *
     * @throws OptionDoesNotExistException
     */

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
