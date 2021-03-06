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

use Jdomenechb\BRChain\CallStringOptionTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;
use Jdomenechb\BRChain\SourceItem\SourceItemInterface;

/**
 * Class that implements basic methods that almost all strings should follow.
 */
abstract class AbstractString implements StringInterface
{
    use CallStringOptionTrait;
    use DynamicOptionsTrait;

    /**
     * Context of the string to be evaluated.
     *
     * @var SourceItemInterface
     */
    protected $context;

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

    /**
     * {@inheritdoc}
     */
    public function getContext(): SourceItemInterface
    {
        return $this->context;
    }

    /**
     * {@inheritdoc}
     */
    public function setContext(SourceItemInterface $context): void
    {
        $this->context = $context;
    }
}
