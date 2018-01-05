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

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemTrait;
use Jdomenechb\BRChain\DynamicOptionsTrait;
use Jdomenechb\BRChain\Navigation\AbstractNavigation;
use Jdomenechb\BRChain\Navigation\NavigationInterface;
use Jdomenechb\BRChain\Stub\Navigation\AbstractNavigationStub;
use Jdomenechb\BRChain\Test\ObjectBehavior;

class AbstractNavigationSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(AbstractNavigationStub::class);
    }

    public function its_stub_extends_the_abstract_class()
    {
        $this->shouldHaveType(AbstractNavigation::class);
    }

    public function it_is_a_Navigation_item()
    {
        $this->shouldImplement(NavigationInterface::class);
    }

    public function it_is_chainable()
    {
        $this->shouldImplement(ChainableItemInterface::class);
    }

    public function it_can_contain_a_chain()
    {
        $this->shouldImplement(ChainContainerItemInterface::class);
        $this->shouldUseTrait(ChainContainerItemTrait::class);
    }

    public function it_accepts_dynamic_options()
    {
        $this->shouldUseTrait(DynamicOptionsTrait::class);
    }
}
