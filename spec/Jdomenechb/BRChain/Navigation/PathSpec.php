<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Navigation;

use Jdomenechb\BRChain\ChainableItemInterface;
use Jdomenechb\BRChain\ChainContainerItemInterface;
use Jdomenechb\BRChain\ChainInterface;
use Jdomenechb\BRChain\Navigation\Path;
use PhpSpec\ObjectBehavior;

class PathSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Path::class);
    }

    public function it_is_chainable()
    {
        $this->shouldImplement(ChainableItemInterface::class);
    }

    public function it_contains_a_chain()
    {
        $this->shouldImplement(ChainContainerItemInterface::class);
        $this->getChain()->shouldReturnAnInstanceOf(ChainInterface::class);
    }

    public function it_accepts_a_path()
    {
        $this->setPath('test/path')->shouldReturn($this);
        $this->getPath()->shouldReturn('test/path');
    }
}