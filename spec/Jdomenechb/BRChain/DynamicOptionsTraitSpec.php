<?php

/**
 * This file is part of the brchain package.
 *
 * (c) Jordi Domènech Bonilla
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Jdomenechb\BRChain;

use Jdomenechb\BRChain\Exception\OptionDoesNotExistException;
use Jdomenechb\BRChain\Stub\DynamicOptionsTraitStub;
use PhpSpec\ObjectBehavior;

class DynamicOptionsTraitSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf(DynamicOptionsTraitStub::class);
    }

    public function it_accepts_options_via_setOptions_for_get_methods()
    {
        $this->setOptions(['optionToCheck' => 2]);
        $this->getOptionToCheck()->shouldBe(2);
    }

    public function it_accepts_options_via_setOptions_for_is_methods()
    {
        $this->setChecked(false);
        $this->setOptions(['checked' => true]);
        $this->isChecked()->shouldBe(true);
    }

    public function it_does_not_accept_an_undefined_option()
    {
        $this->shouldThrow(OptionDoesNotExistException::class)->during('setOptions', [['undefinedOption' => 2]]);
    }

    public function it_accepts_options_via_constructor()
    {
        $this->beConstructedWith(['optionToCheck' => 2]);
        $this->getOptionToCheck()->shouldBe(2);
    }
}
