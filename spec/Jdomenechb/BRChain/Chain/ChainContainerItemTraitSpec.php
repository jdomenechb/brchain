<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain\Chain;


use Jdomenechb\BRChain\Chain\ChainInterface;
use Jdomenechb\BRChain\Stub\Chain\ChainContainerItemTraitStub;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class ChainContainerItemTraitSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(ChainContainerItemTraitStub::class);
    }

    public function it_can_receive_a_Chain(ChainInterface $chain)
    {
        $this->setChain($chain);
        $this->getChain()->shouldBe($chain);
    }

    public function it_cannot_accept_anything_other_than_a_Chain()
    {
        $this->shouldThrow(\TypeError::class)->during('setChain', ['something not a chain']);
    }

    public function it_can_create_lazily_a_Chain()
    {
        $this->getChain()->shouldReturnAnInstanceOf(ChainInterface::class);
    }
}