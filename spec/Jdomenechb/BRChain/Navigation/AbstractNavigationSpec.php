<?php

namespace spec\Jdomenechb\BRChain\Navigation;

use Jdomenechb\BRChain\Chain\ChainableItemInterface;
use Jdomenechb\BRChain\Chain\ChainContainerItemInterface;
use Jdomenechb\BRChain\Chain\ChainInterface;
use Jdomenechb\BRChain\Navigation\AbstractNavigation;
use Jdomenechb\BRChain\Navigation\NavigationInterface;
use Jdomenechb\BRChain\Stub\Navigation\AbstractNavigationStub;
use PhpSpec\ObjectBehavior;

class AbstractNavigationSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(AbstractNavigationStub::class);
    }

    public function it_is_initializable()
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
        $this->getChain()->shouldReturnAnInstanceOf(ChainInterface::class);
    }

    public function it_accepts_options()
    {
        $this->setOptions(['optionToCheck' => 2]);
        $this->getOptionToCheck()->shouldBe(2);
    }

    public function it_accepts_options_via_constructor()
    {
        $this->beConstructedWith(['optionToCheck' => 2]);
        $this->getOptionToCheck()->shouldBe(2);
    }

    public function it_can_return_options_as_string()
    {
        $this->setOptions(['optionToCheck' => 2]);
        $this->strOptionToCheck()->shouldBe('2');
    }
}
